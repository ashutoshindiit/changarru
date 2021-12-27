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
                        <li class="breadcrumb-item">Payment Settings</li>
                     </ol>
                  </div>
                  <h4 class="page-title">Payment Settings</h4>
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
                               <a class="nav-link active" data-toggle="tab" href="#paypal">Paypal</a>
                             </li>
                             <li class="nav-item">
                               <a class="nav-link" data-toggle="tab" href="#stripe">Stripe</a>
                             </li>
                           </ul>

                           <!-- Tab panes -->
                           <div class="tab-content">
                             <div class="tab-pane active" id="paypal">
                                <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                         <label for="">Paypal Mode</label>
                                         <select class="form-control">
                                            <option>Sandbox</option> 
                                            <option>Live</option>       
                                         </select>
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                         <label for="">Paypal Email address</label>
                                         <input type="email" class="form-control" placeholder="">
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                         <label for="">Client Id</label>
                                         <input type="email" class="form-control" placeholder="">
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                         <label for="">Client Secret</label>
                                         <input type="email" class="form-control" placeholder="">
                                       </div>
                                    </div>
                                    <div class="col-12 text-left">
                                       <button type="button" class="btn btn-success waves-effect waves-light">
                                          <i class="fe-check-circle mr-1"></i> Save
                                       </button>
                                    </div>
                                </div>
                             </div>
                             <div class="tab-pane fade" id="stripe">
                                <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                         <label for="">Stripe Mode</label>
                                         <select class="form-control">
                                            <option>Sandbox</option> 
                                            <option>Live</option>       
                                         </select>
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                         <label for="">Secret Key</label>
                                         <input type="email" class="form-control" placeholder="">
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                         <label for="">Publishable Key</label>
                                         <input type="email" class="form-control" placeholder="">
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                         <label for="">Client Id</label>
                                         <input type="email" class="form-control" placeholder="">
                                       </div>
                                    </div>
                                    <div class="col-12 text-left">
                                       <button type="button" class="btn btn-success waves-effect waves-light">
                                          <i class="fe-check-circle mr-1"></i> Save
                                       </button>
                                    </div>
                                </div>
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