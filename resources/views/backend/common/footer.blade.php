    			  <footer class="footer">
    		      <div class="container-fluid">
    		         <div class="row">
    		            <div class="col-md-12  text-center"> &copy; Copyright 2021 Changarru. All Rights Reserved </div>
    		         </div>
    		      </div>
    		   </footer>
		    </div>
      </div>

      <div id="sendReplyModel" class="modal fade" role="">
          <form method="post" id="send_reply_form" action="{{url('admin/contactUs/query/reply')}}">
              @csrf
              <input type="hidden" name="contact_us_id" id="contact_us_id" value="">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h4 class="modal-title caption-subject theme-font-color bold z">Reply</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                      <div class="modal-body">
                          <div class="form-group">
                              <label>Email</label>
                              <input type="text" required="" class="form-control" value="" id="user_email_id" disabled>
                          </div>
                          <div class="form-group">
                              <label>Subject</label>
                              <input type="text" required="" class="form-control" value="" id="subject_id" disabled>
                          </div>
                          <div class="form-group">
                              <label>Query</label>
                              <textarea type="text" required="" class="form-control" value="" id="query_id" disabled></textarea>
                          </div>
                          <div class="form-group">
                              <label>Reply</label>
                              <textarea type="text" required="" name="reply" class="form-control" value=""></textarea>
                          </div>
                      </div>
                      <div class="modal-footer"> 
                          <button type="submit" id="send_reply_btn" class="btn btn-primary"> Send Reply</button>
                      </div>
                  </div>
              </div>
          </form>
      </div>


      <div class="modal fade delpopup" id="accreject" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <div class="form-group mb-2 mt-2">
                        <label class="lablefon" for="emailaddress">Description</label>
                        <textarea placeholder="Message" rows="5" class="form-control"></textarea>
                     </div>
                    <a href="javascript: void(0);" data-dismiss="modal" class="btn btn-success">Yes</a> 
                    <a href="javascript: void(0);" data-dismiss="modal" class="btn btn-danger">No</a> 
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div>

      <div class="modal fade delpopup" id="delpopup" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <i class="icon-close"></i>
                    <p>Are you sure you want to delete this record? <br> This process cannot be undone</p>
                    <a href="javascript: void(0);" data-dismiss="modal" class="btn btn-md btn-success">Cancel</a> 
                    <a href="javascript: void(0);" data-dismiss="modal" class="btn btn-md btn-danger">Delete</a> 
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div>

    <div class="rightbar-overlay"></div>
        <script type="text/javascript" src="{{ url('public/backend/assets/js/vendor.min.js')}}"></script>
        
        <script src="{{url('public/backend/assets/js/jquery-3.2.1.min.js')}}"></script>

        <script src="{{url('public/backend/assets/js/jquery.validate.js')}}"></script>

        <script src="{{url('public/backend/assets/js/additional-methods.min.js')}}"></script>
        <script src="{{url('public/backend/assets/js/bootstrap.min.js')}}"></script>

        <script type="text/javascript" src="{{url('public/backend/assets/js/jquery.dataTables.min.js')}}"></script>
        <script src="https://unpkg.com/dropzone"></script>
        <script src="https://unpkg.com/cropperjs"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/js/bootstrap-switch.js" data-turbolinks-track="true"></script>
        
        <script type="text/javascript" src="{{ url('public/backend/assets/libs/flatpickr/flatpickr.min.js')}}"></script>
        <!-- <script type="text/javascript" src="{{ url('public/backend/assets/libs/apexcharts/apexcharts.min.js')}}"></script> -->
        <script type="text/javascript" src="{{ url('public/backend/assets/libs/selectize/js/standalone/selectize.min.js')}}"></script>
        <!-- <script type="text/javascript" src="{{ url('public/backend/assets/js/pages/dashboard-1.init.js')}}"></script> -->
        <script type="text/javascript" src="{{ url('public/backend/assets/libs/quill/quill.min.js')}}"></script>
        <script type="text/javascript" src="{{ url('public/backend/assets/js/app.min.js')}}"></script>

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <!-- <script type="text/javascript" src="{{url('public/backend/assets/js/sweetalert.js')}}"></script> -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script type="text/javascript" src="{{url('public/backend/assets/js/toastr.min.js')}}"></script>
        <script src="{{ url('public/backend/assets/js/tinymce/tinymce.min.js')}}"></script>

        <script>
            @if(Session::has('success'))
                $(function () {
                    toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "10000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };
                    toastr.success("{{ Session::get('success') }}");
                });
            @endif    
            @if(Session::has('error'))
                $(function () {
                    toastr.options = {
                      "closeButton": true,
                      "debug": false,
                      "newestOnTop": false,
                      "progressBar": true,
                      "positionClass": "toast-top-right",
                      "preventDuplicates": false,
                      "onclick": null,
                      "showDuration": "300",
                      "hideDuration": "1000",
                      "timeOut": "10000",
                      "extendedTimeOut": "1000",
                      "showEasing": "swing",
                      "hideEasing": "linear",
                      "showMethod": "fadeIn",
                      "hideMethod": "fadeOut"
                    };
                    toastr.error("{{ Session::get('error') }}");
                });
            @endif  
        </script>
        


        <script type="text/javascript">
            $(document).on('click','.send_reply_cls', function(){
                console.log('here')
                $('#contact_us_id').val($(this).attr('ral_id'));
                console.log($(this).attr('ral_id'));
                $('#user_email_id').val($(this).attr('ral_email'));
                console.log($(this).attr('ral_email'));
                $('#query_id').val($(this).attr('ral_query'));
                console.log($(this).attr('ral_query'));
                $('#subject_id').val($(this).attr('ral_subject'));
                console.log($(this).attr('ral_subject'));
                $('#sendReplyModel').modal('show');
            })
        </script>

        <script type="text/javascript">
            $('#send_reply_form').validate({
                ignore:[],
                rules:{
                    "reply":{
                        required: true,
                        maxlength: 5000
                    }
                },
                messages: {
                    "reply":{
                        required: "Please enter reply",
                        maxlength: "Maximum 5000 characters are allowed"
                    }
                }
            })
        </script>
        
        <script type="text/javascript">
            $(document).ready(function(){
                function readURL(input){
                    if(input.files && input.files[0]){
                        var reader = new FileReader();
                        reader.onload = function(e){
                            $('.old_image').attr('src', e.target.result);
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }

                $('.img_upload').change(function(){
                    var img_name = $(this).val();
                    if(img_name != '' && img_name != null){
                        var img_arr = img_name.split('.');
                        var ext = img_arr.pop();
                        ext = ext.toLowerCase();
                        // alert(ext); return false;
                        if(ext == 'jpeg' || ext == 'jpg' || ext == 'png'){
                            input = document.getElementById('img_upload');
                            readURL(this);
                        }
                    } else{
                        $(this).val('');
                        alert('Please select an image of .jpeg, .jpg, .png file format.');
                    }
                });
            });
        </script>

        <script type="text/javascript">    
            // $(document).on('click','.userFormCommissionSubmit',function(){
            //     submitHandler:function(form){
            //         }
            //             form.submit();
            // });

            // $(document).on('click','.sellerFormCommissionSubmit',function(){
            //     submitHandler:function(form){
            //             form.submit();
            //         }
            // });



            
            var commisssionTypeUser =  $('.user_commisionTypeClass').val();
            
            if(commisssionTypeUser=='fixed'){
              $(".user_c_percent").hide();
                $(".user_c_amount").show();
                $("[name='user_commission_amount']").prop("required",true);
                $("[name='user_commission_percentage']").prop("required",false);


            }else if(commisssionTypeUser=='percent'){
                 $(".user_c_percent").show();
                 $(".user_c_amount").hide();
                $("[name='user_commission_percentage']").prop("required",true);
                $("[name='user_commission_amount']").prop("required",false);

            }else{

            }

            
            $(document).on('change','.user_commisionTypeClass',function(){
                // alert($(this).val())
                if($(this).val()=='fixed'){
                $(".user_c_percent").hide();
                $(".user_c_amount").show();
                $("[name='user_commission_amount']").prop("required",true);
                $("[name='user_commission_percentage']").prop("required",false);

                }else{
                    $(".user_c_percent").show();
                    $(".user_c_amount").hide();
                    $("[name='user_commission_percentage']").prop("required",true);
                    $("[name='user_commission_amount']").prop("required",false);

                }
            })


            var commisssionTypeSeller =  $('.seller_commisionTypeClass').val();
            
            if(commisssionTypeSeller=='fixed'){
                $(".seller_c_percent").hide();
                $(".seller_c_amount").show();
                $("[name='seller_commission_amount']").prop("required",true);
                $("[name='seller_commission_percentage']").prop("required",false);
                $("[name='seller_commission_percentage']").val('');


                                    
            }else if(commisssionTypeSeller=='percent'){
                $(".seller_c_amount").hide();
                $(".seller_c_percent").show();
                $("[name='seller_commission_percentage']").prop("required",true);
                $("[name='seller_commission_amount']").prop("required",false);
                $("[name='seller_commission_amount']").val('');




            }else{

            }

            $(document).on('change','.seller_commisionTypeClass',function(){
                if($(this).val()=='fixed'){
                    $(".seller_c_percent").hide();
                    $(".seller_c_amount").show();
                    $("[name='seller_commission_amount']").prop("required",true);
                    $("[name='seller_commission_percentage']").prop("required",false);
                    $("[name='seller_commission_percentage']").val('');




                }else{
                    $(".seller_c_amount").hide();
                    $(".seller_c_percent").show();
                    $("[name='seller_commission_amount']").prop("required",true);
                    $("[name='seller_commission_percentage']").prop("required",false);
                    $("[name='seller_commission_percentage']").val('');


                }
            })
        </script>

        <script type="text/javascript">    
            $(document).ready(function(){
                $('#productCategoryImageForm').validate({
                    rules: {
                        "name": {
                            required: true
                        },
                        "seller_id":{
                            required:true
                        }
                    },
                    messages: {
                        "name":{
                            required:"Plesae enter name"
                        },
                        "seller_id":{
                             required:"Plesae select seller"
                        }
                    },
                    submitHandler:function(form){
                        form.submit();
                    }
                });
            });
        </script>

    <script type="text/javascript">    
        $(document).ready(function(){
            $('#edit_shop').validate({
                rules: {
                    "buisness_name": {
                        required: true
                    },
                    "buisness_category_id":{
                        required:true
                    },
                    "verified_status":{
                        required:true
                    },
                },
                messages: {
                    "buisness_name":{
                        required:"Plesae enter buisness name"
                    },
                    "buisness_category_id":{
                         required:"Plesae select buisness category"
                    },
                    "verified_status":{
                         required:"Plesae select status"
                    },
                },
                submitHandler:function(form){
                    form.submit();
                }
            });
        });
    </script>

    <script>
        google.charts.load('current', {packages: ['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawMultSeries);

        function drawMultSeries() {
              var data = new google.visualization.DataTable();
              data.addColumn('timeofday', 'Time of Day');
              data.addColumn('number', 'Users ');
              data.addColumn('number', 'Dealers');

              data.addRows([
                [{v: [8, 0, 0], f: '1 Month'}, 1, .25],
                [{v: [9, 0, 0], f: '2 Month'}, 2, .5],
                [{v: [10, 0, 0], f:'3 Month'}, 3, 1],
                [{v: [11, 0, 0], f: '4 Month'}, 4, 2.25],
                [{v: [12, 0, 0], f: '5 Month'}, 5, 2.25],
                [{v: [13, 0, 0], f: '6 Month'}, 6, 3],
                [{v: [14, 0, 0], f: '7 Month'}, 7, 4],
                [{v: [15, 0, 0], f: '8 Month'}, 8, 5.25],
                [{v: [16, 0, 0], f: '9 Month'}, 9, 7.5],
                [{v: [17, 0, 0], f: '10 Month'}, 10, 10],
              ]);

              var options = {
                title: 'Users v/s Dealers',
                
                hAxis: {
                  // title: 'Time of Day',
                  format: 'h:mm a',
                  viewWindow: {
                    min: [7, 30, 0],
                    max: [17, 30, 0]
                  }
                },
                // vAxis: {
                //   title: 'Rating (scale of 1-10)'
                // }
              };

              var chart = new google.visualization.ColumnChart(
                document.getElementById('chart_div'));

              chart.draw(data, options);
            }
      </script>
      <script>
        google.charts.load('current', {packages: ['corechart', 'line']});
        google.charts.setOnLoadCallback(drawBasic);

        function drawBasic() {

              var data = new google.visualization.DataTable();
              data.addColumn('number', 'X');
              data.addColumn('number', 'Bids History');

              data.addRows([
                [0, 0],   [1, 10],  [2, 23],  [3, 17],  [4, 18],  [5, 9],
                [6, 11],  [7, 27],  [8, 33],  [9, 40],  [10, 32], [11, 35],
                [12, 30], [13, 40], [14, 42], [15, 47], [16, 44], [17, 48],
                [18, 52], [19, 54], [20, 42], [21, 55], [22, 56], [23, 57],
                [24, 60], [25, 50], [26, 52], [27, 51], [28, 49], [29, 53],
                [30, 55], [31, 60], [32, 61], [33, 59], [34, 62], [35, 65],
                [36, 62], [37, 58], [38, 55], [39, 61], [40, 64], [41, 65],
                [42, 63], [43, 66], [44, 67], [45, 69], [46, 69], [47, 70],
                [48, 72], [49, 68], [50, 66], [51, 65], [52, 67], [53, 70],
                [54, 71], [55, 72], [56, 73], [57, 75], [58, 70], [59, 68],
                [60, 64], [61, 60], [62, 65], [63, 67], [64, 68], [65, 69],
                [66, 70], [67, 72], [68, 75], [69, 80]
              ]);

              var options = {
                hAxis: {
                  title: 'Time'
                },
                vAxis: {
                  title: 'Popularity'
                }
              };

              var chart = new google.visualization.LineChart(document.getElementById('chart_div1'));

              chart.draw(data, options);
            }
      </script>
      <script>
        (function() {
            function init(raw_markdown) {
              var quill = new Quill("#editor-container", {
                modules: {
                  toolbar: [
                    [{ header: [1, 2, false] }],
                     ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
                      ['blockquote', 'code-block'],

                      [{ 'header': 1 }, { 'header': 2 }],               // custom button values
                      [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                      [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
                      [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
                      [{ 'direction': 'rtl' }],                         // text direction

                      [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
                      [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

                      [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
                      [{ 'font': [] }],
                      [{ 'align': [] }],

                      ['clean']
                  ]
                },
                placeholder: "Compose an epic...",
                theme: "snow" // or 'bubble'
              });
            }

            // Just some fake markdown that would come from the server.
            
            var text = "";
          text += "# Dillinger" + "\n";
          text += " " + "\n";
          text += "[![N|Solid](https://cldup.com/dTxpPi9lDf.thumb.png)](https://nodesource.com/products/nsolid)" + "\n";
          text += " " + "\n";
          text += "Dillinger is a cloud-enabled, mobile-ready, offline-storage, AngularJS powered HTML5 Markdown editor." + "\n";
          text += " " + "\n";
          text += "  - Type some Markdown on the left" + "\n";
          text += "  - See HTML in the right" + "\n";
          text += "  - Magic" + "\n";
          text += " " + "\n";
          text += "# New Features!" + "\n";
          text += " " + "\n";
          text += "  - Import a HTML file and watch it magically convert to Markdown" + "\n";
          text += "  - Drag and drop images (requires your Dropbox account be linked)" + "\n";
          text += " " + "\n";
          text += " " + "\n";
          text += "You can also:" + "\n";
          text += "  - Import and save files from GitHub, Dropbox, Google Drive and One Drive" + "\n";
          text += "  - Drag and drop markdown and HTML files into Dillinger" + "\n";
          text += "  - Export documents as Markdown, HTML and PDF" + "\n";
          text += " " + "\n";
          text += "Markdown is a lightweight markup language based on the formatting conventions that people naturally use in email.  As [John Gruber] writes on the [Markdown site][df1]" + "\n";
          text += " " + "\n";
          text += "> The overriding design goal for Markdown's" + "\n";
          text += "> formatting syntax is to make it as readable" + "\n";
          text += "> as possible. The idea is that a" + "\n";
          text += "> Markdown-formatted document should be" + "\n";
          text += "> publishable as-is, as plain text, without" + "\n";
          text += "> looking like it's been marked up with tags" + "\n";
          text += "> or formatting instructions." + "\n";
          text += " " + "\n";
          text += "This text you see here is *actually* written in Markdown! To get a feel for Markdown's syntax, type some text into the left window and watch the results in the right." + "\n";
          text += " " + "\n";
          text += "### Tech" + "\n";
          text += " " + "\n";
          text += "Dillinger uses a number of open source projects to work properly:" + "\n";
          text += " " + "\n";
          text += "* [AngularJS] - HTML enhanced for web apps!" + "\n";
          text += "* [Ace Editor] - awesome web-based text editor" + "\n";
          text += "* [markdown-it] - Markdown parser done right. Fast and easy to extend." + "\n";
          text += "* [Twitter Bootstrap] - great UI boilerplate for modern web apps" + "\n";
          text += "* [node.js] - evented I/O for the backend" + "\n";
          text += "* [Express] - fast node.js network app framework [@tjholowaychuk]" + "\n";
          text += "* [Gulp] - the streaming build system" + "\n";
          text += "* [Breakdance](https://breakdance.io) - HTML to Markdown converter" + "\n";
          text += "* [jQuery] - duh" + "\n";
          text += " " + "\n";
          text += "And of course Dillinger itself is open source with a [public repository][dill]" + "\n";
          text += " on GitHub." + "\n";
          text += " " + "\n";
          text += "### Installation" + "\n";
          text += " " + "\n";
          text += "Dillinger requires [Node.js](https://nodejs.org/) v4+ to run." + "\n";
          text += " " + "\n";
          text += "Install the dependencies and devDependencies and start the server." + "\n";
          text += " " + "\n";
          text += "```sh" + "\n";
          text += "$ cd dillinger" + "\n";
          text += "$ npm install -d" + "\n";
          text += "$ node app" + "\n";
          text += "```" + "\n";
          text += " " + "\n";
          text += "For production environments..." + "\n";
          text += " " + "\n";
          text += "```sh" + "\n";
          text += "$ npm install --production" + "\n";
          text += "$ npm run predeploy" + "\n";
          text += "$ NODE_ENV=production node app" + "\n";
          text += "```" + "\n";
          text += " " + "\n";
          text += "### Plugins" + "\n";
          text += " " + "\n";
          text += "Dillinger is currently extended with the following plugins. Instructions on how to use them in your own application are linked below." + "\n";
          text += " " + "\n";
          text += "| Plugin | README |" + "\n";
          text += "| ------ | ------ |" + "\n";
          text += "| Dropbox | [plugins/dropbox/README.md] [PlDb] |" + "\n";
          text += "| Github | [plugins/github/README.md] [PlGh] |" + "\n";
          text += "| Google Drive | [plugins/googledrive/README.md] [PlGd] |" + "\n";
          text += "| OneDrive | [plugins/onedrive/README.md] [PlOd] |" + "\n";
          text += "| Medium | [plugins/medium/README.md] [PlMe] |" + "\n";
          text += "| Google Analytics | [plugins/googleanalytics/README.md] [PlGa] |" + "\n";
          text += " " + "\n";
          text += " " + "\n";
          text += "### Development" + "\n";
          text += " " + "\n";
          text += "Want to contribute? Great!" + "\n";
          text += " " + "\n";
          text += "Dillinger uses Gulp + Webpack for fast developing." + "\n";
          text += "Make a change in your file and instantanously see your updates!" + "\n";
          text += " " + "\n";
          text += "Open your favorite Terminal and run these commands." + "\n";
          text += " " + "\n";
          text += "First Tab:" + "\n";
          text += "```sh" + "\n";
          text += "$ node app" + "\n";
          text += "```" + "\n";
          text += " " + "\n";
          text += "Second Tab:" + "\n";
          text += "```sh" + "\n";
          text += "$ gulp watch" + "\n";
          text += "```" + "\n";
          text += " " + "\n";
          text += "(optional) Third:" + "\n";
          text += "```sh" + "\n";
          text += "$ karma test" + "\n";
          text += "```" + "\n";
          text += "#### Building for source" + "\n";
          text += "For production release:" + "\n";
          text += "```sh" + "\n";
          text += "$ gulp build --prod" + "\n";
          text += "```" + "\n";
          text += "Generating pre-built zip archives for distribution:" + "\n";
          text += "```sh" + "\n";
          text += "$ gulp build dist --prod" + "\n";
          text += "```" + "\n";
          text += "### Docker" + "\n";
          text += "Dillinger is very easy to install and deploy in a Docker container." + "\n";
          text += " " + "\n";
          text += "By default, the Docker will expose port 80, so change this within the Dockerfile if necessary. When ready, simply use the Dockerfile to build the image." + "\n";
          text += " " + "\n";
          text += "```sh" + "\n";
          text += "cd dillinger" + "\n";
          text += "docker build -t joemccann/dillinger:${package.json.version}" + "\n";
          text += "```" + "\n";
          text += "This will create the dillinger image and pull in the necessary dependencies. Be sure to swap out `${package.json.version}` with the actual version of Dillinger." + "\n";
          text += " " + "\n";
          text += "Once done, run the Docker image and map the port to whatever you wish on your host. In this example, we simply map port 8000 of the host to port 80 of the Docker (or whatever port was exposed in the Dockerfile):" + "\n";
          text += " " + "\n";
          text += "```sh" + "\n";
          text += "docker run -d -p 8000:8080 --restart=\"always\" <youruser>/dillinger:${package.json.version}" + "\n";
          text += "```" + "\n";
          text += " " + "\n";
          text += "Verify the deployment by navigating to your server address in your preferred browser." + "\n";
          text += " " + "\n";
          text += "```sh" + "\n";
          text += "127.0.0.1:8000" + "\n";
          text += "```" + "\n";
          text += " " + "\n";
          text += "#### Kubernetes + Google Cloud" + "\n";
          text += " " + "\n";
          text += "See [KUBERNETES.md](https://github.com/joemccann/dillinger/blob/master/KUBERNETES.md)" + "\n";
          text += " " + "\n";
          text += " " + "\n";
          text += "### Todos" + "\n";
          text += " " + "\n";
          text += " - Write MOAR Tests" + "\n";
          text += " - Add Night Mode" + "\n";
          text += " " + "\n";
          text += "License" + "\n";
          text += "----" + "\n";
          text += " " + "\n";
          text += "MIT" + "\n";
          text += " " + "\n";
          text += " " + "\n";
          text += "**Free Software, Hell Yeah!**" + "\n";
          text += " " + "\n";
          text += "[//]: # (These are reference links used in the body of this note and get stripped out when the markdown processor does its job. There is no need to format nicely because it shouldn't be seen. Thanks SO - https://stackoverflow.com/questions/4823468/store-comments-in-markdown-syntax)" + "\n";
          text += " " + "\n";
          text += " " + "\n";
          text += "   [dill]: <https://github.com/joemccann/dillinger>" + "\n";
          text += "   [git-repo-url]: <https://github.com/joemccann/dillinger.git>" + "\n";
          text += "   [john gruber]: <http://daringfireball.net>" + "\n";
          text += "   [df1]: <https://daringfireball.net/projects/markdown/>" + "\n";
          text += "   [markdown-it]: <https://github.com/markdown-it/markdown-it>" + "\n";
          text += "   [Ace Editor]: <https://ace.ajax.org>" + "\n";
          text += "   [node.js]: <https://nodejs.org>" + "\n";
          text += "   [Twitter Bootstrap]: <https://twitter.github.com/bootstrap/>" + "\n";
          text += "   [jQuery]: <https://jquery.com>" + "\n";
          text += "   [@tjholowaychuk]: <https://twitter.com/tjholowaychuk>" + "\n";
          text += "   [express]: <https://expressjs.com>" + "\n";
          text += "   [AngularJS]: <https://angularjs.org>" + "\n";
          text += "   [Gulp]: <https://gulpjs.com>" + "\n";
          text += " " + "\n";
          text += "   [PlDb]: <https://github.com/joemccann/dillinger/tree/master/plugins/dropbox/README.md>" + "\n";
          text += "   [PlGh]: <https://github.com/joemccann/dillinger/tree/master/plugins/github/README.md>" + "\n";
          text += "   [PlGd]: <https://github.com/joemccann/dillinger/tree/master/plugins/googledrive/README.md>" + "\n";
          text += "   [PlOd]: <https://github.com/joemccann/dillinger/tree/master/plugins/onedrive/README.md>" + "\n";
          text += "   [PlMe]: <https://github.com/joemccann/dillinger/tree/master/plugins/medium/README.md>" + "\n";
          text += "   [PlGa]: <https://github.com/RahulHP/dillinger/blob/master/plugins/googleanalytics/README.md>" + "\n";

          text = "<ol><li>List Item 1<li><li><ol><li>Point a</li></ol></li></ol>";

            init(text);
          })();
      </script>
   </body>
</html>