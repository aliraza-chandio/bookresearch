@extends('layouts.master')
@section('page-title')
    Create User
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
                    <h3>Create User</h3>
                </div>
                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-lg-12 form-group text-right top_search">
                        <a href="/users" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <br />
                            <form class="form-horizontal form-label-left" action="{{ route('users.store') }}"
                                method="POST" id="userForm">
                                @csrf
                                @include('layouts.flash-message')
                                <div class="form-group row">
                                    <div class="col-md-12 col-sm-12">
                                        <label class="control-label fs18">Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Name" id="full_name"
                                            name="full_name" value="{{ old('full_name') }}">

                                        @error('full_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <label class="control-label fs18">Username <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Username" id="username"
                                            name="username" value="{{ old('username') }}">

                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <label class="control-label fs18">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" placeholder="Email" id="email"
                                            name="email" value="{{ old('email') }}">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <label class="control-label fs18">Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" placeholder="Password" id="password"
                                            name="password" value="{{ old('password') }}">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <label class="control-label fs18">Role <span class="text-danger">*</span></label>
                                        <select class="form-control" id="role" name="role">
                                            <option {{ old('role') == 'editor' ? 'selected' : '' }} value="editor">Editor</option>
                                            <option {{ old('role') == 'viewer' ? 'selected' : '' }} value="viewer">Viewer</option>
                                            <option {{ old('role') == 'subscriber' ? 'selected' : '' }} value="subscriber">Subscriber</option>
                                        </select>

                                        @error('role')
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
<script>
    $(document).ready(function() {
        $("#userForm").validate({
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true
                },
                role: {
                    required: true
                },
                password: {
                    required: true
                },
            },
            messages: {
                name: {
                    required: "Name cannot be blank.",
                },
                email: {
                    required: "Email cannot be blank.",
                },
                role: {
                    required: "Role cannot be blank.",
                },
                password: {
                    required: "Password cannot be blank.",
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
        $('#type_id').select2({
            placeholder: "Select a Type ..."
        });
    });
</script>
@endsection
