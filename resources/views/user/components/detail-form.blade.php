<div class="col-sm-5">
    <h5 class="mb-3 section-title">Nomor dan Tanggal Dokumen</h5>
    <div class="mb-3">
        <div class="row">
            <div class="col-6">
                <label class="form-label" for="sptjb_nomor">No. SK</label>
                <input type="text" class="form-control" v-model="detail.nomor_sk" :disabled="!isDetailEditing" />
            </div>
            <div class="col-6">
                <label class="form-label" for="kuitansi_nomor">Tanggal SK</label>
                <input type="date" class="form-control" v-model="detail.tanggal_sk" :disabled="!isDetailEditing" />
            </div>
        </div>
    </div>
    <div class="mb-3">
        <div class="row">
            <div class="col-6">
                <label class="form-label" for="sptjb_nomor">No. SPTJB</label>
                <input type="text" class="form-control" v-model="detail.sptjb_nomor" :disabled="!isDetailEditing" />
            </div>
            <div class="col-6">
                <label class="form-label" for="kuitansi_nomor">No. Kuitansi</label>
                <input type="text" class="form-control" v-model="detail.kuitansi_nomor" :disabled="!isDetailEditing" />
            </div>
        </div>
    </div>
    <div class="row mb-3 ">
        <div class="col-6">
            <label class="form-label" for="tanggal_dokumen">Tanggal Dokumen Pencairan</label>
            <input type="date" class="form-control" v-model="detail.tanggal_dokumen" :disabled="!isDetailEditing" />
        </div>
    </div>
    <!-- Dasar Surat -->
    <div class="mb-3">
        <label class="form-label d-block">Dasar Surat</label>
        <div class="form-check form-check-inline">
            <input
                class="form-check-input"
                type="checkbox"
                id="dasarSK"
                v-model="detail.dasar.isSK"
                true-value="1"
                false-value="0"
                :disabled="!isDetailEditing" />
            <label class="form-check-label" for="dasarSK">Surat Keputusan (SK)</label>
        </div>
        <div class="form-check form-check-inline" v-if="isBelanjaBahan">
            <input
                class="form-check-input"
                type="checkbox"
                id="dasarKuitansi"
                v-model="detail.dasar.isKuitansi"
                true-value="1"
                false-value="0"
                :disabled="!isDetailEditing" />
            <label class="form-check-label" for="dasarKuitansi">Kuitansi</label>
        </div>

    </div>

</div>
<div class="col-md-7 col-sm-12">
    <h5 class="mb-3 section-title">Penandatangan Dokumen</h5>
    <div class="mb-3">
        <div class="row">
            <div class="col-6">
                <select v-model="detail.ppk_id" class="form-control" :disabled="!isDetailEditing">
                    <option value="">Pilih PPK</option>
                    <option v-for="ppk in ppkList" :key="ppk.id" :value="ppk.id">
                        @{{ ppk.nama_pejabat }} - @{{ ppk.pegawai.pegawai_nomor_induk }}
                    </option>
                </select>
            </div>
            <div class="col-6">
                <select v-model="detail.bendahara_id" class="form-control" :disabled="!isDetailEditing">
                    <option value="">Pilih Bendahara</option>
                    <option v-for="bendahara in bendaharaList" :key="bendahara.id" :value="bendahara.id">
                        @{{ bendahara.nama_pejabat }} - @{{ bendahara.pegawai.pegawai_nomor_induk }}
                    </option>
                </select>
            </div>
            <div class="col-4 mt-3">
                <label class="form-label" for="penerima_nama">Penerima</label>

                <input type="text" v-model="detail.penerima_nama" @input="fetchPegawai('penerima')"
                    @focus="activeDropdownGlobal = 'penerima'" @blur="hideDropdown('penerima')"
                    placeholder="Cari Pegawai..." class="form-control" :disabled="!isDetailEditing">

                <ul v-if="activeDropdownGlobal === 'penerima' && searchResultsGlobal.length" class="dropdown">
                    <li v-for="pegawai in searchResultsGlobal" :key="pegawai.pegawai_nomor_induk"
                        @mousedown.prevent="selectPegawai('penerima', pegawai)">
                        @{{ pegawai.pegawai_nomor_induk }} - @{{ pegawai.nama }}
                    </li>
                </ul>



            </div>
            <div class="col-4 mt-3">
                <label class="form-label" for="penerima_nomor">ID Penerima (NIP/ID)</label>
                <input type="text" class="form-control" v-model="detail.penerima_nomor" :disabled="!isDetailEditing" />

            </div>
            <div class="col-4 mt-3">

                <label class="form-label" for="penerima_jabatan">Jabatan Penerima</label>
                <input type="text" class="form-control" v-model="detail.penerima_jabatan" :disabled="!isDetailEditing" />
            </div>
            <div class="col-4 mt-3">
                <label class="form-label" for="penerima_nomor">Label Penerima</label>
                <input type="text" class="form-control" v-model="detail.penerima_2" :disabled="!isDetailEditing" />

            </div>
            <div class="row"></div>
            <div class="col-4 mt-3">
                <label class="form-label" for="sptjk_nama">Nama Penanggung Jawab</label>
                <input type="text" v-model="detail.sptjk_nama" @input="fetchPegawai('sptjk')"
                    @focus="activeDropdownGlobal = 'sptjk'" @blur="hideDropdown('sptjk')"
                    placeholder="Cari Pegawai..." class="form-control" :disabled="!isDetailEditing">

                <ul v-if="activeDropdownGlobal === 'sptjk' && searchResultsGlobal.length" class="dropdown">
                    <li v-for="pegawai in searchResultsGlobal" :key="pegawai.pegawai_nomor_induk"
                        @mousedown.prevent="selectPegawai('sptjk', pegawai)">
                        @{{ pegawai.pegawai_nomor_induk }} - @{{ pegawai.nama }}
                    </li>
                </ul>
            </div>
            <div class="col-4 mt-3">
                <label class="form-label" for="sptjk_nip">NIP Penanggung Jawab</label>
                <input type="text" class="form-control" v-model="detail.sptjk_nip" :disabled="!isDetailEditing" />

            </div>
            <div class="col-4 mt-3">
                <label class="form-label" for="sptjk_jabatan">Jabatan Penanggung Jawab</label>
                <input type="text" class="form-control" v-model="detail.sptjk_jabatan" :disabled="!isDetailEditing" />

            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 mt-3">
        <button type="button" v-if="!isDetailEditing" @click="editDetail" class="btn btn-warning btn-sm"><i class="icon-base bx bx-pencil icon-sm"></i> Edit Detail</button>
        <button type="button" v-if="isDetailEditing" @click="detailSave" class="btn btn-primary btn-sm me-2"><i class="icon-base bx bx-check icon-sm"></i> Simpan Detail</button>
        <button type="button" v-if="isDetailEditing" @click="cancelEditDetail" class="btn btn-secondary btn-sm"><i class="icon-base bx bx-cancel icon-sm"></i> Batal</button>
    </div>
</div>