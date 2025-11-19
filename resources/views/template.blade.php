<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>APLIKASI ANGGARAN</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('/')}}assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{asset('/')}}assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{asset('/')}}assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{asset('/')}}assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{asset('/')}}assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset('/')}}assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="{{asset('/')}}assets/vendor/libs/apex-charts/apex-charts.css" />
    <link href='https://cdn.boxicons.com/3.0.3/fonts/basic/boxicons.min.css' rel='stylesheet'>
    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{asset('/')}}assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{asset('/')}}assets/js/config.js"></script>
    <style>
        .section-title {
            color: #000080;
            text-transform: uppercase;
        }
    </style>
    @yield('style')
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">

                    <a href="index.html" class="app-brand-link" id="identity">
                        <img src="https://appel.iainkendari.ac.id/logo-iain-kendari.png" width="35">
                        <span style="text-transform:none" class="app-brand-text demo menu-text fw-bolder ms-2">JUARA</span>
                    </a>

                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>
                <!-- <div class="px-3 my-3">
                    <select class="form-select">
                        <option value="">TA. 2023</option>
                    </select>
                </div> -->
                <div id="show-menu"></div>
                <div id="menu-user-organisasi" style="display: none">
                    @include('parts/menu-user-organisasi')
                </div>
                <div id="menu-admin" style="display: none">
                    @include('parts/menu-admin')
                </div>
                <div id="menu-spi" style="display: none">
                    @include('parts/menu-spi')
                </div>
                <div id="menu-spi-pimpinan" style="display: none">
                    @include('parts/menu-spi-pimpinan')
                </div>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <nav class="layout-navbar container-fluid navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Search -->
                        <span>Peran: &nbsp;</span>
                        <div class="navbar-nav align-items-center">
                            <div class="nav-item d-flex align-items-center">
                                <select class="form-select" id="roles">
                                    <!-- <option value="">UPT TIPD (Utama)</option> -->
                                    <!-- <option value="">Administrator</option> -->
                                </select>
                            </div>
                        </div>
                        <!-- /Search -->

                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <!-- Place this tag where you want the button to render. -->
                            <li class="nav-item lh-1 me-3">
                                <span id="user"></span>
                            </li>

                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="{{asset('/')}}assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="{{asset('/')}}assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold d-block">John Doe</span>
                                                    <small class="text-muted">Admin</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="bx bx-user me-2"></i>
                                            <span class="align-middle">My Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="auth-login-basic.html" id="logout">
                                            <i class="bx bx-power-off me-2"></i>
                                            <span class="align-middle">Log Out</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-fluid flex-grow-1 container-p-y">
                        <div class="row">
                            @yield('content')
                        </div>
                        <!-- / Content -->

                        <!-- Footer -->
                        <footer class="content-footer footer bg-footer-theme">
                            <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                                <div class="mb-2 mb-md-0">
                                    ©2025, made with ❤️ by
                                    <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">ThemeSelection</a>
                                </div>
                            </div>
                        </footer>
                        <!-- / Footer -->

                        <div class="content-backdrop fade"></div>
                    </div>
                    <!-- Content wrapper -->
                </div>
                <!-- / Layout page -->
            </div>

            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>
        </div>
        <!-- / Layout wrapper -->
        <!-- 
        <div class="buy-now">
            <a href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/" target="_blank" class="btn btn-danger btn-buy-now">Upgrade to Pro</a>
        </div> -->

        <!-- Core JS -->
        <!-- build:js assets/vendor/js/core.js -->
        <script src="{{asset('/')}}assets/vendor/libs/jquery/jquery.js"></script>
        <script src="{{asset('/')}}assets/vendor/libs/popper/popper.js"></script>
        <script src="{{asset('/')}}assets/vendor/js/bootstrap.js"></script>
        <script src="{{asset('/')}}assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

        <script src="{{asset('/')}}assets/vendor/js/menu.js"></script>
        <!-- endbuild -->

        <!-- Vendors JS -->
        <script src="{{asset('/')}}assets/vendor/libs/apex-charts/apexcharts.js"></script>

        <!-- Main JS -->
        <script src="{{asset('/')}}assets/js/main.js"></script>

        <!-- Page JS -->
        <script src="{{asset('/')}}assets/js/dashboards-analytics.js"></script>

        <!-- Place this tag in your head or just before your close body tag. -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var token = localStorage.getItem('token');

                // Fungsi untuk memeriksa validitas token dengan API endpoint
                function checkTokenValidity(token) {
                    // Lakukan permintaan ke endpoint backend untuk memeriksa token
                    // Misalnya, gunakan fetch atau XMLHttpRequest

                    // Contoh menggunakan fetch:
                    fetch('{{route("token.check")}}', {
                            method: 'POST',
                            headers: {
                                'Authorization': `Bearer ${token}`
                            }
                        })
                        .then(response => {
                            // console.log(response);
                            if (!response.ok) {
                                alert('Sesi login habis, silahkan login kembali')
                                localStorage.removeItem('tahun_anggaran');
                                return window.location.href = '{{route("login.page")}}';
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert(error);
                        });
                }

                // Memeriksa validitas token saat halaman dimuat
                if (token) {
                    checkTokenValidity(token);
                } else {
                    // Jika tidak ada token, arahkan ke halaman login
                    return window.location.href = '{{route("login.page")}}';
                }

                let decodedToken = jwt_decode(token);
                // console.log(decodedToken);
                if (!localStorage.getItem('tahun_anggaran'))
                    return window.location.href = '{{route("pilih.tahun.anggaran")}}';

                document.querySelector("#user").innerText = `${decodedToken.user_data.nama_lengkap}`
                if (decodedToken.current_role === "admin_organisasi" || decodedToken.current_role === "user_kegiatan")
                    document.querySelector("#menu-user-organisasi").style.display = "block";
                if (decodedToken.current_role === "admin")
                    document.querySelector("#menu-admin").style.display = "block";
                if (decodedToken.current_role === "verifikator_spi")
                    document.querySelector("#menu-spi").style.display = "block";
                if (decodedToken.current_role === "spi_pimpinan")
                    document.querySelector("#menu-spi-pimpinan").style.display = "block";

                if (decodedToken.current_role === "verifikator_spi" || decodedToken.current_role === "spi_pimpinan") {

                    document.querySelector("#identity").innerHTML = `
                    <img src="{{asset('/')}}/logo-e-audit-2.png" width="150">
                    `;
                }


                let roles = ""
                decodedToken.roles.map(function(role) {
                    if (decodedToken.roles.length == 1) {
                        if (decodedToken.current_role === "admin_organisasi" || decodedToken.current_role === "verifikator_spi")
                            roles += `<option>${role.organisasi.nama_organisasi}</option>`
                        else
                            roles += `<option>${role.organisasi}</option>`
                    } else {
                        if (role.role == decodedToken.current_role) {
                            if (role.role === "admin_organisasi" || role.role === "user_kegiatan")
                                roles += `<option selected> ${role.organisasi.nama_organisasi}</option>`
                            else
                                roles += `<option selected>${role.organisasi}</option>`
                        } else {
                            if (role.role === "admin_organisasi" || role.role === "user_kegiatan")
                                roles += `<option value="${role.role}">${role.organisasi.nama_organisasi}</option>`
                            else
                                roles += `<option value="${role.role}">${role.organisasi}</option>`
                        }
                    }

                })
                document.querySelector("#roles").innerHTML = roles
                document.querySelector("#roles").addEventListener('change', function() {
                    var selectedValue = document.querySelector("#roles").value;
                    switchRole(selectedValue)
                });

            });

            async function switchRole(role) {
                let konfirmasi = confirm("Yakin ganti peran?")
                if (konfirmasi) {
                    let formData = new FormData()

                    formData.append('switchRole', role)
                    fetch('{{route("switch.role")}}', {
                            method: 'POST',
                            headers: {
                                'Authorization': 'Bearer ' + localStorage.getItem('token')
                            },
                            body: formData
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Gagal ganti peran.');
                            }
                            return response.json();
                        })
                        .then(data => {
                            const token = data.access_token; // Mengambil token dari response JSON
                            // Simpan token ke localStorage atau sessionStorage
                            localStorage.removeItem('token');
                            localStorage.setItem('token', token);

                            // Redirect ke halaman selanjutnya atau lakukan sesuatu setelah login berhasil
                            window.location.href = '{{route("user.dashboard")}}';
                        })
                        .catch(error => {
                            console.error('Gagal Ganti Peran:', error);
                            // Tampilkan pesan error atau lakukan sesuatu jika login gagal
                        });
                }


            }
            document.getElementById('logout').addEventListener('click', function(e) {
                e.preventDefault();

                // const formData = new FormData(this);
                fetch('{{route("logout")}}', {
                        method: 'POST',
                        headers: {
                            'Authorization': 'Bearer ' + localStorage.getItem('token')
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Logout failed.');
                        }
                        return response.json();
                    })
                    .then(data => {
                        const token = data.access_token; // Mengambil token dari response JSON
                        // Simpan token ke localStorage atau sessionStorage
                        localStorage.removeItem('token');
                        localStorage.removeItem('tahun_anggaran');

                        // Redirect ke halaman selanjutnya atau lakukan sesuatu setelah login berhasil
                        window.location.href = '{{route("login.page")}}';
                    })
                    .catch(error => {
                        console.error('Logout error:', error);
                        // Tampilkan pesan error atau lakukan sesuatu jika login gagal
                    });
            });

            function jwt_decode(token) {
                const base64Url = token.split('.')[1]; // Ambil bagian payload dari token (dalam base64)
                const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/'); // Ubah karakter khusus
                const jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
                    return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
                }).join('')); // Decode base64 dan ubah menjadi JSON

                return JSON.parse(jsonPayload); // Parse JSON menjadi objek JavaScript
            }
        </script>
        @yield('scripts')
</body>

</html>