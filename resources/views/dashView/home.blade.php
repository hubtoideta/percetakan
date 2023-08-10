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
                Dasbor</h1>
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
                <li class="breadcrumb-item text-muted">Dasbor</li>
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
        @if ($alertData)
        <!--begin::Alert-->
        <div class="alert alert-dismissible bg-light-warning d-flex flex-column flex-sm-row p-5 mb-10">
            <!--begin::Icon-->
            <i class="ki-duotone  ki-information-4 fs-2hx text-warning me-4 mb-5 mb-sm-0">
                <i class="path1"></i>
                <i class="path2"></i>
                <i class="path3"></i>
            </i>
            <!--end::Icon-->

            <!--begin::Wrapper-->
            <div class="d-flex flex-column pe-0 pe-sm-10">
                <!--begin::Title-->
                <h4 class="fw-semibold">Perhatian!</h4>
                <!--end::Title-->

                <!--begin::Content-->
                <span>Lengkapi data toko anda. <a href="{{  route("kelolah-toko")  }}">Kelolah toko!</a></span>
                <!--end::Content-->
            </div>
            <!--end::Wrapper-->

            <!--begin::Close-->
            <button type="button"
                class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
                data-bs-dismiss="alert">
                <i class="ki-duotone ki-cross fs-1 text-warning"><span class="path1"></span><span
                        class="path2"></span></i>
            </button>
            <!--end::Close-->
        </div>
        <!--end::Alert-->
        @endif
        <!--begin::About card-->
        <div class="card">
            <!--begin::Body-->
            <div class="card-body p-lg-17">
                <!--begin::Row-->
                <div class="row g-10 mx-auto">
                    <!--begin::Col-->
                    <div class="col-xl-6">
                        <div class="d-flex h-100 align-items-center">
                            <!--begin::Option-->
                            <div
                                class="w-100 d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 py-15 px-10">
                                <!--begin::Heading-->
                                <div class="mb-7 text-center">
                                    <!--begin::Title-->
                                    <h1 class="text-dark mb-5 fw-bolder">Premium</h1>
                                    <!--end::Title-->
                                    <!--begin::Price-->
                                    <div class="text-center">
                                        <span class="mb-2 text-primary">Rp</span>
                                        <span class="fs-3x fw-bold text-primary" data-kt-plan-price-month="39"
                                            data-kt-plan-price-annual="399">149k</span>
                                        <span class="fs-7 fw-semibold opacity-50">/
                                            <span data-kt-element="period">Bln</span></span>
                                    </div>
                                    <!--end::Price-->
                                </div>
                                <!--end::Heading-->
                                <!--begin::Features-->
                                <div class="w-100 mb-10">
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-5">
                                        <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Karyawan</span>
                                        5 Users
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-5">
                                        <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Data Bahan Cetak & Decal</span>
                                        <i class="ki-duotone ki-check-circle fs-1 text-success">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-5">
                                        <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Monitoring Proses Produksi</span>
                                        <i class="ki-duotone ki-check-circle fs-1 text-success">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-5">
                                        <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Print Nota & Shipping</span>
                                        <i class="ki-duotone ki-check-circle fs-1 text-success">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-5">
                                        <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Laporan Omset</span>
                                        <i class="ki-duotone ki-check-circle fs-1 text-success">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-5">
                                        <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Perhitungan Biaya Pengiriman</span>
                                        <i class="ki-duotone ki-check-circle fs-1 text-success">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-5">
                                        <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Laporan Order</span>
                                        <i class="ki-duotone ki-check-circle fs-1 text-success">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-5">
                                        <span class="fw-semibold fs-6 text-gray-600 flex-grow-1">Arus Kas</span>
                                        <i class="ki-duotone ki-cross-circle fs-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-5">
                                        <span class="fw-semibold fs-6 text-gray-600 flex-grow-1">Laporan Penggunaan Bahan</span>
                                        <i class="ki-duotone ki-cross-circle fs-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-5">
                                        <span class="fw-semibold fs-6 text-gray-600 flex-grow-1">Toko Online & Upload Produk Retail</span>
                                        <i class="ki-duotone ki-cross-circle fs-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-5">
                                        <span class="fw-semibold fs-6 text-gray-600 flex-grow-1">Dapat Mengakses Toko Template Cetak dan Pola Decal</span>
                                        <i class="ki-duotone ki-cross-circle fs-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-5">
                                        <span class="fw-semibold fs-6 text-gray-600 flex-grow-1">Kerjasama Dengan Percetakan Lain</span>
                                        <i class="ki-duotone ki-cross-circle fs-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-5">
                                        <span class="fw-semibold fs-6 text-gray-600 flex-grow-1">Bermitra dengan Para Penyedia jasa seperti Desainer dan Pemasang</span>
                                        <i class="ki-duotone ki-cross-circle fs-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-5">
                                        <span class="fw-semibold fs-6 text-gray-600 flex-grow-1">Download Data (.pdf)</span>
                                        <i class="ki-duotone ki-cross-circle fs-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </div>
                                    <!--end::Item-->
                                </div>
                                <!--end::Features-->
                                <!--begin::Select-->
                                <div class="d-flex">
                                    <a href="#" class="btn btn-sm btn-primary">Beli</a>
                                    <a href="#" class="btn btn-sm btn-secondary">Trial 14 Hari</a>
                                </div>
                                <!--end::Select-->
                            </div>
                            <!--end::Option-->
                        </div>
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-xl-6">
                        <div class="d-flex h-100 align-items-center">
                            <!--begin::Option-->
                            <div
                                class="w-100 d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 py-15 px-10">
                                <!--begin::Heading-->
                                <div class="mb-7 text-center">
                                    <!--begin::Title-->
                                    <h1 class="text-dark mb-5 fw-bolder">Business</h1>
                                    <!--end::Title-->
                                    <!--begin::Price-->
                                    <div class="text-center">
                                        <span class="mb-2 text-primary">Rp</span>
                                        <span class="fs-3x fw-bold text-primary" data-kt-plan-price-month="39"
                                            data-kt-plan-price-annual="399">299k</span>
                                        <span class="fs-7 fw-semibold opacity-50">/
                                            <span data-kt-element="period">Bln</span></span>
                                    </div>
                                    <!--end::Price-->
                                </div>
                                <!--end::Heading-->
                                <!--begin::Features-->
                                <div class="w-100 mb-10">
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-5">
                                        <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Karyawan</span>
                                        15 Users
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-5">
                                        <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Data Bahan Cetak & Decal</span>
                                        <i class="ki-duotone ki-check-circle fs-1 text-success">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-5">
                                        <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Monitoring Proses Produksi</span>
                                        <i class="ki-duotone ki-check-circle fs-1 text-success">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-5">
                                        <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Print Nota & Shipping</span>
                                        <i class="ki-duotone ki-check-circle fs-1 text-success">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-5">
                                        <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Laporan Omset</span>
                                        <i class="ki-duotone ki-check-circle fs-1 text-success">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-5">
                                        <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Perhitungan Biaya Pengiriman</span>
                                        <i class="ki-duotone ki-check-circle fs-1 text-success">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-5">
                                        <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Laporan Order</span>
                                        <i class="ki-duotone ki-check-circle fs-1 text-success">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-5">
                                        <span class="fw-semibold fs-6 text-gray-800 flex-grow-1">Arus Kas</span>
                                        <i class="ki-duotone ki-check-circle fs-1 text-success">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-5">
                                        <span class="fw-semibold fs-6 text-gray-800 flex-grow-1">Laporan Penggunaan Bahan</span>
                                        <i class="ki-duotone ki-check-circle fs-1 text-success">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-5">
                                        <span class="fw-semibold fs-6 text-gray-800 flex-grow-1">Toko Online & Upload Produk Retail</span>
                                        <i class="ki-duotone ki-check-circle fs-1 text-success">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-5">
                                        <span class="fw-semibold fs-6 text-gray-800 flex-grow-1">Dapat Mengakses Toko Template Cetak dan Pola Decal</span>
                                        <i class="ki-duotone ki-check-circle fs-1 text-success">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-5">
                                        <span class="fw-semibold fs-6 text-gray-800 flex-grow-1">Kerjasama Dengan Percetakan Lain</span>
                                        <i class="ki-duotone ki-check-circle fs-1 text-success">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-5">
                                        <span class="fw-semibold fs-6 text-gray-800 flex-grow-1">Bermitra dengan Para Penyedia jasa seperti Desainer dan Pemasang</span>
                                        <i class="ki-duotone ki-check-circle fs-1 text-success">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-5">
                                        <span class="fw-semibold fs-6 text-gray-800 flex-grow-1">Download Data (.pdf)</span>
                                        <i class="ki-duotone ki-check-circle fs-1 text-success">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </div>
                                    <!--end::Item-->
                                </div>
                                <!--end::Features-->
                                <!--begin::Select-->
                                <a href="#" class="btn btn-sm btn-primary">Beli</a>
                                <!--end::Select-->
                            </div>
                            <!--end::Option-->
                        </div>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::About card-->
    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->
@endsection
