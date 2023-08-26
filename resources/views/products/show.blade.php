@extends('layouts.master')
@section('page-title')
Show Product
@endsection

@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Show Product</h3>
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
                                    <th>Id</th>
                                    <td>{{ $product->id }}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $product->name }}</td>
                                </tr>
                                <tr>
                                    <th>Slug</th>
                                    <td>{{ $product->slug }}</td>
                                </tr>
                                <tr>
                                    <th>Desc</th>
                                    <td>{{ $product->desc }}</td>
                                </tr>
                                <tr>
                                    <th>Keywords</th>
                                    <td>{{ $product->keywords }}</td>
                                </tr>
                                <tr>
                                    <th>Extra</th>
                                    <td>{{ $product->extra }}</td>
                                </tr>
                                <tr>
                                    <th>Date Birthday</th>
                                    <td>{{ $product->date_birthday }}</td>
                                </tr>
                                <tr>
                                    <th>Date Death</th>
                                    <td>{{ $product->date_death }}</td>
                                </tr>
                                <tr>
                                    <th>Date Birthday G</th>
                                    <td>{{ $product->date_birthday_g }}</td>
                                </tr>
                                <tr>
                                    <th>Date Death G</th>
                                    <td>{{ $product->date_death_g }}</td>
                                </tr>
                                <tr>
                                    <th>Most View</th>
                                    <td>{{ $product->most_view }}</td>
                                </tr>
                                <tr>
                                    <th>Most Download</th>
                                    <td>{{ $product->most_download }}</td>
                                </tr>
                                <tr>
                                    <th>Featured</th>
                                    <td>{!! $product->featured == 1 ? '<span class="badge badge-success">Yes</span>' :
                                        '<span class="badge badge-danger">No</span>' !!}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{!! $product->status == 1 ? '<span class="badge badge-success">Active</span>' :
                                        '<span class="badge badge-danger">Deactive</span>' !!}</td>
                                </tr>
                                <tr>
                                    <th>Image_visible</th>
                                    <td>{!! $product->image_visible == 1 ? '<span
                                            class="badge badge-success">Visible</span>' :
                                        '<span class="badge badge-danger">Hidden</span>' !!}</td>
                                </tr>
                                <tr>
                                    <th>Api_featured</th>
                                    <td>{!! $product->api_featured == 1 ? '<span class="badge badge-success">Yes</span>'
                                        :
                                        '<span class="badge badge-danger">No</span>' !!}</td>
                                </tr>
                                <tr>
                                    <th>User_id</th>
                                    <td>{{ $product->user_id }}</td>
                                </tr>
                                <tr>
                                    <th>Created_date</th>
                                    <td>{{ $product->created_date }}</td>
                                </tr>
                                <tr>
                                    <th>Updated_date</th>
                                    <td>{{ $product->updated_date }}</td>
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
