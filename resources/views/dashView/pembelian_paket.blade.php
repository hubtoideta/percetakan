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
                    <table class="table table-sm table-bordered table-hover">
                        <thead style="vertical-align: middle;">
                            <tr>
                                <th scope="col">Tgl Order</th>
                                <th scope="col">Nama Percetakan</th>
                                <th scope="col">Paket</th>
                                <th scope="col">Durasi</th>
                                <th scope="col">Status Order</th>
                                <th scope="col">Tgl Konfirmasi</th>
                                <th scope="col">Aksi</th>
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
                                        {{ $item['confirm_at'] == 0 ? '-,-' : date('Y-m-d H:i:s',$item['confirm_at']/1000) . 'WIB' }}
                                    </td>
                                    <td>
                                        <a href="#" class="p-1" data-bs-toggle="tooltip" data-bs-placement="top" title="terima">
                                            <i class="ki-outline ki-check text-success fs-2"></i>
                                        </a>
                                        <a href="#" class="p-1" data-bs-toggle="tooltip" data-bs-placement="top" title="tolak">
                                            <i class="ki-outline ki-cross text-danger fs-2"></i>
                                        </a>
                                        <a href="#" class="p-1" data-bs-toggle="tooltip" data-bs-placement="top" title="detail">
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
<!--end::Content-->
@endsection
