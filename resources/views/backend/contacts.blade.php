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
                                   
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                    <li class="breadcrumb-item active">Queries</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Queries</h4>
                        </div>
                    </div>
                </div> 
           

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                           <div class="row">
                             <div class="col-md-6">
                               <h4 class="header-title mb-3">All Queries </h4>
                             </div>
                            </div>
                            <div class="table-responsive">
                                <table  id="basic-datatable1" class="table  table-hover table-nowrap table-centered m-0">


                             <thead class="thead-light">
                                        <tr>
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>Mobile No.</th>
                                            <th>Query</th>
                                            <th>Reply</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($contactUs as $key => $value): ?>
                                         <tr>

                                             <td>{{$value['full_name']}}</td>
                                             <td>{{@$value['email']}}</td>
                                             <td>{{@$value['phone']}}</td>
                                             <td>@if(@$value['message']) {{@$value['message']}} @else - @endif </td>
                                             <td>@if(@$value['reply']) {{@$value['reply']}} @else - @endif</td>
                                             <td>
                                                @if(@$value['is_reply']=='yes')
                                                Sent
                                                @else
                                                <a class="send_reply_cls" href="javascript:void(0)" ral_id="{{$value->id}}" ral_email="{{$value->email}}" ral_subject="{{$value->subject}}" ral_query="{{$value->message}}"><i class="fa fa-reply" title="Send Reply"></i></a>
                                                @endif
                                             </td>
                                         </tr>
                                         <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> 
                
                </div>
            </div>
        </div>
        
        
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12  text-center">
                       &copy; Copyright 2021 Changarru Team. All Rights Reserved
                    </div>
                  
                </div>
            </div>
        </footer>

        @include('backend.common.footer')
        </div>
    </div>
    <div class="rightbar-overlay"></div>
            
