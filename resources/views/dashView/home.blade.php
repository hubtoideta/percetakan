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
        <!--begin:: Dasbor Developer-->
        @if ($userLogin->category == "Developer")
                
        @endif
        <!--end:: Dasbor Developer-->
        <!--begin:: Dasbor Owner-->
        @if ($userLogin->category == "Owner")
        <!--begin:: card-->
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
            @else
                {{-- TAMPILKAN PAKET JIKA OWNER TIDAK MEMILIKI PAKET AKTIF --}}
                @if ($checkPembelianPaket->count() == 0 || $checkPembelianPaket[0]['status_order'] == "Ditolak" || ($checkPembelianPaket[0]['status_order'] == "Diterima" && $checkPembelianPaket[0]['status_paket'] == "Tidak Aktif"))
                    @if ($checkPembelianPaket[0]['status_order'] == "Diterima" && $checkPembelianPaket[0]['status_paket'] == "Tidak Aktif" && $checkPembelianPaket[0]['end_paket_at'] > round(microtime(true) * 1000))
                        <div class="card">
                            <!--begin::Body-->
                            <div class="card-body p-lg-17">
                                <div class="text-center">
                                    <span>Paket di Non Aktifkan oleh Admin!</span> <br><br>
                                    <a class="btn btn-success btn-sm">Contact Us</a>
                                </div>
                            </div>
                            <!--end::Body-->
                        </div>
                    @else
                        <div class="row">
                            <div class="col-sm-12">
                                <!--begin::Alert & modal-->
                                @if($checkPembelianPaket[0]['status_order'] == "Diterima" && $checkPembelianPaket[0]['status_paket'] == "Tidak Aktif" && $checkPembelianPaket[0]['end_paket_at'] < round(microtime(true) * 1000))
                                    <div class="alert alert-dismissible bg-light-warning d-flex flex-row flex-sm-row p-5 mb-10">
                                        <!--begin::Icon-->
                                        <i class="ki-duotone ki-notification-bing fs-2hx text-warning me-4 mb-5 mb-sm-0"><span
                                                class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                        <!--end::Icon-->
                        
                                        <!--begin::Wrapper-->
                                        <div class="d-flex flex-column pe-0 pe-sm-10">
                                            <!--begin::Title-->
                                            <h4 class="fw-semibold">Peringatan!</h4>
                                            <!--end::Title-->
                        
                                            <!--begin::Content-->
                                            <span>Paket langganan anda telah berakhir.</span>
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
                                    @if (!$urlPaketPremium)
                                        <div class="modal modal-lg fade" tabindex="-1" id="aturKaryawan">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <form method="POST" action="{{ route('premeselect') }}" class="modal-content">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <div class="d-block">
                                                            <h3 class="modal-title">Atur Karyawan</h3>
                                                            <p class="fs-7"><strong>*maksimal {{ $fiturPaket[0]->Premium }} Karyawan Untuk Paket Premium</strong></p>
                                                        </div>
                                                    </div>
                                        
                                                    <div class="modal-body">
                                                        <div class="table-responsive mb-2">
                                                            <table class="table table-row-dashed align-middle gs-0 gy-3 my-0 table-hover">
                                                                <thead>
                                                                    <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                                                                        <th class="p-0 pb-3 w-50px text-start">#</th>
                                                                        <th class="p-0 pb-3 min-w-150px text-start">INFO</th>
                                                                        <th class="p-0 pb-3 min-w-100px text-end pe-13">ROLE</th>
                                                                        <th class="p-0 pb-3 min-w-100px text-end pe-13">CONTACT</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @if ($employed_data->count() > 0)
                                                                        @foreach ($employed_data as $item)
                                                                            <tr>
                                                                                <td class="text-start">
                                                                                    <div class="form-check">
                                                                                        <input class="form-check-input" type="checkbox" value="{{ $item['username'] }}" name="check[]" id="{{ $item['username'] }}" />
                                                                                    </div>                                                                                    
                                                                                </td>
                                                                                <td>
                                                                                    <label for="{{ $item['username'] }}" style="cursor: pointer" class="d-flex align-items-center">
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
                                                                                            <span class="text-gray-400 fw-semibold d-block fs-7">
                                                                                                {{ $item['username'] }}
                                                                                            </span>
                                                                                        </div>
                                                                                    </label>
                                                                                </td>
                                                                                <td class="text-end pe-13">
                                                                                    <label for="{{ $item['username'] }}" style="cursor: pointer" class="badge bg-secondary">
                                                                                        {{ $item['role'] }}
                                                                                    </label>
                                                                                </td>
                                                                                <td class="text-end pe-13">
                                                                                    <label for="{{ $item['username'] }}" style="cursor: pointer" class="text-gray-600 fw-bold fs-6">
                                                                                        {{ $item['email'] }} <br>
                                                                                        {{ $item['no_telpn'] == '' ? 'Belum di atur' : '+62' . $item['no_telpn'] }}
                                                                                    </label>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    @else
                                                                        <tr>
                                                                            <td colspan="4" class="text-center">Data kosong.</td>
                                                                        </tr>
                                                                    @endif
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                        
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Beli Paket</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                                <!--end::Alert & modal-->
                                <!--begin::Alert-->
                                @if($checkPembelianPaket[0]['status_order'] == "Ditolak")
                                    <div class="alert alert-dismissible bg-light-danger d-flex flex-row flex-sm-row p-5 mb-10">
                                        <!--begin::Icon-->
                                        <i class="ki-duotone ki-notification-bing fs-2hx text-danger me-4 mb-5 mb-sm-0"><span
                                                class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                        <!--end::Icon-->
                        
                                        <!--begin::Wrapper-->
                                        <div class="d-flex flex-column pe-0 pe-sm-10">
                                            <!--begin::Title-->
                                            <h4 class="fw-semibold">Peringatan!</h4>
                                            <!--end::Title-->
                        
                                            <!--begin::Content-->
                                            <span>Pembelian paket ditolak.</span>
                                            <!--end::Content-->
                                        </div>
                                        <!--end::Wrapper-->
                        
                                        <!--begin::Close-->
                                        <button type="button"
                                            class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
                                            data-bs-dismiss="alert">
                                            <i class="ki-duotone ki-cross fs-1 text-danger"><span class="path1"></span><span
                                                    class="path2"></span></i>
                                        </button>
                                        <!--end::Close-->
                                    </div>
                                @endif
                                <!--end::Alert-->
                            </div>
                        </div>
                        <!--begin::Alert-->
                        @if(Session::has('errorselect'))
                            <div class="alert alert-dismissible bg-light-danger d-flex flex-row flex-sm-row p-5 mb-10">
                                <!--begin::Icon-->
                                <i class="ki-duotone ki-notification-bing fs-2hx text-danger me-4 mb-5 mb-sm-0"><span
                                        class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                <!--end::Icon-->
                
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column pe-0 pe-sm-10">
                                    <!--begin::Title-->
                                    <h4 class="fw-semibold">Gagal!</h4>
                                    <!--end::Title-->
                
                                    <!--begin::Content-->
                                    <span>{{ Session::get('errorselect') }}</span>
                                    <!--end::Content-->
                                </div>
                                <!--end::Wrapper-->
                
                                <!--begin::Close-->
                                <button type="button"
                                    class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
                                    data-bs-dismiss="alert">
                                    <i class="ki-duotone ki-cross fs-1 text-danger"><span class="path1"></span><span
                                            class="path2"></span></i>
                                </button>
                                <!--end::Close-->
                            </div>
                        @endif
                        <!--end::Alert-->
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
                                                    <h1 class="text-dark mb-5 fw-bolder">{{ $listPaket[0]['nama_paket'] }}</h1>
                                                    <!--end::Title-->
                                                    <!--begin::Price-->
                                                    <div class="text-center">
                                                        <span class="mb-2 text-primary">Rp</span>
                                                        <span class="fs-3x fw-bold text-primary" data-kt-plan-price-month="39"
                                                            data-kt-plan-price-annual="399">{{ number_format($listPaket[0]['harga_paket'],0,",",".") }}</span>
                                                        <span class="fs-7 fw-semibold opacity-50">/
                                                            <span data-kt-element="period">Bln</span></span>
                                                    </div>
                                                    <!--end::Price-->
                                                </div>
                                                <!--end::Heading-->
                                                <!--begin::Features-->
                                                <div class="w-100 mb-10">
                                                    @foreach ($fiturPaket as $item)
                                                        <!--begin::Item-->
                                                        <div class="d-flex align-items-center mb-5">
                                                            @if ($item['Premium'] != 'y' && $item['Premium'] != 'n')
                                                                <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">{{ $item['nama_fitur_paket'] }}</span>
                                                                {{ $item['Premium'] }} User
                                                            @else
                                                                @if ($item['Premium'] == 'y')
                                                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">{{ $item['nama_fitur_paket'] }}</span>
                                                                    <i class="ki-duotone ki-check-circle fs-1 text-success">
                                                                        <span class="path1"></span>
                                                                        <span class="path2"></span>
                                                                    </i>
                                                                @else
                                                                    <span class="fw-semibold fs-6 text-gray-600 flex-grow-1 pe-3">{{ $item['nama_fitur_paket'] }}</span>
                                                                    <i class="ki-duotone ki-cross-circle fs-1">
                                                                        <span class="path1"></span>
                                                                        <span class="path2"></span>
                                                                    </i>
                                                                @endif
                                                            @endif
                                                        </div>                                                
                                                        <!--end::Item-->
                                                    @endforeach
                                                </div>
                                                <!--end::Features-->
                                                <!--begin::Select-->
                                                <div class="d-flex">
                                                    @if ($urlPaketPremium)
                                                    <a href="{{ route('checkoutPremium') }}" class="btn btn-sm btn-primary">Beli</a>
                                                    @else
                                                    <a href="#aturKaryawan" data-bs-toggle="modal" class="btn btn-sm btn-primary">Beli</a>
                                                    @endif
                                                    {{-- <a href="#" class="btn btn-sm btn-secondary">Trial 14 Hari</a> --}}
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
                                                    <h1 class="text-dark mb-5 fw-bolder">{{ $listPaket[1]['nama_paket'] }}</h1>
                                                    <!--end::Title-->
                                                    <!--begin::Price-->
                                                    <div class="text-center">
                                                        <span class="mb-2 text-primary">Rp</span>
                                                        <span class="fs-3x fw-bold text-primary" data-kt-plan-price-month="39"
                                                            data-kt-plan-price-annual="399">{{ number_format($listPaket[1]['harga_paket'],0,",",".") }}</span>
                                                        <span class="fs-7 fw-semibold opacity-50">/
                                                            <span data-kt-element="period">Bln</span></span>
                                                    </div>
                                                    <!--end::Price-->
                                                </div>
                                                <!--end::Heading-->
                                                <!--begin::Features-->
                                                <div class="w-100 mb-10">
                                                    @foreach ($fiturPaket as $item)
                                                        <!--begin::Item-->
                                                        <div class="d-flex align-items-center mb-5">
                                                            @if ($item['Business'] != 'y' && $item['Business'] != 'n')
                                                                <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">{{ $item['nama_fitur_paket'] }}</span>
                                                                {{ $item['Business'] }} User
                                                            @else
                                                                @if ($item['Business'] == 'y')
                                                                    <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">{{ $item['nama_fitur_paket'] }}</span>
                                                                    <i class="ki-duotone ki-check-circle fs-1 text-success">
                                                                        <span class="path1"></span>
                                                                        <span class="path2"></span>
                                                                    </i>
                                                                @else
                                                                    <span class="fw-semibold fs-6 text-gray-600 flex-grow-1 pe-3">{{ $item['nama_fitur_paket'] }}</span>
                                                                    <i class="ki-duotone ki-cross-circle fs-1">
                                                                        <span class="path1"></span>
                                                                        <span class="path2"></span>
                                                                    </i>
                                                                @endif
                                                            @endif
                                                        </div>                                                
                                                        <!--end::Item-->
                                                    @endforeach
                                                </div>
                                                <!--end::Features-->
                                                <!--begin::Select-->
                                                <a href="{{ route('checkoutBusiness') }}" class="btn btn-sm btn-primary">Beli</a>
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
                    @endif
                {{-- TAMPILKAN PEMBYARAN PAKET JIKA OWNER SUDAH MELAKUKAN PEMBELIAN --}}
                @else
                    @if ($checkPembelianPaket[0]->status_order == "Pending")
                        <div class="card">
                            <!--begin::Body-->
                            <div class="card-body p-lg-17">
                                <div class="text-center">
                                    <span>Pembelian berhasil, Segera lakukan Pembayaran!</span> <br><br>
                                    <a class="btn btn-success btn-sm">Contact Us</a>
                                </div>
                            </div>
                            <!--end::Body-->
                        </div>
                    @else
                        <h1>PAKET AKTIF</h1>
                    @endif
                @endif
            @endif
            <!--end:: card-->
        @endif
        <!--end:: Dasbor Owner-->
    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->
@endsection
