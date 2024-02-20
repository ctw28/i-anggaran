@extends('template')
@section('style')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@endsection
@section('content')
<div class="col-lg-12 mb-4 order-0">
    <div class="card">
        <div class="d-flex align-items-end row">
            <div class="col-sm-7">
                <div class="card-body">
                    <h5 class="card-title text-primary">Selamat Datang</h5>
                    <p class="mb-4">
                        Selamat datang di aplikasi juara
                    </p>

                    <!-- <a href="javascript:;" class="btn btn-sm btn-outline-primary">Isi RPD</a> -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="card mb-4">
        <h5 class="card-header">Daftar Usulan Pemeriksaan Dokumen</h5>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead class="text-center align-middle">
                        <th>No</th>
                        <th>Fakultas / <br>Lembaga / Unit</th>
                        <th>Nama Pencairan</th>
                        <th>Pemeriksa</th>
                    </thead>
                    <tbody id="usulan-data">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script>
    loadUsulan()
    async function loadUsulan() {

        let dataSend = new FormData()
        dataSend.append('tahun_anggaran_id', JSON.parse(localStorage.getItem('tahun_anggaran')).id)
        // dataSend.append('idpeg', JSON.stringify(await getListAnggota()))
        let url = '{{route("spi.daftar-usulan")}}'
        let sendRequest = await fetch(url, {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },
            method: "POST",
            body: dataSend
        })
        response = await sendRequest.json()
        var usulanDataContainer = document.querySelector('#usulan-data')
        let contents = ''
        if (response.status) {
            response.data.map((data, index) => {
                contents += `<tr>
                    <td class="text-center">${index + 1}</td>
                    <td>${data.pencairan_sesi.kegiatan.organisasi.organisasi.organisasi_nama} (${data.pencairan_sesi.kegiatan.organisasi.organisasi.organisasi_singkatan} )</td>
                    <td>${data.pencairan_sesi.pencairan_nama}</td>`
                if (data.periksa_sesi == null)
                    contents += `<td class="text-center"><button class="btn btn-primary btn-sm" data-id="${data.id}" onclick="klaim(this)"><i class="tf-icons bx bx-list-check"></i> Klaim</button></td>`
                else
                    contents += `<td class="text-center">${data.periksa_sesi.verifikator.pegawai.data_diri.nama_lengkap}</td>`
                contents += `</tr>`
            })
            usulanDataContainer.innerHTML = contents
            return
        }
        usulanDataContainer.innerHTML = '<tr><td>Tidak ada Data</td></tr>'
    }

    async function klaim(button) {

        let dataSend = new FormData()
        dataSend.append('periksa_usul_id', button.dataset.id)
        dataSend.append('verifikator_id', JSON.parse(localStorage.getItem('tahun_anggaran')).verifikator_id)
        dataSend.append('status', "0")
        // dataSend.append('idpeg', JSON.stringify(await getListAnggota()))
        let url = "{{route('periksa.sesi.store')}}"
        let sendRequest = await fetch(url, {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },
            method: "POST",
            body: dataSend
        })
        response = await sendRequest.json()
        if (response.status) {
            toastr.options.closeButton = true;
            toastr.options.positionClass = 'toast-top-center mt-3';
            toastr.success('Sukses Klaim!');
            button.innerText = "Sudah diklaim"
            button.setAttribute('disabled', 'disabled')

        }
        toastr.options.closeButton = true;
        toastr.options.positionClass = 'toast-top-center mt-3';
        toastr.danger('gagal klaim. coba lagi!');

    }
</script>
@endsection