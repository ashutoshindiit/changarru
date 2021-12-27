<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests, DB, Session, Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Auth;
use Crypt;
use Config;
use DataTables;
use App\Models\Admin;
use Exception;
use App\Models\TermAndCondtion;
use App\Models\PrivacyPolicy;
use App\Models\Page;



class PageController extends Controller
{

    public function getPagesList(Request $request){
        $allPage = Page::where('type','admin')
                        ->orderby('created_at', 'desc')
                        ->get();
                        
        $page='page';
        return view('backend.pages',compact('page','allPage'));        
    }

    public function addPage(Request $request){
        if($request->isMethod('post')){
            $input = $request->all();
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->title)));
            $pageId = Page::create([
                        'type'          =>'admin',
                        'user_id'       =>Auth::guard('admin')->user()->id,
                        'page_name'     =>$slug,
                        'title'         =>$request->title,
                        'description'   =>$request->description_id,                
                    ])->id;

            if($pageId){
                return redirect('admin/pages/list')->with('success','Page Added successfully');
            }else{
                Session::flash('error','Something went wrong');
                return redirect()->back();
            }
        }    
        $page='page';
        return view('backend.addPage',compact('page'));        
    }

    public function editPage(Request $request,$id){
        if($request->isMethod('post')){
            $payload = $request->except('_token');
            $sellerUpdate = Page::where('id',$id)->where('type','admin')
                                                 ->update([
                                                    'description'     =>$payload['description'],
                                                    'title'           =>$payload['title']
                                                ]);
            Session::flash('success', 'Page updated successfully');
            return redirect('/admin/pages/list');
        
        }
        // dd('here');
        $pageData = Page::where('id',$id)->first();
        return view('backend.editPage',compact('id','pageData'));
    }

    public function pageDelete(Request $request,$id){
        $response = [];
        $user = Page::where('id',$id)->first();
        if($user){
            Page::find($id)->delete();
            $response['msg'] = 'true';
        }else{
            $response['msg'] = 'false';
        }
        return $response;
    }

    public function termsCondtion(Request $request){
        if($request->isMethod('post')){
            $input = $request->all();
            $update = TermAndCondtion::first();   
            if(!empty($update)){
                $update->title         = $request->title;
                $update->description   = $request->description_id;

                 if ($update->save()){             
                      return redirect('admin/pages/list')->with('success','Terms & Condtions updated successfully');
                 }else{
                    Session::flash('error','Something went wrong');
                    return redirect()->back();
                }
            }
        }   
        $terms_condition = TermAndCondtion::orderby('created_at', 'desc')->first();
        $page='page';
        return view('backend.terms', compact('terms_condition','page'));
    }
    
    public function privacyPolicy(Request $request){
        if($request->isMethod('post')){
            $input  = $request->all();
            $update = PrivacyPolicy::first();   
            if(!empty($update)){
                $update->title         = $request->title;
                $update->description   = $request->description_id;
                 if ($update->save()){             
                      return redirect('admin/pages/list')->with('success','Privacy Policy updated successfully');
                 }else{
                    Session::flash('error','Something went wrong');
                    return redirect()->back();
                }
            }
        }   
        $privacyPolicy = PrivacyPolicy::orderby('created_at','desc')->first();
        $page='page';
        return view('backend.privacyPolicy', compact('privacyPolicy','page'));
    }
    // public function getPagesList(Request $request){
    //     $page='page';
    //     return view('backend.pages',compact('page'));        
    // } 

    // public function termsCondtion(Request $request){
    //     if($request->isMethod('post')){
    //         $input = $request->all();
    //         $update = TermAndCondtion::first();   
    //         if(!empty($update)){
    //             $update->title         = $request->title;
    //             $update->description   = $request->description_id;

    //              if ($update->save()){             
    //                   return redirect('admin/pages/list')->with('success','Terms & Condtions updated successfully');
    //              }else{
    //                 Session::flash('error','Something went wrong');
    //                 return redirect()->back();
    //             }
    //         }
    //     }   
    //     $terms_condition = TermAndCondtion::orderby('created_at', 'desc')->first();
    //     $page='page';
    //     return view('backend.terms', compact('terms_condition','page'));
    // }
    
    // public function privacyPolicy(Request $request){
    //     if($request->isMethod('post')){
    //         $input  = $request->all();
    //         $update = PrivacyPolicy::first();   
    //         if(!empty($update)){
    //             $update->title         = $request->title;
    //             $update->description   = $request->description_id;
    //              if ($update->save()){             
    //                   return redirect('admin/pages/list')->with('success','Privacy Policy updated successfully');
    //              }else{
    //                 Session::flash('error','Something went wrong');
    //                 return redirect()->back();
    //             }
    //         }
    //     }   
    //     $privacyPolicy = PrivacyPolicy::orderby('created_at','desc')->first();
    //     $page='page';
    //     return view('backend.privacyPolicy', compact('privacyPolicy','page'));
    // }
}
