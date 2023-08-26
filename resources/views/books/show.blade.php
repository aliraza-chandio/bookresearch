@extends('layouts.master')
@section('page-title')
    Show Book
@endsection

@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Show Book</h3>
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
                                        <td>{{ $book->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Product</th>
                                        <td>{{ $product->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Table Type</th>
                                        <td>{{ $table_type->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Related </th>
                                        <td>{{ $related->name }}</td>
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
