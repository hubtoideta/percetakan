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
                {{ $title }}</h1>
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
                <li class="breadcrumb-item text-muted">{{ $title }}</li>
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
        <!--begin::Card-->
        <div class="card">
            <div class="card-body p-8">
                <div class="row mb-3">
                    <form method="POST" action="pengguna/{{ $slugg }}" class="col-sm-3 ms-auto">
                        @csrf
                        <div class="input-group input-group-sm mb-5">
                            <input type="text" name="name" value="{{ $name }}" class="form-control" placeholder="Masukkan username atau email" aria-label="Masukkan nama toko atau owner" aria-describedby="button-addon2">
                            <button class="btn btn-primary mx-auto" type="submit" id="button-addon2"><i class="ki-outline ki-magnifier"></i></button>
                        </div>
                    </form>
                </div>
                <div class="table-responsive mb-2">
                    <table class="table table-row-dashed align-middle gs-0 gy-3 my-0 table-hover">
                        <thead>
                            <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                                <th class="p-0 pb-3 min-w-150px text-start">USERS</th>
                                <th class="p-0 pb-3 min-w-100px text-end pe-13">CONTACT</th>
                                <th class="p-0 pb-3 w-50px text-end">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($data['items']) > 0)
                                @foreach ($data['items'] as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-50px me-3">
                                                    @if ($item['foto'] == '' || $item['foto'] == 'none')
                                                        <img src="assets/media/avatars/blank.png" class="" alt="" />
                                                    @else
                                                        <img src="assets/media/profile/{{ $item['foto'] }}" class="" alt="" />
                                                    @endif
                                                </div>
                                                <div class="d-flex justify-content-start flex-column">
                                                    <span class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">
                                                        {{ $item['first_name'] == '' && $item['second_name'] == '' ? 'Belum di atur' : $item['first_name'] . ' ' . $item['second_name'] }}
                                                    </span>
                                                    <span class="text-gray-400 fw-semibold d-block fs-7">{{ $item['username'] }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end pe-13">
                                            <span class="text-gray-600 fw-bold fs-6">
                                                {{ $item['email'] }} <br> 
                                                {{ $item['no_telpn'] == '' ? 'Belum di atur' : '+62' . $item['no_telpn'] }}
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <a href="#reset-pass-{{ $item['username'] }}" data-bs-toggle="modal" class="btn btn-sm btn-icon btn-bg-danger btn-active-color-primary w-30px h-30px" title="reset password">
                                                <i class="ki-duotone ki-lock-2 fs-2 text-white">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                    <span class="path5"></span>
                                                </i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" class="text-center">Data kosong.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                {!! $data['url'] !!}
            </div>
        </div>
        <!--end::Card-->
        
        <!--begin::modal-->
        @if (count($data['items']) > 0)
            @foreach ($data['items'] as $item)
                <div class="modal fade" id="reset-pass-{{ $item['username'] }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form method="POST" action="/reset-pass/{{ $slugg }}" class="modal-content">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title ">Reset Password</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!--begin::Main wrapper-->
                                <div class="fv-row" data-kt-password-meter="true">
                                    <!--begin::Wrapper-->
                                    <div class="mb-1">
                                        <!--begin::Label-->
                                        <label class="form-label fw-semibold fs-6 mb-2">
                                            Password Baru
                                        </label>
                                        <!--end::Label-->

                                        <!--begin::Input wrapper-->
                                        <div class="position-relative mb-3">
                                            <input class="form-control form-control-lg form-control-solid"
                                                type="password" placeholder="" name="new_password" autocomplete="off"/>

                                            <!--begin::Visibility toggle-->
                                            <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                                data-kt-password-meter-control="visibility">
                                                    <i class="ki-duotone ki-eye-slash fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                                    <i class="ki-duotone ki-eye d-none fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                            </span>
                                            <!--end::Visibility toggle-->
                                        </div>
                                        <!--end::Input wrapper-->

                                        <!--begin::Highlight meter-->
                                        <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                        </div>
                                        <!--end::Highlight meter-->
                                    </div>
                                    <!--end::Wrapper-->

                                    <!--begin::Hint-->
                                    <div class="text-muted">
                                        Minimal 8 Karakter atau lebih, kombinasikan dengan Huruf kapital, Angka dan Simbol.
                                    </div>
                                    <!--end::Hint-->
                                </div>
                                <!--end::Main wrapper-->
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="username" value="{{ $item['username'] }}">
                                <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        @endif
        <!--end::modal-->
    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->
@endsection
