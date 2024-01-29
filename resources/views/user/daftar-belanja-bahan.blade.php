<div class="col-md-12">
    <h5>Data NPWP Perusahaan</h5>
    <div class="form-check form-check-inline mt-3">
        <input onclick="changeNpwp(this)" class="form-check-input" type="radio" name="inlineRadioOptions" id="ada_npwp" value="1">
        <label class="form-check-label" for="ada_npwp">Ada</label>
    </div>
    <div class="form-check form-check-inline">
        <input onclick="changeNoNpwp(this)" class="form-check-input" type="radio" name="inlineRadioOptions" id="tidak_ada_npwp" value="0">
        <label class="form-check-label" for="tidak_ada_npwp">Tidak Ada</label>
    </div>

    <div class="mt-3" id="npwp-form" style="display:none">
        <div class="col-12">
            <div class="mb-3">
                <div class="row">
                    <div class="col-3">
                        <label class="form-label" for="tanggal_mulai">NPWP</label>
                        <input type="text" class="form-control" id="npwp" placeholder="Nomor Pokok Wajib Pajak" />

                    </div>
                    <div class="col-3">
                        <label class="form-label" for="tanggal_mulai">Nama pada NPWP</label>
                        <input type="text" class="form-control" id="npwp_nama" placeholder="Nama NPWP" />
                    </div>
                    <div class="col-4">
                        <label class="form-label" for="tanggal_mulai">Alamat NPWP</label>
                        <input type="text" class="form-control" id="npwp_alamat" placeholder="Alamat NPWP" />
                    </div>

                    <div class="row">
                        <div class="col-2 mt-3">
                            <button type="button" onclick="saveNpwp()" class="btn btn-dark btn-sm">Simpan NPWP</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h4 class="mt-5">Daftar Belanja Bahan</h4>

    <div class="table-responsive">
        <table class="table table-striped table-hover" id="bahan">
            <thead>
                <tr class="text-center">
                    <th width="1%" class="align-middle">Urut</th>
                    <th width="2%" class="align-middle">No</th>
                    <th width="10%" class="align-middle">Jenis</th>
                    <th width="20%" class="align-middle">Item</th>
                    <th width="15%" class="align-middle">Nilai</th>
                    <th width="10%" class="align-middle">PPN</th>
                    <th width="10%">PPH</th>
                    <th width="1%">Hapus</th>
                </tr>
            </thead>
            <tbody id='belanja-bahan-data' data-sesi-id="">

            </tbody>
        </table>
    </div>
    <button onclick="tambahBelanjaBahan()" id="tambah-belanja-bahan" class="btn btn-warning btn-sm mt-3"><i class="tf-icons bx bx-plus"></i></button>

    <div class="col-12 mt-3 text-center">
        <button type="button" class="btn btn-danger" onclick="saveBelanjaBahan()"><i class="tf-icons bx bx-save"></i> Simpan</button>
    </div>
</div>