@extends('authView.main')

@section('formAuth')

<form class="form w-100" method="POST" action="{{ route('registrasiAction') }}">
    @csrf
    <!--begin::Heading-->
    <div class="text-center mb-11">
        <!--begin::Title-->
        <h1 class="text-dark fw-bolder mb-3">Registrasi</h1>
        <!--end::Title-->
    </div>
    <!--begin::Input group-->
    <div class="fv-row">
        <!--begin::Row-->
        <div class="row">
            <!--begin::Col-->
            <div class="col-lg-6 mb-3">
                <!--begin::Option-->
                <input type="radio" class="btn-check" name="account_type" value="Owner" @if(old('account_type') == "" || old('account_type') == "Owner") checked="checked" @endif id="kt_create_account_form_account_type_corporate" />
                <label class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center" for="kt_create_account_form_account_type_corporate">
                    <!--begin::Info-->
                    <span class="d-block fw-semibold"> 
                        <i class="ki-duotone ki-home fs-3x text-center"></i>
                        <div class="text-start">
                            <span class="text-dark fw-bold d-block fs-5 mb-2" >Percetakan</span>
                            <span class="text-muted fw-semibold fs-7">Buat toko online anda dan kelolah percetakan anda.</span>
                        </div>
                    </span>
                    <!--end::Info-->
                </label>
                <!--end::Option-->
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-lg-6 mb-3">
                <!--begin::Option-->
                <input type="radio" class="btn-check" name="account_type" value="Freelance" @if(old('account_type') == "Freelance") checked="checked" @endif id="kt_create_account_form_account_type_personal" />
                <label class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center mb-10" for="kt_create_account_form_account_type_personal">
                    <!--begin::Info-->
                    <span class="d-block fw-semibold">
                        <i class="ki-duotone ki-badge fs-3x text-center">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                            <span class="path5"></span>
                        </i>
                        <div class="text-start">
                            <span class="text-dark fw-bold d-block fs-5 mb-2">Freelance</span>
                            <span class="text-muted fw-semibold fs-7">Pekerja Lepas untuk desainer dan Pemasangan.</span>
                        </div>
                    </span>
                    <!--end::Info-->
                </label>
                <!--end::Option-->
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group=-->
    <div class="fv-row mb-8">
        <!--begin::username-->
        <input type="text" placeholder="Username" name="username" id="no-space-username" value="{{ old('username') }}" oninput="hapusSpasiUsername()" autocomplete="off" class="form-control bg-transparent @error('username') is-invalid @enderror"/>
        @error('username')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <!--end::username-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group=-->
    <div class="fv-row mb-8">
        <!--begin::Email-->
        <input type="text" placeholder="Email" name="email" id="no-space-email" value="{{ old('email') }}" oninput="hapusSpasiEmail()" autocomplete="off" class="form-control bg-transparent @error('email') is-invalid @enderror"/>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <!--end::Email-->
    </div>
    <!--end::Input group-->
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
    <!--begin::Accept-->
    <div class="fv-row mb-8">
        <label class="form-check form-check-inline">
            <input class="form-check-input  @error('toc') is-invalid @enderror" type="checkbox" name="toc" value="1" />
            <span class="form-check-label fw-semibold text-gray-700 fs-base ms-1">Saya menyetujui
            <a href="#" class="ms-1 link-primary">Syarat dan Ketentuan</a>.</span>
        </label>
    </div>
    <!--end::Accept-->
    <!--begin::Submit button-->
    <div class="d-grid mb-10">
        <button type="submit" id="kt_page_loading_overlay" class="btn btn-primary">
            <!--begin::Indicator label-->
            <span class="indicator-label">Registrasi</span>
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