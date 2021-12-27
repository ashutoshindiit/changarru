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
                                    <li class="breadcrumb-item active">Cms Pages</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Cms Pages</h4>
                        </div>
                    </div>
                </div>            

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                           <div class="row">
                             <div class="col-md-6">
                               <h4 class="header-title mb-3">All Cms Pages </h4>
                             </div>
                            <!-- <div class="col-md-6 text-right">
                                <a href="addcompany.php" class="btn btn-primary  mb-3">Add Package</a>
                             </div> -->
                            </div>
                            <div class="table-responsive">
                                <table  id="basic-datatable5" class="table  table-hover table-nowrap table-centered m-0">


                                    <thead class="thead-light">
                                        <tr>
                                            <th colspan="2">Cms Page Name</th>    
                                            <th colspan="2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td>
                                                <h5 class="m-0 font-weight-normal"> Home Page Information</h5>
                                            </td>
                                            <td></td>
                                            <td>
                                                <a href="{{url('admin/update-homepage-information')}}" class="btn btn-xs btn-success"><i class="mdi mdi-pencil"></i></a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <h5 class="m-0 font-weight-normal">Feature List</h5>
                                            </td>
                                            <td></td>
                                            <td>
                                                <a href="{{url('admin/changarru-feature')}}" class="btn btn-xs btn-success"><i class="fa fa-list"></i></a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <h5 class="m-0 font-weight-normal">Faq List</h5>
                                            </td>
                                            <td></td>
                                            <td>
                                                <a href="{{url('admin/faqs')}}" class="btn btn-xs btn-success"><i class="fa fa-list"></i></a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <h5 class="m-0 font-weight-normal">Blog List</h5>
                                            </td>
                                            <td></td>
                                            <td>
                                                <a href="{{url('admin/blogs')}}" class="btn btn-xs btn-success"><i class="fa fa-list"></i></a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <h5 class="m-0 font-weight-normal">Testimonial List</h5>
                                            </td>
                                            <td></td>
                                            <td>
                                                <a href="{{url('admin/changarru-testimonial')}}" class="btn btn-xs btn-success"><i class="fa fa-list"></i></a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <h5 class="m-0 font-weight-normal">About us</h5>
                                            </td>
                                            <td></td>
                                            <td>
                                                <a href="{{url('admin/edit-about-us-page')}}" class="btn btn-xs btn-success"><i class="mdi mdi-pencil"></i></a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <h5 class="m-0 font-weight-normal">Contact us queries</h5>
                                            </td>
                                            <td></td>
                                            <td>
                                                <a href="{{url('admin/contact-us')}}" class="btn btn-xs btn-success"><i class="mdi mdi-pencil"></i></a>
                                            </td>
                                        </tr>
                                        

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