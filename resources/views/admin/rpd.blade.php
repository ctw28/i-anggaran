@extends('template')

@section('style')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<style>

</style>
@endsection
@section('content')

<!-- <h4 class="py-3 mb-4"><span class="text-muted fw-light">Pengaturan/</span> Tahun Anggaran</h4> -->

<div class="col-md-12">
    <div class="card mb-4">
        <h5 class="card-header">Pengaturan Rencana Penarikan Dana (RPD)</h5>
        <div class="card-body">
            <div class="mb-3">
                <div class="row">
                    <div class="col-2">
                        <label class="form-label" for="tanggal_rpd_mulai">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="tanggal_rpd_mulai" readonly />

                    </div>
                    <div class="col-2">
                        <label class="form-label" for="tanggal_rpd_selesai">Tanggal Selesai</label>
                        <input type="date" class="form-control" id="tanggal_rpd_selesai" readonly />

                    </div>
                    <div class="col-8">
                        <label class="form-label" for="catatan">Catatan (jika ada)</label>
                        <input type="text" class="form-control" id="catatan" readonly />

                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <button type="button" onclick="atur(this)" class="btn btn-primary btn-sm">Edit</button>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="card mb-4">
        <h5 class="card-header">Rencana Penarikan Dana (RPD)</h5>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead class="text-center">
                        <th>No</th>
                        <th>RPD</th>
                        <th>Fakultas / Lembaga / Unit</th>
                        <!-- <th>Selesai</th> -->
                    </thead>
                    <tbody id="organisasi-data">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="fullscreenModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title " id="modalFullTitle">Rencana Penarikan Dana (RPD)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="loadData()"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <!-- <div class="table-container"> -->
                    <!-- <table id="data-table"> -->
                    <table class="table table-striped table-bordered" id="rpd-table">
                        <thead class="align-middle text-center text-bold">
                            <tr>
                                <th style="width: 1%" rowspan="2">No</th>
                                <th style="width: 25%" rowspan="2">Program</th>
                                <th colspan="11">Rencana Penarikan Dana<br>(RPD)</th>
                                <!-- <th rowspan="2">Aksi</th> -->
                            </tr>
                            <tr>
                                <th>Jan</th>
                                <th>Feb</th>
                                <th>Mar</th>
                                <th>Apr</th>
                                <th>Mei</th>
                                <th>Jun</th>
                                <th>Jul</th>
                                <th>Agust</th>
                                <th>Sept</th>
                                <th>Okt</th>
                                <th>Nov</th>
                            </tr>
                        </thead>
                        <tbody id="rpd-data">

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button onclick="loadData()" type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Keluar</button>
                <!-- <button type="button" class="btn btn-primary">Simpan Perubahan</button> -->
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        loadData()
    });

    const tanggalMulai = document.querySelector('#tanggal_rpd_mulai')
    const tanggalSelesai = document.querySelector('#tanggal_rpd_selesai')
    const catatan = document.querySelector('#catatan')

    function atur(button) {
        tanggalMulai.removeAttribute('readonly')
        tanggalSelesai.removeAttribute('readonly')
        catatan.removeAttribute('readonly')

        // tanggalMulai.setAttribute('type', 'date');
        // tanggalMulai.setAttribute('value', tanggalMulai.value);

        button.innerText = "Atur"
        button.removeAttribute('onclick')

        button.setAttribute('onclick', 'save(this)')
    }

    function save(button) {

        const formData = new FormData();
        formData.append('tahun_anggaran_id', '1')
        formData.append('tanggal_rpd_mulai', document.querySelector('#tanggal_rpd_mulai').value)
        formData.append('tanggal_rpd_selesai', document.querySelector('#tanggal_rpd_selesai').value)
        formData.append('catatan', document.querySelector('#catatan').value)

        fetch('{{route("admin.tahun-anggaran-sesi.store")}}', {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                method: 'POST',
                body: formData
            })
            .then(response => {
                console.log(response);
                if (!response.ok) {

                    if (response.status === 422) {
                        // console.log(document.getElementById('data-table'));
                        const errors = response.errors;

                        // Menampilkan pesan kesalahan kepada pengguna
                        Object.keys(errors).forEach(key => {
                            const errorMessages = errors[key].join(', ');
                            toastr.options.closeButton = true;
                            toastr.options.positionClass = 'toast-top-center mt-3';
                            toastr.error(errorMessages);
                            // console.error(`Error in ${key}: `);
                            // Tampilkan pesan kesalahan ke pengguna, misalnya dengan alert atau menambahkan ke dalam elemen HTML
                        });

                    }
                    throw new Error('ada kesalahan.');
                }
                // if (!response.ok) {
                // }
                return response.json();
            })
            .then(data => {


                console.log(data);
                toastr.options.closeButton = true;
                toastr.options.positionClass = 'toast-top-center mt-3';
                toastr.success('Sukses');
                document.querySelector('#tanggal_rpd_mulai').setAttribute('readonly', 'readonly')
                document.querySelector('#tanggal_rpd_selesai').setAttribute('readonly', 'readonly')
                document.querySelector('#catatan').setAttribute('readonly', 'readonly')
                button.removeAttribute('onclick')

                button.innerText = "Edit"
                button.setAttribute('onclick', 'atur(this)')
            })
            .catch(error => {

                console.error('error:', error);
                // Tampilkan pesan error atau lakukan sesuatu jika login gagal
            });

    }

    function loadData() {
        fetch('{{route("admin.organisasi.rpd")}}', {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                method: 'GET',
            })
            .then(response => {
                console.log(response);
                if (!response.ok) {

                    if (response.status === 404) {
                        // console.log(document.getElementById('data-table'));
                        document.querySelector("#kegiatan-data").innerHTML = '<tr><td colspan="5" class="text-center">Data tidak ada</td></tr>'
                        document.querySelector("#tambah-baris").dataset.isNoResult = true
                    }
                    throw new Error('ada kesalahan.');
                }
                // if (!response.ok) {
                // }
                return response.json();
            })
            .then(data => {

                console.log(data);
                // return

                let contents = '' // Mengambil token dari response JSON
                data.data.map((data, index) => {
                    contents += `<tr data-id="${data.id}">
                    <td class="text-center">${index+1}</td>`

                    // if (data.rencana_sesi.length != 0) {
                    // <button class="btn btn-sm btn-info mt-1 mb-1" onclick="lihatRPD(this)"><i class="tf-icons bx bx-printer"></i> Cetak RPD</button>
                    contents += `<td class="text-center">
                                    <button class="btn btn-sm btn-primary mt-1 mb-1" onclick="showRpd(this)" data-bs-toggle="modal" data-bs-target="#fullscreenModal"><i class="tf-icons bx bx-grid"></i> Lihat RPD</button>
                                    </td>`
                    contents += `<td>
                    ${data.organisasi.organisasi_nama} (${data.organisasi.organisasi_singkatan})<br>
                    <span style="color:red">Pagu : Rp.xxxxx </span></td>`
                    // contents += `<td class="text-center">
                    //                     <div class="form-check form-switch mb-2">
                    //                         <input class="form-check-input" type="checkbox">
                    //                     </div>
                    //                 </td>`
                    // } else {
                    //     contents += `<td>Belum Mengajukan</td>`
                    //     contents += `<td class="text-center">-</td>`
                    // }

                    contents += `</tr>`
                })
                document.querySelector("#organisasi-data").innerHTML = ''
                document.querySelector("#organisasi-data").innerHTML = contents
            })
            .catch(error => {
                console.error('error:', error);
                // Tampilkan pesan error atau lakukan sesuatu jika login gagal
            });

        fetch('{{route("admin.tahun-anggaran-sesi.index")}}', {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                method: 'GET',
            })
            .then(response => {
                console.log(response);
                if (!response.ok) {

                    if (response.status === 404) {}
                    throw new Error('ada kesalahan.');
                }
                // if (!response.ok) {
                // }
                return response.json();
            })
            .then(data => {
                console.log(data);
                tanggalMulai.value = data.data.tanggal_mulai
                tanggalSelesai.value = data.data.tanggal_selesai
                catatan.value = data.data.catatan

            })
            .catch(error => {
                console.error('error:', error);
                // Tampilkan pesan error atau lakukan sesuatu jika login gagal
            });
    }
    // 
    function showRpd(button) {
        // Fungsi untuk menangani aksi ketika tombol Escape ditekan
        const row = button.parentNode.parentNode
        // return console.log(row);
        const formData = new FormData();
        formData.append('organisasi_rpd_id', row.dataset.id)
        fetch('{{route("admin.kegiatan.data")}}', {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    if (response.status == 404) {
                        document.querySelector("#rpd-data").innerHTML = '<tr><td colspan="13" class="text-center">Data tidak ada</td></tr>'
                    }
                    throw new Error('data tidak ada.');
                }
                return response.json();
            })
            .then(data => {
                console.log(data);
                // if()
                let contents = ''
                data.data.kegiatan.map((data, index) => {
                    contents += `<tr data-id="${data.id}">
                    <td class="text-center">${index+1}</td>
                    <td>
                    ${data.kegiatan_nama}<br>
                    <small>Pagu : Rp. ${data.jumlah_biaya} (${data.sumber_dana})</small>
                    </td>`
                    for (let inc = 0; inc < 11; inc++) {
                        if (!data.rencana[inc + 1]) {
                            contents += `
                                    <td class="text-center" data-bulan="${inc + 1}">
                                    -
                                    </td>`
                        } else {
                            contents += `
                                <td class="text-center">
                                <span class="badge bg-label-dark"><small>${data.rencana[inc + 1].tanggal}-${data.rencana[inc + 1].bulan_indonesia}</small></span>
                                <br><span class="badge bg-label-danger" style="font-size: 14px">${formatRupiah(data.rencana[inc + 1].jumlah)}</span>
                                </td>`
                        }
                    }
                    contents += `</tr>`
                })
                document.querySelector("#rpd-data").innerHTML = ''
                document.querySelector("#rpd-data").innerHTML = contents
            })
            .catch(error => {
                console.error('error:', error);
                // Tampilkan pesan error atau lakukan sesuatu jika login gagal
            });
    }

    function formatRupiah(angka) {
        let reverse = angka.toString().split('').reverse().join('');
        let ribuan = reverse.match(/\d{1,3}/g);
        let formatted = ribuan.join('.').split('').reverse().join('');
        return `${formatted}`;
    }
</script>
@endsection