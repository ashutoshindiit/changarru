@include('frontend.common.header')



<style>

    .sticky-header.sticky

    {

        position: relative;

    }

    body

    {

        overflow-x: hidden;

    }

</style>



<div class="paddSec1">

    <div class="container">

       <div class="row">

        @include('frontend.common.sidebar1')

            <div class="col-md-8">

                <div class="link-order-details-right link-order-details-box p-4">

                   <div class="hrs-ytsr">

                      <h2>Support</h2>

                   </div>

                   <div class="card-body p-0">

                       <form id="formForSupport" method="post" action="{{url('/'.$slug.'/support')}}">

                            @csrf               

                          

                            <div class="row">

                                <div class="col-md-12 checkout_form">

                                    <div class="form-group">

                                        <label>Choose sellers</label>

                                        <div class="input-group">

                                            <select class="form-control custom-select sellerSelectSupport" name="seller_id" value="">

                                                <option value="" selected disabled>Choose sellers</option>

                                                @foreach($sellers as $value)

                                                    <option class="sellerSupport" buisness_name="{{@$value['buisness_name']}}"  sellerNumber="{{'+'.@$value['isd_code']}}{{@$value['mobile_number']}}" value="{{@$value['id']}}">{{@$value['buisness_name']}} </option>

                                                @endforeach

                                            </select>

                                        </div>

                                    </div>

                                    <label for="seller_id" class="error"></label>

                                </div>

                                <input type="hidden" name="userId" id="userAuthmobilenumber" value="{{Auth::guard('user')->user()->mobile_number}}" >

                                <div class="col-md-12 mb-20 checkout_form">

                                    <label>Title<span>*</span></label>

                                    <input type="text" id="titleSupport" value="" name="title" placeholder="Enter Title">    

                                </div>



                                <div class="col-md-12 mb-10 contact_message">

                                    <label>Description  <span>*</span></label>

                                    <textarea placeholder="Enter Description" id="descriptionSupport" name="description" class="form-control2 mb-0" rows="2"></textarea>     

                                </div>

                           </div>

                            <div class="product_variant quantity mt-2">

                                <button id="supportSubmitButton" class="button mll-0" type="button">Submit</button>

                            </div>

                       </form>

                   </div>

                </div>

             </div>

          </div>

       </div>

    </div>

<!--Order Completed page section end-->

@include('frontend.common.footer')



<script type="text/javascript">

    $(document).ready(function(){

        $('#formForSupport').validate({

            ignore:[],

            rules:{

                seller_id:{

                    required:true

                },

                title:{

                    required:true

                },

                description:{

                    required:true

                },

            },

            messages:{

                seller_id:{

                    required:"Please choose seller"

                },

                title:{

                    required:"Please enter title"

                },

                description:{

                    required:"Please enter description"

                },

            }

        });

    });



$(document).on('click','#supportSubmitButton',function(){

    if($('#formForSupport').valid()){

        var sellerNumber  = $('.sellerSupport').attr('sellerNumber');

        var buisness_name = $('.sellerSupport').attr('buisness_name');    

        var userAuthmobilenumber = $("#userAuthmobilenumber").val();

        var title = $("#titleSupport").val();

        var description = $("#descriptionSupport").val();

        console.log(sellerNumber,buisness_name,title,description)



        window.open("https://api.whatsapp.com/send?phone=*"+sellerNumber+"*"+"&text=Hey "+buisness_name+", please find the querry below:- %0a  User - "+userAuthmobilenumber+" %0a  Title-*"+title+"* %0a Description-"+description+"* %0a Thanks Chanagarru");

        // window.location.replace("https://api.whatsapp.com/send?phone="+sellerNumber+"&text=*"+title+"*"+description);

    }

});

</script>