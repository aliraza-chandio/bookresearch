@extends('layouts.master')
@section('page-title')
Create Product
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
                <h3>Create Product</h3>
            </div>
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-lg-12 form-group text-right top_search">
                    <a href="/products" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_content">
                        <br />
                        <form class="form-horizontal form-label-left" action="{{ route('products.store') }}"
                            method="POST" id="productForm">
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
                                    <label class="control-label fs18">Extra </label>
                                    <input type="text" class="form-control" placeholder="Extra" id="extra" name="extra"
                                        value="{{ old('extra') }}">

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
                                <div class="col-md-6 col-sm-6">
                                    <label class="control-label fs18">Desc </label>
                                    <textarea name="desc" id="desc" class="w-100" rows="6">{{ old('desc') }}</textarea>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="control-label fs18">Keywords <span
                                            class="text-danger">*</span></label>
                                    <textarea name="keywords" id="keywords" class="w-100"
                                        rows="6">{{ old('keywords') }}</textarea>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <label class="control-label fs18">Birth Day <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Birth Day"
                                        name="date_birthday" value="{{ old('date_birthday') ? old('date_birthday') : '0000-00-00'  }}">

                                    @error('date_birthday')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <label class="control-label fs18">Death Day <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Death Day"
                                        name="date_death" value="{{ old('date_death') ? old('date_death') : '0000-00-00'  }}">

                                    @error('date_death')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <label class="control-label fs18">Birth Day G</label>
                                    <input type="text" class="form-control" placeholder="Birth Day G"
                                        name="date_birthday_g" value="{{ old('date_birthday_g') }}">

                                    @error('date_birthday_g')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <label class="control-label fs18">Death Day G </label>
                                    <input type="text" class="form-control" placeholder="Death Day G"
                                        name="date_death_g" value="{{ old('date_death_g') }}">

                                    @error('date_death_g')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-3 col-sm-3 ">
                                    <label class="control-label fs18">Image <span class="text-danger">*</span></label>
                                    <select class="form-control" name="image_visible">
                                        <option {{ old('image_visible')==0 ? 'selected' : '' }} value="0">Hidden
                                        </option>
                                        <option {{ old('image_visible')==1 ? 'selected' : '' }} value="1">Visible
                                        </option>
                                    </select>

                                    @error('image_visible')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-3 col-sm-3 ">
                                    <label class="control-label fs18">Featured <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" name="featured">
                                        <option {{ old('featured')==0 ? 'selected' : '' }} value="0">No</option>
                                        <option {{ old('featured')==1 ? 'selected' : '' }} value="1">Yes</option>
                                    </select>

                                    @error('featured')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-3 col-sm-3 ">
                                    <label class="control-label fs18">Api Featured <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" name="api_featured">
                                        <option {{ old('api_featured')==0 ? 'selected' : '' }} value="0">No
                                        </option>
                                        <option {{ old('api_featured')==1 ? 'selected' : '' }} value="1">Yes
                                        </option>
                                    </select>

                                    @error('api_featured')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-3 col-sm-3 ">
                                    <label class="control-label fs18">Status <span class="text-danger">*</span></label>
                                    <select class="form-control" name="featured">
                                        <option {{ old('featured')==0 ? 'selected' : '' }} value="0">Active</option>
                                        <option {{ old('featured')==1 ? 'selected' : '' }} value="1">Deacctive</option>
                                    </select>

                                    @error('featured')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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
            $("#productForm").validate({
                rules: {
                    type_id: {
                        required: true
                    },
                    keywords: {
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
                    type_id: {
                        required: "Type cannot be blank.",
                    },
                    keywords: {
                        required: "Keywords cannot be blank.",
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
            });
            $("input").bind("propertychange change click keyup input paste", function(e) {
                $(this).valid();
            });
            $("textarea").bind("propertychange change click keyup input paste", function(e) {
                $(this).valid();
            });
            $("select").on("select2:close", function(e) {
                $(this).valid();
            });
            $('#type_id').select2({
                placeholder: "Select a Type ..."
            });
            $('.date').datetimepicker({
                format: 'YYYY-MM-DD'
            });
        });
</script>
@endsection
