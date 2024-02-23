<div class="row">
    <!-- Basic Layout -->
    <div class="col-12">
        <h5 class="mb-3 section-title">Form Pencairan Perjalanan Dinas</h5>
        <div class="mb-3">
            <div class="row">
                <div class="col-12 mb-3">
                    <label class="form-label" for="nama_perjadin">Nama Perjadin</label>
                    <textarea class="form-control" id="nama_perjadin" placeholder="Tuliskan Nama Perjadin sesuai Surat Tugas"></textarea>
                </div>
                <div class="col-3">
                    <label class="form-label" for="kota_tujuan">Kota Tujuan</label>
                    <input type="text" class="form-control" id="kota_tujuan" placeholder="Kota Tujuan" />
                </div>
                <div class="col-3">
                    <label class="form-label" for="tanggal_dokumen_perjadin">Tanggal Dokumen</label>
                    <input type="date" class="form-control" id="tanggal_dokumen_perjadin" />

                </div>
                <div class="col-3">
                    <label class="form-label" for="no_surat_tugas">Nomor Surat Tugas</label>
                    <input type="text" class="form-control" id="no_surat_tugas" />
                </div>
                <div class="col-3">
                    <label class="form-label" for="tanggal_surat_tugas">Tanggal Surat Tugas</label>
                    <input type="date" class="form-control" id="tanggal_surat_tugas" />
                </div>
            </div>
        </div>
        <h5 class="mb-3 section-title">Dinas 1</h5>
        <div class="mb-3">
            <div class="row">
                <div class="col-3">
                    <label class="form-label" for="tgl_mulai">Tanggal Mulai</label>
                    <input type="date" class="form-control" id="tgl_mulai" required />
                </div>
                <div class="col-3">
                    <label class="form-label" for="tgl_selesai">Tanggal Selesai</label>
                    <input type="date" class="form-control" id="tgl_selesai" required />
                </div>
                <div class="col-3">
                    <label class="form-label" for="uang_harian">Uang Harian 1</label>
                    <input type="text" class="form-control" id="uang_harian" required />
                </div>
                <div class="col-3">
                    <label class="form-label" for="uang_penginapan">Uang Penginapan 1</label>
                    <input type="text" class="form-control" id="uang_penginapan" required />
                </div>
            </div>
        </div>
        <h5 class="mb-3 section-title">Dinas 2</h5>
        <div class="mb-3">
            <div class="row">
                <div class="col-3">
                    <label class="form-label" for="tgl_mulai2">Tanggal Mulai (boleh kosong)</label>
                    <input type="date" class="form-control" id="tgl_mulai2" />
                </div>
                <div class="col-3">
                    <label class="form-label" for="tgl_selesai2">Tanggal Selesai (boleh kosong)</label>
                    <input type="date" class="form-control" id="tgl_selesai2" />
                </div>
                <div class="col-3">
                    <label class="form-label" for="uang_harian2">Uang Harian 1 (boleh kosong)</label>
                    <input type="text" class="form-control" id="uang_harian2" />
                </div>
                <div class="col-3">
                    <label class="form-label" for="uang_penginapan2">Uang Penginapan 1 (boleh kosong)</label>
                    <input type="text" class="form-control" id="uang_penginapan2" />
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-sm-12">
            <button type="button" onclick="savePerjadin()" class="btn btn-primary">Submit</button>
        </div>
    </div>


</div>