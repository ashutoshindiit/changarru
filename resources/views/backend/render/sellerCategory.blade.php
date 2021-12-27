
<option value="" selected disabled>Choose sellers</option>
@if(isset($sellerCategories) && !empty($sellerCategories))
    @foreach($sellerCategories as $value)
        <option value="{{@$value['id']}}" @if(isset($sellerProduct)) @if($sellerProduct['sellerCategory']['id']==$value['id']) selected @endif @endif>{{@$value['name']}}</option>
    @endforeach
@endif
