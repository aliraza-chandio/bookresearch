@extends('layouts.master')
@section('page-title')
    Create Master
@endsection
@section('content')
    <style>
        .form-control.error {
            border-color: red !important;
        }

        .error {
            color: red !important;
        }

    </style>
    <div class="right_col" role="main">
        <div>
            <div class="page-title">
                <div class="title_left">
                    <h3>Create Master</h3>
                </div>
                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-lg-12 form-group text-right top_search">
                        <a href="/masters" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <br />
                            <form class="form-horizontal form-label-left" action="{{ route('masters.store') }}"
                                method="POST" id="masterForm">
                                @csrf
                                @include('layouts.flash-message')
                                <div class="form-group row">
                                    <div class="col-md-6 col-sm-6">
                                        <label class="control-label fs18">Type <span class="text-danger">*</span></label>
                                        <select class="form-control" id="type_id" name="type_id">
                                        </select>

                                        @error('type_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label class="control-label fs18">Table Type <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="table_type" name="table_type">
                                        </select>

                                        @error('table_type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label class="control-label fs18">Parent <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="parent" name="parent">
                                        </select>

                                        @error('parent')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label class="control-label fs18">Extra </label>
                                        <input type="text" class="form-control" placeholder="Extra" id="extra"
                                            name="extra" value="{{ old('extra') }}">

                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label class="control-label fs18">Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Name" id="name" name="name"
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label class="control-label fs18">Slug <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Slug" id="permalink"
                                            name="slug" value="{{ old('slug') }}">

                                        @error('slug')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <label class="control-label fs18">Desc </label>
                                        <textarea name="desc" id="desc" class="w-100" rows="6">{{ old('desc') }}</textarea>
                                    </div>
                                    <div class="col-md-6 col-sm-6 ">
                                        <label class="control-label fs18">Status <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="status">
                                            <option {{ old('status') == 1 ? 'selected' : '' }} value="1">Active</option>
                                            <option {{ old('status') == 0 ? 'selected' : '' }} value="0">Deactive
                                            </option>
                                        </select>

                                        @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 col-sm-6">
                                        <label class="control-label fs18">Order </label>
                                        <input type="text" class="form-control" placeholder="Order" id="order"
                                            name="order" value="{{ old('order') }}">
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/speakingurl/14.0.1/speakingurl.min.js"></script>
    <script src="/assets/js/jquery.stringtoslug.min.js"></script>
    <script>
        $("#name").stringToSlug({
            setEvents: 'keyup keydown blur change paste'
        });
        $(document).ready(function() {
            $.ajax({
                url: "/get-types",
                type: "GET",
                dataType: 'json',
                success: function(result) {
                    $("#type_id").html('<option value="">Select a Type</select>');
                    $.each(result, function(key, value) {
                        $("#type_id").append('<option value="' + value.id + '">' + value
                            .name + '</option>');
                    });
                    $("#type_id").select2({
                        placeholder: "Select a Type ..."
                    }).trigger("change");
                }
            });
            $("#masterForm").validate({
                rules: {
                    type: {
                        required: true
                    },
                    table_type: {
                        required: true
                    },
                    parent: {
                        required: true
                    },
                    name: {
                        required: true
                    },
                    slug: {
                        required: true
                    },
                    status: {
                        required: true
                    },
                },
                messages: {
                    type: {
                        required: "Type cannot be blank.",
                    },
                    table_type: {
                        required: "Table type cannot be blank.",
                    },
                    parent: {
                        required: "Parent cannot be blank.",
                    },
                    name: {
                        required: "Name cannot be blank.",
                    },
                    slug: {
                        required: "Slug cannot be blank.",
                    },
                    status: {
                        required: "Status cannot be blank.",
                    },
                },
                highlight: function(element, errorClass, validClass) {
                    if (element.type === "radio") {
                        this.findByName(element.name).addClass(errorClass).removeClass(validClass);
                    } else {
                        var elem = $(element);
                        if (elem.attr('readonly') == 'readonly') {
                            if (elem.hasClass("input-group-addon")) {
                                $("#" + elem.attr("id")).parent().addClass(errorClass);
                            } else {
                                $(element).addClass(errorClass).removeClass(validClass);
                            }
                        } else {
                            if (elem.hasClass("select2-hidden-accessible")) {
                                $("#select2-" + elem.attr("id") + "-container").parent().addClass(
                                    errorClass);
                            } else {
                                $(element).addClass(errorClass).removeClass(validClass);
                            }
                        }
                    }
                },
                unhighlight: function(element, errorClass, validClass) {
                    if (element.type === "radio") {
                        this.findByName(element.name).removeClass(errorClass).addClass(validClass);
                    } else {
                        var elem = $(element);
                        if (elem.attr('readonly') == 'readonly') {
                            if (elem.hasClass("input-group-addon")) {
                                $("#" + elem.attr("id")).parent().removeClass(errorClass);
                            } else {
                                $(element).addClass(errorClass).removeClass(validClass);
                            }
                        } else {
                            if (elem.hasClass("select2-hidden-accessible")) {
                                $("#select2-" + elem.attr("id") + "-container").parent().removeClass(
                                    errorClass);
                            } else {
                                $(element).removeClass(errorClass).addClass(validClass);
                            }
                        }
                    }
                },
                errorPlacement: function(error, element) {
                    var elem = $(element);
                    if (elem.attr('readonly') == 'readonly') {
                        element = $("#" + elem.attr("id")).parent();
                        error.insertAfter(element);
                    } else {
                        if (elem.hasClass("select2-hidden-accessible")) {
                            element = $("#select2-" + elem.attr("id") + "-container").parent().parent()
                                .parent();
                            error.insertAfter(element);
                        } else {
                            error.insertAfter(element);
                        }
                    }
                }
                // errorPlacement: function(error, element) {
                //     if (element.next('.select2-container').length) {
                //         console.log(element);
                //         error.insertAfter(element.next('.select2-container'));
                //     } else {
                //         error.insertAfter(element);

                //     }
                // }
            });
            $("input").bind("propertychange change click keyup input paste", function(e) {
                $(this).valid();
            });
            $("select").on("select2:close", function(e) {
                $(this).valid();
            });
            $('#type_id').select2({
                placeholder: "Select a Type ..."
            });
            $("#table_type").select2({
                placeholder: "Select Table Type ..."
            });
            $("#parent").select2({
                placeholder: "Select Parent ..."
            });

        });
        $('#type_id').on('change', function() {
            var type = $('#type_id').val();
            $("#table_type").html('');
            $("#parent").html('');

            $.ajax({
                url: "/get-table-type-by-type-id?type=" + type,
                type: "GET",
                dataType: 'json',
                success: function(result) {
                    $("#table_type").html('');
                    $.each(result, function(key, value) {
                        $("#table_type").append('<option value="' + value.id + '">' + value
                            .name + '</option>');
                    });

                    $("#table_type").select2({
                        placeholder: "Select Table Type ..."
                    }).trigger("change");
                }
            });
        });
        $('#table_type').on('change', function() {
            var type = $('#type_id').val();
            var table_type = $('#table_type').val();
            $.ajax({
                url: "/get-parent-by-table-type?type=" + type + "&table_type=" + table_type,
                type: "GET",
                dataType: 'json',
                success: function(result) {
                    $("#parent").html('<option value="">Select Table Type</option>');
                    $.each(result, function(key, value) {
                        $("#parent").append('<option value="' + value.id + '">' + value
                            .name + '</option>');
                    });

                    $("#parent").select2({
                        placeholder: "Select Parent ..."
                    }).trigger("change");
                }
            });
        });
    </script>
@endsection
