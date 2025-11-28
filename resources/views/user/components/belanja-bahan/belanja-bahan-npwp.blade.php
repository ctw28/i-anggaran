<div class="mb-3">
    <h5 class="mb-2">Data NPWP Perusahaan</h5>
    <div class="d-flex align-items-center gap-3 mt-2">
        <div class="form-check form-check-inline mb-0">
            <input
                v-model="isNpwp"
                @change="handleNpwpChange"
                class="form-check-input"
                type="radio"
                name="inlineRadioOptions"
                id="ada_npwp"
                :value="true">
            <label class="form-check-label" for="ada_npwp">Ada</label>
        </div>
        <div class="form-check form-check-inline mb-0">
            <input
                v-model="isNpwp"
                @change="handleNpwpChange"
                class="form-check-input"
                type="radio"
                name="inlineRadioOptions"
                id="tidak_ada_npwp"
                :value="false">
            <label class="form-check-label" for="tidak_ada_npwp">Tidak Ada</label>
        </div>
    </div>
</div>


<!-- Form NPWP -->
<div v-if="isNpwp">
    <div class="col-12">
        <div class="mb-3">
            <div class="row">
                <div class="col-3">
                    <label class="form-label" for="npwp">NPWP</label>
                    <input type="text" v-model="perusahaan.npwp" class="form-control" placeholder="Nomor Pokok Wajib Pajak" />
                </div>
                <div class="col-3">
                    <label class="form-label" for="npwp_nama">Nama pada NPWP</label>
                    <input type="text" v-model="perusahaan.npwp_nama" class="form-control" placeholder="Nama NPWP" />
                </div>
                <div class="col-4">
                    <label class="form-label" for="npwp_alamat">Alamat NPWP</label>
                    <input type="text" v-model="perusahaan.npwp_alamat" class="form-control" placeholder="Alamat NPWP" />
                </div>
            </div>
            <div class="row">
                <div class="col-2 mt-3">
                    <button type="button" @click="saveNpwp" class="btn btn-dark btn-sm">Simpan NPWP</button>
                </div>
            </div>
        </div>
    </div>
</div>