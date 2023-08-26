@extends('layouts.master')
@section('page-title')
Masters
@endsection
@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Masters </h3>
            </div>
        </div>
        <div class="title_right">
            <div class="col-md-4 col-sm-4 col-lg-6 mr-auto form-group text-right top_search">
                <a class="btn btn-success" href="{{ route('masters.create') }}"> Create Master</a>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row" style="display: block;">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_content">
                        @include('layouts.flash-message')
                        <table id="masters" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Native</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Desc</th>
                                    <th>Extra</th>
                                    <th>Status</th>
                                    <th>Order</th>
                                    <th>Parent</th>
                                    <th>Table Type</th>
                                    <th width="150px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($masters as $master)
                                <tr>
                                    @php
                                    $type = \App\Models\Type::find($master->type_id);
                                    @endphp
                                    <td>{{ $type->name }}</td>
                                    <td><a href="/master_natives?masterId={{ $master->id }}"
                                            class="btn btn-primary btn-sm">Native</a>
                                    </td>
                                    <th>{{ $master->id }}</th>
                                    <td>{{ $master->name }}</td>
                                    <td>{{ $master->slug }}</td>
                                    <td>...</td>
                                    <td>{{ $master->extra }}</td>
                                    <td>{{ $master->status }}</td>
                                    <td>{{ $master->order }}</td>
                                    <td>
                                        @php
                                        $parent = \App\Models\Master::find($master->parent);
                                        @endphp
                                        {{ $parent->name }}
                                    </td>
                                    <td>
                                        @php
                                        $table_type = \App\Models\Master::find($master->table_type);
                                        @endphp
                                        {{ $table_type->name }}
                                    </td>
                                    <td>
                                        <form action="{{ route('masters.destroy', $master->id) }}" method="POST">
                                            <a class="btn-sm btn btn-info "
                                                href="{{ route('masters.show', $master->id) }}"><i
                                                    class="fa fa-eye"></i></a>
                                            <a class="btn-sm btn btn-primary"
                                                href="{{ route('masters.edit', $master->id) }}"><i
                                                    class="fa fa-edit"></i></a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-sm btn btn-danger"
                                                onclick="return confirm('Are you sure do you wan\'t to delete the Master?')"><i
                                                    class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row text-center justify-content-center">
                            {{-- {{ $masters->links('layouts.pagination') }}</div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>

$.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('#datatable-ajax-crud').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('masters.index') }}",
        columns: [
                {data: 'id', name: 'id', 'visible': false},
                { data: 'title', name: 'title' },
                { data: 'code', name: 'code' },
                { data: 'author', name: 'author' },
                { data: 'created_at', name: 'created_at' },
                {data: 'action', name: 'action', orderable: false},
                ],
        order: [[0, 'desc']]
});

</script>
@endsection
