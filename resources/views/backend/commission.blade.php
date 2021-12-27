@include('backend.common.header')
@include('backend.common.navbar')
@include('backend.common.leftside-menu')

<div class="content-page">
   <div class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-12">
               <div class="page-title-box">
                  <div class="page-title-right">
                     <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Commission Settings</a></li>
                     </ol>
                  </div>
                  <h4 class="page-title">Commission Settings</h4>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-12">
               <div class="card">
                    <div class="card-body">

                           <div class="row mb-3">
                              <div class="col-md-12 payTabs">
                                 <!-- Nav tabs -->
                                 <ul class="nav nav-tabs">
                                   <li class="nav-item">
                                     <a class="nav-link active" data-toggle="tab" href="#paypal">User Commission</a>
                                   </li>
                                   <li class="nav-item">
                                     <a class="nav-link" data-toggle="tab" href="#stripe">Seller Commission</a>
                                   </li>
                                 </ul>

                                 <!-- Tab panes -->
                                 <div class="tab-content">
                                     <div class="tab-pane active" id="paypal">
                                       <form action="{{url('admin/commissionManagement/commission/commission-list')}}" id="commisionSettingForm2" method="post"  enctype="multipart/form-data" >
                                          @csrf
                                          
                                          <!-- $commissionSetting['commission']='' -->

                                         <div class="row">
                                          <input type="hidden" name="commission_role" value="user">

                                            <div class="col-lg-12 col-sm-12">
                                               <div class="form-group">
                                                  <label>Commision Type</label>
                                                   <select class="form-control user_commisionTypeClass" name="user_commision_type" type="text" >
                                                        <option value="" selected disabled >Select Commision Type <body></body></option> 
                                                        <option value="fixed" 
                                                        @if(@$commissionSetting['user_commision_type'] == 'fixed') selected @endif}}>Fixed</option>
                                                        <option value="percent" 
                                                        @if(@$commissionSetting['user_commision_type'] ==  'percent') selected @endif}}>Percent</option>
                                                    </select>
                                                </div>
                                            </div> 

                                            <div class="col-lg-12 user_c_amount">
                                                <div class="form-group">
                                                    <label for="">Commision Amount</label>
                                                    <input type="text" class="form-control" value="{{@$commissionSetting['user_commission_amount']}}" name="user_commission_amount" placeholder="Enter Commission Amount" >
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-12 user_c_percent">
                                                <div class="form-group">
                                                    <label for="">Commision Percent</label>
                                                    <input type="text" class="form-control" value="{{@$commissionSetting['user_commission_percentage']}}" name="user_commission_percentage" placeholder="Enter Commission Percentage" >
                                                </div>
                                            </div>

                                            <div class="col-12 text-left">
                                              <button type="submit" class="btn btn-success waves-effect waves-light userFormCommissionSubmit">
                                                  <i class="fe-check-circle mr-1"></i> Save
                                              </button>
                                            </div>
                                        </div>
                                       </form>
                                    </div>

                                    <div class="tab-pane fade" id="stripe">
                                       <form action="{{url('admin/commissionManagement/commission/commission-list')}}" id="commisionSettingForm1" method="post"  enctype="multipart/form-data" >
                                          @csrf
                                          <div class="row">
                                             <div class="col-lg-12 col-sm-12">
                                                <input type="hidden" name="commission_role" value="seller">
                                                <div class="form-group">
                                                   <label>Commision Type</label>
                                                    <select class="form-control seller_commisionTypeClass" name="seller_commision_type" type="text" >
                                                         <option value="" selected disabled >Select Commision Type <body></body></option> 
                                                         <option value="fixed" 
                                                         @if(@$commissionSetting['seller_commision_type'] == 'fixed') selected @endif}}>Fixed</option>
                                                         <option value="percent" 
                                                         @if(@$commissionSetting['seller_commision_type'] ==  'percent') selected @endif}}>Percent</option>
                                                     </select>
                                                 </div>
                                             </div> 

                                             <div class="col-lg-12 seller_c_amount">
                                                 <div class="form-group">
                                                     <label for="">Commision Amount</label>
                                                     <input type="text" class="form-control" value="{{@$commissionSetting['seller_commission_amount']}}" name="seller_commission_amount" placeholder="Enter Commission Amount" >
                                                 </div>
                                             </div>
                                             
                                             <div class="col-lg-12 seller_c_percent">
                                                 <div class="form-group">
                                                     <label for="">Commision Percent</label>
                                                     <input type="text" class="form-control" value="{{@$commissionSetting['seller_commission_percentage']}}" name="seller_commission_percentage" placeholder="Enter Commission Percentage" >
                                                 </div>
                                             </div>

                                             <div class="col-12 text-left">
                                               <button type="submit" class="btn btn-success waves-effect waves-light sellerFormCommissionSubmit">
                                                   <i class="fe-check-circle mr-1"></i> Save
                                               </button>
                                             </div>
                                         </div>
                                      </form>
                                      </div>
                                    </div>
                                 </div>
                                 
                              </div>
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

