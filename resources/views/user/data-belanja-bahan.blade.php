<div class="row">
    <!-- Basic Layout -->
    <div class="col-6">
        <h5 class="mb-3 section-title" id="pelaksanaan" data-pelaksanaan-id="">Waktu dan Dasar Pelaksanaan Kegiatan</h5>
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
            <button type="button" onclick="editBelanja()" class="btn btn-warning">Edit</button>
        </div>
    </div>


</div>