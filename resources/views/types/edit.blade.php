@extends('layouts.master')
@section('page-title')
Edit Type
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
                <h3>Edit Type</h3>
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
                        <form class="form-horizontal form-label-left"
                            action="{{ route('types.update',$type->id) }}" method="POST"
                            id="productForm">
                            @csrf
                            @method('PUT')
                            @include('layouts.flash-message')
                            <div class="form-group row">
                                <input type="hidden" name="product_id" value="{{ $type->product_id }}">
                                <input type="hidden" name="type_id" id="type_id"  value="{{ $_GET['type_id'] }}">
                                {{-- <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label fs18">Products <span class="text-danger">*</span></label>
                                    <select class="form-control" name="product_id" id="product_id">
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('lang')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div> --}}

                                <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label fs18">Select Table Type <span class="text-danger">*</span></label>
                                    <select class="form-control" name="table_type" id="table_type">
                                    </select>

                                    @error('table_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-sm-6">
                                    <label class="control-label fs18">Related ID <span
                                            class="text-danger">*</span></label>

                                    <select class="form-control" name="related_id" id="related_id">
                                    </select>
                                    @error('related_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Update</button>
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

<script>
    $(document).ready(function() {
        $("#product_id").select2({
            placeholder: "Select a product ..."
        }).trigger("change");

        $('.summernote').summernote({
            height: 200,
        });
        var type = $('#type_id').val();
        $.ajax({
            url: "/get-table-type-by-type-id?type={{ $type->type_id }}",
            type: "GET",
            dataType: 'json',
            success: function(result) {
                $("#table_type").html('');
                $.each(result, function(key, value) {
                    var table_type = {{ $type->table_type }};
                    if(table_type == value.id){
                        $("#table_type").append('<option selected value="' + value.id + '">' + value.name + '</option>');
                    }
                    else{
                        $("#table_type").append('<option value="' + value.id + '">' + value.name + '</option>');
                    }
                });
                $("#table_type").select2({
                    placeholder: "Select Table Type ..."
                }).val({{ $type->table_type }}).trigger("change");
                $.ajax({
                    url: "/get-parent-by-table-type?type={{ $type->type_id }}&table_type={{ $type->table_type }}",
                    type: "GET",
                    dataType: 'json',
                    success: function(result) {
                        $("#parent").html('');
                        $.each(result, function(key, value) {
                            $("#parent").append('<option value="' + value.id + '">' + value
                                .name + '</option>');
                        });

                        $("#parent").select2({
                            placeholder: "Select Parent ..."
                        }).val({{ $type->parent }}).trigger("change");
                    }
                });
            }
        });
    });
$("#productForm").validate({
    rules: {
        table_type: {
            required: true
        },
        related_id: {
            required: true
        },
    },
    messages: {
        table_type: {
            required: "Table Type cannot be blank.",
        },
        related_id: {
            required: "Related Id cannot be blank.",
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
</script>
@endsection
