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
                Kelolah Toko</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('home') }}" class="text-muted text-hover-primary">Dasbor</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">Kelolah Toko</li>
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
        <!--begin::Basic info-->
        <div class="card mb-5 mb-xl-10">
            <!--begin::Card header-->
            <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                data-bs-target="#kt_account_profile_details" aria-expanded="true"
                aria-controls="kt_account_profile_details">
                <!--begin::Card title-->
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">Informasi Toko</h3>
                </div>
                <!--end::Card title-->
            </div>
            <!--begin::Card header-->
            <!--begin::Content-->
            <div id="kt_account_settings_profile_details" class="collapse show">
                <!--begin::Form-->
                <form method="POST" action="{{ $infoDataCount > 0 ? route('edit-toko') : route('input-toko') }}"
                    class="form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_store" value="{{ $infoDataCount > 0 ? $infoData->id_store : '' }}">
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">
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
                                <span>Informasi toko anda telah di perbaharui.</span>
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
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Logo</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                <!--begin::Image input-->
                                <div class="image-input image-input-outline {{ $logo == 'none' ? 'image-input-empty' : '' }}"
                                    data-kt-image-input="true"
                                    style="background-image: url('assets/media/svg/avatars/blank.svg')">
                                    <!--begin::Preview existing avatar-->
                                    <div class="image-input-wrapper w-125px h-125px"
                                        style="background-image: {{ $logo == 'none' ? 'none' : 'url(assets/media/logo/' . $logo . ')' }}">
                                    </div>
                                    <!--end::Preview existing avatar-->
                                    <!--begin::Label-->
                                    <label
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                        title="Change avatar">
                                        <i class="ki-duotone ki-pencil fs-7">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <!--begin::Inputs-->
                                        <input type="file" name="logoInput" accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="avatar_remove" />
                                        <!--end::Inputs-->
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Cancel-->
                                    <span
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                        title="Cancel avatar">
                                        <i class="ki-duotone ki-cross fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                                    <!--end::Cancel-->
                                    <!--begin::Remove-->
                                    <span
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                        title="Remove avatar">
                                        <i class="ki-duotone ki-cross fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                                    <!--end::Remove-->
                                </div>
                                <!--end::Image input-->
                                <!--begin::Hint-->
                                <br>
                                @error('logoInput')
                                <span class="invalid" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <div class="form-text">Ukuran Logo: 4x4<br>Format file: png, jpg, jpeg.</div>
                                <!--end::Hint-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Nama Toko</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                <!--begin::Row-->
                                <input type="text" name="store_name"
                                    class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 @error('store_name') is-invalid @enderror"
                                    placeholder="Masukkan nama toko anda."
                                    value="{{ old('store_name') != '' ? old('store_name') : ($infoDataCount > 0 ? $infoData->store_name : '') }}" />
                                @error('store_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <!--end::Row-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Alamat Email</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                <!--begin::Row-->
                                <input type="email" name="store_email"
                                    class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 @error('store_email') is-invalid @enderror"
                                    placeholder="Masukkan email toko anda."
                                    value="{{ old('store_email') != '' ? old('store_email') : ($infoDataCount > 0 ? $infoData->store_email : '') }}" />
                                @error('store_email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <!--end::Row-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                <span class="required">Nomor Telpn</span>
                                <span class="ms-1" data-bs-toggle="tooltip" title="Nomor telpn harus aktif">
                                    <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                </span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                <!--begin::Row-->
                                <div class="input-group input-group-solid">
                                    <span class="input-group-text">+62</span>
                                    <input type="tel" name="noTokoInput"
                                        class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 @error('noTokoInput') is-invalid @enderror"
                                        placeholder="cth: 897xxxxxx"
                                        value="{{ old('noTokoInput') != '' ? old('noTokoInput') : ($infoDataCount > 0 ? $infoData->contact : '') }}" />
                                    @error('noTokoInput')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                <span class="required">Deskripsi</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                <!--begin::Row-->
                                <textarea class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 @error('deskTokoInput') is-invalid @enderror"
                                    placeholder="Tentang toko anda." 
                                    maxlength="150" 
                                    name="deskTokoInput"
                                    placeholder="" rows="4">{{ old('deskTokoInput') != '' ? old('deskTokoInput') : ($infoDataCount > 0 ? $infoData->deskripsi : '') }}</textarea>
                                @error('deskTokoInput')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <!--end::Row-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Card body-->
                    <!--begin::Actions-->
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <a href="{{ route('home') }}"
                            class="btn btn-light btn-active-light-primary btn-sm me-2">Discard</a>
                        <button type="submit" class="btn btn-primary btn-sm" id="kt_account_profile_details_submit">Save
                            Changes</button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Basic info-->
    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->
@endsection
