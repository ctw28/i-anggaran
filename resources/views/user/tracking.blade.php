@extends('template')

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<style>

</style>
@endsection
@section('content')
<div class="col-lg-12 mb-4 order-0">
    <div class="card">
        <div class="d-flex align-items-end row">
            <div class="col-sm-7">
                <div class="card-body">
                    <h5 class="card-title text-primary">Tracking Dokumen</h5>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="card mb-4">
        <h5 class="card-header">Daftar Dokumen terkirim ke SPI</h5>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead class="text-center align-middle">
                        <th>No</th>
                        <th>Dokumen Pencairan</th> <!-- 0 proses, 1 perbaikan, 2 ditolak, 3 sesuai -->
                        <th>Status</th> <!-- 0 proses, 1 perbaikan, 2 ditolak, 3 sesuai -->
                        <th>Keterangan / Aksi</th>
                    </thead>
                    <tbody id="periksa-data">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title text-center"><i class="tf-icons bx bx-food-menu"></i> Form Pemeriksaan Dokumen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Nama Pencairan : <span id="show-pencairan-nama"></span></h5>
                <h5>status : <span id="show-status"></span></h5>


                <div id="periksa"></div>
                <!-- <div class="modal-body"> -->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Keluar</button>
                <!-- <button type="button" id="submit_excel" class="btn btn-primary">OK</button> -->
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
        dataSend.append('organisasi_id', JSON.parse(localStorage.getItem('tahun_anggaran')).organisasi_rpd)
        let url = '{{route("tracking.index")}}'
        let sendRequest = await fetch(url, {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },
            method: "POST",
            body: dataSend
        })
        response = await sendRequest.json()
        console.log(response);
        var usulanDataContainer = document.querySelector('#periksa-data')
        let contents = ''
        if (response.status) {
            response.data.map((data, index) => {
                contents += `<tr>
                    <td class="text-center">${index + 1}</td>
                    <td><span id="pencairan-nama">${data.periksa_usul.pencairan_sesi.pencairan_nama}</span></td>`
                let status = `<span class="badge bg-label-primary">Terkirim</span>`
                if (data.status == 0)
                    status = `<span class="badge bg-label-info">Pemeriksaan</span>`
                else if (data.status == 1)
                    status = `<span class="badge bg-label-danger">Dikembalikan</span>`
                else if (data.status == 3)
                    status = `<span class="badge bg-label-success">Valid</span>`
                contents += `<td class="text-center">${status}</td>`

                if (data.status == 1)
                    contents += `<td class="text-center">
                <button class="btn btn-primary btn-sm" data-id="${data.id}" btn-sm" onclick="showDetail(this)" data-bs-toggle="modal" data-bs-target="#modal"><i class="tf-icons bx bx-info-circle"></i> Detail</button>
                <button class="btn btn-warning btn-sm" data-id="${data.periksa_usul.dokumen_pencairan_sesi_id}" btn-sm" onclick="sendSPI(this)"><i class="tf-icons bx bx-redo"></i> Kirim Ulang</button>
                </td>`
                else if (data.status == 0)
                    contents += `<td class="text-center"><span class="badge bg-label-secondary">Sedang pemeriksaan....</span></td>`
                else
                    contents += `<td class="text-center"><span class="badge bg-label-success">Diteruskan ke keuangan</span></td>`
                contents += `</tr>`
            })
            usulanDataContainer.innerHTML = contents
            return
        }
        usulanDataContainer.innerHTML = '<tr><td colspan="6" style="text-align: center">Tidak ada Data</td></tr>'
    }

    async function showDetail(button) {
        let url = '{{route("periksa.daftar.index",":id")}}'
        url = url.replace(':id', button.dataset.id)
        let sendRequest = await fetch(url, {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },
            method: "GET",
        })
        response = await sendRequest.json()
        console.log(response);
        // if(response.data.length > 0){

        // }
        let row = button.parentNode.parentNode

        var periksa = document.querySelector('#periksa')
        let status = `<span class="badge bg-label-danger">Dikembalikan</span>`
        document.querySelector("#show-pencairan-nama").innerText = row.querySelector('#pencairan-nama').innerText
        document.querySelector("#show-status").innerHTML = status
        periksa.dataset.id = button.dataset.id
        document.querySelector("#modal").dataset.sesiId = button.dataset.id
        let contents = ''
        let contents2 = ''
        let contents3 = ''
        contents2 += `<div class="tab-pane fade active show" role="tabpanel">`
        contents2 += `<table class="table table-striped table-hover">`
        contents2 += `<thead class="text-center">
                        <th>Item Periksa</th>
                        <th>Validasi</th>
                        <th>Catatan Validasi</th>
                    </thead>`
        contents2 += `<tbody>`
        response.data[0].periksa_template.periksa_daftar.map((data, index) => {
            data.periksa_kategori.periksa_kategori_list.map(item => {
                // console.log(item.periksa_dokumen[0]);
                if (item.periksa_dokumen.length > 0) {

                    contents2 += `<tr data-id="${item.periksa_dokumen[0].id}">`

                    contents2 += `<td >${item.periksa_list.nama_list}</td>`
                    contents2 += `<td class="text-center" >${(item.periksa_dokumen[0].is_valid==1)?'<span class="badge bg-label-success">Valid</span>':'<span class="badge bg-label-danger">Tidak Valid</span>'}</td>`
                    contents2 += `<td>${(item.periksa_dokumen[0].catatan!=null)?item.periksa_dokumen[0].catatan:''}</td>`
                    contents2 += `</tr>`
                }
            })
        })
        contents2 += `</tbody>`
        contents2 += `</table>`
        contents2 += `</div>`
        contents += `<div class="tab-content">`
        contents += `${contents2}`
        contents += `</div>`
        contents += `</div>`
        periksa.innerHTML = ''
        periksa.innerHTML = contents
    }
    async function sendSPI(button) {
        let konfir = confirm('Yakin kirim ulang?')
        if (!konfir) return
        let dataSend = new FormData()
        dataSend.append('dokumen_pencairan_sesi_id', button.dataset.id)
        dataSend.append('is_finish', 0)
        let url = '{{route("spi.daftar-usulan.store")}}'
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
            toastr.success('Sukses');
            button.innerText = "Terkirim kembali ke SPI"
            button.setAttribute('disabled', 'disabled')
        }
    }
</script>
@endsection