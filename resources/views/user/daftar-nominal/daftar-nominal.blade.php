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
                <th rowspan="2" width="10%" class="align-middle">Hapus</th>
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
<button onclick="tambahBarisPencairan()" id="tambah-baris" class="btn btn-warning btn-sm mt-3"><i class="tf-icons bx bx-plus"></i></button>
<!-- <button onclick="duplikat()" id="tambah-baris" class="btn btn-secondary btn-sm mt-3"><i class="tf-icons bx bx-duplicate"></i> Duplikat Baris</button> -->

<div class="col-12 mt-3 text-center">
    <button type="button" class="btn btn-danger" onclick="saveNominal()"><i class="tf-icons bx bx-save"></i> Simpan</button>
</div>