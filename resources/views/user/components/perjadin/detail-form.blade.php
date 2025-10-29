<!-- Basic Layout -->
<div class="col-sm-7">
    <h5 class="mb-3 section-title">Form Pencairan Perjalanan Dinas</h5>
    <div class="row">
        <div class="col-sm-12">
            <label class="form-label" for="kota_tujuan">Kota Tujuan</label>
            <input type="text" class="form-control" v-model="perjadinData.kota_tujuan" placeholder="Kota Tujuan" :disabled="!isDetailEditing" />
        </div>
        <div class="col-md-6 col-sm-12 mt-2">
            <label class="form-label" for="tgl_mulai">Tanggal Mulai</label>
            <input type="date" class="form-control" v-model="perjadinData.tgl_mulai" required :disabled="!isDetailEditing" />
        </div>
        <div class="col-md-6 col-sm-12 mt-2">
            <label class="form-label" for="tgl_selesai">Tanggal Selesai</label>
            <input type="date" class="form-control" v-model="perjadinData.tgl_selesai" required :disabled="!isDetailEditing" />
        </div>
        <div class="col-md-6 col-sm-12 mt-2">
            <label class="form-label" for="no_surat_tugas">Nomor Surat Tugas</label>
            <input type="text" class="form-control" v-model="perjadinData.no_surat_tugas" :disabled="!isDetailEditing" />
        </div>
        <div class="col-md-6 col-sm-12 mt-2">
            <label class="form-label" for="tanggal_surat_tugas">Tanggal Surat Tugas</label>
            <input type="date" class="form-control" v-model="perjadinData.tanggal_surat_tugas" :disabled="!isDetailEditing" />
        </div>
        <div class="col-md-6 col-sm-12 mt-2">
            <label class="form-label" for="tanggal_dokumen">Tanggal Dokumen Perjadin</label>
            <input type="date" class="form-control" v-model="perjadinData.tanggal_dokumen" :disabled="!isDetailEditing" />
        </div>
    </div>
</div>

<div class="col-sm-5">
    <div class="row">
        <h5 class="mb-3 section-title">Referensi Uang Harian dan Penginapan</h5>
        <div class="col-sm-12">
            <label class="form-label" for="uang_harian">Uang Harian 1</label>
            <input type="text" @input="formatRibuan(perjadinData, 'non-array', 'uang_harian1', $event.target.value)" class="form-control" v-model="formattedReferensiUangPerjadin['uang_harian1']" required :disabled="!isDetailEditing" />
        </div>
        <div class="col-sm-12 mt-2">
            <label class="form-label" for="uang_penginapan">Uang Penginapan 1</label>
            <input type="text" @input="formatRibuan(perjadinData, 'non-array', 'uang_penginapan1', $event.target.value)" class="form-control" v-model="formattedReferensiUangPerjadin['uang_penginapan1']" required :disabled="!isDetailEditing" />
        </div>
        <div class="row mt-2">
            <div class="col-sm-12">
                <label class="form-label" for="uang_harian2">Uang Harian 2 (boleh kosong)</label>
                <input type="text" @input="formatRibuan(perjadinData, 'non-array', 'uang_harian2', $event.target.value)" class="form-control" :value="formattedReferensiUangPerjadin['uang_harian2']"
                    :disabled="!isDetailEditing" />
            </div>
            <div class="col-sm-12  mt-2">
                <label class="form-label" for="uang_penginapan2">Uang Penginapan 2 (boleh kosong)</label>
                <input type="text" @input="formatRibuan(perjadinData, 'non-array', 'uang_penginapan2', $event.target.value)" class="form-control" v-model="formattedReferensiUangPerjadin['uang_penginapan2']" :disabled="!isDetailEditing" />
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 mt-3">
        <button type="button" v-if="!isDetailEditing" @click="editDetail" class="btn btn-warning btn-sm"><i class="icon-base bx bx-pencil icon-sm"></i> Edit Detail</button>
        <button type="button" v-if="isDetailEditing" @click="savePerjadin" class="btn btn-primary btn-sm me-2"><i class="icon-base bx bx-check icon-sm"></i> Simpan Detail</button>
        <button type="button" v-if="isDetailEditing" @click="cancelEditDetail" class="btn btn-secondary btn-sm"><i class="icon-base bx bx-cancel icon-sm"></i> Batal</button>

    </div>
</div>