<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>

<body>
    <h1>Selamat Datang, <span id="user"></span></h1>

    <h2>Ganti Role</h2>
    <section id="roles">

    </section>

    <button id="logout">Logout</button>


    <script>
        // Memeriksa keberadaan token pada localStorage saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            var token = localStorage.getItem('token');

            // Jika token tidak ada atau null, redirect ke halaman login
            if (!token) {
                window.location.href = '{{route("login-page")}}'; // Ganti HALAMAN_LOGIN dengan URL halaman login
            }

            let decodedToken = jwt_decode(token);
            console.log(decodedToken);
            const currentTime = Date.now() / 1000; // Waktu saat ini dalam detik

            if (decodedToken.exp < currentTime) {
                // Token telah kedaluwarsa
                alert('Sesi login habis, silahkan login kembali');
                localStorage.removeItem('token');

                // Lakukan sesuatu, seperti menghapus token dari localStorage atau tindakan lainnya
                window.location.href = '{{route("login-page")}}';

            }
            document.querySelector("#user").innerText = `${decodedToken.user_data.nama_lengkap}, Peran anda : ${decodedToken.organisasi} `
            let roles = ""
            decodedToken.roles.map(function(role) {
                if (decodedToken.roles.length == 1) {
                    roles += `<button disabled>sebagai ${role.organisasi}</button>`
                } else {

                    if (role.role == decodedToken.current_role)
                        roles += `<button disabled>sebagai ${role.organisasi}</button>`
                    else
                        roles += `<button onclick="switchRole('${role.role}')">sebagai ${role.organisasi}</button>`
                }

            })
            document.querySelector("#roles").innerHTML = roles
        });

        async function switchRole(role) {
            let konfirmasi = confirm("Yakin ganti peran?")
            if (konfirmasi) {
                let formData = new FormData()

                formData.append('switchRole', role)
                // dataSend.append('password', password)

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
                        window.location.href = '{{route("setup")}}';
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
                    localStorage.removeItem('data');

                    // Redirect ke halaman selanjutnya atau lakukan sesuatu setelah login berhasil
                    window.location.href = '{{route("login-page")}}';
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
</body>

</html>