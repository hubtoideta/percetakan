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
                Paket & Fitur Langganan</h1>
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
                <li class="breadcrumb-item text-muted">Paket & Fitur Langganan</li>
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
        <!--begin::Row-->
        <div class="row mb-3">
            <!--begin::Setting Paket-->
            <div class="col-sm-6 mx-auto">
                <!--begin::Card-->
                <form method="POST" action="{{ route('editPaket') }}" class="card">
                    @csrf
                    <div class="card-header">
                        <h5 class="card-title">Harga Paket Perbulan</h5>
                    </div>
                    <!--begin::Body-->
                    <div class="card-body"> 
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
                                <span>Data telah di perbaharui.</span>
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
                        @foreach ($listPaket as $key => $value)
                        <div class="row">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">{{ $value['nama_paket'] }}</label>
                            <div class="col-lg-8">
                                <div class="input-group input-group-sm input-group-solid">
                                    <span class="input-group-text">Rp.</span>
                                    <input type="number" class="form-control @error('harga.'.$key) is-invalid @enderror" 
                                        name="harga[]" 
                                        placeholder="Harga / Bulan" 
                                        value="{{ old('harga') != 0  ? old('harga')[$key] : $value['harga_paket'] }}"
                                        id="harga{{ $value['nama_paket'] }}">
                                        @error('harga.'.$key)
                                        <span class="invalid-feedback" role="alert">
                                            <strong style="font-size: 0.8rem">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                </div>
                            </div>

                        </div>
                        @endforeach
                    </div>
                    <!--end::Body-->
                    <!--begin::footer-->
                    <div class="card-footer">
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        </div>
                    </div>
                    <!--end::footer-->
                </form>
                <!--end::Card-->
            </div>
            <!--end::Setting Paket-->
        </div>
        <!--end::Row-->
        <!--begin::Row-->
        <div class="row">
            <!--begin::Setting Paket-->
            <div class="col-sm-12 mx-auto">
                <!--begin::Card-->
                <form method="POST" action="{{ route('editDiskon') }}" class="card mb-3">
                    @csrf
                    <div class="card-header">
                        <h5 class="card-title">Diskon Paket</h5>
                    </div>
                    <!--begin::Body-->
                    <div class="card-body"> 
                        <!--begin::Alert-->
                        @if(Session::has('successDis'))
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
                                <span>Data telah di perbaharui.</span>
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
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr class="fw-bold fs-6 text-gray-800">
                                        <th rowspan="3" style="text-align: center; vertical-align: middle;">Paket Langganan</th>
                                        <th colspan="2" style="text-align: center; vertical-align: middle;">3 Bulan</th>
                                        <th colspan="2" style="text-align: center; vertical-align: middle;">6 Bulan</th>
                                        <th colspan="2" style="text-align: center; vertical-align: middle;">12 Bulan</th>
                                        <th colspan="2" style="text-align: center; vertical-align: middle;">24 Bulan</th>
                                    </tr>
                                    <tr>
                                        <th style="text-align: center; vertical-align: middle;">%</th>
                                        <th style="text-align: center; vertical-align: middle;">Harga</th>
                                        <th style="text-align: center; vertical-align: middle;">%</th>
                                        <th style="text-align: center; vertical-align: middle;">Harga</th>
                                        <th style="text-align: center; vertical-align: middle;">%</th>
                                        <th style="text-align: center; vertical-align: middle;">Harga</th>
                                        <th style="text-align: center; vertical-align: middle;">%</th>
                                        <th style="text-align: center; vertical-align: middle;">Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($diskonPaket as $key => $value)
                                    <tr>
                                        <th>{{ $value['nama_paket_diskon'] }}</th>
                                        <td>
                                            <input type="number" class="form-control form-control-sm @error('diskon3.'.$key) is-invalid @enderror" 
                                                name="diskon3[]" 
                                                placeholder="Diskon" 
                                                value="{{ old('diskon3') != 0  ? old('diskon3')[$key] : $value['tiga_bulan'] }}"
                                                onkeyup="diskonTigaBulan{{ $value['nama_paket_diskon'] }}(this.value)">
                                                @error('diskon3.'.$key)
                                                <span class="invalid-feedback" role="alert">
                                                    <strong style="font-size: 0.8rem">{{ $message }}</strong>
                                                </span>
                                                @enderror
                                        </td>
                                        <td id="{{ $value['nama_paket_diskon']."Harga3" }}">Rp.{{ number_format((($value['harga']*3)-(($value['harga']*3)*($value['tiga_bulan']/100))),0,",",".") }}</td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm @error('diskon6.'.$key) is-invalid @enderror" 
                                                name="diskon6[]" 
                                                placeholder="Diskon" 
                                                value="{{ old('diskon6') != 0  ? old('diskon6')[$key] : $value['enam_bulan'] }}"
                                                onkeyup="diskonEnamBulan{{ $value['nama_paket_diskon'] }}(this.value)">
                                                @error('diskon6.'.$key)
                                                <span class="invalid-feedback" role="alert">
                                                    <strong style="font-size: 0.8rem">{{ $message }}</strong>
                                                </span>
                                                @enderror
                                        </td>
                                        <td id="{{ $value['nama_paket_diskon']."Harga6" }}">Rp.{{ number_format((($value['harga']*6)-(($value['harga']*6)*($value['enam_bulan']/100))),0,",",".") }}</td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm @error('diskon12.'.$key) is-invalid @enderror" 
                                                name="diskon12[]" 
                                                placeholder="Diskon" 
                                                value="{{ old('diskon12') != 0  ? old('diskon12')[$key] : $value['dua_belas_bulan'] }}"
                                                onkeyup="diskonDuaBelasBulan{{ $value['nama_paket_diskon'] }}(this.value)">
                                                @error('diskon12.'.$key)
                                                <span class="invalid-feedback" role="alert">
                                                    <strong style="font-size: 0.8rem">{{ $message }}</strong>
                                                </span>
                                                @enderror
                                        </td>
                                        <td id="{{ $value['nama_paket_diskon']."Harga12" }}">Rp.{{ number_format((($value['harga']*12)-(($value['harga']*12)*($value['dua_belas_bulan']/100))),0,",",".") }}</td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm @error('diskon2.4'.$key) is-invalid @enderror" 
                                                name="diskon24[]" 
                                                placeholder="Diskon" 
                                                value="{{ old('diskon24') != 0  ? old('diskon24')[$key] : $value['dua_puluh_empat_bulan'] }}"
                                                onkeyup="diskonDuaPuluhEmpatBulan{{ $value['nama_paket_diskon'] }}(this.value)">
                                                @error('diskon2.4'.$key)
                                                <span class="invalid-feedback" role="alert">
                                                    <strong style="font-size: 0.8rem">{{ $message }}</strong>
                                                </span>
                                                @enderror
                                        </td>
                                        <td id="{{ $value['nama_paket_diskon']."Harga24" }}">Rp.{{ number_format((($value['harga']*24)-(($value['harga']*24)*($value['dua_puluh_empat_bulan']/100))),0,",",".") }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--end::Body-->
                    <!--begin::footer-->
                    <div class="card-footer">
                        <div class="text-end">
                            <a href="{{ route('paket') }}" class="btn btn-secondary btn-sm">Reset</a>
                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        </div>
                    </div>
                    <!--end::footer-->
                </form>
                <!--end::Card-->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Features Paket Langganan</h5>
                    </div>
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
                <!--end:: card-->
            </div>
            <!--end::Setting Paket-->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->
@endsection
