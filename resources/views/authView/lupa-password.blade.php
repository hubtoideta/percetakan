@extends('authView.main')

@section('formAuth')
    <form class="form w-100" action="{{ route('lupa_password') }}" method="POST">
        @csrf
        <!--begin::Heading-->
        <div class="text-center mb-11">
            <!--begin::Title-->
            <h1 class="text-dark fw-bolder mb-3">Lupa Password ?</h1>
            <div class="text-gray-500 fw-semibold fs-6">Masukkan Email Anda untuk mereset Password.</div>
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
                            Verifikasi Berhasil dikirim!
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
            <input type="text" placeholder="Email" name="email" id="no-space-email" value="{{ old('email') }}" oninput="hapusSpasiEmail()" autocomplete="off" class="form-control bg-transparent @error('email') is-invalid @enderror"/>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <!--end::Email-->
        </div>
        <!--end::Input group=-->
        
        <!--begin::Submit button-->
        <div class="d-flex flex-wrap justify-content-center pb-lg-0 mb-5">
            <button type="submit" id="kt_page_loading_overlay" class="btn btn-sm btn-primary me-4">
                <!--begin::Indicator label-->
                <span class="indicator-label">Submit</span>
                <!--end::Indicator label-->
            </button>
            <a href="{{ route('login') }}" class="btn btn-sm btn-danger">Batal</a>
        </div>
        <!--end::Submit button-->
        <!--begin::Sign up-->
        <div class="text-gray-500 text-center fw-semibold fs-6">Belum punya Akun?
        <a href="{{ route('registrasi') }}" class="link-primary">Daftar</a></div>
        <!--end::Sign up-->
    </form>
@endsection