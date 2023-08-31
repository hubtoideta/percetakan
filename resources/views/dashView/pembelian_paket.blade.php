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
        <div class="card">
            <div class="card-body p-9">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead style="vertical-align: middle;">
                            <tr>
                                <th class="min-w-200px">Tgl Order</th>
                                <th class="min-w-150px">Nama Percetakan</th>
                                <th>Paket</th>
                                <th class="min-w-100px">Durasi</th>
                                <th class="min-w-100px">Status Order</th>
                                <th class="min-w-200px">Tgl Perubahan</th>
                                <th class="min-w-100px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody style="vertical-align: middle;">
                            @foreach ($data['items'] as $item)
                                <tr>
                                    <td>{{ date('Y-m-d H:i:s',$item['order_at']/1000) }} WIB</td>
                                    <td>{{ $item['percetakan'] }}</td>
                                    <td>{{ $item['paket'] }}</td>
                                    <td>{{ $item['jangka_waktu'] }}</td>
                                    <td>
                                        <span class="badge badge-{{ $item['status_order'] == 'Pending' ? 'warning text-dark' : ($item['status_order'] == 'Diterima' ? 'success' : 'danger') }}">
                                            {{ $item['status_order'] }}
                                        </span>
                                    </td>
                                    <td>
                                        {{ $item['confirm_at'] == 0 ? '-,-' : date('Y-m-d H:i:s',$item['confirm_at']/1000) . ' WIB' }}
                                    </td>
                                    <td>
                                        @if ($item['status_order'] == "Pending")
                                            <a href="pembelian-paket?id={{ $item['code_pembelian'] }}&confirm=terima" class="p-1" data-bs-toggle="tooltip" data-bs-placement="top" title="terima">
                                                <i class="ki-outline ki-check text-success fs-2"></i>
                                            </a>
                                            <a href="pembelian-paket?id={{ $item['code_pembelian'] }}&confirm=tolak" class="p-1" data-bs-toggle="tooltip" data-bs-placement="top" title="tolak">
                                                <i class="ki-outline ki-cross text-danger fs-2"></i>
                                            </a>
                                        @endif
                                        <a href="#detail{{ $item['code_pembelian'] }}" class="p-1" data-bs-toggle="modal" data-bs-placement="top" title="detail">
                                            <i class="ki-outline ki-dots-vertical text-dark fs-2"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <span>{{ $data['url'] }}</span>
            </div>
        </div>
    </div>
    <!--end::Content container-->
</div>

<!--Begin::Model-->
<!--end::Model-->
@foreach ($data['items'] as $item)
<div class="modal fade" tabindex="-1" id="detail{{ $item['code_pembelian'] }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Detail Pembayaran</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-6 col-sm-6 fs-7 text-start">
                        Paket {{ $item['paket'] }}
                    </div>
                    <div class="col-6 col-sm-6 fs-7 text-end">
                        Rp{{ number_format($item['harga_normal'],0,",",".") }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 col-sm-6 fs-7 text-start">
                        Durasi {{ $item['jangka_waktu']  }}
                    </div>
                    <div class="col-6 col-sm-6 fs-7 text-end">
                        Rp{{ number_format(($item['harga_normal']*(explode(" ", $item['jangka_waktu'])[0])),0,",",".") }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 col-sm-6 fs-7 text-start">
                        Diskon Paket -{{ $item['diskon'] }}%
                    </div>
                    <div class="col-6 col-sm-6 fs-7 text-end text-danger">
                        -Rp{{ number_format((($item['harga_normal']*(explode(" ", $item['jangka_waktu'])[0]))*($item['diskon']/100)),0,",",".") }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 col-sm-6 fs-7 text-start">
                        Total Harga Paket
                    </div>
                    <div class="col-6 col-sm-6 fs-7 text-end">
                        Rp{{ number_format(($item['harga_normal']*(explode(" ", $item['jangka_waktu'])[0]))-(($item['harga_normal']*(explode(" ", $item['jangka_waktu'])[0]))*($item['diskon']/100)),0,",",".") }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 col-sm-6 fs-7 text-start">
                        PPN & Biaya Tambahan 11%
                    </div>
                    <div class="col-6 col-sm-6 fs-7 text-end">
                        Rp{{ number_format($item['ppn'],0,",",".") }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <hr>
                    </div>
                    <div class="col-6 col-sm-6 fs-7 text-start">
                        Total
                    </div>
                    <div class="col-6 col-sm-6 fs-7 text-end">
                        Rp{{ number_format($item['total_pembayaran'],0,",",".") }}
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach
<!--end::Content-->
@endsection
