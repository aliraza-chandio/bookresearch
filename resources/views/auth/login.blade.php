@extends('layouts.app')

@section('page-title', 'Login')

@section('content')
<style>

    .logoImg
    {
        width: 236px;
    }

.login100-form-title
{
    font-size: 24px !important;
}
</style>
<div class="wrap-login100">



    <form class="login100-form validate-form"  method="POST" action="{{ route('login') }}">

        @csrf

        <div class="text-center logo-img">

            <img src="{{ config('global.imgLogin') }}/logo.png?" class="logoImg" alt="{{ config('global.site') }}">

        </div>



        <span class="login100-form-title p-b-34 p-t-27 text-capitalize">

            Login

        </span>

        @if ($errors->any())

            <div class="alert alert-danger">

                <ul>

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        @if ($message = Session::get('warning'))

            <div class="alert alert-warning mb-5">

                {{ $message }}

            </div>

        @endif

        @if ($message = Session::get('primary'))

            <div class="alert alert-primary mb-5">

                {{ $message }}

            </div>

        @endif

        @if ($message = Session::get('error'))

            <div class="alert alert-danger mb-5">

                {{ $message }}

            </div>

        @endif

        @if ($message = Session::get('success'))

            <div class="alert alert-success mb-5">

                {{ $message }}

            </div>

        @endif

        <div class="wrap-input100 validate-input" data-validate = "Enter email">

            <input class="input100" type="email" name="email" placeholder="Email" value="{{ old('email') }}">

            <span class="focus-input100"  data-placeholder="&#xf15a;"></span>

        </div>



        <div class="wrap-input100 validate-input" data-validate="Enter password">

            <input class="input100" type="password" name="password" placeholder="Password"  value="">

            <span class="focus-input100" data-placeholder="&#xf191;"></span>

        </div>



        {{-- <div class="contact100-form-checkbox">

            <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me" {{ old('remember') ? 'checked' : '' }}>

            <label class="label-checkbox100" for="ckb1">

                Remember me

            </label>

        </div> --}}



        <div class="container-login100-form-btn">

            <button type="submit" class="login100-form-btn">

                Login

            </button>

        </div>



        <div class="text-center pt-5 txt1">



            {{-- <a class="txt1" href="/e-learning/register">

                Register

            </a> |

            <a class="txt1" href="/e-learning/forgot-password">

                Forgot Password?

            </a> --}}

        </div>

    </form>

</div>

@endsection
