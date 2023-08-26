@extends('layouts.master')
@section('page-title')
Users
@endsection
@section('content')
<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js"></script>
@php
$i =0;
@endphp
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3>Users </h3>
        </div>
    </div>
    <div class="title_right">
        <div class="col-md-4 col-sm-4 col-lg-6 mr-auto form-group text-right top_search">
            <a class="btn btn-success" href="{{ route('users.create') }}"> Create User</a>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12  ">
            <div class="x_panel">
                <div class="x_content">
                    @include('layouts.flash-message')
                    <table id="users" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>S. No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th width="150px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <th>{{ ++$i }}</th>
                                <td>{{ $user->full_name }}</td>
                                <th>{{ $user->email }}</th>
                                <th class="text-capitalize">{{ $user->role }}</th>
                                <td>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                        <a class="btn-sm btn btn-info "
                                            href="{{ route('users.show', $user->id) }}"><i
                                                class="fa fa-eye"></i></a>
                                        <a class="btn-sm btn btn-primary"
                                            href="{{ route('users.edit', $user->id) }}"><i
                                                class="fa fa-edit"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-sm btn btn-danger"
                                            onclick="return confirm('Are you sure do you wan\'t to delete the User?')"><i
                                                class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row text-center justify-content-center">
                        {{ $users->links('pagination::bootstrap-4') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        //$.noConflict();

        var table = $('#users').DataTable();
            
    $(".delete").click(function(){
        var id = $(this).data("id");
        var token = "{{ csrf_token() }}";
        $.ajax({
            url: "users/"+id,
            type: 'DELETE',
            data: {
                "id": id,
                "_token": token,
            },
            success: function (){
                alert('User Deleted');
                location.reload();
            },
            error: function (response){
                console.log(response);
            }
        });
    
    });
    })
</script>
@endsection
