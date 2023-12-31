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
                Paket {{ $checkout['namaPaket'] }}</h1>
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
                <li class="breadcrumb-item text-muted">Pembayaran</li>
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
        <form action="{{ route('checkoutPost') }}" method="post">
            @csrf
            <input type="hidden" name="paketLangganan" value="{{ $checkout['namaPaket'] }}">
            <input type="hidden" id="hargaNormal" name="hargaNormal" value="{{ $checkout['hargaNormal'] }}">
            <input type="hidden" id="diskonTigaBulan" name="diskonTigaBulan" value="{{ $checkout['diskonTigaBulan'] }}">
            <input type="hidden" id="diskonEnamBulan" name="diskonEnamBulan" value="{{ $checkout['diskonEnamBulan'] }}">
            <input type="hidden" id="diskonDuaBelasBulan" name="diskonDuaBelasBulan" value="{{ $checkout['diskonDuaBelasBulan'] }}">
            <input type="hidden" id="diskonDuaPuluhEmpatBulan" name="diskonDuaPuluhEmpatBulan" value="{{ $checkout['diskonDuaPuluhEmpatBulan'] }}">
            <div class="card">
                <div class="card-body p-lg-10">
                    <h3>1. Pilih durasi paket</h3>
                    <div class="row g-10 mx-auto mt-3">
                        <div class="col-sm mb-3">
                            <div class="d-flex h-100 align-items-center">
                                <!--begin::Option-->
                                <input type="radio" class="btn-check" name="durasi_paket" value="1" checked id="sebulan" onclick="sebulanBulan(this.value)" />
                                <label class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 align-items-center" style="width: 100%" for="sebulan">
                                    <!--begin::Info-->
                                    <div class="row">
                                        <span class="fw-semibold"> 
                                            <span class="col-12 text-dark text-center">1 BULAN</span>
                                            <div class="col-12">
                                                <div class="text-center">
                                                    {{-- <span class="text-muted fw-semibold fs-7"><s>Rp149.000</s></span>    --}}
                                                    <br>
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Price-->
                                    <div class="text-center">
                                        <span class="mb-2 text-primary">Rp</span>
                                        <span class="fs-1x fw-bold text-primary">{{ number_format($checkout['hargaNormal'],0,",",".") }}</span>
                                        <span class="fs-7 fw-semibold opacity-50">/
                                            <span data-kt-element="period">Bln</span>
                                        </span>
                                    </div><br>
                                    {{-- <span class="text-muted text-center fw-semibold fs-7">Hemat Rp.567.000</span> --}}
                                    <!--end::Price-->
                                </label>
                                <!--end::Option-->
                            </div>
                        </div>
                        <div class="col-sm mb-3">
                            <div class="d-flex h-100 align-items-center">
                                <!--begin::Option-->
                                <input type="radio" class="btn-check" name="durasi_paket" value="3" id="tigabulan" onclick="tigaBulan(this.value)" />
                                <label class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 align-items-center" style="width: 100%" for="tigabulan">
                                    <!--begin::Info-->
                                    <div class="row">
                                        <span class="fw-semibold"> 
                                            <span class="col-12 text-dark text-center">3 BULAN</span>
                                            <div class="col-12">
                                                <div class="text-center">
                                                    <span class="text-muted fw-semibold fs-7"><s>Rp{{ number_format($checkout['hargaNormal'],0,",",".") }}</s></span>
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Price-->
                                    <div class="text-center">
                                        <span class="mb-2 text-primary">Rp</span>
                                        <span class="fs-1x fw-bold text-primary">{{ number_format($checkout['paketTigaBulan'],0,",",".") }}</span>
                                        <span class="fs-7 fw-semibold opacity-50">/
                                            <span data-kt-element="period">Bln</span>
                                        </span>
                                    </div>
                                    <span class="text-muted text-center fw-semibold fs-7">Hemat Rp{{ number_format($checkout['potonganPaketTigaBulan'],0,",",".") }}</span>
                                    <!--end::Price-->
                                </label>
                                <!--end::Option-->
                            </div>
                        </div>
                        <div class="col-sm mb-3">
                            <div class="d-flex h-100 align-items-center">
                                <!--begin::Option-->
                                <input type="radio" class="btn-check" name="durasi_paket" value="6" id="enambulan" onclick="enamBulan(this.value)" />
                                <label class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 align-items-center" style="width: 100%" for="enambulan">
                                    <!--begin::Info-->
                                    <div class="row">
                                        <span class="fw-semibold"> 
                                            <span class="col-12 text-dark text-center">6 BULAN</span>
                                            <div class="col-12">
                                                <div class="text-center">
                                                    <span class="text-muted fw-semibold fs-7"><s>Rp{{ number_format($checkout['hargaNormal'],0,",",".") }}</s></span>
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Price-->
                                    <div class="text-center">
                                        <span class="mb-2 text-primary">Rp</span>
                                        <span class="fs-1x fw-bold text-primary">{{ number_format($checkout['paketEnamBulan'],0,",",".") }}</span>
                                        <span class="fs-7 fw-semibold opacity-50">/
                                            <span data-kt-element="period">Bln</span>
                                        </span>
                                    </div>
                                    <span class="text-muted text-center fw-semibold fs-7">Hemat Rp{{ number_format($checkout['potonganPaketEnamBulan'],0,",",".") }}</span>
                                    <!--end::Price-->
                                </label>
                                <!--end::Option-->
                            </div>
                        </div>
                        <div class="col-sm mb-3">
                            <div class="d-flex h-100 align-items-center">
                                <!--begin::Option-->
                                <input type="radio" class="btn-check" name="durasi_paket" value="12" id="duabelasbulan" onclick="duaBelasBulan(this.value)" />
                                <label class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 align-items-center" style="width: 100%" for="duabelasbulan">
                                    <!--begin::Info-->
                                    <div class="row">
                                        <span class="fw-semibold"> 
                                            <span class="col-12 text-dark text-center">12 BULAN</span>
                                            <div class="col-12">
                                                <div class="text-center">
                                                    <span class="text-muted fw-semibold fs-7"><s>Rp{{ number_format($checkout['hargaNormal'],0,",",".") }}</s></span>
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Price-->
                                    <div class="text-center">
                                        <span class="mb-2 text-primary">Rp</span>
                                        <span class="fs-1x fw-bold text-primary">{{ number_format($checkout['paketDuaBelasBulan'],0,",",".") }}</span>
                                        <span class="fs-7 fw-semibold opacity-50">/
                                            <span data-kt-element="period">Bln</span>
                                        </span>
                                    </div>
                                    <span class="text-muted text-center fw-semibold fs-7">Hemat Rp{{ number_format($checkout['potonganPaketDuaBelasBulan'],0,",",".") }}</span>
                                    <!--end::Price-->
                                </label>
                                <!--end::Option-->
                            </div>
                        </div>
                        <div class="col-sm mb-3">
                            <div class="d-flex h-100 align-items-center">
                                <!--begin::Option-->
                                <input type="radio" class="btn-check" name="durasi_paket" value="24" id="duapuluhempatbulan" onclick="duaPuluhEmpatBulan(this.value)" />
                                <label class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 align-items-center" style="width: 100%" for="duapuluhempatbulan">
                                    <!--begin::Info-->
                                    <div class="row">
                                        <span class="fw-semibold"> 
                                            <span class="col-12 text-dark text-center">24 BULAN</span>
                                            <div class="col-12">
                                                <div class="text-center">
                                                    <span class="text-muted fw-semibold fs-7"><s>Rp{{ number_format($checkout['hargaNormal'],0,",",".") }}</s></span>
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Price-->
                                    <div class="text-center">
                                        <span class="mb-2 text-primary">Rp</span>
                                        <span class="fs-1x fw-bold text-primary">{{ number_format($checkout['paketDuaPuluhEmpatBulan'],0,",",".") }}</span>
                                        <span class="fs-7 fw-semibold opacity-50">/
                                            <span data-kt-element="period">Bln</span>
                                        </span>
                                    </div>
                                    <span class="text-muted text-center fw-semibold fs-7">Hemat Rp{{ number_format($checkout['potonganPaketDuaPuluhEmpatBulan'],0,",",".") }}</span>
                                    <!--end::Price-->
                                </label>
                                <!--end::Option-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body p-lg-10">
                    <h3>2. Total Pembayaran</h3>
                    <div class="row mt-3">
                        <div class="col-6 col-sm-6 fs-7 text-start">
                            Paket {{ $checkout['namaPaket'] }} <span id="totalBulan">1 Bulan</span>
                        </div>
                        <div id="Harga" class="col-6 col-sm-6 fs-7 text-end">
                            Rp{{ number_format($checkout['hargaNormal'],0,",",".") }}
                        </div>
                    </div>
                    <div class="row">
                        <div id="persen" class="col-6 col-sm-6 fs-7 text-start">
                            Diskon Paket -0%
                        </div>
                        <div id="potongan" class="col-6 col-sm-6 fs-7 text-success text-end">
                            -Rp0
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 col-sm-6 fs-7 text-start">
                            PPN & Biaya Tambahan 11%
                        </div>
                        <div id="ppn" class="col-6 col-sm-6 fs-7 text-danger text-end">
                            Rp{{ number_format($checkout['hargaNormal']*0.11,0,",",".") }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-sm-12">
                            <hr>
                        </div>
                        <div class="col-6 col-sm-6 text-start">
                            <b>Total</b>
                        </div>
                        <div class="col-6 col-sm-6 text-end d-flex">
                            {{-- <s class="flex-fill flex-sm-fill fs-7 opacity-50">Rp.1.760.000</s> &nbsp; --}}
                            <b class="flex-fill flex-sm-fill fs-7" id="total">Rp{{ number_format(($checkout['hargaNormal'])+($checkout['hargaNormal']*0.11),0,",",".") }}</b>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary btn-sm">Checkout</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->
@endsection
