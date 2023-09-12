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
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link" href="#">
                                <span class="menu-icon">
                                    <i class="">
                                    </i>
                                </span>
                                <span class="menu-title">menu aktif</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                    @endif
					<!--end:Dasbord-->
                        
                    @endif

                    @if ($userLogin->category == "Developer")

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
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                            <!--begin:Menu link-->
                            <span class="menu-link">
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
                                    <a class="menu-link" href="#">
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
                                    <a class="menu-link" href="#">
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
                                    <a class="menu-link" href="#">
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
