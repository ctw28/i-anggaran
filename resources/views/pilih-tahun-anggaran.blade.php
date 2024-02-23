<!DOCTYPE html>

<html lang="en" class="light-style" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Pilih Tahung Anggaran</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

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

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{asset('/')}}assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{asset('/')}}assets/js/config.js"></script>
</head>

<body>
    <div class="container">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Pengaturan Tahun Anggaran</h5>
                        <select class="form-control" id="tahun-anggaran-data">

                        </select>
                        <button class="btn btn-primary mt-2" onclick="setTahunAnggaran()">Pilih</button>
                    </div>
                </div>

            </div>
        </div>

        <!-- Core JS -->
        <!-- build:js assets/vendor/js/core.js -->
        <script src="{{asset('/')}}assets/vendor/libs/jquery/jquery.js"></script>
        <script src="{{asset('/')}}assets/vendor/libs/popper/popper.js"></script>
        <script src="{{asset('/')}}assets/vendor/js/bootstrap.js"></script>
        <script src="{{asset('/')}}assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

        <script src="{{asset('/')}}assets/vendor/js/menu.js"></script>
        <!-- endbuild -->

        <!-- Vendors JS -->

        <!-- Main JS -->
        <script src="{{asset('/')}}assets/js/main.js"></script>

        <!-- Page JS -->

        <!-- Place this tag in your head or just before your close body tag. -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var token = localStorage.getItem('token');

                // Jika token tidak ada atau null, redirect ke halaman login
                if (!token) {
                    window.location.href = '{{route("login.page")}}'; // Ganti HALAMAN_LOGIN dengan URL halaman login
                }

                let decodedToken = jwt_decode(token);
                console.log(decodedToken);
                const currentTime = Date.now() / 1000; // Waktu saat ini dalam detik

                if (decodedToken.exp < currentTime) {
                    // Token telah kedaluwarsa
                    alert('Sesi login habis, silahkan login kembali');
                    localStorage.removeItem('token');

                    // Lakukan sesuatu, seperti menghapus token dari localStorage atau tindakan lainnya
                    window.location.href = '{{route("login.page")}}';

                }
                if (localStorage.getItem('tahun_anggaran'))
                    return window.location.href = '{{route("user.dashboard")}}';
                // const formData = new FormData(this);
                fetch('{{route("tahun.anggaran.data")}}', {
                        headers: {
                            'Authorization': 'Bearer ' + localStorage.getItem('token')
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Login failed.');
                        }
                        return response.json();
                    })
                    .then(data => {
                        // alert('gg')
                        console.log(data);
                        // if ()
                        let contents = '' // Mengambil token dari response JSON
                        // contents += `<option value="">${data.sebutan}</option>`
                        data.data.map((data, index) => {
                            contents += `<option value="${data.id}" data-tahun="${data.tahun}">${data.sebutan}</option>`
                        })
                        document.querySelector("#tahun-anggaran-data").innerHTML = contents
                    })
                    .catch(error => {
                        console.error('error:', error);
                        // Tampilkan pesan error atau lakukan sesuatu jika login gagal
                    });
            });

            function setTahunAnggaran() {
                const selectElement = document.querySelector("#tahun-anggaran-data")
                const formData = new FormData();

                formData.append('tahun_anggaran_id', selectElement.value)

                fetch('{{route("set.organisasi.sesi")}}', {
                        headers: {
                            'Authorization': 'Bearer ' + localStorage.getItem('token')
                        },
                        method: 'POST',
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Login failed.');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log(data.data);
                        // return
                        if (data.data.role == 'admin') {
                            localStorage.setItem('tahun_anggaran', JSON.stringify({
                                'id': selectElement.value,
                                'tahun': selectElement.options[selectElement.selectedIndex].dataset.tahun,
                                'organisasi_rpd': data.data.id
                            }));

                            return window.location.href = '{{route("admin.dashboard")}}'
                        } else if (data.data.role == 'verifikator_spi') {
                            localStorage.setItem('tahun_anggaran', JSON.stringify({
                                'id': selectElement.value,
                                'tahun': selectElement.options[selectElement.selectedIndex].dataset.tahun,
                                'verifikator_id': data.data.id
                            }));
                            return window.location.href = '{{route("spi.dashboard")}}'
                        } else {
                            localStorage.setItem('tahun_anggaran', JSON.stringify({
                                'id': selectElement.value,
                                'tahun': selectElement.options[selectElement.selectedIndex].dataset.tahun,
                                'organisasi_rpd': data.data.id
                            }));
                            return window.location.href = '{{route("user.dashboard")}}'
                        }

                    })
                    .catch(error => {
                        console.error('error:', error);
                        // Tampilkan pesan error atau lakukan sesuatu jika login gagal
                    });


            }

            function jwt_decode(token) {
                const base64Url = token.split('.')[1]; // Ambil bagian payload dari token (dalam base64)
                const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/'); // Ubah karakter khusus
                const jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
                    return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
                }).join('')); // Decode base64 dan ubah menjadi JSON

                return JSON.parse(jsonPayload); // Parse JSON menjadi objek JavaScript
            }
        </script>

</body>

</html>