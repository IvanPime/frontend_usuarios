@extends('layouts.login')

@section('content')
    <form class="form w-100" id="form_login" method="POST" action="{{ route('login') }}" autocomplete="nope">
        @csrf
        <div class="text-center mb-11">
            <img alt="Logo" src="{{ asset("img/logo.jpg") }}" class="h-100px" />
            <h1 class="text-gray-900 fw-bolder mt-10 mb-3">Iniciar sesión</h1>
        </div>
        <div class="row g-3 mb-9">
            <div class="col-md-6">
                <a href="#" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                <img alt="Logo" src="assets/media/svg/brand-logos/google-icon.svg" class="h-15px me-3" />Con Google</a>
            </div>
            <div class="col-md-6">
                <a href="#" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                <img alt="Logo" src="assets/media/svg/brand-logos/apple-black.svg" class="theme-light-show h-15px me-3" />
                <img alt="Logo" src="assets/media/svg/brand-logos/apple-black-dark.svg" class="theme-dark-show h-15px me-3" />Con Apple</a>
            </div>
        </div>
        <div class="separator separator-content my-14">
            <span class="w-125px text-gray-500 fw-semibold fs-7">O con correo electrónico</span>
        </div>
        <div class="fv-row mb-8">
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="off" placeholder="Usuario">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="fv-row mb-3">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Contraseña">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
            <div></div>
            <a href="authentication/layouts/corporate/reset-password.html" class="link-primary">¿Olvidó su contraseña?</a>
        </div>
        <div class="d-grid mt-12">
            <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                <span class="indicator-label">Ingresar</span>
            </button>
        </div>
    </form>
@endsection

@push('scripts')
    <script src="{{ asset('assets/plugins/custom/jqueryvalidate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/jqueryvalidate/messages_es.js') }}"></script>
	<script>
        var blockUI = new KTBlockUI(document.querySelector("#kt_body"), {
            message: '<div class="blockui-message"><span class="spinner-border text-primary"></span> Loading...</div>',
        });
        const formLogin = $("#form_login");
        const validatorFormLogin = formLogin.validate({
            validClass: "is-valid",
            errorClass: "is-invalid",   
            submitHandler: function(form) {
                blockUI.block();
                form.submit();
            }
        });
    </script>
@endpush
