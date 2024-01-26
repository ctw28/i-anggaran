@extends('template')

@section('style')

<style>

</style>
@endsection
@section('content')
<div class="col-12 col-lg-12">
    <div class="card mb-4">
        <div class="card-body">

            <div class="d-flex justify-content-between">
                <h6>Detail Kegiatan</h6>
            </div>
            <p class=" mb-1">Sub Kegiatan :</p>
            <p class=" mb-1"><b><span id="sub_kegiatan">Sub Kegiatan</span></b></p>
            <p class=" mb-1">Nama Kegiatan / Program :</p>
            <p class=" mb-1"><b><span id="nama_kegiatan">Nama Kegiatan</span></b></p>
            <p class=" mb-1">Pagu :</p>
            <p class=" mb-1"><b><span id="pagu">Pagu Kegiatan</span></b></p>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between">
            <h6 class="card-title m-0">Dasar Pelaksanaan Program/Kegiatan</h6>
            <button onclick="tambahBaris()" class="btn btn-dark btn-sm mb-3"><i class="tf-icons bx bx-plus"></i> Tambah Dasar Pelaksanaan</button>

        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-striped table-bordered" id="dokumen-table">
                    <thead class="text-center align-middle">
                        <tr>
                            <th>Aksi</th>
                            <th>No</th>
                            <th>Dasar</th>
                            <th>Tentang</th>
                            <th>File</th>
                            <th>hapus</th>
                        </tr>
                    </thead>
                    <tbody id="dasar-pelaksanaan-data">

                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <div class="card mb-4">

        <div class="card-header d-flex justify-content-between">
            <h6 class="card-title m-0">Pencairan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-striped table-bordered">
                    <thead class="text-center align-middle">
                        <tr>
                            <th>No</th>
                            <th>Pencairan</th>
                            <th>Bulan</th>
                            <th>Pagu</th>
                            <th>Realisasi</th>
                            <th>Sisa</th>
                        </tr>
                    </thead>
                    <tbody id="rencana-table">

                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <div class="card mb-4">

        <div class="card-header d-flex justify-content-between">
            <h6 class="card-title m-0">Laporan</h6>
        </div>
        <div class="card-body">

        </div>

    </div>
</div>


@endsection
@section('scripts')

<script>
    loadData()

    function tambahBaris() {
        const table = document.getElementById('dasar-pelaksanaan-data');
        const newRow = table.insertRow();
        const actCell = newRow.insertCell(0);
        actCell.innerHTML = "<button data-state='insert' class='btn btn-primary btn-sm' onclick='saveDasarPelaksanaan(this)'>Simpan</button>";

        const numberCell = newRow.insertCell(1);
        numberCell.textContent = table.rows.length; // Nomor urut baris
        let formInput = [{
                'label': 'Jenis Dokumen',
                'name': 'dasar_jenis',
                'id': 'dasar_jenis',
                'type': 'select',
                'form': 'select',
                'select_item': [{
                        'text': 'Surat Keputusan (SK)',
                        'value': 'sk'
                    },
                    {
                        'text': 'Surat Tugas',
                        'value': 'st'
                    },
                ]
            },
            {
                'label': 'Nomor Surat',
                'name': 'nomor',
                'id': 'nomor',
                'placeholder': 'Nomor Surat',
                'type': 'text',
                'form': 'input',
            },
            {
                'label': 'Tanggal Surat',
                'name': 'tanggal',
                'id': 'tanggal',
                'placeholder': 'Tanggal Surat',
                'type': 'date',
                'form': 'input',
            },
            {
                'label': 'Tentang',
                'name': 'tentang',
                'placeholder': 'Tentang',
                'id': 'tentang',
                'form': 'textarea',
            },
            {
                'label': 'File Surat',
                'name': 'path_file',
                'id': 'path_file',
                'type': 'file',
                'form': 'input',
            },
        ]
        const cell1 = newRow.insertCell(2);
        const cell2 = newRow.insertCell(3);
        const cell3 = newRow.insertCell(4);
        const cell4 = newRow.insertCell(5);

        formInput.forEach((input, index) => {
            var element
            if (input.form === 'input')
                element = document.createElement('input');
            else if (input.form === 'textarea')
                element = document.createElement('textarea')
            else if (input.form === 'select')
                element = document.createElement('select');

            const label = document.createElement('label');
            label.setAttribute('class', 'form-label')
            label.innerText = input.label

            element.setAttribute('id', input.id);
            element.setAttribute('class', "form-control form-control-sm");
            element.setAttribute('placeholder', input.placeholder);
            element.setAttribute('name', input.name);
            element.setAttribute('type', input.type);
            element.setAttribute('required', 'required');
            if (input.form === 'select') {
                input.select_item.forEach(item => {
                    var option = document.createElement('option')
                    option.text = item.text
                    option.value = item.value
                    element.appendChild(option)
                })
            }

            if (index == 0) {
                cell1.appendChild(label);
                cell1.appendChild(element);
            } else if (index > 0 && index <= 3) {
                cell2.appendChild(label);
                cell2.appendChild(element);
            } else {
                cell3.appendChild(label);
                cell3.appendChild(element);
            }
        });

    }

    function saveDasarPelaksanaan(button) {
        const row = button.parentNode.parentNode;
        const cells = row.getElementsByTagName('td');
        console.log(row);
        const formData = new FormData();
        if (row.hasAttribute('data-id'))
            formData.append('id', row.dataset.id);
        formData.append('kegiatan_id', '{{$id}}');
        formData.append('dasar_jenis', cells[2].querySelector('#dasar_jenis').value);
        formData.append('nomor', cells[3].querySelector('#nomor').value);
        formData.append('tanggal', cells[3].querySelector('#tanggal').value);
        formData.append('tentang', cells[3].querySelector('#tentang').value);
        formData.append('file', cells[4].querySelector('#path_file').files[0]);

        fetch('{{route("pelaksanaan-dasar.store")}}', {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                method: 'POST',
                body: formData
            })
            .then(response => {
                console.log(response.details);
                if (!response.ok) {
                    throw new Error(response);
                }
                return response.json();
            })
            .then(data => {
                console.log(data);
                // return
                if (data.status === true) {
                    let jenis = (data.data.dasar_jenis == 'st') ? "Surat Tugas (ST)" : "Surat Keputusan (SK)"
                    let filePath = "{{asset('storage/')}}/"
                    filePath += data.data.path_file
                    row.dataset.id = data.data.id
                    alert('data sukses ditambah')
                    cells[0].innerHTML = `
                    <button class="btn btn-sm btn-warning"onclick="editBaris(this)">
                    <i class="tf-icons bx bx-pencil"></i></button>`
                    cells[2].innerHTML = jenis
                    cells[3].innerHTML = `<td>
                    ${data.data.nomor}
                    <br>${data.data.tanggal}
                    <br> ${data.data.tentang}
                    </td>`
                    cells[4].innerHTML = `<td><a href="${filePath}" class="btn btn-sm btn-info" target="_blank">Lihat File</a></td>`
                    cells[5].innerHTML = '<td><button class="btn btn-sm btn-danger"onclick="deleteBaris(this)"><i class="tf-icons bx bx-trash"></i></button></td>'
                }
            })
            .catch(error => {
                console.error('error:', error);
                alert('ada kesalahan, ' + error)

                // Tampilkan pesan error atau lakukan sesuatu jika login gagal
            });
    }

    function loadData() {
        const formData = new FormData();
        let url = "{{route('kegiatan.show',':id')}}"
        url = url.replace(':id', '{{$id}}')
        formData.append('tahun_anggaran_id', localStorage.getItem('tahun_anggaran'))
        fetch(url, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                method: 'GET',
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('ada kesalahan.');
                }
                return response.json();
            })
            .then(data => {

                console.log(data.data);
                // if()

                document.querySelector('#sub_kegiatan').innerHTML = `${data.data.sub_kegiatan_kode1}.${data.data.sub_kegiatan_kode2}.${data.data.sub_kegiatan_kode3}.${data.data.sub_kegiatan_kode4}.${data.data.sub_kegiatan_kode5}`
                document.querySelector('#nama_kegiatan').innerHTML = `${data.data.kegiatan_nama}`
                document.querySelector('#pagu').innerHTML = `${data.data.jumlah_biaya}`
                let contents = '' // Mengambil token dari response JSON
                data.data.rencana.map((rencana, index) => {
                    let url = "{{route('pencairan',[':id',':id2'])}}"
                    url = url.replace(':id', data.data.id)
                    url = url.replace(':id2', rencana.id)
                    console.log(rencana.id);
                    // console.log(Object.values(data.rencana).length);
                    contents += `<tr data-id="${rencana.id}">`
                    contents += `<td class="text-center">${index+1}</td>`
                    contents += `<td class="text-center"><a class="btn btn-sm btn-primary" href="${url}"><i class="tf-icons bx bx-grid"></i> Buat Pencairan</a></td>`
                    contents += `<td>${rencana.bulan_indonesia}</td>
                    <td>${rencana.jumlah}</td>
                    <td>REALISASI</td>
                    <td>SISA</td>`
                    contents += `</tr>`
                })
                document.querySelector("#rencana-table").innerHTML = ''
                document.querySelector("#rencana-table").innerHTML = contents
            })
            .catch(error => {
                console.error('error:', error);
                // Tampilkan pesan error atau lakukan sesuatu jika login gagal
            });
        url = "{{route('pelaksanaan.dasar',':id')}}"
        url = url.replace(":id", "{{$id}}")
        fetch(url, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                method: 'GET',
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('ada kesalahan.');
                }
                return response.json();
            })
            .then(data => {
                console.log(data);
                let contents = ""
                data.data.map((data, index) => {
                    let jenis = (data.dasar_jenis == 'st') ? "Surat Tugas (ST)" : "Surat Keputusan (SK)"
                    let filePath = "{{asset('storage/')}}/"
                    filePath += data.path_file
                    contents += `<tr data-id="${data.id}">`
                    contents += `<td class="text-center">
                    <button class="btn btn-sm btn-warning"onclick="editBaris(this)">
                    <i class="tf-icons bx bx-pencil"></i></button></td>`
                    contents += `<td>${index+1}</td>`
                    contents += `<td>${jenis} <br>No. ${data.nomor} <br>Tanggal : ${data.tanggal}</td>`
                    contents += `<td>${data.tentang}</td>`
                    contents += `<td class="text-center"><a href="${filePath}" class="btn btn-sm btn-info" target="_blank">Lihat File</a></td>`
                    contents += '<td class="text-center"><button class="btn btn-sm btn-danger"onclick="deleteBaris(this)"><i class="tf-icons bx bx-trash"></i></button></td>'
                    contents += `</tr>`
                })
                document.querySelector("#dasar-pelaksanaan-data").innerHTML = ''
                document.querySelector("#dasar-pelaksanaan-data").innerHTML = contents
            })
            .catch(error => {
                console.error('error:', error);
                // Tampilkan pesan error atau lakukan sesuatu jika login gagal
            });
    }
</script>
@endsection