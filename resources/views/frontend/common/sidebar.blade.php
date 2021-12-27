<style type="text/css">
   .reset_sidebar {
        height: 30px;
        line-height: 30px;
        padding: 0 20px;
        text-transform: capitalize;
        color: #ffffff;
        background: #222222;
        border: 0;
        border-radius: 30px;
        float: left;
        -webkit-transition: 0.3s;
        transition: 0.3s;
    }    
</style>

<aside class="sidebar_widget">
   <div class="widget_inner">
      <div class="widget_list widget_categories">
         <h3>Category</h3>
         <ul>
            <?php
                $sellerCategory = \App\Models\SellerCategory::whereIn('id',$sellerProductsCategoryCount)->get();
            ?>
            <li>
                <a class="categoryProductClass" category="0" <?php if(isset($_GET['category_id'])){if($_GET['category_id']==0){echo 'style="font-weight: bold;"';}}?> > All</a>

              <?php foreach ($sellerCategory as $key => $category): ?>
                <a class="categoryProductClass"  category="{{$category['id']}}" <?php if(isset($_GET['category_id'])){if($_GET['category_id']==$category['id']){echo 'style="font-weight: bold;"';}}?> > {{$category['name']}}</a>
              <?php endforeach ?>
            </li>
         </ul>

      </div>

      <div class="widget_list widget_filter">
         <h3>Filter by price</h3>

         <form  id="sidebar_filter" action="{{url('/'.$slug)}}" method="get" enctype="multipart/form-data" >
            <div id="slider-range"></div>
            <input type="hidden" name="slug" value="{{$slug}}">

            <input type="hidden" name="max_sidebar_filter" id="max_sidebar_filter" value="{{ @$_REQUEST['max_sidebar_filter'] }}">
            <input type="hidden" name="min_sidebar_filter" id="min_sidebar_filter" value="{{ @$_REQUEST['min_sidebar_filter'] }}">
            @if(isset($_GET['category_id']))
               <?php 
                  $category_id   = @$_GET['category_id'];
               ?>
                 <input type="hidden" name="category_id" id="selectedCategoryId" value="{{$_GET['category_id']}}">
            @else
               <input type="hidden" name="category_id" id="selectedCategoryId" value="">  
            @endif
                 
            <button type="submit" id="filterSubmitButton">Filter</button>
            <input type="text" name="text" id="amount" />   
         </form>
            &nbsp;<a href="{{url('/'.$slug)}}"><button class="reset_sidebar" type="button">Reset</button></a>

      </div>

   </div>

</aside>