@extends('authView.main')

@section('formAuth')
    <form class="form w-100" action="{{ route('login') }}" method="POST">
        @csrf
        <!--begin::Heading-->
        <div class="text-center mb-11">
            <!--begin::Title-->
            <h1 class="text-dark fw-bolder mb-3">Masuk</h1>
            <!--end::Title-->
            <!--begin::Alert-->
            @if (Session::has('error'))
                <div class="alert alert-dismissible bg-light-danger border border-danger d-flex flex-column flex-sm-row p-5 mb-10">
                    
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column mx-auto">
                        <!--begin::Title-->
                        <h5 class="mb-1 text-danger">
                            <!--begin::Icon-->
                                <i class="ki-duotone ki-information fs-1hx text-danger">
                                    <i class="path1"></i>
                                    <i class="path2"></i>
                                    <i class="path3"></i>
                                </i>
                            <!--end::Icon-->
                            Peringatan!
                        </h5>
                        <!--end::Title-->

                        <!--begin::Content-->
                        <span class="fs-7 text-danger">{{ Session::get('error') }}.</span>
                        <!--end::Content-->
                    </div>
                    <!--end::Wrapper-->

                </div>
            @endif
            @if(Session::has('status'))
            <div class="alert alert-dismissible bg-light-success border border-success d-flex flex-column flex-sm-row p-5 mb-10">
                
                <!--begin::Wrapper-->
                <div class="d-flex flex-column mx-auto">
                    <!--begin::Title-->
                    <h5 class="mb-1 text-success">
                        <!--begin::Icon-->
                            <i class="ki-duotone ki-shield-tick fs-1hx text-success">
                                <i class="path1"></i>
                                <i class="path2"></i>
                            </i>
                        <!--end::Icon-->
                        Password Berhasil diubah!
                    </h5>
                    <!--end::Title-->

                    <!--begin::Content-->
                    <span class="fs-7 text-success">{{ Session::get('status') }}.</span>
                    <!--end::Content-->
                </div>
                <!--end::Wrapper-->

            </div>
        @endif
            <!--end::Alert-->
        </div>
        <!--begin::Input group=-->
        <div class="fv-row mb-8">
            <!--begin::Email-->
            <input type="text" placeholder="Username / Email" name="EmailOrUsername" value="{{ old('EmailOrUsername') }}" oninput="hapusSpasiUsername()" id="no-space-username" autocomplete="off" class="form-control bg-transparent" />
            <!--end::Email-->
        </div>
        <!--end::Input group=-->
        <div class="fv-row mb-3">
            <!--begin::Password-->
            <input type="password" placeholder="Password" name="password" autocomplete="off" class="form-control bg-transparent" />
            <!--end::Password-->
        </div>
        <!--end::Input group=-->
        <!--begin::Wrapper-->
        <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
            <div></div>
            <!--begin::Link-->
            <a href="{{ route('lupa_password') }}" class="link-primary">Lupa Password ?</a>
            <!--end::Link-->
        </div>
        <!--end::Wrapper-->
        <!--begin::Submit button-->
        <div class="d-grid mb-10">
            <button type="submit" id="kt_page_loading_overlay" class="btn btn-primary">
                <!--begin::Indicator label-->
                <span class="indicator-label">Masuk</span>
                <!--end::Indicator label-->
            </button>
        </div>
        <!--end::Submit button-->
        <!--begin::Sign up-->
        <div class="text-gray-500 text-center fw-semibold fs-6">Belum punya Akun?
        <a href="{{ route('registrasi') }}" class="link-primary">Daftar</a></div>
        <!--end::Sign up-->
    </form>
@endsection