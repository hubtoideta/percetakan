@extends('dashView.main')

@section('body')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                Paket & Fitur Langganan</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('home') }}" class="text-muted text-hover-primary">App</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">Paket & Fitur Langganan</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
    </div>
    <!--end::Toolbar container-->
</div>
<!--end::Toolbar-->

<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl">
        <!--begin::Row-->
        <div class="row">
            <!--begin::Setting Paket-->
            <div class="col-sm-6 mx-auto">
                <!--begin::Card-->
                <form method="POST" action="{{ route('editPaket') }}" class="card">
                    @csrf
                    <div class="card-header">
                        <h5 class="card-title">Data Paket</h5>
                    </div>
                    <!--begin::Body-->
                    <div class="card-body"> 
                        <!--begin::Alert-->
                        @if(Session::has('success'))
                        <div class="alert alert-dismissible bg-light-success d-flex flex-row flex-sm-row p-5 mb-10">
                            <!--begin::Icon-->
                            <i class="ki-duotone ki-notification-bing fs-2hx text-success me-4 mb-5 mb-sm-0"><span
                                    class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                            <!--end::Icon-->
    
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-column pe-0 pe-sm-10">
                                <!--begin::Title-->
                                <h4 class="fw-semibold">Berhasil</h4>
                                <!--end::Title-->
    
                                <!--begin::Content-->
                                <span>Data telah di perbaharui.</span>
                                <!--end::Content-->
                            </div>
                            <!--end::Wrapper-->
    
                            <!--begin::Close-->
                            <button type="button"
                                class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
                                data-bs-dismiss="alert">
                                <i class="ki-duotone ki-cross fs-1 text-success"><span class="path1"></span><span
                                        class="path2"></span></i>
                            </button>
                            <!--end::Close-->
                        </div>
                        @endif
                        <!--end::Alert-->
                        @foreach ($listPaket as $key => $value)
                        <div class="row">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">{{ $value['paket'] }}</label>
                            <div class="col-lg-8">
                                <div class="input-group input-group-sm input-group-solid">
                                    <span class="input-group-text">Rp.</span>
                                    <input type="number" class="form-control @error('harga.'.$key) is-invalid @enderror>" 
                                        name="harga[]" 
                                        placeholder="Harga / Bulan" 
                                        value="{{ old('harga') != 0  ? old('harga')[$key] : $value['harga_paket'] }}">
                                        @error('harga.'.$key)
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                </div>
                            </div>

                        </div>
                        @endforeach
                    </div>
                    <!--end::Body-->
                    <!--begin::footer-->
                    <div class="card-footer">
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        </div>
                    </div>
                    <!--end::footer-->
                </form>
                <!--end::Card-->
            </div>
            <!--end::Setting Paket-->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->
@endsection
