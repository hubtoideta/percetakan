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
                Data Karyawan</h1>
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
                <li class="breadcrumb-item text-muted">Data Karyawan</li>
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
        <div class="row">
            <div class="col-sm-12">
                <!--begin::Alert-->
                @if(Session::has('error'))
                <div class="alert alert-dismissible bg-light-danger d-flex flex-row flex-sm-row p-5 mb-10">
                    <!--begin::Icon-->
                    <i class="ki-duotone ki-notification-bing fs-2hx text-danger me-4 mb-5 mb-sm-0"><span
                            class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                    <!--end::Icon-->
    
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column pe-0 pe-sm-10">
                        <!--begin::Title-->
                        <h4 class="fw-semibold">Gagal</h4>
                        <!--end::Title-->
    
                        <!--begin::Content-->
                        <span>{{ Session::get('error') }}</span>
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
                        <h4 class="fw-semibold">Berhasil!</h4>
                        <!--end::Title-->
    
                        <!--begin::Content-->
                        <span>{{ Session::get('success') }}</span>
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
            </div>
            <div class="col-sm-4">
                <div class="card mb-2">
                    <form action="{{ route('SimpanDataEmploye') }}" method="POST" class="card-body p-lg-17">
                        @csrf
                        <div class="card-title mb-4">
                            <h3>TAMBAH KARYAWAN</h3>
                        </div>
                        <hr>
                        <div class="fv-row mb-8">
                            <!--begin::category-->
                            <select name="roleEmployed" id="" class="form-select bg-transparent @error('roleEmployed') is-invalid @enderror">
                                <option value="">--Pilih Role--</option>
                                @foreach ($roleOpt as $opt)
                                    <option value="{{ $opt }}" {{ $opt == old('roleEmployed') ? 'selected="selected"' : '' }}>{{ $opt }}</option>
                                @endforeach
                            </select>
                            @error('roleEmployed')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <!--end::category-->
                        </div>
                        <!--begin::Input group=-->
                        <div class="fv-row mb-8">
                            <!--begin::username-->
                            <input type="text" placeholder="Username" name="username" id="no-space-username" value="{{ old('username') }}" oninput="hapusSpasiUsername()" autocomplete="off" class="form-control bg-transparent @error('username') is-invalid @enderror"/>
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <!--end::username-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group=-->
                        <div class="fv-row mb-8">
                            <!--begin::Email-->
                            <input type="text" placeholder="Email" name="email" id="no-space-email" value="{{ old('email') }}" oninput="hapusSpasiEmail()" autocomplete="off" class="form-control bg-transparent @error('email') is-invalid @enderror"/>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <!--end::Email-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-8" data-kt-password-meter="true">
                            <!--begin::Wrapper-->
                            <div class="mb-1">
                                <!--begin::Input wrapper-->
                                <div class="position-relative mb-3">
                                    <input class="form-control bg-transparent @error('password') is-invalid @enderror" type="password" placeholder="Password" name="password" autocomplete="off" />
                                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                        <i class="ki-duotone ki-eye-slash fs-2"></i>
                                        <i class="ki-duotone ki-eye fs-2 d-none"></i>
                                    </span>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!--end::Input wrapper-->
                                <!--begin::Meter-->
                                <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                </div>
                                <!--end::Meter-->
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Hint-->
                            <div class="text-muted">Minimal 8 Karakter atau lebih, kombinasikan dengan Huruf kapital, Angka dan Simbol.</div>
                            <!--end::Hint-->
                        </div>
                        <!--end::Input group=-->
                        <!--begin::Input group=-->
                        <div class="fv-row mb-8">
                            <!--begin::Repeat Password-->
                            <input placeholder="Repeat Password" name="password_confirmation" type="password"  autocomplete="off" class="form-control bg-transparent" />
                            <!--end::Repeat Password-->
                        </div>
                        <!--end::Input group=-->
                        <!--begin::Submit button-->
                        <div class="d-grid mb-10">
                            <button type="submit" class="btn btn-primary">
                                <!--begin::Indicator label-->
                                <span class="indicator-label">Simpan</span>
                                <!--end::Indicator label-->
                            </button>
                        </div>
                        <!--end::Submit button-->
                    </form>
                </div>
            </div>

            <div class="col-sm-8">
                <div class="card">
                    <div class="card-body p-lg-17">
                        <div class="card-title mb-4">
                            <h3>DATA KARYAWAN</h3>
                        </div>
                        <hr>
                        <div class="table-responsive mb-2">
                            <table class="table table-row-dashed align-middle gs-0 gy-3 my-0 table-hover">
                                <thead>
                                    <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                                        <th class="p-0 pb-3 min-w-150px text-start">INFO</th>
                                        <th class="p-0 pb-3 min-w-100px text-end pe-13">ROLE</th>
                                        <th class="p-0 pb-3 min-w-100px text-end pe-13">CONTACT</th>
                                        <th class="p-0 pb-3 w-50px text-end">STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($data['total'] > 0)
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
                                                            <span class="text-gray-400 fw-semibold d-block fs-7">
                                                                {{ $item['username'] }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-end pe-13">
                                                    <span class="badge bg-secondary">
                                                        {{ $item['role'] }}
                                                    </span>
                                                </td>
                                                <td class="text-end pe-13">
                                                    <span class="text-gray-600 fw-bold fs-6">
                                                        {{ $item['email'] }} <br>
                                                        {{ $item['no_telpn'] == '' ? 'Belum di atur' : '+62' . $item['no_telpn'] }}
                                                    </span>
                                                </td>
                                                <td class="text-end">
                                                    @if ($item['status'] == 'Aktif')
                                                    <a href="#confirm{{ $item['username'] }}" class="p-1" data-bs-toggle="modal" data-bs-placement="top" title="Aktif">
                                                        <i class="ki-duotone ki-toggle-on-circle text-success fs-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </a>
                                                    @else
                                                    <a href="#confirm{{ $item['username'] }}" class="p-1" data-bs-toggle="modal" data-bs-placement="top" title="Tidak Aktif">
                                                        <i class="ki-duotone ki-toggle-off-circle text-danger fs-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </a>
                                                    @endif
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
                        {!! $data['url'] !!}
                    </div>
                </div>
            </div>
            @if ($data['total'] > 0)
                @foreach ($data['items'] as $item)
                    <div class="modal fade" tabindex="-1" id="confirm{{ $item['username'] }}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">Konfirmasi</h3>
                    
                                    <!--begin::Close-->
                                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                    </div>
                                    <!--end::Close-->
                                </div>
                    
                                <div class="modal-body">
                                    @if ($item['status'] == 'Aktif')
                                        <h5>anda yakin ingin menonaktifkan karyawan ini?</h5>
                                    @else
                                        <h5>Aktifkan karyawan ?</h5>
                                    @endif
                                </div>
                    
                                <div class="modal-footer">
                                    <form action="{{ route('updateStatus') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="username" value="{{ $item['username'] }}">
                                        <input type="hidden" name="status" value="{{ $item['status'] }}">
                                        <button type="submit" class="btn btn-primary">Ya</button>
                                    </form>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->
@endsection
