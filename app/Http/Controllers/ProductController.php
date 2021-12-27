<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Session, Response,Validator;
use Auth;
use Crypt;
use Config;
use DataTables;
use App\Models\Admin;
use Exception;
use App\Traits\ImagesTrait;
use App\Models\User;
use App\Models\Order;
use App\Models\BuisnessCategory;
use App\Models\UserAddress;
use App\Models\UserSupport;
use App\Models\Seller;
use App\Models\SellerProduct;
use App\Models\SellerProductSize;
use App\Models\SellerCategory;
use App\Models\SellerProductColor;
use App\Models\SellerImage;
use App\Models\Unit;
use App\Models\SellerDiscountCoupon;
use File;
use Image; //Intervention Image
use Illuminate\Support\Facades\Storage; //Laravel Filesystem

class ProductController extends Controller
{
    use ImagesTrait;

    public function productList(Request $request){
        
        $sellerProductPaginate = SellerProduct::with('sellerProductColors','sellerProductSizes','sellerInfo','sellerProductImages','sellerUnit','sellerCategory')
                                            ->orderBy('id','DESC')
                                             ->paginate(10);
                                             // ->get();


       // dd($sellerProductPaginate); 

        $page = "product";
        return view('backend.products',compact('page','sellerProductPaginate'));
    }

    public function addProduct(Request $request){
        if($request->isMethod('post')){
            $payload = $request->except('_token');

            // dd($payload);
            $slug = str_slug($payload['name']);
            $oldslug = $slug;

            $count = 1;
            while (SellerProduct::where('product_slug',$slug)->exists()) {
               $slug = $oldslug.'-'.$count;
               $count++;   
            }
            $main_price = '';
            if($payload['discounted_price']){
                $main_price = $payload['discounted_price'];
            }else{
                $main_price = $payload['price'];
            }
            $productId = SellerProduct::create([
                'name'               =>@$payload['name'], 
                'seller_id'          =>@$payload['seller_id'],                    
                'category_id'        =>@$payload['category_id'],
                'price'              =>@$payload['price'],
                'discounted_price'   =>@$payload['discounted_price'],
                'main_price'         => $main_price,
                'quantity'           =>@$payload['quantity'],
                'unit_id'            =>@$payload['unit_id'],
                'weight'             =>@$payload['weight'],
                'length'             =>@$payload['length'],
                'height'             =>@$payload['height'],
                'width'              =>@$payload['width'],                
                'description'        =>@$payload['description'],
                'product_slug'       =>@$slug
           ])->id;

           if (isset($payload['price_firsrt_append_div']) && sizeof($payload['price_firsrt_append_div'])>0) {
               foreach ($payload['price_firsrt_append_div'] as $key => $sizeData) {
                   if (!empty($sizeData)) {
                       SellerProductSize::Create([
                                    'seller_id'      => @$payload['seller_id'], 
                                    'product_id'     => @$productId,
                                    'size_price'     => @$sizeData['size_price'],  
                                    'size'           => @$sizeData['size'],  
                                    'discount_price' => @$sizeData['discount_price'],
                                    'quantity'       => @$sizeData['quantity']  
                                ]);
                   }
               }
           }

           if (isset($payload['color_firsrt_append_div']) && sizeof($payload['color_firsrt_append_div'])>0) {
               foreach ($payload['color_firsrt_append_div'] as $key => $colorData) {
                   if (!empty($colorData)) {
                       SellerProductColor::Create([
                             'seller_id'      => @$payload['seller_id'], 
                             'product_id'     => @$productId,
                             'name'           => @$colorData['name'],  
                             'color_code'     => @$colorData['color_code']
                           ]);
                   }
               }
           }
                        // dd($payload['images']);

           if(isset($payload['images'])){
               foreach ($payload['images'] as $key => $val) {
                   $image = isset($val) && !empty($val) ? $val:'';  
                    $imageThumbnail = isset($val) && !empty($val) ? $val:'';  

                    if($image){ 
                        $directory = 'frontend/assets/img/product';
                        $type = 'logo';
                        $imagedata = $this->uploadimage($directory,$type, $image, '');
                        if(isset($imagedata) && $imagedata != ''){
                           $image = $imagedata['image'];
                        }
                    }
                    $new_file = url('/').'/frontend/assets/img/product/'.$image; 
                    // Thumbnail image
                    if ($new_file) {
                        $profile = preg_replace('/\..+$/', '', $imageThumbnail->getClientOriginalName()).time().'.'.$imageThumbnail->getClientOriginalExtension();
                        $img_thmbnail = $this->resizeImage($new_file,$profile);
                    }
                    SellerImage::create([
                        'product_id'      => @$productId,
                        'image'           => @$image,
                        'thumbnail_image' => @$img_thmbnail
                    ]);
               }
           }

           Session::flash('success', 'Product added successfully');
           return redirect('/admin/productManagement/product/product-list');
       }

        $sellerProductSizes     = SellerProductSize::orderBy('id','DESC')->get();
        $sellerProductColors    = SellerProductColor::orderBy('id','DESC')->get();
        $units                  = Unit::orderBy('id','DESC')->get();
        // dd($units);
        $sellers          = Seller::orderBy('id','DESC')->get();
        $sellerCategories = SellerCategory::orderBy('id','DESC')->get();
        $page             = "product";
        return view('backend.addProduct',compact('page','sellers','sellerCategories','units'));
    }

    ///Edit Product
    public function resizeImage($file, $fileNameToStore) {
        // Resize image
        $resize = Image::make($file)->resize(100, null, function ($constraint) {
           $constraint->aspectRatio();
        })->encode('jpg');

        // $image =[];
        // Create hash value
        $hash = md5($resize->__toString());
        $image = $hash."jpg";
        $save = Storage::put("product-images/".$fileNameToStore, $resize->__toString());
        // dd($fileNameToStore);
        if($save) {

            return $fileNameToStore;
        }

        return false;
    }

    public function editProduct(Request $request,$id){
            if($request->isMethod('post')){
                $payload = $request->except('_token');
                SellerProductSize::where('product_id',$payload['product_id'])->delete();
                SellerProductColor::where('product_id',$payload['product_id'])->delete();
                $main_price = '';
                if($payload['discounted_price']){
                    $main_price = $payload['discounted_price'];
                }else{
                    $main_price = $payload['price'];
                }
                $productId = SellerProduct::where('id',$payload['product_id'])
                                            ->update([
                                                    'name'               =>@$payload['name'], 
                                                    'seller_id'          =>@$payload['seller_id'],                    
                                                    'category_id'        =>@$payload['category_id'],
                                                    'price'              =>@$payload['price'],
                                                    'discounted_price'   =>@$payload['discounted_price'],
                                                    'main_price'         =>@$main_price,
                                                    'quantity'           =>@$payload['quantity'],
                                                    'unit_id'            =>@$payload['unit_id'],
                                                    'weight'             =>@$payload['weight'],
                                                    'length'             =>@$payload['length'],
                                                    'height'             =>@$payload['height'],
                                                    'width'              =>@$payload['width'],                                                   
                                                    'description'        =>@$payload['description']
                                               ]);

                if (isset($payload['price_firsrt_append_div']) && sizeof($payload['price_firsrt_append_div'])>0) {
                    
                    $main_price1 = '';
                    if($payload['price_firsrt_append_div'][0]['discount_price']){
                        $main_price1 = $payload['price_firsrt_append_div'][0]['discount_price'];
                    }else{
                        $main_price1 = $payload['price_firsrt_append_div'][0]['size_price'];
                    }

                    SellerProduct::where('id',$payload['product_id'])->update(['main_price' =>@$main_price1]);

                   foreach ($payload['price_firsrt_append_div'] as $key => $sizeData) {
                       if (!empty($sizeData)) {
                           SellerProductSize::Create([
                                                'seller_id'      => @$payload['seller_id'], 
                                                'product_id'     => @$payload['product_id'],
                                                'size_price'     => $sizeData['size_price'],  
                                                'size'           => $sizeData['size'],  
                                                'discount_price' => $sizeData['discount_price'],
                                                'quantity'       => $sizeData['quantity']    
                                               ]);
                       }
                   }
               }

               if (isset($payload['color_firsrt_append_div']) && sizeof($payload['color_firsrt_append_div'])>0) {
                   foreach ($payload['color_firsrt_append_div'] as $key => $colorData) {
                       if (!empty($colorData)) {
                           SellerProductColor::Create([
                                                     'seller_id'      => @$payload['seller_id'], 
                                                     'product_id'     => @$payload['product_id'],
                                                     'name'           => @$colorData['name'],  
                                                     'color_code'     => @$colorData['color_code']
                                                   ]);
                       }
                   }
               }

               // images

               // dd($jobImageCount);
               $jobImageCount = SellerImage::where('product_id',$id)->count();
               if($jobImageCount<5){
                   if(isset($payload['images'])){               
                       foreach ($payload['images'] as $key => $val) {
                            $image = isset($val) && !empty($val) ? $val:'';
                            $imageThumbnail = isset($val) && !empty($val) ? $val:'';  
                            
                            if($image){ 
                              $directory = 'frontend/assets/img/product';
                              $type = 'logo';
                              $imagedata = $this->uploadimage($directory,$type, $image, '');
                                if(isset($imagedata) && $imagedata != ''){
                                    $image = $imagedata['image'];
                                }
                            }

                            $new_file = url('/').'/frontend/assets/img/product/'.$image; 
                            // Thumbnail image
                            if ($new_file) {
                                $profile = preg_replace('/\..+$/', '', $imageThumbnail->getClientOriginalName()).time().'.'.$imageThumbnail->getClientOriginalExtension();
                                $img_thmbnail = $this->resizeImage($new_file,$profile);
                            }

                            SellerImage::create([
                                   'product_id'      => @$payload['product_id'],
                                   'image'           => @$image,
                                   'thumbnail_image' => @$img_thmbnail
                                ]);
                       }
                   }     
               }

               Session::flash('success', 'Product updated successfully');
               return redirect('/admin/productManagement/product/product-list');
           }
            $sellerProduct = SellerProduct::where('id',$id)
                                        ->with('sellerInfo','sellerProductImages','sellerUnit','sellerCategory','sellerProductSizes','sellerProductColors')
                                        ->first();

            $sellerProductSizes     =   SellerProductSize::orderBy('id','DESC')
                                                    ->get();
            // dd($sellerProductSizes,$sellerProduct);                                    

            $sellerProductColors    = SellerProductColor::orderBy('id','DESC')->get();
            $units                  = Unit::orderBy('id','DESC')->get();
            $sellers                = Seller::orderBy('id','DESC')->get();
            $sellerCategories       = SellerCategory::orderBy('id','DESC')->get();
            $page                   = "product";
            // dd('here');
            return view('backend.edit-product',compact('page','sellers','sellerCategories','units','sellerProduct','id'));
    }


    public function productDelete(Request $request,$id)
    {
        $input =$request->all();
        
        $response = [];
        $SellerProducts = SellerProduct::pluck('id');

        $SellerProduct = SellerProduct::find($input['id']);
        // dd($SellerProducts,$SellerProduct);
        if($SellerProduct){
            SellerProductSize::where('product_id',$request->id)
                                ->delete();

            SellerProductColor::where('product_id',$request->id)
                                ->delete();

            SellerProduct::find($request->id)->delete();
            
            $response['msg'] = 'true';
        }else{
            $response['msg'] = 'false';
        }
        return $response;
    }

    public function deleteProductImage($product_image_id){
        $product_img = SellerImage::find($product_image_id);    
        $destination     = base_path().'/'.asset('frontend/images/jobs/');

        if (file_exists(public_path('frontend/assets/img/product/'.$product_img['image']))){
            unlink(public_path('frontend/assets/img/product/'.$product_img['image']));
        }   
        $product_img_del = SellerImage::where('id',$product_image_id)->delete();

        if ($product_img_del){
            return redirect()->back()->with('success','product image deleted successfully');
        }
        else{
            return redirect()->back()->with('error','Something went wrong');
        }
    }


    public function renderCategory (Request $request){
        $payload = $request->all();
        $sellerCategories = SellerCategory::where('seller_id',$payload['seller_id'])
                                            ->orderBy('name', 'asc')
                                            ->get();
        return view('backend.render.sellerCategory', ['sellerCategories' => $sellerCategories])->render();
    }

    public function renderCategoryForEditProduct (Request $request){
        $payload = $request->all();
        $sellerCategories = SellerCategory::where('seller_id',$payload['seller_id'])
                                            ->orderBy('name', 'asc')
                                            ->get();

        $sellerProduct = SellerProduct::where('id',$payload['product_id'])
                                    ->with('sellerInfo','sellerProductImages','sellerUnit','sellerCategory','sellerProductSizes','sellerProductColors')
                                    ->first();

                                    
        return view('backend.render.sellerCategory', ['sellerProduct'=>$sellerProduct,'sellerCategories' => $sellerCategories])->render();
    }

    public function productCategoryList(Request $request){
        $sellerCategories = SellerCategory::paginate(10);;
        $page = "productCategory";
        return view('backend.productCategory',compact('sellerCategories'));
    }

    public function addProductCategory(Request $request){
        if($request->isMethod('post')){
            $payload = $request->except('_token');
            // dd($payload);

            $image = isset($payload['image']) && !empty($payload['image']) ? $payload['image']:'';  

            if(isset($payload['image'])){
                if($image){ 
                  $directory = 'frontend/assets/img/productCategoryImage';
                  $type = 'logo';
                  $imagedata = $this->uploadimage($directory,$type, $image, '');
                    if(isset($imagedata) && $imagedata != ''){
                        $image = $imagedata['image'];
                    }
                }
                if($payload['image'] != null && file_exists('frontend/assets/img/productCategoryImage'.'/'.$payload['image']) ) {
                    unlink('frontend/assets/img/productCategoryImage'.'/'.$payload['image']);
                }
            }

            SellerCategory::create([
                            'name'          => @$payload['name'],
                            'seller_id'     => @$payload['seller_id'],
                            'image'         => @$image
                        ]);   

            Session::flash('success', 'Product Category added successfully');
            return redirect('/admin/productManagement/category/category-list'); 
        }

        $sellers          = Seller::get();
        $sellerCategories = SellerCategory::get();
        $page = "productCategory";
        return view('backend.addProductCategory',compact('sellerCategories','sellers'));
    }

    public function editProductCategory(Request $request,$id){
        if($request->isMethod('post')){
            $payload = $request->except('_token');
            
            $image = isset($payload['image']) && !empty($payload['image']) ? $payload['image']:'';  

            if(isset($payload['image'])){
                if($image){ 
                  $directory = 'frontend/assets/img/productCategoryImage';
                  $type = 'logo';
                  $imagedata = $this->uploadimage($directory,$type, $image, '');
                    if(isset($imagedata) && $imagedata != ''){
                        $imageCategory = $imagedata['image'];
                    }
                }
                if($payload['image'] != null && file_exists('frontend/assets/img/productCategoryImage'.'/'.$payload['image']) ) {
                    unlink('frontend/assets/img/productCategoryImage'.'/'.$payload['image']);
                }
            }
            // dd($sellerCategories);                                    

            SellerCategory::where('id',$id)->update([
                            'name'          => @$payload['name'],
                            'seller_id'     => @$payload['seller_id'],
                            'image'         => @$imageCategory
                        ]);  
         
            Session::flash('success', 'Product Category updated successfully');
            return redirect('/admin/productManagement/category/category-list'); 
        }
        $sellers          = Seller::get();
        $sellerCategories = SellerCategory::with('seller')
                                            ->where('id',$id)
                                            ->first();
        $page = "productCategory";
        return view('backend.editProductCategory',compact('sellerCategories','sellers','id'));
    }

    public function deleteProductCategory(Request $request)
    {
        $data = $request->all();
        $response = [];
        $user = SellerCategory::where('id',$data['id'])->first();
        // dd($data);                        
        if($user){
            SellerCategory::where('id',$data['id'])
                    ->delete();

            $response['msg'] = 'true';
        }else{
            $response['msg'] = 'false';
        }
        return $response;
    }

}
