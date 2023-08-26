@extends('layouts.master')
@section('page-title')
Create Type
@endsection
@section('content')
<style>
    .form-control.error {
        border-color: red !important;
    }

    .error {
        color: red !important;
    }

    .select2-container .select2-selection--single .select2-selection__rendered {
        font-size: 16px !important;
    }
    .generateImage{
        margin-top: 42px !important;
    }
</style>
<div class="right_col" role="main">
    <div>
        <div class="page-title">
            <div class="title_left">
                <h3>Create Type</h3>
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
                        <form class="form-horizontal form-label-left" action="{{ route('types.store') }}"
                            method="POST" id="productForm">
                            @csrf
                            @include('layouts.flash-message')
                            <div class="form-group row">
                                <div class="col-md-12 col-sm-12 ">
                                    <label class="control-label fs18">Title <span class="text-danger">*</span></label>

                                    <input type="text" class="form-control" name="title" id="title" >
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-12 col-sm-12 ">
                                    <label class="control-label fs18">Description <span class="text-danger">*</span></label>

                                    <textarea type="text" class="form-control summernote" name="description" id="description" ></textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-12 col-sm-12 ">
                                    <label class="control-label fs18">Status <span class="text-danger">*</span></label>
                                    <select class="form-control" name="status" id="status">
                                        <option>Please Select</option>
                                        <option value="1">Active</option>
                                        <option value="2">Deactive</option>
                                    </select>

                                    @error('status')
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
    $(document).ready(function() {
        $("#type_id").select2({
            placeholder: "Select a Type ..."
        }).trigger("change");

        $('.summernote').summernote({
            height: 200,
        });
    });
$("#productForm").validate({
    rules: {
        type_id: {
            required: true
        },
        type_id: {
            required: true
        },
        order: {
            required: true
        },
    },
    messages: {
        type_id: {
            required: "Type Id cannot be blank.",
        },
        type_id: {
            required: "Related Product Id cannot be blank.",
        },
        order: {
            required: "Order cannot be blank.",
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
$("select").on("select2:close", function(e) {
    $(this).valid();
});

$('#table_type').on('change', function() {
    var type = $('#type_id').val();
    var table_type = $('#table_type').val();
    $.ajax({
        url: "/get-parent-by-table-type?type=" + type + "&table_type=" + table_type,
        type: "GET",
        dataType: 'json',
        success: function(result) {
            $("#related_id").html('<option value="">Select Related ID</option>');
            $.each(result, function(key, value) {
                $("#related_id").append('<option value="' + value.id + '">' + value
                    .name + '</option>');
            });

            $("#related_id").select2({
                placeholder: "Select Related ID..."
            }).trigger("change");
        }
    });
});
</script>
@endsection
