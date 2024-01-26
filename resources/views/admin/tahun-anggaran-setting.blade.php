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
        <h5 class="card-header">DIPA</h5>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <label for="dipa_pagu" class="form-label">Pagu</label>
                    <input type="text" class="form-control" id="dipa_pagu" readonly>
                </div>
                <div class="col-2">
                    <label for="dipa_tanggal" class="form-label">Tanggal Dipa</label>
                    <input type="date" class="form-control" id="dipa_tanggal" readonly>
                </div>
                <div class="col-3">
                    <label for="dipa_nomor" class="form-label">Nomor Dipa</label>
                    <input type="text" class="form-control" id="dipa_nomor" readonly>
                </div>
                <div class="col-sm-12 mt-3">
                    <button type="button" onclick="atur(this)" class="btn btn-primary btn-sm">Atur Dipa</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="card mb-4">
        <div class="card-header">
            <h6 class="card-title mb-0">BENDAHARA</h6>
            <!-- <button onclick="tambahBaris()" class="btn btn-dark btn-sm"><i class="tf-icons bx bx-plus"></i> Tambah Bendahara</button> -->
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered table-hover">
                <thead class="text-center">
                    <th>Aksi</th>
                    <th>Bendahara</th>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Status</th>
                </thead>
                <tbody>
                    <tr class="text-center">
                        <td><button class="btn btn-dark btn-sm">Edit</button></td>
                        <td>Bendahara Pemasukkan</td>
                        <td id="bendahara_pemasukkan_nip">-</td>
                        <td id="bendahara_pemasukkan_nama">-</td>
                        <td id="bendahara_pemasukkan_status">-</td>
                    </tr>
                    <tr class="text-center">
                        <td><button class="btn btn-dark btn-sm">Edit</button></td>
                        <td>Bendahara Pengeluaran</td>
                        <td id="bendahara_pengeluaran_nip">-</td>
                        <td id="bendahara_pengeluaran_nama">-</td>
                        <td id="bendahara_pengeluaran_status">-</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>




@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script>
    const pagu = document.querySelector('#dipa_pagu')
    const dipaTanggal = document.querySelector('#dipa_tanggal')
    const dipaNomor = document.querySelector('#dipa_nomor')
    document.addEventListener('DOMContentLoaded', function() {
        loadData()
        loadBendaraPengeluaran()
        loadBendaraPemasukkan()
    });


    function loadBendaraPengeluaran() {
        fetch('{{route("jabatan.data","bendahara_pengeluaran")}}', {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                method: 'GET',
            })
            .then(response => {
                console.log(response);
                if (!response.ok) {

                    if (response.status === 404) {
                        dipa.value = 'belum ditentukan'
                        dipaNomor.value = 'belum ditentukan'
                        dipaTanggal.value = 'belum ditentukan'
                    }
                    throw new Error('ada kesalahan.');
                }
                // if (!response.ok) {
                // }
                return response.json();
            })
            .then(data => {
                console.log(data);
                document.querySelector('#bendahara_pengeluaran_nip').innerText = data.data[0].pegawai.pegawai_nomor_induk
                document.querySelector('#bendahara_pengeluaran_nama').innerText = data.data[0].nama_pejabat
                document.querySelector('#bendahara_pengeluaran_status').innerText = (data.data[0].is_aktif ? 'Aktif' : 'Tidak Aktif')

            })
            .catch(error => {
                console.error('error:', error);
                // Tampilkan pesan error atau lakukan sesuatu jika login gagal
            });
    }

    function loadBendaraPemasukkan() {
        fetch('{{route("jabatan.data","bendahara_pemasukkan")}}', {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                method: 'GET',
            })
            .then(response => {
                console.log(response);
                if (!response.ok) {

                    if (response.status === 404) {
                        dipa.value = 'belum ditentukan'
                        dipaNomor.value = 'belum ditentukan'
                        dipaTanggal.value = 'belum ditentukan'
                    }
                    throw new Error('ada kesalahan.');
                }
                // if (!response.ok) {
                // }
                return response.json();
            })
            .then(data => {
                console.log(data);
                document.querySelector('#bendahara_pemasukkan_nip').innerText = data.data[0].pegawai.pegawai_nomor_induk
                document.querySelector('#bendahara_pemasukkan_nama').innerText = data.data[0].nama_pejabat
                document.querySelector('#bendahara_pemasukkan_status').innerText = (data.data[0].is_aktif ? 'Aktif' : 'Tidak Aktif')

            })
            .catch(error => {
                console.error('error:', error);
                // Tampilkan pesan error atau lakukan sesuatu jika login gagal
            });
    }

    function loadData() {
        fetch('{{route("admin.tahun-anggaran-dipa.index")}}', {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                method: 'GET',
            })
            .then(response => {
                console.log(response);
                if (!response.ok) {

                    if (response.status === 404) {
                        dipa.value = 'belum ditentukan'
                        dipaNomor.value = 'belum ditentukan'
                        dipaTanggal.value = 'belum ditentukan'
                    }
                    throw new Error('ada kesalahan.');
                }
                // if (!response.ok) {
                // }
                return response.json();
            })
            .then(data => {
                console.log(data);
                pagu.value = formatRupiah(data.data.dipa_pagu)
                dipaNomor.value = data.data.dipa_nomor
                dipaTanggal.value = data.data.dipa_tgl

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

    function atur(button) {
        pagu.removeAttribute('readonly')
        dipaNomor.removeAttribute('readonly')
        dipaTanggal.removeAttribute('readonly')

        button.innerText = "Atur"
        button.removeAttribute('onclick')

        button.setAttribute('onclick', 'save(this)')
        const uangInput = document.querySelector('#dipa_pagu');

        uangInput.addEventListener('input', function(event) {
            // Menghapus semua karakter kecuali angka
            let cleanedInput = event.target.value.replace(/\D/g, '');

            // Memformat angka dengan pemisah ribuan
            const formattedInput = Number(cleanedInput).toLocaleString('id-ID');

            // Mengatur nilai input ke nilai yang telah diformat
            event.target.value = formattedInput;
        });
    }

    function save(button) {

        const formData = new FormData();
        formData.append('tahun_anggaran_id', '1')
        formData.append('dipa_tgl', document.querySelector('#dipa_tanggal').value)
        formData.append('dipa_nomor', document.querySelector('#dipa_nomor').value)
        formData.append('dipa_pagu', document.querySelector('#dipa_pagu').value.replace(/\D/g, ''))

        fetch('{{route("admin.tahun-anggaran-dipa.store")}}', {
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
                document.querySelector('#dipa_pagu').setAttribute('readonly', 'readonly')
                document.querySelector('#dipa_tanggal').setAttribute('readonly', 'readonly')
                document.querySelector('#dipa_nomor').setAttribute('readonly', 'readonly')
                button.removeAttribute('onclick')

                button.innerText = "Atur Dipa"
                button.setAttribute('onclick', 'atur(this)')
            })
            .catch(error => {

                console.error('error:', error);
                // Tampilkan pesan error atau lakukan sesuatu jika login gagal
            });

    }
</script>
@endsection