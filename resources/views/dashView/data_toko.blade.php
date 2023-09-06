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
                Data Toko</h1>
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
                <li class="breadcrumb-item text-muted">Data Toko</li>
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
        <div class="card">
            <div class="card-body p-9">
                <div class="row">
                    {{-- <form method="POST" action="{{ route('cari') }}" class="col-sm-3 ms-auto">
                        @csrf
                        <div class="input-group input-group-sm mb-5">
                            <input type="text" name="codeOrder" class="form-control" placeholder="Masukkan kode pemesanan" required aria-label="Masukkan kode pemesanan" aria-describedby="button-addon2">
                            <button class="btn btn-primary mx-auto" type="submit" id="button-addon2"><i class="ki-outline ki-magnifier"></i></button>
                        </div>
                    </form> --}}
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead style="vertical-align: middle;">
                            <tr>
                                <th rowspan="2" class="min-w-200px text-center">Toko</th>
                                <th rowspan="2" class="min-w-150px text-center">Owner</th>
                                <th rowspan="2" class="min-w-110px text-center">Paket</th>
                                <th rowspan="2" class="min-w-100px text-center">Status</th>
                                <th colspan="2" class="text-center">Masa Aktif</th>
                                <th rowspan="2" class="min-w-100px text-center">Aksi</th>
                            </tr>
                            <tr>
                                <th class="min-w-200px text-center">Dari</th>
                                <th class="min-w-200px text-center">Sampai</th>
                            </tr>
                        </thead>
                        <tbody style="vertical-align: middle;">
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-50px me-3">
                                            <img src="assets/media/stock/600x600/img-49.jpg" alt="">
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <span class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Beedecal</span>
                                            <span class="text-gray-600 fw-semibold d-block fs-7">beedecal@gmail.com</span>
                                            <span class="text-gray-600 fw-semibold d-block fs-7">+628xxxxxxxx</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="text-gray-800 fw-bold  fs-6">Riswan</span>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="text-gray-600 fw-semibold d-block fs-7">Premium</span>
                                        <span class="text-gray-600 fw-semibold d-block fs-7">3 bulan</span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-success">Aktif</span>
                                </td>
                                <td>
                                    2023-08-07 14:34:45 WIB
                                </td>
                                <td>
                                    2023-11-07 14:34:45 WIB
                                </td>
                                <td class="text-end">
                                    <a href="" class="p-1" data-bs-placement="top" title="detail">
                                        <i class="ki-outline ki-dots-vertical text-dark fs-2"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                {{-- <span>{{ $data['url'] }}</span> --}}
            </div>
        </div>
    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->
@endsection
