@extends('template')

@section('style')

<style>

</style>
@endsection
@section('content')
<div class="col-lg-12 mb-4 order-0">
    <div class="card">
        <div class="d-flex align-items-end row">
            <div class="col-sm-12">
                <div class="card-body">
                    <h5 class="card-title text-primary">Pelaksanaan Kegiatan</h5>
                    <div class="mb-2 mt-3">
                        <!-- <button onclick="tambah()" class="btn btn-dark mb-2" data-bs-toggle="modal" data-bs-target="#fullscreenModal"><i class="tf-icons bx bx-plus"></i> Tambah Pelaksanaan</button> -->
                    </div>

                    <div class="table-responsive">

                        <table class="table table-striped table-bordered" id="data-table">
                            <thead class="text-center align-middle">
                                <tr>
                                    <th>No</th>
                                    <th>Program</th>
                                    <th>Pagu</th>
                                    <th>Realisasi</th>
                                    <th>Sisa</th>
                                    <th>Dasar <br>Pelaksanaan</th>
                                    <th>Laporan</th>
                                    <th>Kelola</th>
                                </tr>
                            </thead>
                            <tbody id="kegiatan-data">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="fullscreenModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title " id="modalFullTitle">Pelaksanaan Program/Kegiatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Basic Layout -->
                    <div class="col-xxl">
                        <h5 class="mb-3">Kegiatan</h5>

                        <div class="mb-3">
                            <label class="form-label" for="rpd">Pilih RPD</label>

                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="tanggal_mulai">Tanggal Pelaksanaan (Mulai-Selesai)</label>
                            <div class="row">
                                <div class="col-sm-4">
                                    <input type="date" class="form-control" id="tanggal_mulai" placeholder="Tanggal Mulai" />
                                </div>
                                <div class="col-sm-1 text-center align-middle">
                                    -
                                </div>
                                <div class="col-sm-4">
                                    <input type="date" class="form-control" id="tanggal_selesai" placeholder="Tanggal Selesai" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        <h5 class="mb-3 mt-3">Dasar Pelaksanaan</h5>
                        <div class="table-responsive">
                            <!-- <div class="table-container"> -->
                            <!-- <table id="data-table"> -->
                            <button onclick="tambahBaris()" class="btn btn-dark btn-sm mb-3"><i class="tf-icons bx bx-plus"></i> Tambah Dasar Pelaksanaan</button>

                            <table class="table table-striped table-bordered">
                                <thead class="text-center align-middle">
                                    <tr>
                                        <th>Aksi</th>
                                        <th>No</th>
                                        <th>Surat</th>
                                        <th>Detail Surat</th>
                                        <th>File</th>
                                    </tr>
                                </thead>
                                <tbody id="dasar-pelaksanaan-data">

                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <!-- <button onclick="loadData()" type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Keluar</button> -->
            <!-- <button type="button" class="btn btn-primary">Simpan Perubahan</button> -->
        </div>
    </div>
</div>
</div>
@endsection
@section('scripts')

<script>
    loadData()

    function tambah() {

    }

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

    function loadData() {
        const formData = new FormData();
        formData.append('id', JSON.parse(localStorage.getItem('tahun_anggaran')).organisasi_rpd)
        fetch('{{route("kegiatan.data")}}', {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('ada kesalahan.');
                }
                return response.json();
            })
            .then(data => {
                console.log(data);
                // if()
                let contents = '' // Mengambil token dari response JSON
                data.data.kegiatan.map((data, index) => {
                    let url = "{{route('pelaksanaan.kelola',':id')}}"
                    url = url.replace(':id', data.id)
                    console.log(Object.values(data.rencana).length);
                    contents += `<tr data-id="${data.id}">
                    <td class="text-center">${index+1}</td>
                    <td>
                    <small>${data.sub_kegiatan_kode1}.
                    ${data.sub_kegiatan_kode2}.
                    ${data.sub_kegiatan_kode3}.
                    ${data.sub_kegiatan_kode4}.
                    ${data.sub_kegiatan_kode5}.
                    </small>
                    <br><span class="badge bg-label-primary">${data.kegiatan_nama}</span>
                    <br>
                    </td>
                    <td>
                    <small>Rp. ${data.jumlah_biaya} (${data.sumber_dana})</small>
                    </td>
                    <td>REALISASI</td>
                    <td>SISA</td>
                    <td>SK / ST</td>
                    <td>Laporan</td>
                    `

                    contents += `<td class="text-center"><a class="btn btn-sm btn-dark" href="${url}"><i class="tf-icons bx bx-customize"></i> Kelola</a></td>`
                    contents += `</tr>`
                })
                document.querySelector("#kegiatan-data").innerHTML = ''
                document.querySelector("#kegiatan-data").innerHTML = contents
            })
            .catch(error => {
                console.error('error:', error);
                // Tampilkan pesan error atau lakukan sesuatu jika login gagal
            });
    }
</script>
@endsection