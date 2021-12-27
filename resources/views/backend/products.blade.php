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
                        <li class="breadcrumb-item active">Products</li>
                     </ol>
                  </div>
                  <h4 class="page-title">Products</h4>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-12">
               <div class="card-box">
                  <div class="d-flex align-items-center justify-content-between">
                     <h4 class="header-title mb-3 pull-left">Products List</h4> 
                     <a href="{{url('admin/productManagement/product/add-product')}}" class="btn btn-primary pull-right  mb-3">Add Product</a>
                  </div>
                  <div class="table-responsive">
                     <table class="table table-borderless table-hover table-nowrap table-centered m-0 dash">
                        <thead class="thead-light">
                            <tr>
                                <th>Sr. No</th>
                                <th>Image </th>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Discount Price</th>
                                <th>Discount</th>
                                <th>Final Price</th>
                                <th>Stock</th>
                                <th>Action</th>
                            </tr>
                        <tbody>
                        	<?php
                    			$count = 1;
                    			if(isset($_GET['page']) && $_GET['page']){
                    			   $count = $_GET['page'];
                    			}
                    			$Sno = ($count*10)-10;   
                            ?>
                           	    <?php 
                                    // dd($sellerProductPaginate[0]);
                                ?>
                            @foreach ($sellerProductPaginate as $key => $value)
                                <tr>
                                    <td  class="deleteProductClass"> {{($key+1) + $Sno}} </td>
                                    <td> <img src="{{isset($value['sellerProductImages'][0]['image']) ? asset('frontend/assets/img/product/'.$value['sellerProductImages'][0]['image']):asset('public/backend/assets/images/default.jpg')}}" class="userimg" alt="" /> </td>
                                    <td> {{$value['name']}} </td>

                                    @if(isset($value['sellerProductSizes'][0]))    

                                        @if($value['sellerProductSizes'][0]['discount_price']!=null && $value['sellerProductSizes'][0]['size_price']!=null)
                                            
                                            <td> {{$value['sellerProductSizes'][0]['size_price']}} </td>
                                            <td>@if($value['sellerProductSizes'][0]['discount_price']!=null)  {{$value['sellerProductSizes'][0]['discount_price']}} @else - @endif </td>
                                            
                                            <td>
                                                @php
                                                    $result = $value['sellerProductSizes'][0]['size_price'] -$value['sellerProductSizes'][0]['discount_price']; 
                                                    $percentPrice = $result/$value['sellerProductSizes'][0]['size_price']*100;
                                                @endphp
                                                 <span class="badge badge-success">{{number_format($percentPrice)}} % OFF</span>
                                            </td>
                                            <td> @if($value['sellerProductSizes'][0]['discount_price']!=null) {{$value['sellerProductSizes'][0]['discount_price']}} @else {{$value['sellerProductSizes'][0]['size_price']}} @endif </td>
                                            <td> <span class="badge badge-success"> @if($value['sellerProductSizes'][0]['quantity']!=0) In Stock @else Out Of Stock @endif</span> </td>
                                            <!-- <span class="current_price">${{$value['sellerProductSizes'][0]['discount_price']}}</span>
                                            <span class="old_price">${{$value['sellerProductSizes'][0]['size_price']}}</span>
                                             -->
                                        @elseif($value['sellerProductSizes'][0]['discount_price']==null)
                                            <td> {{$value['sellerProductSizes'][0]['size_price']}} </td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>{{$value['sellerProductSizes'][0]['size_price']}} </td>
                                            <td> <span class="badge badge-success"> @if($value['sellerProductSizes'][0]['quantity']!=0) In Stock @else Out Of Stock @endif</span> </td>
                                            <!-- <span class="current_price">${{$value['sellerProductSizes'][0]['size_price']}}</span> -->
                                        @elseif($value['sellerProductSizes'][0]['size_price']==null)

                                            <td> {{$value['sellerProductSizes'][0]['size_price']}} </td>
                                            <td>@if($value['sellerProductSizes'][0]['discount_price']!=null)  {{$value['sellerProductSizes'][0]['discount_price']}} @else - @endif </td>
                                            <td> -</td>
                                            <td> @if($value['sellerProductSizes'][0]['discount_price']!=null) {{$value['sellerProductSizes'][0]['discount_price']}} @else {{$value['sellerProductSizes'][0]['size_price']}} @endif </td>
                                            <td> <span class="badge badge-success"> @if($value['sellerProductSizes'][0]['quantity']!=0) In Stock @else Out Of Stock @endif</span> </td>
                                            <!-- <span class="current_price">${{$value['sellerProductSizes'][0]['discount_price']}}</span> -->
                                        @endif
                                    @else
                                        @if($value['discounted_price']!=null && $value['price']!=null)
                                            <td> {{$value['price']}} </td>
                                            <td>@if($value['discounted_price']!=null)  {{$value['discounted_price']}} @else - @endif </td>
                                            
                                            <td>
                                                @php
                                                    $result = $value['price'] -$value['discounted_price']; 
                                                    $percentPrice = $result/$value['price']*100;
                                                @endphp
                                                 <span class="badge badge-success">{{number_format($percentPrice)}} % OFF</span>
                                            </td>
                                            <td> @if($value['discounted_price']!=null) {{$value['discounted_price']}} @else {{$value['price']}} @endif </td>
                                            <td> <span class="badge badge-success"> @if($value['quantity']!=0) In Stock @else Out Of Stock @endif</span> </td>
                                            <!-- <span class="current_price">${{$value['discounted_price']}}</span> -->
                                            <!-- <span class="old_price">${{$value['price']}}</span> -->
                                        @elseif($value['discounted_price']==null)
                                            <td> {{$value['price']}} </td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>{{$value['price']}} </td>
                                            <td> <span class="badge badge-success"> @if($value['quantity']!=0) In Stock @else Out Of Stock @endif</span> </td>
                                        @elseif($value['price']==null)
                                            <!-- <span class="current_price">${{$value['discounted_price']}}</span> -->
                                            <td> {{$value['price']}} </td>
                                            <td>@if($value['discounted_price']!=null)  {{$value['discounted_price']}} @else - @endif </td>
                                            <td> -</td>
                                            <td> @if($value['discounted_price']!=null) {{$value['discounted_price']}} @else {{$value['price']}} @endif </td>
                                            <td> <span class="badge badge-success"> @if($value['quantity']!=0) In Stock @else Out Of Stock @endif</span> </td>
                                        @endif
                                    @endif

                                    <!-- <td> {{$value['price']}} </td> -->
                                    <!-- <td>@if($value['discounted_price']!=null)  {{$value['discounted_price']}} @else - @endif </td> -->
                                        <!-- <td>
                                        @if($value['discounted_price']!=null && $value['price']!=null)
                                            @php
                                                $result = $value['price'] -$value['discounted_price']; 
                                                $percentPrice = $result/$value['price']*100;
                                            @endphp
                                             <span class="badge badge-success">{{number_format($percentPrice)}} % OFF</span>
                                        @else
                                        -
                                        @endif 
                                    </td> -->

                                   <!--  <td> @if($value['discounted_price']!=null) {{$value['discounted_price']}} @else {{$value['price']}} @endif </td> -->
                                    
                                    <!-- <td> <span class="badge badge-success"> @if($value['quantity']!=0) In Stock @else Out Of Stock @endif</span> </td> -->
                                    
                                    <td>  
                                        <a href="{{url('admin/productManagement/product/edit-product/'.$value['id'])}}" class="btn btn-xs btn-success btn-successf"><i class="mdi mdi-pencil"></i></a> 
                                        <a href="javascript: void(0);" id="productIdDelete" data-id="{{$value['id']}}" class="btn btn-xs btn-danger "><i class="mdi mdi-trash-can"></i></a> 
                                    </td>
                                </tr>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
               </div>
               
               <div class="centred"> 
                  {{$sellerProductPaginate->links("pagination::bootstrap-4")}} 
               </div>

            </div>
         </div>
      </div>
   </div>
 
@include('backend.common.footer')

<script type="text/javascript">
   $(document).on('click', '#productIdDelete', function() {
      event.preventDefault();
      ths = $(this);
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
               url: "{{url('admin/productManagement/product/delete-product/')}}/" + id,
               data: {
                  id: id,
                  _token: csrf_token
               },
               success: function(data) {
                  if(data['msg'] = 'true') {
                     Swal.fire('Deleted!', 'Product has been deleted.', 'success').then((result) => {
                        // setTimeout(function(){
                        //     location.reload();
                        // },2000);    
                        ths.parents('tr').remove();
                        $('.deleteProductClass').each(function(key, val) {
                           $(this).text(key + 1)
                        })
                        toastr.success('Product has been deleted');
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