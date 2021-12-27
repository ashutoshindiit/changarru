@include('backend.common.header')
@include('backend.common.navbar')
@include('backend.common.leftside-menu')
<style type="text/css">
.btn-danger {
    color: #fff  !important;
    background-color: #d9534f !important;
    border-color: #d43f3a !important;
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
                                    <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{url('admin/cms-page')}}">Cms Pages</a></li>
                                    <li class="breadcrumb-item active">Changarru Testimonial</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Testimonial List</h4>
                        </div>
                    </div>
                </div> 
           
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                           <div class="row">
                             <div class="col-md-6">
                               <h4 class="header-title mb-3">Testimonial List </h4>
                             </div>

                            <div class="col-md-6 text-right">
                                <a href="{{url('admin/add-changarru-testimonial')}}" class="btn btn-primary mb-3">Add Testimonial</a>
                            </div>

                            </div>
                            <div class="table-responsive">
                                <table  id="basic-datatable1" class="table  table-hover table-nowrap table-centered m-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>S.no</th>
                                            <th>Testimonial Name</th>
                                            <th>Testimonial Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach (@$testimonials as $key => $value): ?>
                                         <tr>
                                            <td class="serialTestimonialClass">
                                                {{$key+1}}
                                            </td>
                                             <td>
                                                 <h5 class="m-0 font-weight-normal">{{@$value['title']}}</h5>
                                             </td>
                                             <?php
                                                $contentDescription =  substr($value['description'], 0, 50);
                                             ?>
                                             <td>
                                                 <h5 class="m-0 font-weight-normal">
                                                 {{strip_tags($contentDescription)}}</h5>
                                             </td>
                                            <td> 
                                                <a href="{{url('/admin/add-changarru-testimonial/'.@$value['id'])}}" class="btn btn-xs btn-success"><i class="mdi mdi-pencil"></i></a>
                                                <a id="testimonialIdDelete" data-id="{{$value['id']}}"  class="btn btn-xs btn-danger "><i class="mdi mdi-trash-can"></i></a>
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
        $(document).on('click', '#testimonialIdDelete', function() {
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
                      url: "{{url('admin/delete-changarru-testimonial/')}}/" + id,
                      data: {
                         id: id,
                         _token: csrf_token
                      },
                      success: function(data) {
                         if(data['msg'] = 'true') {
                            Swal.fire('Deleted!', 'Your file has been deleted.', 'success').then((result) => {
                               ths.parents('tr').remove();
                               $('.serialTestimonialClass').each(function(key, val) {
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

