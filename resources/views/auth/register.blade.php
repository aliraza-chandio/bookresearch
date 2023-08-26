@extends('layouts.app')

@section('page-title', 'Register')

@section('content')

<style>

select#role_id option,select#class_id option ,select#subject_id option {
    background: transparent;
    color: black;
}
select#role_id,select#class_id ,select#subject_id {
    background: transparent;
    color: black;
    border: none;
    width: 92%;
    outline: none;
    margin-left: 35px;
    height: 40px;
    overflow: hidden;
}
.login100-form-title
{
    font-size: 24px !important;
}
.select2-container--default::placeholder {
  color: black !important;
}
::-webkit-input-placeholder { /* WebKit, Blink, Edge */
    color:    #000 !important;
}
:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
   color:    #000 !important;
   opacity:  1;
}
::-moz-placeholder { /* Mozilla Firefox 19+ */
   color:    #000 !important;
   opacity:  1;
}
:-ms-input-placeholder { /* Internet Explorer 10-11 */
   color:    #000 !important;
}
::-ms-input-placeholder { /* Microsoft Edge */
   color:    #000 !important;
}

::placeholder { /* Most modern browsers support this now. */
   color:    #000 !important;
}
span.select2
{
    width: 100% !important;
}
.select2-container--default .select2-selection--multiple
{
    background: transparent;
    border: none !important;
    border-radius: 0px;
}
</style>

<div class="wrap-login100">

    @if ($errors->any())

        <div class="alert alert-danger">

            <ul>

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form class="login100-form validate-form"  method="POST" action="{{ route('register') }}">

        @csrf

        <div class="text-center logo-img">

            <img src="{{ config('global.imgLogin') }}/logo.png" alt="{{ config('global.site') }}">

        </div>



        <span class="login100-form-title p-b-34 p-t-27 text-capitalize">

            Register

        </span>



        <div class="wrap-input100 validate-input" data-validate = "Enter Name">

            <input class="input100" type="text" name="name" placeholder="Name" value="{{ old('name') }}" required>

            <span class="focus-input100" data-placeholder="&#xf205;"></span>

        </div>

        <div class="wrap-input100 validate-input" data-validate = "Enter Email">

            <input class="input100" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>

            <span class="focus-input100" data-placeholder="&#xf15a;"></span>

        </div>



        <div class="wrap-input100 validate-input" data-validate="Enter password">

            <input class="input100" type="password" name="password" placeholder="Password"   required>

            <span class="focus-input100" data-placeholder="&#xf191;"></span>

        </div>

        <div class="wrap-input100 validate-input" data-validate="Enter Confirm Password">
            <input class="input100" type="password" name="password_confirmation" placeholder="Confirm Password" required>
            <span class="focus-input100" data-placeholder="&#xf190;"></span>
        </div>

        <div class="wrap-input100 validate-input" data-validate="Select Role">
            <span class="focus-input100" style="margin-top: 1px;" data-placeholder="&#xf201;"></span>
            <select class="registerRole" name="role_id" id="role_id" required>
                <option value="">Please select your role</option>
                <option value="2">Student</option>
                <option value="1">Teacher</option>
            </select>
        </div>


        <div class="wrap-input100 validate-input" data-validate="Select Role">
            <span class="focus-input100" style="margin-top: 1px;" data-placeholder="&#xf321;"></span>
            <select class="registerRole" name="class_id" id="class_id" required>
                <option value="">Please select the class</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->title }}</option>
                @endforeach
            </select>
        </div>


        <div class="wrap-input100 validate-input" data-validate="Select Role">
            <select class="registerRole" name="subject_id[]" id="subject_id" required multiple>
            </select>
        </div>



        <div class="container-login100-form-btn">
            <button type="submit" class="login100-form-btn">
                Register
            </button>
        </div>





        <div class="text-center pt-5 txt1">



            <a class="txt1" href="/e-learning/login">

                Login

            </a> |

            <a class="txt1" href="/e-learning/forgot-password">

                Forgot Password?

            </a>

        </div>

    </form>

</div>

@endsection
