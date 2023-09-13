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
        <!--begin::Card-->
        <div class="card">
            <div class="card-body p-9">
                <div class="row">
                    <form method="POST" action="{{ route('cari') }}" class="col-sm-3 ms-auto">
                        @csrf
                        <div class="input-group input-group-sm mb-5">
                            <input type="text" name="name" value="{{ $name }}" class="form-control" placeholder="Masukkan nama toko atau owner" aria-label="Masukkan nama toko atau owner" aria-describedby="button-addon2">
                            <button class="btn btn-primary mx-auto" type="submit" id="button-addon2"><i class="ki-outline ki-magnifier"></i></button>
                        </div>
                    </form>
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
                                <th rowspan="2" class="min-w-50px text-center">Aksi</th>
                            </tr>
                            <tr>
                                <th class="min-w-200px text-center">Dari</th>
                                <th class="min-w-200px text-center">Sampai</th>
                            </tr>
                        </thead>
                        <tbody style="vertical-align: middle;">
                            @if (count($data['items']) > 0)
                                @foreach ($data['items'] as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-50px me-3">
                                                    <img src="assets/media/logo/{{ $item['logo'] }}" alt="">
                                                </div>
                                                <div class="d-flex justify-content-start flex-column">
                                                    <span class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">{{ $item['nama_toko'] }}</span>
                                                    <span class="text-gray-600 fw-semibold d-block fs-7">{{ $item['email'] }}</span>
                                                    <span class="text-gray-600 fw-semibold d-block fs-7">+62{{ $item['contact'] }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="text-gray-800 fw-bold  fs-6">{{ $item['owner'] }}</span>
                                        </td>
                                        <td class="text-center">
                                            @if ($item['paket'] == '' && $item['durasi'] == '')
                                                -,-
                                            @else
                                                <div class="d-flex flex-column">
                                                    <span class="text-gray-600 fw-semibold d-block fs-7">{{ $item['paket'] }}</span>
                                                    <span class="text-gray-600 fw-semibold d-block fs-7">{{ $item['durasi'] }}</span>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($item['status'] == '')
                                                -,-
                                            @else
                                                <span class="badge badge-{{ $item['status'] == 'Aktif' ? 'success' : 'danger'  }}">{{ $item['status'] }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $item['dari'] == 0 ? '-,-' : date('Y-m-d H:i:s',$item['dari']/1000) . ' WIB' }}
                                        </td>
                                        <td>
                                            {{ $item['sampai'] == 0 ? '-,-' : date('Y-m-d H:i:s',$item['sampai']/1000) . ' WIB' }}
                                        </td>
                                        <td class="text-center">
                                            @if ($item['status'] == '')
                                                <a href="#trial-{{ $item['code'] }}" data-bs-toggle="modal" class="p-1" data-bs-placement="top" title="Trial">
                                                    <i class="ki-outline ki-time text-dark fs-2"></i>
                                                </a>
                                            @else
                                                @if ($item['status'] == 'Aktif')
                                                    <a href="#matikan-{{ $item['code'] }}" data-bs-toggle="modal" class="p-1" data-bs-placement="top" title="Matikan">
                                                        <i class="ki-outline ki-cross text-danger fs-2"></i>
                                                    </a>
                                                @else
                                                    @if ($item['sampai'] < round(microtime(true) * 1000))
                                                        <a href="#trial-{{ $item['code'] }}" data-bs-toggle="modal" class="p-1" data-bs-placement="top" title="Trial">
                                                            <i class="ki-outline ki-time text-dark fs-2"></i>
                                                        </a>
                                                    @else
                                                        <a href="#aktifkan-{{ $item['code'] }}" data-bs-toggle="modal" class="p-1" data-bs-placement="top" title="Aktifkan">
                                                            <i class="ki-outline ki-check text-success fs-2"></i>
                                                        </a>
                                                    @endif
                                                @endif
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center">Data kosong.</td>
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
        @endif
        <!--end::modal-->
    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->
@endsection
