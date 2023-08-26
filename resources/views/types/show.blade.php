@extends('layouts.master')
@section('page-title')
    Show Type
@endsection

@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Show Type</h3>
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
                                        <td>{{ $type->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Title</th>
                                        <td>{{ $type->title }}</td>
                                    </tr>
                                    <tr>
                                        <th>Description</th>
                                        <td>{{ $type->description }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>{{ $type->status }}</td>
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
