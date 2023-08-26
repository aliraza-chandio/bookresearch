@extends('layouts.master')
@section('page-title')
    Types
@endsection
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Types </h3>
                </div>
            </div>
            <div class="title_right">
                <div class="col-md-4 col-sm-4 col-lg-6 mr-auto form-group text-right top_search">
                    <a class="btn btn-success" href="{{ route('types.create') }}"> Create Type</a>
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
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th width="150px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($types as $type)
                                        <tr>
                                            <th>{{ $type->id }}</th>
                                            <th>{{ $type->title }}</th>
                                            <th>{{ $type->status }}</th>
                                            <td>
                                                <form action="{{ route('types.destroy', $type->id) }}"
                                                    method="POST">
                                                    <a class="btn-sm btn btn-info "
                                                        href="{{ route('types.show', $type->id) }}"><i
                                                            class="fa fa-eye"></i></a>
                                                    <a class="btn-sm btn btn-primary"
                                                        href="{{ route('types.edit', $type->id) }}?&type_id={{ isset($_GET['ProductSearch']['type']) ? $_GET['ProductSearch']['type'] : '' }}"><i
                                                            class="fa fa-edit"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-sm btn btn-danger"
                                                        onclick="return confirm('Are you sure do you wan\'t to delete the Type?')"><i
                                                            class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="row text-center justify-content-center">
                                {{ $types->links('layouts.pagination') }}</div>
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
			var type = $('select[name="ProductSearch[type_id]"] option:selected').val();
			var master = $('select[name="ProductSearch[master_id]"] option:selected').val();
			var type = $('select[name="ProductSearch[type_id]"] option:selected').val();
			var order = $('input[name="ProductSearch[order]"]').val();

            var redirectURL = window.location.origin+ window.location.pathname +"?ProductSearch[id]="+id+"&ProductSearch[product_id]="+product_id+"&ProductSearch[type_id]="+type+"&ProductSearch[master_id]="+master+"&ProductSearch[type_id]="+type+"&ProductSearch[order]="+order;
			 window.location = redirectURL;

		 });
	 });
</script>
@endsection
