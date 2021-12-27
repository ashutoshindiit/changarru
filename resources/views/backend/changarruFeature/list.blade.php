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
                                    <li class="breadcrumb-item"><a href="{{url('admin/cms-page')}}">Cms Pages</a></li>
                                    <li class="breadcrumb-item active">Features</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Feature List</h4>
                        </div>
                    </div>
                </div> 
           
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                           <div class="row">
                             <div class="col-md-6">
                               <h4 class="header-title mb-3">Feature List </h4>
                             </div>

                            <div class="col-md-6 text-right">
                                <a href="{{url('admin/add-changarru-feature')}}" class="btn btn-primary mb-3">Add feature</a>
                            </div>

                            </div>
                            <div class="table-responsive">
                                <table  id="basic-datatable1" class="table  table-hover table-nowrap table-centered m-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>S.no</th>
                                            <th>Feature Name</th>
                                            <th>Feature Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach (@$Features as $key => $value): ?>
                                         <tr>
                                            <td class="serialFeatureClass" >
                                                {{$key+1}}
                                            </td>
                                             <td>
                                                 <h5 class="m-0 font-weight-normal">{{@$value['feature_name']}}</h5>
                                             </td>
                                             <?php
                                                $contentDescription =  substr($value['feature_description'], 0, 50);
                                             ?>
                                             <td>
                                                 <h5 class="m-0 font-weight-normal">
                                                 {{strip_tags($contentDescription)}}</h5>
                                             </td>
                                            <td> 
                                                <a href="{{url('/admin/add-changarru-feature/'.@$value['id'])}}" class="btn btn-xs btn-success"><i class="mdi mdi-pencil"></i></a>
                                                <a val="{{base64_encode($value['id'])}}" href="{{url('/admin/delete-changarru-feature/'.@$value['id'])}}" id="featureIdDelete" data-id="{{$value['id']}}"  class="btn btn-xs btn-danger del_btn"><i class="mdi mdi-trash-can"></i></a>
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
        
            @include('backend.common.footer')
        </div>
    </div>
    <div class="rightbar-overlay"></div>

    <script type="text/javascript">
       $(document).on('click', '#featureIdDelete', function() {
          event.preventDefault();
          var ths = $(this);
          var id = $(this).data('id');
          var csrf_token = $('meta[name=csrf-token]').attr('content');
          Swal.fire({
             title: 'Are you sure?',
             text: "You won't be able to revert this!",
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
             if(result.isConfirmed) {
                $.ajax({
                   type: "POST",
                   url: "{{url('admin/delete-changarru-feature/')}}/" + id,
                   data: {
                      id: id,
                      _token: csrf_token
                   },
                   success: function(data) {
                      if(data['msg'] = 'true') {
                         Swal.fire('Deleted!', 'Your file has been deleted.', 'success').then((result) => {
                            ths.parents('tr').remove();
                            $('.serialFeatureClass').each(function(key, val) {
                               $(this).text(key + 1)
                            })
                            toastr.success('Your data has been deleted');
                         })
                      } else {
                         Swal.fire("Cancelled", "Your data is safe :)", "error");
                      }
                   }
                });
             } else {
                Swal.fire("Cancelled", "Your data is safe :)", "error");
             }
          })
       });
    </script>

    

