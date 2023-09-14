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
                <div class="table-responsive">
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
                                            <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                <i class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
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
        {{-- @if (count($data['items']) > 0)
            @foreach ($data['items'] as $item)
                @if ($item['status'] == 'Aktif')
                    <div class="modal fade" id="matikan-{{ $item['code'] }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content bg-danger">
                                <div class="modal-header" style="border-bottom: 0px solid #000">
                                    <h5 class="modal-title text-white">Matikan Paket</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h3 class="text-white">Matikan Paket Langganan Toko?</h3>
                                </div>
                                <form action="/data-toko/matikan" method="POST" class="modal-footer" style="border-top: 0px solid #000">
                                    @csrf
                                    <input type="hidden" name="id_store" value="{{ $item['code'] }}">
                                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-sm btn-primary">Ya</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
                @if ($item['status'] == 'Tidak Aktif' && $item['sampai'] > round(microtime(true) * 1000))
                <div class="modal fade" id="aktifkan-{{ $item['code'] }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content bg-success">
                            <div class="modal-header" style="border-bottom: 0px solid #000">
                                <h5 class="modal-title text-white">Aktifkan Paket</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h3 class="text-white">Aktifkan Paket Langganan Toko?</h3>
                            </div>
                            <form action="/data-toko/aktifkan" method="POST" class="modal-footer" style="border-top: 0px solid #000">
                                @csrf
                                <input type="hidden" name="id_store" value="{{ $item['code'] }}">
                                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-sm btn-primary">Ya</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
                @if ($item['status'] == '' || ($item['status'] == 'Tidak Aktif' && $item['sampai'] < round(microtime(true) * 1000)))
                    <div class="modal fade" id="trial-{{ $item['code'] }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content bg-secondary">
                                <div class="modal-header" style="border-bottom: 0px solid #000">
                                    <h5 class="modal-title text-dark">Paket Trial 14 Hari (Premium Fitur)</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h3 class="text-dark">Aktifkan Trial Paket Langganan Toko?</h3>
                                </div>
                                <form action="/data-toko/trial" method="POST" class="modal-footer" style="border-top: 0px solid #000">
                                    @csrf
                                    <input type="hidden" name="id_store" value="{{ $item['code'] }}">
                                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-sm btn-primary">Ya</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif --}}
        <!--end::modal-->
    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->
@endsection
