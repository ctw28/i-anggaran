<form @submit.prevent="save">
    <div class="row">
        <div class="col-12">
            <div class="mb-3">
                <label class="form-label" for="akun">Akun</label>
                <select v-model="form.kode_akun_id" class="form-control" @focus="fetchAkun">
                    <option value="">Pilih Akun</option>
                    <option v-for="kodeAkun in kodeAkunList" :key="kodeAkun.id" :value="kodeAkun.id">
                        @{{ kodeAkun.kode }} - @{{ kodeAkun.nama_akun }}
                    </option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label" for="kegiatan">Kegiatan</label>
                <select v-model="form.kegiatan_id" class="form-control" @focus="fetchKegiatan">
                    <option value="">Pilih Kegiatan</option>
                    <option v-for="kegiatan in kegiatanList" :key="kegiatan.id" :value="kegiatan.id">
                        @{{ kegiatan.kegiatan_nama }} (Pagu : @{{formatRupiah(kegiatan.jumlah_biaya)}})
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label" for="nama_pencairan">Nama Pencairan</label>
                <textarea class="form-control" v-model="form.pencairan_nama" rows="5"></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
</form>