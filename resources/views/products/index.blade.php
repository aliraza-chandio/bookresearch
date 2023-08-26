@extends('layouts.master')
@section('page-title')
Products
@endsection
@section('content')
<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js"></script>
<style>
tfoot input {
    width: 100%;
    padding: 3px;
    box-sizing: border-box;
}
</style>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Products </h3>
            </div>
        </div>
        <div class="title_right">
            <div class="col-md-4 col-sm-4 col-lg-6 mr-auto form-group text-right top_search">
                <a class="btn btn-success" href="{{ route('products.create') }}"> Create Product</a>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row" style="display: block;">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_content">
                        @include('layouts.flash-message')
                        <table id="products" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="150px">Type</th>
                                    <th>Other</th>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Date Birthday</th>
                                    <th>Date Death</th>
                                    <th>Featured</th>
                                    <th>Status</th>
                                    <th>Most View</th>
                                    <th width="150px">Action</th>
                                </tr>
                                <tr>
                                    <th>
                                        <select class="form-control onChange" name="ProductSearch[type_id]">
                                            <option value=""></option>
                                            @foreach($types as $type)
                                                <option value="{{ $type->id }}" {{ (isset($_GET['ProductSearch']['type_id']) && $_GET['ProductSearch']['type_id'] == $type->id) ? 'selected' : '' }} >{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </th>
                                    <th>&nbsp;</th>
                                    <th><input type="text" name="ProductSearch[id]" value="{{ isset($_GET['ProductSearch']['id']) ? $_GET['ProductSearch']['id'] : '' }}" class="form-control onChange"></th>
									<th><input type="text" name="ProductSearch[name]" value="{{ isset($_GET['ProductSearch']['name']) ? $_GET['ProductSearch']['name'] : '' }}" class="form-control onChange"></th>
									<th><input type="text" name="ProductSearch[slug]" value="{{ isset($_GET['ProductSearch']['slug']) ? $_GET['ProductSearch']['slug'] : '' }}" class="form-control onChange"></th>
									<th><input type="text" name="ProductSearch[date_birthday]" value="{{ isset($_GET['ProductSearch']['date_birthday']) ? $_GET['ProductSearch']['date_birthday'] : '' }}" class="form-control onChange"></th>
									<th><input type="text" name="ProductSearch[date_death]" value="{{ isset($_GET['ProductSearch']['date_death']) ? $_GET['ProductSearch']['date_death'] : '' }}" class="form-control onChange"></th>
									<th>
									
                                        <select class="form-control onChange" name="ProductSearch[featured]">
                                            <option value=""></option>
                                            <option value="0" {{ (isset($_GET['ProductSearch']['featured']) && $_GET['ProductSearch']['featured'] == "0") ? 'selected' : '' }} >No</option>
                                            <option value="1" {{ (isset($_GET['ProductSearch']['featured']) && $_GET['ProductSearch']['featured'] == "1") ? 'selected' : '' }} >Yes</option>
                                        </select>
									</th>
									<th>
									
                                        <select class="form-control onChange" name="ProductSearch[status]">
                                            <option value=""></option>
                                            <option value="1" {{ (isset($_GET['ProductSearch']['status']) && $_GET['ProductSearch']['status'] == "1") ? 'selected' : '' }} >Active</option>
                                            <option value="0" {{ (isset($_GET['ProductSearch']['status']) && $_GET['ProductSearch']['status'] == "0") ? 'selected' : '' }} >Deactive</option>
                                        </select>
									</th>
									<th><input type="text" name="ProductSearch[most_view]" value="{{ isset($_GET['ProductSearch']['most_view']) ? $_GET['ProductSearch']['most_view'] : '' }}"  class="form-control onChange"></th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <tr>
                                    @php
                                    $type = \App\Models\Type::find($product->type_id);
                                    @endphp
									
                                    <td>{{ $type->name }}</td>
                                    <td>
                                        <a href="/product_natives?productId={{ $product->id }}"
                                            class="btn btn-primary btn-sm" target="_blank">Native</a>
                                        <a href="/product_masters?productId={{ $product->id }}&type_id={{ $product->type_id }}"
                                            class="btn btn-success btn-sm" target="_blank">Master</a>
                                        <a href="/product_relateds?ProductSearch[product_id]={{ $product->id }}"
                                            class="btn btn-danger btn-sm" target="_blank">Releated</a>
                                    </td>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->slug }}</td>
                                    <td>{{ $product->date_birthday }}</td>
                                    <td>{{ $product->date_death }}</td>
                                    <td>{!! $product->featured == 1 ? '<span class="badge badge-success">Yes</span>' :  '<span class="badge badge-danger">No</span>' !!}</td>
                                    <td>{!! $product->status == 1 ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Deactive</span>' !!}</td>
                                    <td>{{ $product->most_view }}</td>
                                    <td>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                            <a class="btn-sm btn btn-info "
                                                href="{{ route('products.show', $product->id) }}"><i
                                                    class="fa fa-eye"></i></a>
                                            <a class="btn-sm btn btn-primary"
                                                href="{{ route('products.edit', $product->id) }}"><i
                                                    class="fa fa-edit"></i></a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-sm btn btn-danger"
                                                onclick="return confirm('Are you sure do you wan\'t to delete the Product?')"><i
                                                    class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row text-center justify-content-center">
							{{ $products->appends($_GET)->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

@section('script')
<script>
    $(document).ready(function() {
        
		 $(".onChange").on('change', function() {
    var selectedValue = $('select[name="ProductSearch[type_id]"] option:selected').val();

			 
			 var id = $('input[name="ProductSearch[id]"]').val();
			 var name = $('input[name="ProductSearch[name]"]').val();
			 var slug = $('input[name="ProductSearch[slug]"]').val();
			 var date_birthday = $('input[name="ProductSearch[date_birthday]"]').val();
			 var date_death = $('input[name="ProductSearch[date_death]"]').val();
			 var featured = $('select[name="ProductSearch[featured]"]').find("option:selected").val();
			 var status = $('select[name="ProductSearch[status]"]').find("option:selected").val();
			 var most_view = $('input[name="ProductSearch[most_view]"]').val();
             
            var redirectURL = window.location.origin+ window.location.pathname+"?ProductSearch[type_id]="+selectedValue+"&ProductSearch[id]="+id+"&ProductSearch[name]="+name+"&ProductSearch[slug]="+slug+"&ProductSearch[date_birthday]="+date_birthday+"&ProductSearch[date_death]="+date_death+"&ProductSearch[featured]="+featured+"&ProductSearch[status]="+status+"&ProductSearch[most_view]="+most_view;
			 window.location = redirectURL;

		 });
		//$.noConflict();
		/*
        var table = $('#products').DataTable({
            ajax: '',
            serverSide: true,
            processing: true,
            aaSorting:[[2,"desc"]],
            columns: [
                {data: 'type', name: 'type'},
                {data: 'other', name: 'other', html: true},
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'slug', name: 'slug'},
                {data: 'date_birthday', name: 'date_birthday'},
                {data: 'date_death', name: 'date_death'},
                {data: 'featured', name: 'featured', html: true},
                {data: 'status', name: 'status', html: true},
                {data: 'most_view', name: 'most_view'},
                {data: 'action', name: 'action', html: true, searchable: false, orderable: false},
            ],
        });
		*/
    })
</script>
@endsection
