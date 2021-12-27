@include('backend.common.header')
@include('backend.common.navbar')
@include('backend.common.leftside-menu')


<style>
    .error{
        color: red !important;
    }    

    .content textarea.form-control {
        height: calc(1.5em + .9rem + 70px)!important;
        resize: none;
    }

    .write_review_modal_list {
      list-style: none;
      margin: 0;
      padding: 10px 30px;
    }
    .write_review_modal_list_item {
      padding: 10px 0;
    }
    .write_review_modal_image_container {
      display: block;
      float: left;
      width: 100%;
      padding: 0 0 12px;
    }
    .photo-container {
      width: 100%;
      padding: 0 10px;
      display: inline-block;
    }
    .flex {
      display: flex;
      flex-flow: row wrap;
    }
    .flex-item {
     float: left;
        background-color: #fff;
        margin-right: 5px;
        border-radius: 5px;
    }
    .add-phots {
      position: relative;
      display: block;
      width: 100%;
      margin-bottom: 15px;
    }

    .add-phots i
    {
            font-size: 65px;
    color: #90b944;
    margin-bottom: 17px;
    }


    .btn-up-phots {
          width: 100%;
    border-radius: 5px;
    padding: 55px 15px;
    text-align: center;
    background-color: #eee;
    display: block;
    font-size: 15px;
    font-weight: bold;
    cursor: pointer;
    color: #b0acac;
    }
    .review_modal_image {
     width: 100%;
    height: 100%;
    opacity: 0;
    position: absolute;
    left: 0;
    top: 0;
    cursor: pointer;
    }
    .options.list {
      list-style: none;
    }
    .options.list-item {
      float: left;
      padding: 5px;
    }
    .selected-btn-color{
      background-color: #5cb85c;
    }
    .phot-upld {
      position: relative;
    }
    .modal-upload-image-preview {
      width: 120px;
    float: left;
    height: 120px;
    object-fit: cover;
    border: 1px solid #ccc;
    padding: 2px;
    border-radius: 5px;
    }
    .btn.btn-remov {
      position: absolute;
      top: -3px;
      right: -2px;
    }
    .label.label-default.cstm-label {
      font-size: 12px;
    }

    .btn-remov {
    position: absolute;
    top: 10px;
    right: 9px;
    width: 20px;
    height: 20px;
    background-color: red;
    border-radius: 100px;
    color: #fff !important;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 11px;
    cursor: pointer;
    transition: all ease 0.3s;
    }

    .btn-remov:hover
    {
        background-color: #000;
        color: #fff;
    }

    /*.write_review_upload_img {
      position: relative;
      width: 24%;
      height: 120px;
      border: 1px solid #ccc;
      background-color: #eee;
      float: left;
      margin-right: 2px;
    }*/


    .col-md-4.uploaded-section {
      padding: 0 !important;
      margin: 0 !important;
      width: 105px;
    }
    .write_review_upload_img p {
      position: absolute;
      top: 45px;
      left: 10px;
      color: #999;
    }
    .write_review_upload_img .fa.fa-times {
      position: absolute;
      top: 5px;
      right: 5px;
      color: #999;
      cursor: pointer;
    }
    .star-review-table {
      width: 52%;
      text-align: left;
    }
    .star-raty > i {
      color: #F3AF4B;
    }
    .review-modal-btn-container {
      display: block;
      width: 100%;
      padding: 25px 0 0;
      text-align: center;
    }
    .review-modal-submit-btn {
      display: block;
      width: 35%;
      border: 1px solid #ccc;
      background-color: transparent;
      border-radius: 30px;
      padding: 10px;
      font-weight: 900;
      margin: 0 auto;
      color: #23527c;
    }
    /*.add-phots label.error{*/
    /*.add-phots{

        display: none!important;
    }*/
    .mydatepicker.error{
        width: 90% !important;
        float: left !important;
    }
    .error1{
      color:red;
    }
    #img_upload.error{
        width: 90% !important;
        float: left !important;
    }
    /*export button*/
    .add_btn ul.export-import.show{
        box-shadow: 0px 0px 4px #b4b4b4;
    }
    .add_btn ul.export-import.show li a{
        color: #565656;
    }
    .add_btn ul.export-import.show li{
        padding: 3px 9px;
    }
    .add_btn ul.export-import.show li:hover{
        background-color: #ddd;
    }
    .review_modal_video_css {
        width: 47%;
        height: 50px;
        opacity: 0;
        position: absolute;
        left: 27%;
        top: -4%;
        cursor: pointer;
    }
</style>

<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                 <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{url('admin/productManagement/product/product-list')}}">Product</a>
                                </li>
                                <li class="breadcrumb-item active">Edit Product</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Edit Product</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h4 class="header-title mb-3 pull-left">Edit Product</h4>  <a href="{{url('admin/productManagement/product/product-list')}}" class="btn btn-primary pull-right  mb-3">Back To Products</a>
                                    </div>
                                </div>
                            </div>
                            <form  id="edit-Product" action="{{url('admin/productManagement/product/edit-product/'.$id)}}" method="post" enctype="multipart/form-data" >
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Product Name</label>
                                            <input type="text" name="name" value="{{@$sellerProduct['name']}}" class="form-control" placeholder="Product name">
                                        </div>
                                    </div>
                                    <input type="hidden" name="product_id" value="{{$id}}">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Choose sellers</label>
                                            <div class="input-group">
                                                <select class="form-control custom-select chng_seller_forEdit_product" name="seller_id" value="" >
                                                    <option value="" selected disabled>Choose sellers</option>
                                                    @foreach($sellers as $value)
                                                        <option value="{{@$value->id}}" <?php if(isset($sellerProduct)){if(@$sellerProduct['seller_id'] == @$value->id){ echo 'selected'; }} ?>>{{@$value->buisness_name}} ({{@$value->slug}})</option>
                                                    @endforeach</select>
                                            </div>
                                        </div>
                                        <label for="seller_id" class="error"></label>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Choose Seller Categories</label>
                                            <div class="input-group">
                                                <select class="form-control custom-select category_of_seller " name="category_id" value="">
                                                   <option value="" selected disabled>Choose sellers</option>
                                                   @if(isset($sellerCategories) && !empty($sellerCategories))
                                                       @foreach($sellerCategories as $value)
                                                           <option value="{{@$value['id']}}" <?php if(isset($sellerProduct)){if(@$sellerProduct['category_id'] == @$value->id){ echo 'selected'; }} ?>>{{@$value['name']}}</option>
                                                       @endforeach
                                                   @endif
                                                </select>
                                            </div>
                                        </div>
                                        <label for="category_id" class="error"></label>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">Product Price</label>
                                            <input type="number" name="price" value="{{@$sellerProduct['price']}}" class="form-control mainPrice" placeholder="">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">Discounted Price</label>
                                            <input type="number" name="discounted_price" value="{{@$sellerProduct['discounted_price']}}" class="form-control discountedMainPrice" placeholder="Discounted Price">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Quantity</label>
                                            <input type="number" name="quantity" value="{{@$sellerProduct['quantity']}}" class="form-control" placeholder="Quantity">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Choose Unit</label>
                                            <div class="input-group">
                                                <select class="form-control custom-select" name="unit_id" value="" >
                                                    <option value="" selected disabled>Choose Unit</option>
                                                    @foreach($units as $val)
                                                        <option value="{{@$val->id}}" @if($sellerProduct['unit_id']==$val['id']) selected @endif>{{@$val->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <label for="unit_id" class="error"></label>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="">Description</label>
                                            <textarea class="form-control ckeditor" id="description_id" name="description">{{@$sellerProduct['description']}}</textarea>
                                            <label class="error" for="description"></label>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">Weight</label>
                                            <input type="number" name="weight" value="{{@$sellerProduct['weight']}}" class="form-control" placeholder="weight">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">length</label>
                                            <input type="number" name="length" value="{{@$sellerProduct['length']}}" class="form-control" placeholder="length">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Height</label>
                                            <input type="number" name="height" value="{{@$sellerProduct['height']}}" class="form-control" placeholder="height">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">width</label>
                                            <input type="number" name="width" value="{{@$sellerProduct['width']}}" class="form-control" placeholder="width">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="row itemBox">
                                            <div class="col-md-6">
                                                <!-- ////////Size/////// -->
                                                <div class="items_size items_prices mb-3">
                                                    <div class="itm_heading mb-3 d-flex align-items-center justify-content-between">
                                                       <h4 class="build_label">Size</h4>
                                                        <a href="javascript:;" class="add_more">
                                                            <i class="fa fa-plus"></i> Add Size
                                                        </a>
                                                    </div>
                                                   
                                                    <div class="size_chart">
                                                        <div class="apnnd_div">


                                                            @if(isset($sellerProduct['sellerProductSizes']))

                                                            <?php foreach ($sellerProduct['sellerProductSizes'] as $key => $val): ?>    
                                                                <div class="price_wrap main_div mb-2">
                                                                    <div class="row" part="0">
                                                                        <div class="col-lg-3">
                                                                            <label class="chart_head mb-2">size</label>
                                                                            <div class="form-group">
                                                                                <input type="text" class="form-control" id="size_{{$key}}" name="price_firsrt_append_div[{{$key}}][size]" value="{{@$val['size']}}" placeholder="size">
                                                                            </div>
                                                                        </div>
                                                                        
                                                                         <div class="col-lg-3">
                                                                            <label class="chart_head mb-2">price</label>
                                                                            <div class="form-group">
                                                                                <input type="number" id="price_{{$key}}" class="form-control priceInput appendPrice"  name="price_firsrt_append_div[{{$key}}][size_price]" value="{{@$val['size_price']}}" placeholder="price">
                                                                            </div>
                                                                        </div>
                                                                        
                                                                         <div class="col-lg-3">   
                                                                            <label class="chart_head mb-2">Discount Price</label> 
                                                                            <div class="form-group">
                                                                                <input type="number" class="form-control appendDiscountPrice" data-index="{{$key}}" id="discount_price_{{$key}}" name="price_firsrt_append_div[{{$key}}][discount_price]" value="{{@$val['discount_price']}}" placeholder="discount price">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-3">
                                                                            <label class="chart_head mb-2">Quantity</label>
                                                                            <div class="form-group"> 
                                                                                <input type="number" class="form-control" minlength="1" id="quantity_product_{{$key}}" name="price_firsrt_append_div[{{$key}}][quantity]" value="{{@$val['quantity']}}" placeholder="quantity">
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <p class="text-right mb-0">
                                                                        <a href="javascript:;" class="remove_apnd"> <i class="fa fa-times"></i> Remove</a>
                                                                    </p>
                                                                </div>
                                                              <?php endforeach ?>
                                                              @endif
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>

                                            <div class="col-md-6">
                                                <!-- ///////Color//////// -->
                                                <div class="items_size items_prices mb-3">
                                                    <div class="itm_heading mb-3 d-flex align-items-center justify-content-between">
                                                       <h4 class="build_label">Color</h4>
                                                       <a href="javascript:;" class="add_color_more">
                                                            <i class="fa fa-plus"></i> Add Color
                                                        </a>
                                                    </div>
                                                    <div class="size_chart">
                                                        <div class="apnnd_color_div">

                                                            @if(isset($sellerProduct['sellerProductColors']))
                                                             
                                                            <?php foreach ($sellerProduct['sellerProductColors'] as $key => $Color): ?>
                                                            <div class="price_wrap main_color_div mb-2">
                                                                <div class="row" part="0">
                                                                    <div class="col-lg-6">
                                                                        <label class="chart_head mb-2">Color Name</label>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control"  name="color_firsrt_append_div[{{$key}}][name]" value="{{$Color['name']}}" placeholder="color name">
                                                                        </div>
                                                                    </div>
                                                                    
                                                                     <div class="col-lg-6">
                                                                        <label class="chart_head mb-2">Color Code</label>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control"  name="color_firsrt_append_div[{{$key}}][color_code]" value="{{$Color['color_code']}}" placeholder="color code">
                                                                        </div>
                                                                    </div>

                                                                </div>                                      

                                                                <p class="text-right mb-0">
                                                                    <a href="javascript:;" class="remove_color_apnd"> <i class="fa fa-times"></i> Remove</a>
                                                                </p>

                                                            </div>
                                                            <?php endforeach ?>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>   
                                        </div>
                                    </div>
                                    
                                    <!--START DROPZONE IMAGE -->

                                         @if(!empty($sellerProduct['sellerProductImages'])) 
                                        <div class="col-md-12">
                                             <div class="form-group uploadimg">
                                                 <label for="lname34" class="text-left control-label col-form-label">Uploaded Images</label>
                                                     @foreach($sellerProduct['sellerProductImages'] as $key => $value)
                                                         <?php  
                                                             $image = 'javascript:;';
                                                             if(!empty($value['image'])) { 
                                                                 if(file_exists(public_path('frontend/assets/img/product/'.$value['image']))) {
                                                                     $image = asset('frontend/assets/img/product/'.$value['image']);
                                                                 }else{
                                                                     $image = asset('frontend/images/default.jpg');
                                                                 }
                                                             }else{
                                                                 $image = asset('frontend/images/default.jpg');
                                                             }
                                                             $count = count($sellerProduct['sellerProductImages']);
                                                         ?>
                                                         <div class="flex-item cal_image_length">
                                                             <div class="phot-upld">
                                                                 @if($count>1)
                                                                 <a href="{{ url('admin/productManagement/product/image/delete/'.$value['id']) }}" title="Delete" class="btn btn-remov del_btn">
                                                                 <i class="fa fa-times" style="float:right"></i>
                                                                 </a>
                                                                 @endif
                                                                 <a href="{{$image}}" target="_blank"> 
                                                                     <img src="{{$image}}"  width="120px" height="120px"  class="img-responsive modal-upload-image-preview">
                                                                 </a>
                                                             </div>
                                                         </div>
                                                     @endforeach
                                                 </div>
                                             </div>
                                         @endif

                                     <div class="col-md-12">
                                        <div class="form-group uploadimg">
                                            <label for="lname12" class="control-label col-form-label"></label>
                                            <div class="write_review_modal_image_container rvw_upld">
                                                <div class="add-phots">
                                                    <a href="javascript:void(0);" class="btn-up-phots" id="upld-gal"><i class="fa fa-upload" aria-hidden="true"></i> <span class="d-block"> Upload new Image </span></a>
                                                    <input type="file" name="images[]" id="id_proof" class="review_modal_image id_proof_document rem0" multiple  accept="image/*">
                                                </div>
                                                <div class="photos-sec photos-sec_image">
                                                    <div class="flex image_upload_class image_class">
                                                     </div>
                                                    <span id="img-error" style="color: red;"></span>
                                                </div>
                                            </div>    
                                        </div>
                                    </div>   
                                    <!--END DROPZONE OMAGE -->
                                    
                                    <div class="col-12 text-left">
                                        <button type="submit" class="btn btn-success waves-effect waves-light"> <i class="fe-check-circle mr-1"></i> Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card-->
            </div>
            <!-- end col-->
        </div>
        <!-- end row-->
    </div>
    <!-- container -->
</div>
<!-- content -->
<!-- Header -->
@include('backend.common.footer')


<script type="text/javascript"> 
    var seller_id = $('.chng_seller_forEdit_product').val();
    renderData(seller_id);
    
    $(document).on('change','.chng_seller_forEdit_product',function(){
       var seller_id = $(this).val();
        renderData(seller_id)
    });

    function renderData(seller_id){
        var product_id = {{$id}};
        $.ajax({
            url:"{{url('admin/productManagement/product/render-category-for-edit')}}",
            data:{ product_id:product_id,seller_id:seller_id,_token:"{{ csrf_token() }}" },
            type:'POST',
            success:function(data){
             console.log(data);
             $('.category_of_seller').html(data);
            } 
        }); 
    }

</script>

<script type="text/javascript">
    
    $(document).on('click', '.add_more', function(){
        var len = $('.main_div').length + 1;
        $('.remove_apnd').hide();
        
        $('.more_prc_inpt').prop('readonly', true);

        $('.apnnd_div').append('<div class="price_wrap main_div mb-2"><div class="row" part="'+len+'"><div class="col-lg-3"> <label class="chart_head mb-2">size</label><div class="form-group"> <input type="text" class="form-control" id="size_'+len+'" name="price_firsrt_append_div['+len+'][size]" value="" placeholder="size"></div></div><div class="col-lg-3"> <label class="chart_head mb-2">price</label><div class="form-group"> <input type="number" class="form-control priceInput appendPrice" id="price_'+len+'" name="price_firsrt_append_div['+len+'][size_price]" value="" placeholder="price"></div></div><div class="col-lg-3"> <label class="chart_head mb-2">Discount Price</label><div class="form-group"> <input type="number" class="form-control appendDiscountPrice" data-index="'+len+'"  id="discount_price_'+len+'" name="price_firsrt_append_div['+len+'][discount_price]" value="" placeholder="discount price"></div></div> <div class="col-lg-3"> <label class="chart_head mb-2">Quantity</label><div class="form-group"> <input type="number" class="form-control" minlength="1" id="quantity_product_'+len+'" name="price_firsrt_append_div['+len+'][quantity]" value="" placeholder="quantity"></div></div> </div><p class="text-right mb-0"> <a href="javascript:;" class="remove_apnd"> <i class="fa fa-times"></i> Remove</a></p></div>');

        if (len==0) {
            $('.remove_apnd').hide();
        }
       
        $("input[id^=size_").each(function(){
            $(this).rules("add", {
                required: true,
                // digits: true,
                messages: {
                    required: "Please enter size",
                }
            });   
        });

        $(".appendPrice").each(function(){
            $(this).rules("add", {
                required: true,
                digits: true,
                messages: {
                    required: "Please enter price",
                }
            });   
        });

        $(".appendDiscountPrice").each(function(){

            $.validator.addMethod('priceGrtrDscPrice', function(value,elm) {
                var indexNumber = $(elm).attr('data-index');
                var priceId = "#price_"+indexNumber;
                console.log(indexNumber,priceId,$(priceId).val());
                if(value=='') return true;
                return parseFloat(value) < $(priceId).val();
            }, 'Discounted price should be less then product price');

            $(this).rules("add", {
                priceGrtrDscPrice: true,
                messages: {
                    required: "Please enter discount price",
                }
            });   
        });

        $("input[id^=quantity_product_").each(function(){
            $(this).rules("add", {
                required:true,
                digits: true,
                min: 1,
                messages: {
                    required: "Please enter quantity",
                }
            });   
        });

        // $.validator.addMethod('appendValidationSize', function(value,e) {
        //     console.log($(this).attr("id"));
        //     if(value=='') return true;
        //     return parseFloat(value) < $(e).parents('.price_wrap').find('.priceInput').val();
        // }, 'Discount price should less then price');

        // $("input[id^=discount_price_").each(function(){
        //         console.log($(this).attr("id"));

        //     $(this).rules("add", {
        //         required: true,
        //         digits: true,
        //         appendValidationSize:true,
        //         messages: {
        //             required: "Please enter discount_price",
        //         }
        //     });   
            
        // });
       
    }); 

    $("body").on('click', '.remove_apnd', function(){
        $(this).parents('.main_div').remove();
        var lengt = $('.main_div').length;
        if (lengt>1) {
            $('.main_div').last().find('.remove_apnd').show();
        }
    });
</script>

<script type="text/javascript">
    
    $(document).on('click', '.add_color_more', function(){
        var len_color = $('.main_color_div').length;

        $('.remove_color_apnd').hide();
        $('.apnnd_color_div').append('<div class="price_wrap main_color_div mb-2"><div class="row" part="'+len_color+'"><div class="col-lg-6"> <label class="chart_head mb-2">Color Name</label><div class="form-group"> <input type="text" class="form-control" id="name_'+len_color+'" name="color_firsrt_append_div['+len_color+'][name]" value="" placeholder="color name"></div></div><div class="col-lg-6"> <label class="chart_head mb-2">Color Code</label><div class="form-group"> <input type="text" class="form-control" id="color_code_'+len_color+'" name="color_firsrt_append_div['+len_color+'][color_code]" value="" placeholder="color code"></div></div></div><p class="text-right mb-0"> <a href="javascript:;" class="remove_color_apnd"> <i class="fa fa-times"></i> Remove</a></p></div>');

        if (len_color==0) {
            $('.remove_color_apnd').hide();
        }
       
        $("input[id^=name_").each(function(){
            $(this).rules("add", {
                required: true,
                messages: {
                    required: "Please enter name",
                }
            });   
        });

        $("input[id^=color_code_").each(function(){
            $(this).rules("add", {
                required: true,
                messages: {
                    required: "Please enter color_code",
                }
            });   
        });

    }); 

    $(document).on('click', '.remove_color_apnd', function(){
        $(this).parents('.main_color_div').remove();
        var lengt = $('.main_color_div').length;
        if (lengt>1) {
            $('.main_color_div').last().find('.remove_color_apnd').show();
        }
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $.validator.addMethod('AgeGrtrEighteen', function(value) {
            if(value=='') return true;
            return parseFloat(value) < $('.mainPrice').val();
        }, 'Discounted price should be less then product price');
                       
        $('#edit-Product').validate({
            ignore: [],
            debug: false,
            rules: {
                "name": {
                    required: true
                },
                "seller_id": {
                    required: true
                },
                "category_id": {
                    required: true
                },
                "price":{
                    required:true
                },
                "discounted_price":{
                    AgeGrtrEighteen: true
                },
                "quantity":{
                    required:true,
                    digits: true
                },
                "unit_id": {
                    required: true
                },
                "description":{
                    required:true,
                    minlength:20
                },
                "weight":{
                    required:true,
                    digits: true
                    // min: 1
                },
                "length":{
                    required:true,
                    digits: true
                    // min: 1
                },
                "height":{
                    required:true,
                    digits: true
                    // min: 1
                },
                "width":{
                    required:true,
                    digits: true
                    // min: 1
                },

                // description: {
                //     required: function(textarea) {
                //     CKEDITOR.instances[textarea.id].updateElement();
                //     var editorcontent = textarea.value.replace(/<[^>]*>/gi, '');
                //     return editorcontent.length === 0;
                // },

                // "price_firsrt_append_div[0][size]":{
                //     required:true
                // },
                // "price_firsrt_append_div[0][size_price]":{
                //     required:true,
                //     digits: true
                // },

                // "color_firsrt_append_div[0][name]":{
                //     required:true
                // },
                // "color_firsrt_append_div[0][color_code]":{
                //     required:true
                // },
                // "images[]":{
                //     min:1
                // },
            },
            messages: {
                "name": {
                    required: "Please enter your name"
                },
                "category_id": {
                    required: "Please enter your category"
                },
                "seller_id":{
                    required:"Please select seller"
                },
                "price": {
                    required: "Plaese enter price"
                },
                "quantity": {
                    required: "Plaese enter quantity"
                },  
                "discounted_price": {
                    required: "Plaese enter discounted price"
                },
                "unit_id": {
                    required: "Plaese select unit"
                },
                "description":{
                    required:"Please enter description",
                    minlength:"Description must contain 20 characters"
                },
                "weight": {
                    required: "Please enter weight"
                },
                "length": {
                    required: "Please enter length"
                },
                "height": {
                    required: "Please enter height"
                },
                "width": {
                    required: "Please enter width"
                },

                // "price_firsrt_append_div[0][size]":{
                //     required:"Please enter size"
                // },
                // "price_firsrt_append_div[0][size_price]":{
                //     required:"Please enter size price"
                // },
                // "price_firsrt_append_div[0][discount_price]":{
                //     required:"Please enter discount price"
                // },

                // "color_firsrt_append_div[0][name]":{
                //    required:"Please enter size"
                // },
                // "color_firsrt_append_div[0][color_code]":{
                //    required:"Please enter size"
                // },

                // "images[]":{
                //    min:"Please select atleat 1 image"
                // },
            },
       
        });
    });
    
    $(document).ready(function(){

        $(".appendDiscountPrice").each(function(){
            $.validator.addMethod('priceGrtrDscPrice', function(value,elm) {
                var indexNumber = $(elm).attr('data-index');
                var priceId = "#price_"+indexNumber;
                console.log(indexNumber,priceId,$(priceId).val());
                if(value=='') return true;
                return parseFloat(value) < $(priceId).val();
            }, 'Discounted price should be less then product price');
            $(this).rules("add", {
                priceGrtrDscPrice: true,
                messages: {
                    required: "Please enter discount price",
                }
            });   
        });

        $("input[id^=size_").each(function(){
           $(this).rules("add", {
                required: true,
                // digits: true,
                messages: {
                   required: "Please enter size",
               }
            });   
        });

        $(".appendPrice").each(function(){
            $(this).rules("add", {
                required: true,
                digits: true,
                messages: {
                   required: "Please enter price",
               }
            });   
        });

       
        $("input[id^=quantity_product_").each(function(){
            $(this).rules("add", {
                required:true,
                digits: true,
                min: 1,
                messages: {
                   required: "Please enter quantity",
               }
            });   
        });
    })

</script>

<script type="text/javascript">
    var inc_val = 0;
    $(document).on('change','.review_modal_image', function () {

        var input = this;
        console.log(input);
        var this_addr = $(this);
        var extension = this_addr.val().split('.').pop().toLowerCase();

        var reader = new FileReader();
        reader.onload = function(){
            var dataURL = '';
            if((extension=='jpg' || extension=='jpeg' || extension=='png')){
                dataURL = reader.result;
            }else{
                swal({
                  title: "This file Type is not valid",
                  text: "Only jpg,jpeg,png file type is supported",
                  icon: "warning",
                  buttons: "Ok", 
                  dangerMode: true,
                }).then((okay) => {
                    if (okay) {
                        return false;
                    }else{
                        return false;
                    }
                });

                return false;
            }      
            var output = $('.phot-upld img');
            output.src = dataURL;
            
            var cal_image_length = $('.cal_image_length').length;
            // alert(cal_image_length);

            var len = $('.photos-sec_image > .flex > div').length;
            var len = len + cal_image_length;
            console.log(len);
           
            if (len <= 19) {
                $('#img-error').text('');
                $('.photos-sec> .image_class').append('<div class="flex-item uploaded-section"><div class="phot-upld"><img src="'+ dataURL +'" class="img-responsive modal-upload-image-preview" /><a class="btn btn-remov"  data-toggle="tooltip" title="Delete Image" inpt-id="'+inc_val+'"><i class="fa fa-times"></i></a></div></div>');
                this_addr.off('change');
                inc_val++;
                if (len<=19) {
                    this_addr.after('<input type="file" name="images['+inc_val+']" class="review_modal_image rem'+inc_val+' id_proof">');
                }
            }else{
                $('#img-error').text("Maximum 20 files can be uploaded");
            }                    
            
           
            $('.btn-remov').on('click',function(){
                $(this).closest('.uploaded-section').remove();
                var rem_id = $(this).attr('inpt-id');
                $('.rem'+rem_id).remove();
                if ($('.photos-sec > .flex > div').length < 20 ) {
                    $('#img-error').text('');
                }else{
                    $('#img-error').text("Maximum 20 files can be uploaded");
                }
            });
        };        
        reader.readAsDataURL(input.files[0]);
    });
</script>