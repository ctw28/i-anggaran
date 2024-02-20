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
                    <h5 class="card-title text-primary">Periksa Dokumen</h5>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="card mb-4">
        <h5 class="card-header">Daftar Pemeriksaan Dokumen</h5>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead class="text-center align-middle">
                        <th>No</th>
                        <th>Fakultas / <br>Lembaga / Unit</th>
                        <th>Verifikator</th> <!-- 0 proses, 1 perbaikan, 2 ditolak, 3 sesuai -->
                        <th>Validasi Sekretaris</th> <!-- 0 proses, 1 perbaikan, 2 ditolak, 3 sesuai -->
                        <th>Validasi Ketua</th> <!-- 0 proses, 1 perbaikan, 2 ditolak, 3 sesuai -->
                        <th>Aksi</th>
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
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title text-center"><i class="tf-icons bx bx-food-menu"></i> Form Pemeriksaan Dokumen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-10 mb-3">
                        <h5>Nama Pencairan : <span id="show-pencairan-nama"></span></h5>
                    </div>
                    <div class="col-2 mb-3 text-end">

                        <button class="btn btn-danger btn-sm mb-1" id="btn-kembalikan" onclick="kembalikan(this)"><i class="tf-icons bx bx-undo me-1"></i> Kembalikan</button>
                        <button class="btn btn-success btn-sm mb-1" id="btn-ke-pimpinan" onclick="kePimpinan(this)"><i class="tf-icons bx bx-right-arrow-alt me-1"></i> Valid / Teruskan</button>
                    </div>
                </div>
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
        dataSend.append('verifikator_id', JSON.parse(localStorage.getItem('tahun_anggaran')).verifikator_id)
        let url = '{{route("periksa.sesi.index")}}'
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
                    <td>${data.periksa_usul.pencairan_sesi.kegiatan.organisasi.organisasi.organisasi_singkatan}
                    <br><b><span id="pencairan-nama">${data.periksa_usul.pencairan_sesi.pencairan_nama}</b></span>
                    </td>`
                let status = `<span class="badge bg-label-primary">Proses</span>`
                if (data.status == 1)
                    status = `<span class="badge bg-label-danger">Dikembalikan</span>`
                else if (data.status == 2)
                    status = `<span class="badge bg-label-danger">Ditolak</span>`
                else if (data.status == 3)
                    status = `<span class="badge bg-label-success">Valid</span>`
                contents += `<td class="text-center">${status}</td>`
                if (data.periksa_pimpinan == null) {
                    contents += `<td class="text-center">-</td>`
                    contents += `<td class="text-center">-</td>`
                } else {
                    let statusSekretaris = `<span class="badge bg-label-primary">Proses</span>`
                    let statusKetua = `<span class="badge bg-label-primary">-</span>`
                    if (data.periksa_pimpinan.validasi_sekretaris == 1)
                        status = `<span class="badge bg-label-success">Valid</span>`
                    else
                        status = `<span class="badge bg-label-danger">Tidak Valid</span>`

                    if (data.periksa_pimpinan.validasi_pimpinan == 1)
                        status = `<span class="badge bg-label-primary">Proses</span>`
                    else if (data.periksa_pimpinan.validasi_pimpinan == 2)
                        status = `<span class="badge bg-label-success">Valid</span>`
                    else
                        status = `<span class="badge bg-label-danger">Tidak Valid</span>`

                    contents += `<td class="text-center">${statusSekretaris}</td>`
                    contents += `<td class="text-center">${statusKetua}</td>`
                }

                contents += `<td class="text-center"><button class="btn btn-primary btn-sm" data-id="${data.id}" btn-sm" data-bs-toggle="modal" data-bs-target="#modal" onclick="showPeriksa(this)">Periksa</button></td>`
                contents += `</tr>`
            })
            usulanDataContainer.innerHTML = contents
            return
        }
        usulanDataContainer.innerHTML = '<tr><td>Tidak ada Data</td></tr>'
    }

    async function kembalikan(button) {
        let sesiId = button.dataset.sesiId
        let dataSend = new FormData()
        let data = {
            'status': '1'
        }
        // dataSend.append('data', JSON.stringify(data))
        dataSend.append('status', "1")
        let url = "{{route('periksa.sesi.update',':id')}}"
        url = url.replace(':id', sesiId)
        let sendRequest = await fetch(url, {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },
            method: "POST",
            body: dataSend
        })
        response = await sendRequest.json()
        console.log(response);
        if (response.status) {
            toastr.options.closeButton = true;
            toastr.options.positionClass = 'toast-top-center mt-3';
            toastr.success('Sukses dikembalikan');
            return
        }
    }
    async function kePimpinan(button) {
        let sesiId = button.dataset.sesiId
        // return console.log(sesiId);
        let dataSend = new FormData()
        let url = '{{route("periksa-pimpinan.store")}}'
        dataSend.append('periksa_sesi_id', sesiId)
        dataSend.append('validasi_sekretaris', 0)
        dataSend.append('validasi_ketua', 0)
        dataSend.append('catatan_sekretaris', '')
        dataSend.append('catatan_ketua', '')

        let sendRequest = await fetch(url, {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },
            method: "POST",
            body: dataSend
        })
        response = await sendRequest.json()
        console.log(response);
        if (response.status) {
            toastr.options.closeButton = true;
            toastr.options.positionClass = 'toast-top-center mt-3';
            toastr.success('Sukses dikirim ke sekretaris dan ketua');


            return
        }
        toastr.options.closeButton = true;
        toastr.options.positionClass = 'toast-top-center mt-3';
        toastr.danger('gagal, coba lagi');
    }
    async function showPeriksa(button) {
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
        document.querySelector("#show-pencairan-nama").innerText = row.querySelector('#pencairan-nama').innerText
        periksa.dataset.id = button.dataset.id
        document.querySelector("#btn-kembalikan").dataset.sesiId = button.dataset.id
        document.querySelector("#btn-ke-pimpinan").dataset.sesiId = button.dataset.id
        let contents = ''
        let contents2 = ''
        let contents3 = ''
        contents += `<div class="nav-align-left">`
        contents += `<ul class="nav nav-tabs" role="tablist" id="kategori">`
        contents += `<h6 class="text-center">Jenis Pemeriksaan</h6>`
        response.data[0].periksa_template.periksa_daftar.map((data, index) => {
            contents += `
                        <li class="nav-item">
                            <button type="button" class="nav-link btn btn-primary ${(index==0)?'active':''}" onclick="" id="data" role="tab" data-bs-toggle="tab" data-bs-target="#show-data-${index}" aria-controls="navs-justified-home" aria-selected="true"><i class="tf-icons bx bx-home me-1"></i> ${data.periksa_kategori.nama_kategori}</button>
                        </li>`
            if (index == 0)
                contents2 += `<div class="tab-pane fade active show" id="show-data-${index}" role="tabpanel">`
            else
                contents2 += `<div class="tab-pane fade" id="show-data-${index}" role="tabpanel">`
            contents2 += `<table class="table table-striped table-hover">`
            contents2 += `<thead class="text-center" style="color:white; background:#696cff">
                            <th width="30%" style="color:white;">Item Periksa</th>
                            <th width="30%" style="color:white;">Validasi</th>
                            <th style="color:white;">Catatan Validasi (Jika ada)</th>
                            <th style="color:white;">Aksi</th>
                        </thead>`
            contents2 += `<tbody>`
            data.periksa_kategori.periksa_kategori_list.map(item => {
                // console.log(item.periksa_dokumen[0]);
                let disabled = (response.data[0].periksa_sesi.status != "0") ? 'disabled' : ''
                if (item.periksa_dokumen.length > 0) {

                    contents2 += `<tr data-id="${item.periksa_dokumen[0].id}">`

                    contents2 += `<td >${item.periksa_list.nama_list}</td>`
                    contents2 += `<td class="text-center" >
                                    <div class="form-check form-check-inline mt-3">
                                        <input ${disabled} onclick="setValid(this)" data-id="${item.id}" data-sesi="${button.dataset.id}" class="form-check-input" type="radio" name="inlineRadioOptions${item.id}" id="valid${item.id}" value="1" ${(item.periksa_dokumen[0].is_valid==1)?'checked':''}>
                                        <label class="form-check-label" for="valid${item.id}">Valid</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input ${disabled} onclick="addCatatan(this)" data-id="${item.id}" data-sesi="${button.dataset.id}" class="form-check-input" type="radio" name="inlineRadioOptions${item.id}" id="novalid${item.id}" value="0" ${(item.periksa_dokumen[0].is_valid==0)?'checked':''}>
                                        <label class="form-check-label" for="novalid${item.id}">Tidak Valid</label>
                                    </div>
                                
                            </td>`
                    contents2 += `<td id="catat-row"><input class="form-control" id="catatan" value="${(item.periksa_dokumen[0].catatan!=null)?item.periksa_dokumen[0].catatan:''}" disabled></td>`
                    contents2 += `<td id="aksi"  class="text-center"><a href="#" onclick="batal(this)"><i class="tf-icons bx bx-x"></i></a></td>`
                    contents2 += `</tr>`
                } else {
                    contents2 += `<tr>`
                    contents2 += `<td >${item.periksa_list.nama_list}</td>`
                    contents2 += `<td class="text-center" >
                                    <div class="form-check form-check-inline mt-3">
                                        <input ${disabled} onclick="setValid(this)" data-id="${item.id}" data-sesi="${button.dataset.id}" class="form-check-input" type="radio" name="inlineRadioOptions${item.id}" id="valid${item.id}" value="1">
                                        <label class="form-check-label" for="valid${item.id}">Valid</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input ${disabled} onclick="addCatatan(this)" data-id="${item.id}" data-sesi="${button.dataset.id}" class="form-check-input" type="radio" name="inlineRadioOptions${item.id}" id="novalid${item.id}" value="0" >
                                        <label class="form-check-label" for="novalid${item.id}">Tidak Valid</label>
                                    </div>                                
                                </td>`
                    contents2 += `<td id="catat-row"><input class="form-control" id="catatan" disabled></td>`
                    contents2 += `<td id="aksi" class="text-center">-</td>`
                    contents2 += `</tr>`

                }
            })
            contents2 += `</tbody>`
            contents2 += `</table>`
            contents2 += `</div>`
        })
        contents += '</ul>'
        contents += `<div class="tab-content">`
        contents += `${contents2}`
        contents += `</div>`
        contents += `</div>`
        periksa.innerHTML = ''
        periksa.innerHTML = contents
    }

    function addCatatan(input) {
        let row = input.parentNode.parentNode.parentNode

        let value = row.querySelector('#catatan').value
        row.querySelector('#catat-row').innerHTML = ``
        row.querySelector('#catat-row').innerHTML = `<input class="form-control" id="catatan" value="${value}">
        <button data-id="${input.dataset.id}" data-sesi="${input.dataset.sesi}" class="btn btn-primary btn-sm mt-2" onclick="setNoValid(this)">Simpan</button>`

    }

    async function batal(button) {
        let konfirm = confirm('yakin batal?')
        if (konfirm) {
            let row = button.parentNode.parentNode

            let dataSend = new FormData()
            id = row.dataset.id
            let url = '{{route("periksa-dokumen.delete",":id")}}'
            url = url.replace(":id", id)
            let sendRequest = await fetch(url, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                method: "POST",
                body: dataSend
            })
            response = await sendRequest.json()
            console.log(response);
            if (response.status) {
                toastr.options.closeButton = true;
                toastr.options.positionClass = 'toast-top-center mt-3';
                toastr.success('Sukses batal');
                row.querySelector('#catatan').setAttribute('disabled', 'disabled');
                row.dataset.id = ''
                row.querySelector('#catat-row').innerHTML = ``
                row.querySelector('#catat-row').innerHTML = `<input class="form-control" id="catatan" value="" disabled>`
                row.querySelector('#aksi').innerHTML = `-`
                var checkedRadio = row.querySelector('input[type="radio"]:checked');

                // Memeriksa apakah ada elemen radio yang dicentang
                if (checkedRadio) {
                    // Menghapus properti checked
                    checkedRadio.checked = false;
                }
            }
        }
    }
    async function setNoValid(input) {
        // console.log(input.value)
        let row = input.parentNode.parentNode

        let dataSend = new FormData()
        if (row.hasAttribute('data-id'))
            dataSend.append('id', row.dataset.id);
        dataSend.append('periksa_sesi_id', input.dataset.sesi)
        dataSend.append('periksa_kategori_list_id', input.dataset.id)
        dataSend.append('is_valid', 0)
        dataSend.append('catatan', row.querySelector('#catatan').value)
        let url = '{{route("periksa-dokumen.store")}}'
        let sendRequest = await fetch(url, {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },
            method: "POST",
            body: dataSend
        })
        response = await sendRequest.json()
        console.log(response);
        if (response.status) {
            row.querySelector('#aksi').innerHTML = `<a href="#" onclick="batal(this)"><i class="tf-icons bx bx-x"></i></a>`

            toastr.options.closeButton = true;
            toastr.options.positionClass = 'toast-top-center mt-3';
            toastr.success('Sukses');
            row.querySelector('#catatan').setAttribute('disabled', 'disabled');
            row.dataset.id = response.data.id
            row.querySelector('#catat-row').innerHTML = ``
            row.querySelector('#catat-row').innerHTML = `<input class="form-control" id="catatan" value="${response.data.catatan}" disabled>`
        }
    }
    async function setValid(input) {
        // console.log(input.value)
        let row = input.parentNode.parentNode.parentNode

        let dataSend = new FormData()
        if (row.hasAttribute('data-id'))
            dataSend.append('id', row.dataset.id);
        dataSend.append('periksa_sesi_id', input.dataset.sesi)
        dataSend.append('periksa_kategori_list_id', input.dataset.id)
        dataSend.append('is_valid', input.value)
        dataSend.append('catatan', '')
        let url = '{{route("periksa-dokumen.store")}}'
        let sendRequest = await fetch(url, {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },
            method: "POST",
            body: dataSend
        })
        response = await sendRequest.json()
        console.log(response);
        if (response.status) {
            toastr.options.closeButton = true;
            toastr.options.positionClass = 'toast-top-center mt-3';
            toastr.success('Sukses');
            row.querySelector('#aksi').innerHTML = `<a href="#" onclick="batal(this)"><i class="tf-icons bx bx-x"></i></a>`
            if (input.value == 1) {
                row.querySelector('#catatan').value = '';
                row.querySelector('#catat-row').innerHTML = '<input class="form-control" id="catatan" disabled>';
                row.querySelector('#catatan').setAttribute('disabled', 'disabled');
                row.dataset.id = response.data.id
            } else {
                row.dataset.id = response.data.id
                row.querySelector('#catatan').removeAttribute('disabled');
            }

        }
    }
</script>
@endsection