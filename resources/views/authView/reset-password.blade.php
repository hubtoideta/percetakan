@extends('authView.main')

@section('formAuth')

<form class="form w-100" method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="email" value="{{ request()->get('email') }}">
    <input type="hidden" name="token" value="{{ $token }}">
    <!--begin::Heading-->
    <div class="text-center mb-11">
        <!--begin::Title-->
        <h1 class="text-dark fw-bolder mb-3">Reset Password</h1>
        <!--end::Title-->
        
            <!--begin::Alert-->
            @if($errors->has('emails'))
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
                        <span class="fs-7 text-danger">{{ $errors->first('emails') }}.</span>
                        <!--end::Content-->
                    </div>
                    <!--end::Wrapper-->

                </div>
            @endif

            <!--end::Alert-->
    </div>
    <!--begin::Input group-->
    <div class="fv-row mb-8" data-kt-password-meter="true">
        <!--begin::Wrapper-->
        <div class="mb-1">
            <!--begin::Input wrapper-->
            <div class="position-relative mb-3">
                <input class="form-control bg-transparent @error('password') is-invalid @enderror" type="password" placeholder="Password" name="password" autocomplete="off" />
                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                    <i class="ki-duotone ki-eye-slash fs-2"></i>
                    <i class="ki-duotone ki-eye fs-2 d-none"></i>
                </span>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!--end::Input wrapper-->
            <!--begin::Meter-->
            <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
            </div>
            <!--end::Meter-->
        </div>
        <!--end::Wrapper-->
        <!--begin::Hint-->
        <div class="text-muted">Minimal 8 Karakter atau lebih, kombinasikan dengan Huruf kapital, Angka dan Simbol.</div>
        <!--end::Hint-->
    </div>
    <!--end::Input group=-->
    <!--end::Input group=-->
    <div class="fv-row mb-8">
        <!--begin::Repeat Password-->
        <input placeholder="Repeat Password" name="password_confirmation" type="password"  autocomplete="off" class="form-control bg-transparent" />
        <!--end::Repeat Password-->
    </div>
    <!--end::Input group=-->
    <!--begin::Submit button-->
    <div class="d-grid mb-10">
        <button type="submit" id="kt_page_loading_overlay" class="btn btn-primary">
            <!--begin::Indicator label-->
            <span class="indicator-label">Reset Password</span>
            <!--end::Indicator label-->
        </button>
    </div>
    <!--end::Submit button-->
    <!--begin::Sign up-->
    <div class="text-gray-500 text-center fw-semibold fs-6">Sudah memiliki akun?
    <a href="{{ route('login') }}" class="link-primary fw-semibold">Login</a></div>
    <!--end::Sign up-->
</form>
@endsection