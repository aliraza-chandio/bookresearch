@extends('layouts.master')
@section('page-title')
    Books
@endsection
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Books </h3>
                </div>
            </div>
            <div class="title_right">
                <div class="col-md-4 col-sm-4 col-lg-6 mr-auto form-group text-right top_search">
                    <a class="btn btn-success" href="{{ route('books.create') }}?productId={{ isset($_GET['ProductSearch']['product_id']) ? $_GET['ProductSearch']['product_id'] : '' }}&type_id={{ isset($_GET['ProductSearch']['type']) ? $_GET['ProductSearch']['type'] : '' }}"> Create Book</a>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row" style="display: block;">
                <div class="col-md-12 col-sm-12  ">
                    <div class="x_panel">
                        <div class="x_content">
                            @include('layouts.flash-message')
                            <table id="products_related" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Product</th>
                                        <th>Related Product</th>
                                        <th>Master</th>
                                        <th>Type</th>
                                        <th>Order</th>
                                        <th width="150px">Action</th>
                                    </tr>
                                    <tr>
                                        
                                    <th><input type="text" name="ProductSearch[id]" value="{{ isset($_GET['ProductSearch']['id']) ? $_GET['ProductSearch']['id'] : '' }}" class="form-control onChange"></th>
                                        <th><input type="text" name="ProductSearch[product_id]" value="{{ isset($_GET['ProductSearch']['product_id']) ? $_GET['ProductSearch']['product_id'] : '' }}" class="form-control onChange"></th>
                                    <th>
                                        <select class="form-control onChange select2" name="ProductSearch[related_product_id]">
                                            <option value=""></option>
                                            @foreach($related_products as $related_product)
                                                <option value="{{ $related_product->id }}" {{ (isset($_GET['ProductSearch']['related_product_id']) && $_GET['ProductSearch']['related_product_id'] == $related_product->id) ? 'selected' : '' }} >{{ $related_product->name }}</option>
                                            @endforeach
                                        </select>
                                    </th>
                                    <th>
                                        <select class="form-control onChange select2" name="ProductSearch[master_id]">
                                            <option value=""></option>
                                            @foreach($masters as $master)
                                                <option value="{{ $master->id }}" {{ (isset($_GET['ProductSearch']['master_id']) && $_GET['ProductSearch']['master_id'] == $master->id) ? 'selected' : '' }} >{{ $master->name }}</option>
                                            @endforeach
                                        </select>
                                    </th>
                                    <th>
                                        <select class="form-control onChange select2" name="ProductSearch[type_id]">
                                            <option value=""></option>
                                            @foreach($types as $type)
                                                <option value="{{ $type->id }}" {{ (isset($_GET['ProductSearch']['type_id']) && $_GET['ProductSearch']['type_id'] == $type->id) ? 'selected' : '' }} >{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </th>
										<th><input type="text" name="ProductSearch[order]" value="{{ isset($_GET['ProductSearch']['order']) ? $_GET['ProductSearch']['order'] : '' }}" class="form-control onChange"></th>
                                        <th width="150px">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($books as $book)
                                        <tr>
                                            <th>{{ $book->id }}</th>
                                            <td>
                                                @php
                                                if($book->product_id == null){
                                                    $productName = 'Product not set';
                                                }
                                                else {

                                                    $product = \App\Models\Product::find($book->product_id);
                                                    if(empty($product)){
                                                       $productName = 'Product not available';
                                                    }
                                                    else{

                                                    $productName = $product->name;
                                                    }
                                                }
                                                @endphp
                                                {{ $productName }}
                                            </td>
                                            <td>
                                                @php
                                                if($book->related_product_id == null){
                                                    $productName = 'Related Product not set';
                                                }
                                                else {

                                                    $product = \App\Models\Product::find($book->related_product_id);
                                                    if(empty($product)){
                                                       $productName = 'Related Product not available';
                                                    }
                                                    else{

                                                    $productName = $product->name;
                                                    }
                                                }
                                                @endphp
                                                {{ $productName }}
                                            </td>

                                            <td>
                                                @php
                                                if($book->master_id == null){
                                                    $relatedName = 'Product not set';
                                                }
                                                else {

                                                    $related = \App\Models\Master::find($book->master_id);
                                                    if(empty($related)){
                                                       $relatedName = 'Related not available';
                                                    }
                                                    else{

                                                    $relatedName = $related->name;
                                                    }
                                                }
                                                @endphp
                                                {{ $relatedName }}
                                            </td>
                                            <td>
                                                @php

                                                $type = \App\Models\Type::find($book->type_id);
                                                @endphp
                                                {{ $type->name }}
                                            </td>
                                            <td>
                                                {{ $book->order }}
                                            </td>
                                            <td>
                                                <form action="{{ route('books.destroy', $book->id) }}"
                                                    method="POST">
                                                    <a class="btn-sm btn btn-info "
                                                        href="{{ route('books.show', $book->id) }}"><i
                                                            class="fa fa-eye"></i></a>
                                                    <a class="btn-sm btn btn-primary"
                                                        href="{{ route('books.edit', $book->id) }}?&type_id={{ isset($_GET['ProductSearch']['type']) ? $_GET['ProductSearch']['type'] : '' }}"><i
                                                            class="fa fa-edit"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-sm btn btn-danger"
                                                        onclick="return confirm('Are you sure do you wan\'t to delete the Book?')"><i
                                                            class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="row text-center justify-content-center">
                                {{ $books->links('layouts.pagination') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        
        $('.select2').select2();
		 $(".onChange").on('change', function() {
		    var id = $('input[name="ProductSearch[id]"]').val();
		    var product_id = $('input[name="ProductSearch[product_id]"]').val();
			var related_product = $('select[name="ProductSearch[related_product_id]"] option:selected').val();
			var master = $('select[name="ProductSearch[master_id]"] option:selected').val();
			var type = $('select[name="ProductSearch[type_id]"] option:selected').val();
			var order = $('input[name="ProductSearch[order]"]').val();
             
            var redirectURL = window.location.origin+ window.location.pathname +"?ProductSearch[id]="+id+"&ProductSearch[product_id]="+product_id+"&ProductSearch[related_product_id]="+related_product+"&ProductSearch[master_id]="+master+"&ProductSearch[type_id]="+type+"&ProductSearch[order]="+order;
			 window.location = redirectURL;

		 });
	 });
</script>
@endsection