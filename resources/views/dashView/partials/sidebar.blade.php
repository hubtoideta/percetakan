<!--begin::Sidebar-->
<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <!--begin::Logo image-->
        <a href="../../demo1/dist/index.html">
            <img alt="Logo" src="assets/media/logos/default-dark.svg" class="h-25px app-sidebar-logo-default" />
            <img alt="Logo" src="assets/media/logos/default-small.svg" class="h-20px app-sidebar-logo-minimize" />
        </a>
        <div id="kt_app_sidebar_toggle"
            class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate"
            data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
            data-kt-toggle-name="app-sidebar-minimize">
            <i class="ki-duotone ki-black-left-line fs-3 rotate-180">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>
        <!--end::Sidebar toggle-->
    </div>
    <!--end::Logo-->
    <!--begin::sidebar menu-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
            <!--begin::Scroll wrapper-->
            <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
                <!--begin::Menu-->
                <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                    {{-- <!--begin:Menu item-->
                    <div class="menu-item pt-5">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">Pages</span>
                        </div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item--> --}}
                    <!--begin:Dasbord-->
					<div class="menu-item">
						<!--begin:Menu link-->
						<a class="menu-link {{ $title == 'Home' ? 'active' : '' }} " href="{{ route('home') }}">
							<span class="menu-icon">
								<i class="ki-duotone ki-home fs-2">
								</i>
							</span>
							<span class="menu-title">Dasbor</span>
						</a>
						<!--end:Menu link-->
					</div>
					<!--end:Dasbord-->

                    @if ($userLogin->category == "Owner" || $userLogin->category == "Employed")

                        <!--begin:Dasbord-->
                        @if ($checkPembelianPaket[0]['status_paket'] == "Aktif")
                            
                            <!--begin:TITLE PEMESANAN-->
                            <div class="menu-item pt-5">
                                <div class="menu-content">
                                    <span class="menu-heading fw-bold text-uppercase fs-7">Pemesanan</span>
                                </div>
                            </div>
                            <!--end:TITLE PEMESANAN-->
                            
                            <!--begin:FITUR INPUT PESANAN-->
                            <div class="menu-item">
                                <a class="menu-link {{ $title == 'tambahPesanan' ? 'active' : '' }} " href="#">
                                    <span class="menu-icon">
                                        <i class="ki-outline ki-notepad-edit fs-2"></i>
                                    </span>
                                    <span class="menu-title">Tambah</span>
                                </a>
                            </div>
                            <!--end:FITUR INPUT PESANAN-->
                            
                            <!--begin:FITUR DATA PROSES PESANAN-->
                            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                
                                <!--begin:TITLE PROSES-->
                                <span class="menu-link">
                                    <span class="menu-icon">
                                        <i class="ki-outline ki-arrows-circle fs-2"></i>
                                    </span>
                                    <span class="menu-title">Proses</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:TITLE PROSES-->
                                
                                <!--begin:MENU SUB-->
                                <div class="menu-sub menu-sub-accordion">

                                    <!--begin:FITUR DATA DESAIN-->
                                    <div class="menu-item">
                                        <a class="menu-link" href="#">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Desain</span>
                                        </a>
                                    </div>
                                    <!--end:FITUR DATA DESAIN-->
                                    
                                    <!--begin:FITUR DATA CETAK / CUTTING-->
                                    <div class="menu-item">
                                        <a class="menu-link" href="#">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Cetak / Cutting</span>
                                        </a>
                                    </div>
                                    <!--end:FITUR DATA CETAK / CUTTING-->

                                    <!--begin:FITUR DATA LAMINATING-->
                                    <div class="menu-item">
                                        <a class="menu-link" href="#">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Laminating</span>
                                        </a>
                                    </div>
                                    <!--end:FITUR DATA LAMINATING-->

                                    <!--begin:FITUR DATA PACKING-->
                                    <div class="menu-item">
                                        <a class="menu-link" href="#">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Packing</span>
                                        </a>
                                    </div>
                                    <!--end:FITUR DATA PACKING-->

                                    <!--begin:FITUR DATA PEMASANGAN-->
                                    <div class="menu-item">
                                        <a class="menu-link" href="#">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Pemasangan</span>
                                        </a>
                                    </div>
                                    <!--end:FITUR DATA PEMASANGAN-->

                                </div>
                                <!--end:MENU SUB-->

                            </div>
                            <!--end:FITUR DATA PROSES PESANAN-->

                            <!--begin:FITUR DATA LOGITIK-->
                            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">

                                <!--begin:TITLE LOGISTIK-->
                                <span class="menu-link">
                                    <span class="menu-icon">
                                        <i class="ki-outline ki-parcel fs-2"></i>
                                    </span>
                                    <span class="menu-title">Logistik</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:TITLE LOGISTIK-->

                                <!--begin:MENU SUB-->
                                <div class="menu-sub menu-sub-accordion">

                                    <!--begin:FITUR DATA PENGIRIMAN-->
                                    <div class="menu-item">
                                        <a class="menu-link" href="#">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Pengiriman</span>
                                        </a>
                                    </div>
                                    <!--end:FITUR DATA PENGIRIMAN-->

                                    <!--begin:FITUR DATA AMBIL DITOKO-->
                                    <div class="menu-item">
                                        <a class="menu-link" href="#">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Ambil di Toko</span>
                                        </a>
                                    </div>
                                    <!--end:FITUR DATA AMBIL DITOKO-->

                                </div>
                                <!--end:MENU SUB-->

                            </div>
                            <!--end:FITUR DATA LOGITIK-->

                            <!--begin:TITLE LAPORAN-->
                            <div class="menu-item pt-5">
                                <div class="menu-content">
                                    <span class="menu-heading fw-bold text-uppercase fs-7">Laporan</span>
                                </div>
                            </div>
                            <!--end:TITLE LAPORAN-->
                            
                            <!--begin:FITUR DATA ARUS KAS-->
                            <div class="menu-item">
                                <a class="menu-link" href="#">
                                    <span class="menu-icon">
                                        <i class="ki-outline ki-arrow-up-down fs-2"></i>
                                    </span>
                                    <span class="menu-title">Arus Kas</span>
                                </a>
                            </div>
                            <!--end:FITUR DATA ARUS KAS-->

                            <!--begin:FITUR DATA PESANAN-->
                            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">

                                <!--begin:TITLE PESANAN-->
                                <span class="menu-link">
                                    <span class="menu-icon">
                                        <i class="ki-outline ki-purchase fs-2"></i>
                                    </span>
                                    <span class="menu-title">Pesanan</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:TITLE PESANAN-->

                                <!--begin:MENU SUB-->
                                <div class="menu-sub menu-sub-accordion">

                                    <!--begin:FITUR DATA PESANAN PRODUK-->
                                    <div class="menu-item">
                                        <a class="menu-link" href="#">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Produk</span>
                                        </a>
                                    </div>
                                    <!--end:FITUR DATA PESANAN PRODUK-->

                                    <!--begin:FITUR DATA PESANAN JASA PASANG-->
                                    <div class="menu-item">
                                        <a class="menu-link" href="#">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Jasa Pasang</span>
                                        </a>
                                    </div>
                                    <!--end:FITUR DATA PESANAN JASA PASANG-->

                                </div>
                                <!--end:MENU SUB-->

                            </div>
                            <!--end:FITUR DATA PESANAN-->

                            <!--begin:FITUR DATA PENGGUNAAN BAHAN-->
                            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">

                                <!--begin:TITLE PENGGUNAAN BAHAN-->
                                <span class="menu-link">
                                    <span class="menu-icon">
                                        <i class="ki-outline ki-book-open fs-2"></i>
                                    </span>
                                    <span class="menu-title">Penggunaan Bahan</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:TITLE PENGGUNAAN BAHAN-->
                                
                                <!--begin:MENU SUB-->
                                <div class="menu-sub menu-sub-accordion">

                                    <!--begin:FITUR DATA BAHAN TERPAKAI-->
                                    <div class="menu-item">
                                        <a class="menu-link" href="#">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Terpakai</span>
                                        </a>
                                    </div>
                                    <!--end:FITUR DATA BAHAN TERPAKAI-->

                                    <!--begin:FITUR DATA BAHAN RUSAK-->
                                    <div class="menu-item">
                                        <a class="menu-link" href="#">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Rusak</span>
                                        </a>
                                    </div>
                                    <!--end:FITUR DATA BAHAN RUSAK-->

                                </div>
                                <!--end:MENU SUB-->

                            </div>
                            <!--end:FITUR DATA PENGGUNAAN BAHAN-->

                            <!--begin:TITLE DATA MASTER-->
                            <div class="menu-item pt-5">
                                <div class="menu-content">
                                    <span class="menu-heading fw-bold text-uppercase fs-7">Data Master</span>
                                </div>
                            </div>
                            <!--end:TITLE DATA MASTER-->

                            @if ($userLogin->category == "Owner")

                                <!--begin:FITUR DATA PRODUK-->
                                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                    
                                    <!--begin:TITLE PRODUK-->
                                    <span class="menu-link">
                                        <span class="menu-icon">
                                            <i class="ki-outline ki-folder fs-2"></i>
                                        </span>
                                        <span class="menu-title">Prdouk</span>
                                        <span class="menu-arrow"></span>
                                    </span>
                                    <!--end:TITLE PRODUK-->
                                    
                                    <!--begin:MENU SUB-->
                                    <div class="menu-sub menu-sub-accordion">

                                        <!--begin:FITUR DATA PRODUK CUSTOM-->
                                        <div class="menu-item">
                                            <a class="menu-link" href="#">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Custom</span>
                                            </a>
                                        </div>
                                        <!--end:FITUR DATA PRODUK CUSTOM-->
                                        
                                        <!--begin:FITUR DATA PRODUK RETAIL-->
                                        <div class="menu-item">
                                            <a class="menu-link" href="#">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">Retail</span>
                                            </a>
                                        </div>
                                        <!--end:FITUR DATA PRODUK RETAIL-->

                                    </div>
                                    <!--end:MENU SUB-->

                                </div>
                                <!--end:FITUR DATA PRODUK-->
                                
                                <!--begin:FITUR DATA KARYAWAN-->
                                <div class="menu-item">
                                    <a class="menu-link {{ $title == 'Data Karyawan' ? 'active' : '' }} " href="{{ route('dataEmploye') }}">
                                        <span class="menu-icon">
                                            <i class="ki-outline ki-people fs-2"></i>
                                        </span>
                                        <span class="menu-title">Karyawan</span>
                                    </a>
                                </div>
                                <!--end:FITUR DATA KARYAWAN-->
                                
                                <!--begin:FITUR DATA AKUN BANK-->
                                <div class="menu-item">
                                    <a class="menu-link" href="#">
                                        <span class="menu-icon">
                                            <i class="ki-outline ki-bank fs-2"></i>
                                        </span>
                                        <span class="menu-title">Akun Bank</span>
                                    </a>
                                </div>
                                <!--end:FITUR DATA AKUN BANK-->
                                
                                <!--begin:FITUR DATA PELANGGAN-->
                                <div class="menu-item">
                                    <a class="menu-link" href="#">
                                        <span class="menu-icon">
                                            <i class="ki-outline ki-user-square fs-2"></i>
                                        </span>
                                        <span class="menu-title">Pelanggan</span>
                                    </a>
                                </div>
                                <!--end:FITUR DATA PELANGGAN-->
                                
                                <!--begin:FITUR DATA ALAMAT TOKO-->
                                <div class="menu-item">
                                    <a class="menu-link" href="#">
                                        <span class="menu-icon">
                                            <i class="ki-outline ki-flag fs-2"></i>
                                        </span>
                                        <span class="menu-title">Alamat Toko</span>
                                    </a>
                                </div>
                                <!--end:FITUR DATA ALAMAT TOKO-->

                                <!--begin:FITUR DATA SUMBER PESANAN-->
                                <div class="menu-item">
                                    <a class="menu-link" href="#">
                                        <span class="menu-icon">
                                            <i class="ki-outline ki-cheque fs-2"></i>
                                        </span>
                                        <span class="menu-title">Sumber Pesanan</span>
                                    </a>
                                </div>
                                <!--end:FITUR DATA SUMBER PESANAN-->
                                
                                <!--begin:FITUR DATA DISKON RESELLER-->
                                <div class="menu-item">
                                    <a class="menu-link" href="#">
                                        <span class="menu-icon">
                                            <i class="ki-outline ki-discount fs-2"></i>
                                        </span>
                                        <span class="menu-title">Diskon Reseller</span>
                                    </a>
                                </div>
                                <!--end:FITUR DATA DISKON RESELLER-->
                                
                                <!--begin:FITUR DATA KAS-->
                                <div class="menu-item">
                                    <a class="menu-link" href="#">
                                        <span class="menu-icon">
                                            <i class="ki-outline ki-wallet fs-2"></i>
                                        </span>
                                        <span class="menu-title">Kas</span>
                                    </a>
                                </div>
                                <!--end:FITUR DATA KAS-->


                                <!--begin:TITLE TOKO ONLINE-->
                                <div class="menu-item pt-5">
                                    <!--begin:Menu content-->
                                    <div class="menu-content">
                                        <span class="menu-heading fw-bold text-uppercase fs-7">Toko Online</span>
                                    </div>
                                    <!--end:Menu content-->
                                </div>
                                <!--end:TITLE TOKO ONLINE-->
                                
                                <!--begin:FITUR EDIT ETALASE TOKO-->
                                <div class="menu-item">
                                    <a class="menu-link" href="#">
                                        <span class="menu-icon">
                                            <i class="ki-outline ki-save-2 fs-2"></i>
                                        </span>
                                        <span class="menu-title">Etalase</span>
                                    </a>
                                </div>
                                <!--end:FITUR EDIT ETALASE TOKO-->
                                
                                <!--begin:FITUR EDIT DEKORASI TOKO-->
                                <div class="menu-item">
                                    <a class="menu-link" href="#">
                                        <span class="menu-icon">
                                            <i class="ki-outline ki-element-5 fs-2"></i>
                                        </span>
                                        <span class="menu-title">Dekorasi</span>
                                    </a>
                                </div>
                                <!--end:FITUR EDIT DEKORASI TOKO-->
                                
                                <!--begin:FITUR DATA INFORMASI TOKO-->
                                <div class="menu-item">
                                    <a class="menu-link" href="#">
                                        <span class="menu-icon">
                                            <i class="ki-outline ki-information-2 fs-2"></i>
                                        </span>
                                        <span class="menu-title">Informasi</span>
                                    </a>
                                </div>
                                <!--end:FITUR DATA INFORMASI TOKO-->

                            @endif

                        @endif
                        <!--end:Dasbord-->
                        
                    @endif

                    @if ($userLogin->category == "Developer")
                        <!--end:Menu title-->
                        <!--begin:Paket & langganan-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {{ $title == 'Data Toko' ? 'active' : '' }} " href="{{ route('dataToko') }}">
                                <span class="menu-icon">
                                    <i class="ki-outline ki-shop fs-2"></i>
                                </span>
                                <span class="menu-title">Data Toko</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Paket & langganan-->

                        <!--begin:Pengguna-->
                        <div data-kt-menu-trigger="click" class="menu-item {{ $title == 'Data Pengguna - Owner' || $title == 'Data Pengguna - Employed' || $title == 'Data Pengguna - Freelance' ? 'here show ' : '' }} menu-accordion">
                            <!--begin:Menu link-->
                            <span class="menu-link {{ $title == 'Data Pengguna - Owner' || $title == 'Data Pengguna - Employed' || $title == 'Data Pengguna - Freelance' ? 'active' : '' }}">
                                <span class="menu-icon">
                                    <i class="ki-outline ki-people fs-2"></i>
                                </span>
                                <span class="menu-title">Pengguna</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->
                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{ $title == 'Data Pengguna - Owner' ? 'active' : '' }}" href="/pengguna/owner">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Owner</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{ $title == 'Data Pengguna - Employed' ? 'active' : '' }}" href="/pengguna/employed">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Karyawan</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{ $title == 'Data Pengguna - Freelance' ? 'active' : '' }}" href="/pengguna/freelance">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Freelancer</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                        </div>
                        <!--end:Pengguna-->

                        <!--begin:Menu title-->
                        <div class="menu-item pt-5">
                            <!--begin:Menu content-->
                            <div class="menu-content">
                                <span class="menu-heading fw-bold text-uppercase fs-7">Permintaan</span>
                            </div>
                            <!--end:Menu content-->
                        </div>
                        <!--end:Menu title-->

                        <!--begin:Paket & langganan-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {{ $title == 'Pembelian Paket' ? 'active' : '' }} " href="{{ route('pembelianPaket') }}">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-handcart fs-2"></i>
                                </span>
                                <span class="menu-title">Pembelian Paket</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Paket & langganan-->

                        <!--begin:Join Freelance-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link" href="#">
                                <span class="menu-icon">
                                    <i class="ki-outline  ki-abstract-45 fs-2"></i>
                                </span>
                                <span class="menu-title">Join Freelance</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Join Freelance-->

                        <!--begin:Menu title-->
                        <div class="menu-item pt-5">
                            <!--begin:Menu content-->
                            <div class="menu-content">
                                <span class="menu-heading fw-bold text-uppercase fs-7">Pengaturan</span>
                            </div>
                            <!--end:Menu content-->
                        </div>
                        <!--end:Menu title-->

                        <!--begin:Paket & langganan-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {{ $title == 'Paket & Fitur Langganan' ? 'active' : '' }} " href="{{ route('paket') }}">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-tag fs-2">
                                        <i class="path1"></i>
                                        <i class="path2"></i>
                                        <i class="path3"></i>
                                    </i>
                                </span>
                                <span class="menu-title">Paket & Fitur Langganan</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
					    <!--end:Paket & langganan-->

                    @endif


                </div>
                <!--end::Menu-->
            </div>
            <!--end::Scroll wrapper-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->
    <!--begin::Footer-->
    <div class="app-sidebar-footer flex-column-auto pt-2 pb-6 px-6" id="kt_app_sidebar_footer">
        <a href="https://preview.keenthemes.com/html/metronic/docs"
            class="btn btn-flex flex-center btn-custom btn-primary overflow-hidden text-nowrap px-0 h-40px w-100"
            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss-="click"
            title="200+ in-house components and 3rd-party plugins">
            <span class="btn-label">Docs & Components</span>
            <i class="ki-duotone ki-document btn-icon fs-2 m-0">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </a>
    </div>
    <!--end::Footer-->
</div>
<!--end::Sidebar-->
