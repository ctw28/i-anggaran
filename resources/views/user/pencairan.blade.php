@extends('template')

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<style>
    /* #nominal-data tr td {
        padding: 0;
    }

    #nominal-data tr td input {
        padding: 2px;
    } */
</style>
@endsection
@section('content')
<div class="col-lg-12 mb-4 order-0">
    <div class="card">
        <div class="d-flex align-items-end row">
            <div class="col-sm-12">
                <div class="card-body">
                    <h5 class="card-title text-primary">Pencairan </h5>
                    <div class="mb-2 mt-3">
                        <button onclick="add()" class="btn btn-dark mb-2" data-bs-toggle="modal" data-bs-target="#fullscreenModal"><i class="tf-icons bx bx-plus"></i> Tambah Pencairan</button>
                    </div>

                    <div class="table-responsive">

                        <table class="table table-striped table-bordered" id="data-table">
                            <thead class="text-center align-middle">
                                <tr>
                                    <th>No</th>
                                    <th>Pelaksanaan</th>
                                    <th>Akun yang<br> dicairkan</th>
                                    <th>Nama Pencairan</th>
                                    <th>Penerima</th>
                                    <th>Kuitansi & SPTJB</th>
                                    <th>SPTJK</th>
                                    <th>Kelola</th>
                                    <th>Dokumen</th>
                                </tr>
                            </thead>
                            <tbody id="pencairan-data">

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
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title " id="modalFullTitle">Formulir Pembuatan Dokumen Pencairan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Basic Layout -->
                    <div class="col-6">
                        <h5 class="mb-3 section-title">Waktu dan Dasar Pelaksanaan Kegiatan</h5>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-3">
                                    <label class="form-label" for="tanggal_mulai">Tanggal Mulai</label>
                                    <input type="date" class="form-control" id="tanggal_mulai" />

                                </div>
                                <div class="col-3">
                                    <label class="form-label" for="tanggal_selesai">Tanggal Selesai</label>
                                    <input type="date" class="form-control" id="tanggal_selesai" />
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="pelaksanaan_dasar">Dasar Pelaksanaan</label>
                            <select class="form-control" id="pelaksanaan_dasar">
                                <option>Pilih Dasar Pelaksanaan (dari isian sebelumnya)</option>
                            </select>
                        </div>
                        <h5 class="mb-3 mt-3 section-title">Data Pencairan</h5>
                        <div class="mb-3">
                            <label class="form-label" for="akun">Akun yang akan dibuat dokumen pencairan</label>
                            <select class="form-control" id="akun">
                                <option>Pilih Akun</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="pencairan_nama">Nama Pencairan</label>
                            <textarea id="pencairan_nama" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="tanggal_dokumen">Tanggal Dokumen</label>
                            <input type="date" class="form-control" id="tanggal_dokumen" />
                        </div>

                        <h5 class="mb-3 section-title">Kuitansi, SPTJB</h5>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <label class="form-label" for="sptjb_nomor">No. SPTJB</label>
                                    <input type="text" class="form-control" id="sptjb_nomor" />
                                </div>
                                <div class="col-4">
                                    <label class="form-label" for="kuitansi_nomor">No. Kuitansi</label>
                                    <input type="text" class="form-control" id="kuitansi_nomor" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <h5 class="mb-3 section-title">Penerima</h5>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <label class="form-label" for="penerima_nama">Penerima</label>
                                    <input type="text" class="form-control" id="penerima_nama" />
                                </div>
                                <div class="col-4">
                                    <label class="form-label" for="penerima_nomor">ID Penerima</label>
                                    <input type="text" class="form-control" id="penerima_nomor" />

                                </div>
                                <div class="col-4">

                                    <label class="form-label" for="penerima_jabatan">Jabatan Penerima</label>
                                    <input type="text" class="form-control" id="penerima_jabatan" />
                                </div>

                            </div>
                        </div>

                        <h5 class="mb-3 section-title">SPTJK / Penanggung Jawab</h5>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <label class="form-label" for="sptjk_nama">Nama Penanggung Jawab</label>
                                    <input type="text" class="form-control" id="sptjk_nama" />

                                </div>
                                <div class="col-4">
                                    <label class="form-label" for="sptjk_nip">NIP Penanggung Jawab</label>
                                    <input type="text" class="form-control" id="sptjk_nip" />

                                </div>
                                <div class="col-4">
                                    <label class="form-label" for="sptjk_jabatan">Jabatan Penanggung Jawab</label>
                                    <input type="text" class="form-control" id="sptjk_jabatan" />

                                </div>

                            </div>
                        </div>

                        <h5 class="mb-3 section-title">PPK / Bendahara</h5>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <label class="form-label" for="ppk">Pilih PPK</label>
                                    <select class="form-control" id="ppk">
                                        <option>Pilih PPK</option>
                                    </select>

                                </div>
                                <div class="col-4">
                                    <label class="form-label" for="bendahara">Bendahara</label>
                                    <select class="form-control" id="bendahara">
                                        <option>Pilih Bendahara</option>
                                    </select>

                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <button type="button" onclick="save()" class="btn btn-primary">Submit</button>
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


<!-- Modal -->
<div class="modal fade" id="daftar-nominal-modals" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title " id="modalFullTitle">Daftar Nominal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <h4>Pengaturan Daftar Nominal : <span id="pencairan-sesi-nama"></span></h4>
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" id="is_peserta_luar" onclick="setPesertaLuar(this)">
                    <label class="form-check-label" for="is_peserta_luar">Gunakan Referensi SIMPEG (untuk Nama, Golongan)</label>
                </div>
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" id="is_referensi_row1" onclick="setReferensi(this)">
                    <label class="form-check-label" for="is_referensi_row1">Samakan dengan baris 1 (Untuk Jabatan, Jumlah dan Honor)</label>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="nominal">
                        <thead>
                            <tr class="text-center">
                                <th rowspan="2" width="1%" class="align-middle">Urut</th>
                                <th rowspan="2" width="2%" class="align-middle">No</th>
                                <th rowspan="2" width="15%" class="align-middle">Nama</th>
                                <th rowspan="2" width="5%" class="align-middle">Golongan</th>
                                <th rowspan="2" width="10%" class="align-middle">Jabatan</th>
                                <th colspan="4" width="45%">Jumlah Honor</th>
                                <th rowspan="2" width="10%" class="align-middle">Pajak</th>
                                <th rowspan="2" width="10%" class="align-middle">diterima</th>
                                <!-- <th>Aksi</th> -->
                            </tr>
                            <tr>
                                <th class="text-center" width="5%">Jumlah</th>
                                <th class="text-center" width="5%">Satuan</th>
                                <th class="text-center" width="10%">Honor</th>
                                <th class="text-center" width="8%">Total</th>
                            </tr>
                        </thead>
                        <tbody id='nominal-data' data-sesi-id="">

                        </tbody>
                    </table>
                </div>
                <button onclick="tambahBaris()" id="tambah-baris" class="btn btn-warning btn-sm mt-3"><i class="tf-icons bx bx-plus"></i></button>
                <!-- <button onclick="duplikat()" id="tambah-baris" class="btn btn-secondary btn-sm mt-3"><i class="tf-icons bx bx-duplicate"></i> Duplikat Baris</button> -->

                <div class="col-12 mt-3 text-center">
                    <button type="button" class="btn btn-danger" onclick="saveNominal()"><i class="tf-icons bx bx-save"></i> Simpan</button>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Keluar</button>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="daftar-belanja-bahan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title " id="modalFullTitle">Daftar Belanja Bahan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <h4>Pengaturan Daftar Belanja Bahan : <span id="pencairan-sesi-nama"></span></h4>
                <div class="col-md">
                    <small class="text-light fw-medium d-block">NPWP Perusahaan</small>
                    <div class="form-check form-check-inline mt-3">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1">
                        <label class="form-check-label" for="inlineRadio1">Ada</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="0">
                        <label class="form-check-label" for="inlineRadio2">Tidak Ada</label>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="bahan">
                        <thead>
                            <tr class="text-center">
                                <th rowspan="2" width="1%" class="align-middle">Urut</th>
                                <th rowspan="2" width="2%" class="align-middle">No</th>
                                <th rowspan="2" width="10%" class="align-middle">Jenis</th>
                                <th rowspan="2" width="20%" class="align-middle">Item</th>
                                <th rowspan="2" width="15%" class="align-middle">Nilai</th>
                                <th rowspan="2" width="10%" class="align-middle">PPN</th>
                                <th colspan="4" width="10%">PPH</th>
                                <!-- <th>Aksi</th> -->
                            </tr>
                        </thead>
                        <tbody id='belanja-bahan-data' data-sesi-id="">

                        </tbody>
                    </table>
                </div>
                <button onclick="tambahBelanjaBahan()" id="tambah-belanja-bahan" class="btn btn-warning btn-sm mt-3"><i class="tf-icons bx bx-plus"></i></button>
                <!-- <button onclick="duplikat()" id="tambah-baris" class="btn btn-secondary btn-sm mt-3"><i class="tf-icons bx bx-duplicate"></i> Duplikat Baris</button> -->

                <div class="col-12 mt-3 text-center">
                    <button type="button" class="btn btn-danger" onclick="saveBelanjaBahan()"><i class="tf-icons bx bx-save"></i> Simpan</button>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Keluar</button>
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

    async function saveBelanjaBahan() {
        var tbody = document.getElementById("belanja-bahan-data");

        var dataArray = [];

        // Iterate through each row in tbody
        for (var i = 0; i < tbody.rows.length; i++) {
            // Get reference to cells in the current row
            var cells = tbody.rows[i].cells;

            // Access input values in each cell
            var urut = cells[1].innerText;
            var jenis = cells[2].querySelector('select#jenis').value;
            var item = cells[3].querySelector('input#item').value;
            var nilai = cells[4].querySelector('input#nilai').value.replace(/\D/g, '');
            var ppn = cells[5].querySelector('input#ppn').value.replace(/\D/g, '');
            var pph = cells[6].querySelector('input#pph').value.replace(/\D/g, '');

            // Create an object to store values for the current row
            var rowData = {
                dokumen_pencairan_sesi_id: tbody.dataset.sesiId,
                urutan: urut,
                item: item,
                nilai: nilai,
                pph: pph,
                ppn: ppn,
                jenis: jenis,
            };

            // Push the object to the dataArray
            dataArray.push(rowData);
        }
        console.log(dataArray);

        let url = '{{route("belanja.bahan.store")}}'
        let sendRequest = await fetch(url, {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
                'Content-Type': 'application/json', // Tambahkan header Content-Type
            },
            method: 'POST',
            body: JSON.stringify({
                data: dataArray,
                sesi_id: tbody.dataset.sesiId
            }),
        })
        response = await sendRequest.json()
        console.log(response);
        if (response.status == true) {
            toastr.options.closeButton = true;
            toastr.options.positionClass = 'toast-top-center mt-3';
            toastr.success('Sukses');
        } else {
            toastr.options.closeButton = true;
            toastr.options.positionClass = 'toast-top-center mt-3';
            toastr.danger('Ada kesalahan, coba lagi');
        }
    }
    async function saveNominal() {
        var tbody = document.getElementById("nominal-data");

        var dataArray = [];

        // Iterate through each row in tbody
        for (var i = 0; i < tbody.rows.length; i++) {
            // Get reference to cells in the current row
            var cells = tbody.rows[i].cells;

            // Access input values in each cell
            var urut = cells[1].innerText;
            var nama = cells[2].querySelector('input.pegawai').value;
            var nip = cells[2].querySelector('input.pegawai').dataset.nip;
            var golongan = cells[3].querySelector('select').value;
            var jabatan = cells[4].querySelector('input#jabatan').value;
            var jumlah = cells[5].querySelector('input#jumlah').value.replace(/\D/g, '');
            var satuan = cells[6].querySelector('input#satuan').value;
            var honor = cells[7].querySelector('input#honor').value.replace(/\D/g, '');
            var total = cells[8].querySelector('input#total').value.replace(/\D/g, '');
            var pajak = cells[9].querySelector('input#pajak').value.replace(/\D/g, '');
            var diterima = cells[10].querySelector('input#diterima').value.replace(/\D/g, '');

            // Create an object to store values for the current row
            var rowData = {
                dokumen_pencairan_sesi_id: tbody.dataset.sesiId,
                pegawai_nomor_induk: nip,
                urutan: urut,
                nama: nama,
                golongan: golongan,
                jabatan: jabatan,
                jumlah: jumlah,
                satuan: satuan,
                honor: honor,
                total: total,
                pph: pajak,
                diterima: diterima
            };

            // Push the object to the dataArray
            dataArray.push(rowData);
        }
        console.log(dataArray);

        let url = '{{route("daftar.nominal.store")}}'
        let sendRequest = await fetch(url, {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
                'Content-Type': 'application/json', // Tambahkan header Content-Type
            },
            method: 'POST',
            body: JSON.stringify({
                data: dataArray,
                sesi_id: tbody.dataset.sesiId
            }),
        })
        response = await sendRequest.json()
        console.log(response);
        if (response.status == true) {
            toastr.options.closeButton = true;
            toastr.options.positionClass = 'toast-top-center mt-3';
            toastr.success('Sukses');
        } else {
            toastr.options.closeButton = true;
            toastr.options.positionClass = 'toast-top-center mt-3';
            toastr.danger('Ada kesalahan, coba lagi');
        }
    }

    async function loadSesiData(id) {
        let isReferensiRow1 = document.querySelector('#is_referensi_row1')
        if (localStorage.getItem('referensi_baris_1')) {
            if (localStorage.getItem('referensi_baris_1') === "true")
                isReferensiRow1.setAttribute('checked', 'checked')
            else
                isReferensiRow1.removeAttribute('checked')
        } else {
            localStorage.setItem('referensi_baris_1', true);
            isReferensiRow1.setAttribute('checked', 'checked')

        }
        let url = '{{route("daftar.nominal.index",":id")}}'
        url = url.replace(":id", id)
        let sendRequest = await fetch(url, {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },
        })
        response = await sendRequest.json()
        console.log(response);
        document.querySelector('#pencairan-sesi-nama').innerText = response.data[0].pencairan_nama
        let isPesertaLuarCheckBox = document.querySelector('#is_peserta_luar')
        isPesertaLuarCheckBox.dataset.id = id
        const elemenPegawai = document.querySelectorAll('.pegawai');
        if (response.data[0].nominal_pengaturan.is_peserta_luar == "0") {
            isPesertaLuarCheckBox.setAttribute('checked', 'checked')

            // Iterasi melalui setiap elemen dan hapus atribut oninput
            elemenPegawai.forEach(function(elemen) {
                elemen.removeAttribute('oninput');
            });
        } else {
            elemenPegawai.forEach(function(elemen) {
                elemen.setAttribute('oninput', 'cariPegawai(this)');
            });

            isPesertaLuarCheckBox.removeAttribute('checked')
        }



        let tbody = document.getElementById('nominal-data');
        tbody.dataset.sesiId = id
        // data-sesi-id
        let contents = ''
        response.data[0].daftar_nominal.map(data => {
            contents += `
            <tr data-urut="${data.urutan}">
            <td>
                <a href="#" onclick="goUp(this)"><i class="tf-icons bx bx-chevron-up"></i></a>
                <a href="#" onclick="goDown(this)"><i class="tf-icons bx bx-chevron-down"></i></a>
            </td>
            <td>${data.urutan}</td>
            <td>
            <input autocomplete="off" oninput="cariPegawai(this)" data-urut="${data.urutan}" onchange="setGolonganPajak(this)"
                class="form-control pegawai"
                list="datalistOptions${data.urutan}"
                id="nama"
                data-nip="${data.pegawai_nomor_induk}"
                placeholder="ketik nama / nip"
                value="${data.nama}"
                />
                <datalist id="datalistOptions${data.urutan}">
                </datalist>
            
            </td>
            <td>
                <select class="form-control" id="golongan" onchange="setPajak(this)">
                    <option value="">Pilih Golongan</option>
                    <option value="I/a" ${(data.golongan=="I/a")?'selected':''}>I/a</option>
                    <option value="I/b" ${(data.golongan=="I/b")?'selected':''}>I/b</option>
                    <option value="I/c" ${(data.golongan=="I/c")?'selected':''}>I/c</option>
                    <option value="I/d" ${(data.golongan=="I/d")?'selected':''}>I/d</option>

                    <!-- Golongan II -->
                    <option value="II/a" ${(data.golongan=="II/a")?'selected':''}>II/a</option>
                    <option value="II/b" ${(data.golongan=="II/b")?'selected':''}>II/b</option>
                    <option value="II/c" ${(data.golongan=="II/c")?'selected':''}>II/c</option>
                    <option value="II/d" ${(data.golongan=="II/d")?'selected':''}>II/d</option>

                    <!-- Golongan III -->
                    <option value="III/a" ${(data.golongan=="III/a")?'selected':''}>III/a</option>
                    <option value="III/b" ${(data.golongan=="III/b")?'selected':''}>III/b</option>
                    <option value="III/c" ${(data.golongan=="III/c")?'selected':''}>III/c</option>
                    <option value="III/d" ${(data.golongan=="III/d")?'selected':''}>III/d</option>

                    <!-- Golongan IV -->
                    <option value="IV/a" ${(data.golongan=="IV/a")?'selected':''}>IV/a</option>
                    <option value="IV/b" ${(data.golongan=="IV/b")?'selected':''}>IV/b</option>
                    <option value="IV/c" ${(data.golongan=="IV/c")?'selected':''}>IV/c</option>
                    <option value="IV/d" ${(data.golongan=="IV/d")?'selected':''}>IV/d</option>
                    <option value="IV/e" ${(data.golongan=="IV/e")?'selected':''}>IV/e</option>
                    
                    <option value="NON-PNS" ${(data.golongan=="NON-PNS")?'selected':''}>NON-PNS</option>
                </select>
            </td>
            <td><input class="form-control jabatan" id="jabatan" oninput="setValue(this)" onchange="calculate(this)" onkeydown="handleEnter(event)" value="${data.jabatan}"></td>
            <td><input class="form-control jumlah" type="text" oninput="setValue(this)" onchange="calculate(this)" id="jumlah" value="${formatRupiah(data.jumlah)}" onkeydown="handleEnter(event)"></td>
            <td><input class="form-control satuan" type="text" oninput="setValue(this)" id="satuan" value="${data.satuan}"></td>
            <td><input class="form-control honor" type="text" oninput="setValue(this)" onchange="calculate(this)" id="honor" value="${formatRupiah(data.honor)}" onkeydown="handleEnter(event)"></td>
            <td><input class="form-control" type="text" id="total" value="${formatRupiah(data.total)}" readonly></td>
            <td><input class="form-control" type="text" id="pajak" value="${formatRupiah(data.pph)}" readonly></td>
            <td><input class="form-control" type="text" id="diterima" value="${formatRupiah(data.diterima)}" readonly></td>
            </tr>
            `
        })
        tbody.innerHTML = ''
        tbody.innerHTML = contents


    }

    async function loadBelanjaBahan(id) {
        let url = '{{route("belanja.bahan.index",":id")}}'
        url = url.replace(":id", id)
        let sendRequest = await fetch(url, {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },
        })
        response = await sendRequest.json()
        console.log(response);
        let modal = document.querySelector('#daftar-belanja-bahan')
        modal.querySelector('#pencairan-sesi-nama').innerText = response.data[0].pencairan_nama

        let tbody = document.getElementById('belanja-bahan-data');
        tbody.dataset.sesiId = id
        // data-sesi-id
        let contents = ''
        response.data[0].belanja_bahan.map(data => {
            contents += `
            <tr data-urut="${data.urutan}">
                <td>
                    <a href="#" onclick="goUp(this)"><i class="tf-icons bx bx-chevron-up"></i></a>
                    <a href="#" onclick="goDown(this)"><i class="tf-icons bx bx-chevron-down"></i></a>
                </td>
                <td>${data.urutan}</td>
                <td>
                    <select class="form-control" id="jenis" onchange="setPajak(this)">
                        <option value="">Pilih Jenis</option>
                        <option value="fc" ${(data.jenis=="fc")?'selected':''}>Fotocopy</option>
                        <option value="atk" ${(data.jenis=="atk")?'selected':''}>ATK</option>
                        <option value="snack" ${(data.jenis=="snack")?'selected':''}>Snack / Konsumsi</option>
                        <option value="jasa" ${(data.jenis=="jasa")?'selected':''}>Jasa</option>
                        <option value="pengadaan" ${(data.jenis=="pengadaan")?'selected':''}>Pengadaan</option>
                    </select>
                </td>
                <td><input class="form-control" id="item" placeholder="Item / Barang" value="${data.item}"></td>
                <td><input class="form-control" type="text" id="nilai" oninput="setValue(this)" onchange="calculate(this)" value="${formatRupiah(data.nilai)}"></td>
                <td><input class="form-control" type="text" id="ppn" value="${formatRupiah(data.ppn)}" readonly></td>
                <td><input class="form-control" type="text" id="pph" value="${formatRupiah(data.pph)}" readonly></td>
            </tr>
            `
        })
        tbody.innerHTML = ''
        tbody.innerHTML = contents


    }

    function setReferensi(checkbox) {
        if (checkbox.checked) {
            localStorage.removeItem('referensi_baris_1');
            localStorage.setItem('referensi_baris_1', true);
        } else {
            localStorage.removeItem('referensi_baris_1');
            localStorage.setItem('referensi_baris_1', false);
        }
    }

    async function setPesertaLuar(checkbox) {
        // alert(e.dataset.id)
        // console.log(checkbox.checked);
        // return
        let dataSend = new FormData()
        if (checkbox.checked)
            dataSend.append('is_peserta_luar', 0)
        else
            dataSend.append('is_peserta_luar', 1)

        let url = '{{route("pencairan-sesi.nominal-pengaturan.update",":id")}}'
        url = url.replace(":id", checkbox.dataset.id)
        let sendRequest = await fetch(url, {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },
            method: 'POST',
            body: dataSend
        })
        response = await sendRequest.json()

        const elemenPegawai = document.querySelectorAll('.pegawai');
        console.log(response);
        if (response.status == true) {
            if (response.data.is_peserta_luar == "1") {

                // Iterasi melalui setiap elemen dan hapus atribut oninput
                elemenPegawai.forEach(function(elemen) {
                    elemen.removeAttribute('oninput');
                });
            } else {
                elemenPegawai.forEach(function(elemen) {
                    elemen.setAttribute('oninput', 'cariPegawai(this)');
                    elemen.setAttribute('onchange', 'setGolonganPajak(this)');
                });
            }
        }

    }

    function tambahBelanjaBahan() {
        let table = document.getElementById('bahan');
        let tbody = document.getElementById('belanja-bahan-data');
        let onInput = ``
        let contents = `
            <tr data-urut="${tbody.rows.length+1}">
                <td>
                    <a href="#" onclick="goUp(this)"><i class="tf-icons bx bx-chevron-up"></i></a>
                    <a href="#" onclick="goDown(this)"><i class="tf-icons bx bx-chevron-down"></i></a>
                </td>
                <td>${tbody.rows.length+1}</td>
                <td>
                    <select class="form-control" id="jenis" onchange="setPajak(this)">
                        <option value="">Pilih Jenis</option>
                        <option value="fc">Fotocopy</option>
                        <option value="atk">ATK</option>
                        <option value="snack">Snack / Konsumsi</option>
                        <option value="jasa">Jasa</option>
                        <option value="pengadaan">Pengadaan</option>
                    </select>
                </td>
                <td><input class="form-control" id="item" placeholder="Item / Barang / Jasa" value=""></td>
                <td><input class="form-control" type="text" oninput="setValue(this)" onchange="calculate(this)" id="nilai" value="0"></td>
                <td><input class="form-control" type="text" id="ppn" value="0" readonly></td>
                <td><input class="form-control" type="text" id="pph" value="0" readonly></td>
            </tr>
        `
        tbody.insertAdjacentHTML('beforeend', contents);

    }

    function tambahBaris() {
        let table = document.getElementById('nominal');
        let tbody = document.getElementById('nominal-data');
        let referensiPegawai = document.getElementById('is_peserta_luar')
        console.log(referensiPegawai.checked);
        let onInput = ``
        if (referensiPegawai.checked)
            onInput = `oninput="cariPegawai(this)" onchange="setGolonganPajak(this)"`
        let contents = `
            <tr data-urut="${tbody.rows.length+1}">
            <td>
                <a href="#" onclick="goUp(this)"><i class="tf-icons bx bx-chevron-up"></i></a>
                <a href="#" onclick="goDown(this)"><i class="tf-icons bx bx-chevron-down"></i></a>
            </td>
            <td>${tbody.rows.length+1}</td>
            <td>
            <input autocomplete="off" 
                ${onInput}
                data-urut="${tbody.rows.length+1}" 
                class="form-control pegawai"
                list="datalistOptions${tbody.rows.length+1}"
                id="nama"
                placeholder="ketik nama / nip"
                />
                <datalist id="datalistOptions${tbody.rows.length+1}">
                </datalist>
            
            </td>
            <td>
                <select class="form-control" id="golongan" onchange="setPajak(this)">
                    <option value="">Pilih Golongan</option>
                    <option value="I/a">I/a</option>
                    <option value="I/b">I/b</option>
                    <option value="I/c">I/c</option>
                    <option value="I/d">I/d</option>

                    <!-- Golongan II -->
                    <option value="II/a">II/a</option>
                    <option value="II/b">II/b</option>
                    <option value="II/c">II/c</option>
                    <option value="II/d">II/d</option>

                    <!-- Golongan III -->
                    <option value="III/a">III/a</option>
                    <option value="III/b">III/b</option>
                    <option value="III/c">III/c</option>
                    <option value="III/d">III/d</option>

                    <!-- Golongan IV -->
                    <option value="IV/a">IV/a</option>
                    <option value="IV/b">IV/b</option>
                    <option value="IV/c">IV/c</option>
                    <option value="IV/d">IV/d</option>
                    <option value="IV/e">IV/e</option>
                    
                    <option value="NON-PNS">NON-PNS</option>
                </select>
            </td>
            <td><input class="form-control jabatan" id="jabatan" oninput="setValue(this)" onchange="calculate(this)" onkeydown="handleEnter(event)"></td>
            <td><input class="form-control jumlah" type="text" oninput="setValue(this)" onchange="calculate(this)" id="jumlah" value="0" onkeydown="handleEnter(event)"></td>
            <td><input class="form-control satuan" type="text" oninput="setValue(this)" id="satuan"></td>
            <td><input class="form-control honor" type="text" oninput="setValue(this)" onchange="calculate(this)" id="honor" value="0" onkeydown="handleEnter(event)"></td>
            <td><input class="form-control" type="text" id="total" value="0" readonly></td>
            <td><input class="form-control" type="text" id="pajak" value="0" readonly></td>
            <td><input class="form-control" type="text" id="diterima" value="0" readonly></td>
            </tr>
        `
        tbody.insertAdjacentHTML('beforeend', contents);

    }

    function handleEnter(event) {
        // Check if the key pressed is "Enter"
        if (event.key === "Enter") {
            // Prevent the default behavior of the "Enter" key (e.g., form submission)
            event.preventDefault();

            // Call the calculate function
            calculate(event.target);
        }
    }

    function setPajak(input) {
        var row = input.closest('tr')
        console.log(row);
        let persen = 5
        if (input.value == "IV/a" || input.value == "IV/b" || input.value == "IV/c" || input.value == "IV/d" || input.value == "IV/e")
            persen = 15
        let total = row.querySelector('#pajak').dataset.pajak = persen;
        calculate(input)
    }

    function setValue(input) {
        var row = input.closest('tr')
        // console.log(row);
        if (input.id != "jabatan" && input.id != "satuan") {
            let cleanedInput = input.value.replace(/\D/g, '');
            const formattedInput = Number(cleanedInput).toLocaleString('id-ID');
            input.value = formattedInput;
        }
        if (localStorage.getItem('referensi_baris_1') === "true") {
            if (row.dataset.urut == 1) {
                const elemen = document.querySelectorAll('.' + input.id);
                elemen.forEach(function(elemen) {
                    console.log(elemen.parentNode);
                    elemen.value = input.value;
                    // calculate(elemen.closest('td'))
                });
            }
        }
    }

    function formatRupiah(angka) {
        let reverse = angka.toString().split('').reverse().join('');
        let ribuan = reverse.match(/\d{1,3}/g);
        let formatted = ribuan.join('.').split('').reverse().join('');
        return `${formatted}`;
    }

    function calculate(input) {

        var row = input.closest('tr');
        console.log(row);
        let jumlah = row.querySelector('#jumlah');
        let honor = row.querySelector('#honor');
        let total = jumlah.value.replace(/\D/g, '') * honor.value.replace(/\D/g, '')
        let pajak = row.querySelector('#pajak').dataset.pajak.replace(/\D/g, '') / 100 * total
        let diterima = total - pajak

        row.querySelector('#total').value = formatRupiah(total);
        row.querySelector('#pajak').value = formatRupiah(pajak)
        row.querySelector('#diterima').value = formatRupiah(diterima);

    }

    function goUp(button) {
        var row = button.parentNode.parentNode;
        var table = row.parentNode.parentNode;
        console.log(table);
        if (row.rowIndex > 1) {
            table.rows[row.rowIndex - 1].before(row);
            updateRowNumbers(table);
        }
    }

    function goDown(button) {
        var row = button.parentNode.parentNode;
        var table = row.parentNode.parentNode;
        if (row.rowIndex < table.rows.length - 1) {
            table.rows[row.rowIndex + 1].after(row);
            updateRowNumbers(table);
        }
    }

    function updateRowNumbers(table) {
        for (var i = 2; i < table.rows.length; i++) {
            table.rows[i].cells[1].textContent = i - 1;
            console.log(table.rows[i].cells[1]);
            table.rows[i].dataset.urut = i - 1;
        }
    }
    async function cariPegawai(input) {
        let dataSend = new FormData()
        if (input.value.length > 2) {

            dataSend.append('q', input.value)
            // dataSend.append('idpeg', JSON.stringify(await getListAnggota()))
            let sendRequest = await fetch('https://simpeg.iainkendari.ac.id/api/juara/search', {
                method: "POST",
                body: dataSend
            })
            response = await sendRequest.json()
            const row = input.parentNode.parentNode
            let lists = ``
            // console.log(row);
            response.map((data) => {
                lists += `<option value="${data.nama}-${data.pajak}-${data.gol}-${data.nip}">${data.nip} - ${data.nama}</option>`
            })
            row.querySelector('#datalistOptions' + input.dataset.urut).innerHTML = ''
            row.querySelector('#datalistOptions' + input.dataset.urut).innerHTML = lists
        }

    }

    function setGolonganPajak(e) {

        console.log(e.value)
        const row = e.parentNode.parentNode
        var splitArray = e.value.split('-');

        var nama = splitArray[0];
        var pajak = splitArray[1];
        var golongan = splitArray[2];
        var nip = splitArray[3];
        e.value = nama
        // row.querySelector('#golongan').value = golongan
        row.querySelector('#pajak').dataset.pajak = pajak
        row.querySelector('#nama').dataset.nip = nip
        var golonganSelect = row.querySelector("#golongan");

        // Loop melalui setiap opsi
        for (var i = 0; i < golonganSelect.options.length; i++) {
            // Jika nilai opsi sesuai dengan golongan yang dipilih, atur properti selected
            if (golonganSelect.options[i].value === golongan) {
                golonganSelect.options[i].selected = true;
            }
        }
        // e.setAttribute('readonly', 'readonly')

    }


    function loadData() {
        fetch('{{route("pencairan-sesi.index",$rencana_id)}}', {
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
                let contents = '' // Mengambil token dari response JSON
                data.data.map((data, index) => {
                    console.log(data.kode_akun.kode);
                    let filePath = "{{asset('storage/')}}/"
                    filePath += data.pelaksanaan_dasar.path_file
                    let url = "{{route('cetak',[':id','daftar-nominal'])}}"
                    url = url.replace(":id", data.id)
                    contents += `<tr>
                    <td>${index + 1}</td>
                    <td>${data.pelaksanaan.tanggal_mulai} - ${data.pelaksanaan.tanggal_selesai}
                    <br>
                    <a href="${filePath}" target="_blank">dasar Pelaksanaan : ${data.pelaksanaan_dasar.nomor} - tentang ${data.pelaksanaan_dasar.tentang} (${data.pelaksanaan_dasar.tanggal_format})</a></td>
                    <td>${data.kode_akun.kode} - ${data.kode_akun.nama_akun} <br>
                    Tanggal dokumen : ${data.tanggal_dokumen}</td>
                    <td>${data.pencairan_nama}</td>
                    <td>${data.penerima_jabatan} <br>${data.penerima_nama}<br>${data.penerima_nomor}</td>
                    <td>Kuitansi : ${data.kuitansi_nomor}
                    <br>SPTJB : ${data.sptjb_nomor}</td>
                    <td>${data.sptjk_jabatan} <br>${data.sptjk_nama}<br>${data.sptjk_nip}</td>`
                    if (data.kode_akun.kode == "521211")
                        contents += `<td><button data-bs-toggle="modal" onclick="loadBelanjaBahan(${data.id})" data-bs-target="#daftar-belanja-bahan"  class="btn btn-info btn-sm">Belanja Bahan</button></td>`
                    else
                        contents += `<td><button data-bs-toggle="modal" onclick="loadSesiData(${data.id})"  data-bs-target="#daftar-nominal-modals"  class="btn btn-primary btn-sm">Daftar Nominal</button></td>`
                    contents += `<td><a href="${url}" class="btn btn-warning btn-sm" >Dokumen Pencairan</a></td>
                    </tr>`
                })
                document.querySelector("#pencairan-data").innerHTML = ''
                document.querySelector("#pencairan-data").innerHTML = contents
            })
            .catch(error => {
                console.error('error:', error);
                // Tampilkan pesan error atau lakukan sesuatu jika login gagal
            });
    }

    function add() {

        fetch('{{route("kode.akun")}}', {
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
                let contents = '' // Mengambil token dari response JSON
                data.data.map((data, index) => {
                    contents += `<option value="${data.id}">${data.kode} - ${data.nama_akun}</option>`
                })
                document.querySelector("#akun").innerHTML = ''
                document.querySelector("#akun").innerHTML = contents
            })
            .catch(error => {
                console.error('error:', error);
                // Tampilkan pesan error atau lakukan sesuatu jika login gagal
            });
        let url = '{{route("pejabat.data",[":id","ppk"])}}'
        url = url.replace(":id", 33)
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
                let contents = '' // Mengambil token dari response JSON
                data.data.map((data, index) => {
                    contents += `<option value="${data.id}">${data.pegawai.pegawai_nomor_induk} - ${data.nama_pejabat}</option>`
                })
                document.querySelector("#ppk").innerHTML = ''
                document.querySelector("#ppk").innerHTML = contents
            })
            .catch(error => {
                console.error('error:', error);
                // Tampilkan pesan error atau lakukan sesuatu jika login gagal
            });
        url = '{{route("pejabat.data",[":id","bendahara_pengeluaran"])}}'
        url = url.replace(":id", 33)
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
                let contents = '' // Mengambil token dari response JSON
                data.data.map((data, index) => {
                    contents += `<option value="${data.id}">${data.pegawai.pegawai_nomor_induk} - ${data.nama_pejabat}</option>`
                })
                document.querySelector("#bendahara").innerHTML = ''
                document.querySelector("#bendahara").innerHTML = contents
            })
            .catch(error => {
                console.error('error:', error);
                // Tampilkan pesan error atau lakukan sesuatu jika login gagal
            });


        fetch('{{route("pelaksanaan.dasar",$id)}}', {
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
                // return
                let contents = '' // Mengambil token dari response JSON
                data.data.map((data, index) => {
                    contents += `<option value="${data.id}">${data.tentang} - (${data.tanggal_format})</option>`
                })
                document.querySelector("#pelaksanaan_dasar").innerHTML = ''
                document.querySelector("#pelaksanaan_dasar").innerHTML = contents
            })
            .catch(error => {
                console.error('error:', error);
                // Tampilkan pesan error atau lakukan sesuatu jika login gagal
            });
        fetch('{{route("kegiatan.show",$id)}}', {
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
                // return
                let contents = '' // Mengambil token dari response JSON
                document.querySelector("#pencairan_nama").innerHTML = ''
                document.querySelector("#pencairan_nama").innerHTML = data.data.kegiatan_nama;
            })
            .catch(error => {
                console.error('error:', error);
                // Tampilkan pesan error atau lakukan sesuatu jika login gagal
            });
    }

    function save() {


        const formData = new FormData();
        formData.append('rencana_id', '{{$rencana_id}}');
        formData.append('kegiatan_id', '{{$id}}');
        formData.append('kode_akun_id', document.querySelector('#akun').value);
        formData.append('ppk', document.querySelector('#ppk').value);
        formData.append('bendahara', document.querySelector('#bendahara').value);
        formData.append('tanggal_mulai', document.querySelector('#tanggal_mulai').value);
        formData.append('tanggal_selesai', document.querySelector('#tanggal_selesai').value);
        formData.append('pelaksanaan_dasar_id', document.querySelector('#pelaksanaan_dasar').value);
        formData.append('tanggal_dokumen', document.querySelector('#tanggal_dokumen').value);
        formData.append('pencairan_nama', document.querySelector('#pencairan_nama').value);
        formData.append('penerima_nama', document.querySelector('#penerima_nama').value);
        formData.append('penerima_nomor', document.querySelector('#penerima_nomor').value);
        formData.append('penerima_jabatan', document.querySelector('#penerima_jabatan').value);
        formData.append('kuitansi_nomor', document.querySelector('#kuitansi_nomor').value);
        formData.append('sptjb_nomor', document.querySelector('#sptjb_nomor').value);
        formData.append('sptjk_nama', document.querySelector('#sptjk_nama').value);
        formData.append('sptjk_nip', document.querySelector('#sptjk_nip').value);
        formData.append('sptjk_jabatan', document.querySelector('#sptjk_jabatan').value);
        fetch('{{route("pencairan-sesi.store")}}', {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                method: 'POST',
                body: formData,
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('ada kesalahan.');
                }
                return response.json();
            })
            .then(data => {
                console.log(data);
                // return
                toastr.options.closeButton = true;
                toastr.options.positionClass = 'toast-top-center mt-3';
                toastr.success('Sukses');
                loadData()

            })
            .catch(error => {
                console.error('error:', error);
                // Tampilkan pesan error atau lakukan sesuatu jika login gagal
            });
    }
</script>
@endsection