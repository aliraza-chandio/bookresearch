@extends('layouts.master')
@section('page-title')
    Show Master
@endsection

@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Show Master</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 ">
                    <div class="x_panel">
                        <div class="x_content">
                            <table class="table table-striped table-bordered detail-view">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $master->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Name</th>
                                        <td>{{ $master->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Slug</th>
                                        <td>{{ $master->slug }}</td>
                                    </tr>
                                    <tr>
                                        <th>Desc</th>
                                        <td><span class="not-set">(not set)</span></td>
                                    </tr>
                                    <tr>
                                        <th>Extra</th>
                                        <td>{{ $master->extra }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>{!! $master->status == 1 ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Deactive</span>' !!}</td>
                                    </tr>
                                    <tr>
                                        <th>Order</th>
                                        <td>{{ $master->order }}</td>
                                    </tr>
                                    <tr>
                                        <th>Parent</th>
                                        <td>{{ $parent->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Table Type</th>
                                        <td>{{ $table_type->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Type</th>
                                        <td>{{ $type->name }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
