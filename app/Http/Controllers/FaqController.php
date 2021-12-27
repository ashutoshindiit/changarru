<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests, DB, Session, Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\Admin;
use App\Models\User;
use App\Models\Country;
use App\Models\Job;
use App\Models\JobImage;
use App\Models\TypeOfWork;
use App\Models\Language;
use App\Models\JobServiceProvide;
use App\Models\Subscription;
use App\Models\Privacy;
use App\Models\Term;
use App\Models\UserBooking;
use App\Models\contactUs;
use App\Models\AdminContactInformation;
use DataTables;
use Exception;
use Auth;
use Crypt;
use Config;
use App\Models\AdminAboutUsInformation;
use App\Traits\ImagesTrait;
use App\Models\Faq;

class FaqController extends Controller
{


    public function indexFaq(Request $request)
    {
        $faqs = Faq::orderBy('id', 'desc')->get();
        $page = 'faq';
        return view('backend.faq.list', compact('faqs','page'));
    }

     public function add(Request $request,$id = ''){
         if(!empty($id)){
             $faq = Faq::find($id);
         }else{
            $faq = new Faq();
         }

        if ($request->isMethod('post')) {
            $input = $request->all();

            $validator = $this->validate($request,  [
                        'title'         => 'required|unique:faqs,title,'.$id,
                        'description'   => 'required',
                    ]
                );  
            // dd($input);   
            $faq->title        = @$input['title'];
            $faq->description  = @$input['description'];
            if($faq->save()){
                $description = ($id?'Updated':'Added').' the blog category '.$faq->title;
                if($request->ajax()){
                    if(empty($id)){
                        return array('code' => 700, 'message' => 'Faq added successfully', 'id' => $faq->id);
                    }else{
                        \Session::flash('success','Faq '.($id?'updated':'added').' Successfully.');    
                         return array('code' => 600, 'message' => 'Faq added successfully', 'url' => url('admin/faqs'), 'status'=> 'Success');
                    }
                } 
                \Session::flash('success','Faq '.($id?'updated':'added').' Successfully.');    
                return redirect('/admin/faqs');   
            }
        }
        // dd($faq,$id);
        return view('backend.faq.add', compact('faq', 'id'));
    }

    public function deleteFaq($id, Request $request)
    {
        $response = [];

        $data= Faq::where('id', $id)->first();
        if(!empty($data)){
            Faq::where('id', $id)->delete();
            Session::flash('success', 'Faq deleted successfully');
            $response['msg'] = 'true';
        }else{
            $response['msg'] = 'false';
        }
        return $response;
    }
}
