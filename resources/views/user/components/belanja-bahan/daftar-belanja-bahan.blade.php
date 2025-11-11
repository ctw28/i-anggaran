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

<h4 class="mt-5">Daftar Belanja Bahan</h4>
<small class="text-muted">
    <ul class="mb-2">
        <li><b>PPN</b>: 11%</li>
        <li><b>PPh 22</b>: 1,5% (ada NPWP) / 3% (tidak ada NPWP)</li>
        <li><b>PPh 23</b>: 2% (ada NPWP) / 4% (tidak ada NPWP)</li>
    </ul>
</small>
<div class="table-responsive">
    <table class="table table-striped table-hover" id="belanja-table">
        <thead>
            <tr class="text-center">
                <th>Urut</th>
                <th>No</th>
                <th>Item</th>
                <th>Qty</th>
                <th>Satuan</th>
                <th>Total</th>
                <th>PPN</th>
                <th>PPh 22</th>
                <th>PPh 23</th>
                <th>Nilai PPN</th>
                <th>Nilai PPh</th>
                <th>Hapus</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(item, index) in dataBelanjaBahan" :key="index">
                <td class="text-center">
                    <a v-if="isBelanjaEditing" href="#" @click.prevent="moveUp(dataBelanjaBahan, index)">
                        <i class="tf-icons bx bx-chevron-up"></i>
                    </a>
                    <a v-if="isBelanjaEditing" href="#" @click.prevent="moveDown(dataBelanjaBahan, index)">
                        <i class="tf-icons bx bx-chevron-down"></i>
                    </a>
                </td>
                <td class="text-center">@{{ index + 1 }}</td>
                <td><input v-model="item.item" :disabled="!isBelanjaEditing || isSaving" class="form-control"></td>
                <td><input v-model.number="item.qty" @input="updateTotal(index)" :disabled="!isBelanjaEditing || isSaving" class="form-control"></td>
                <td><input v-model="item.harga_satuan" @input="updateTotal(index)" :disabled="!isBelanjaEditing || isSaving" class="form-control"></td>
                <td>
                    <input
                        v-model="formattedBelanja[index].nilai"
                        :disabled="!isBelanjaEditing || isSaving"
                        class="form-control"
                        @input="formatRibuan(dataBelanjaBahan, index, 'nilai', $event.target.value)">
                </td>

                <!-- Checkbox Pajak -->
                <td class="text-center">
                    <input type="checkbox" v-model="item.isPpn" :disabled="!isBelanjaEditing || isSaving"
                        @change="calculateBelanjaBahan(index)">
                </td>
                <td class="text-center">
                    <input type="checkbox" v-model="item.isPph22" :disabled="!isBelanjaEditing || isSaving"
                        @change="calculateBelanjaBahan(index)">
                </td>
                <td class="text-center">
                    <input type="checkbox" v-model="item.isPph23" :disabled="!isBelanjaEditing || isSaving"
                        @change="calculateBelanjaBahan(index)">
                </td>

                <!-- Nilai PPN / PPH hasil hitung -->
                <td><input v-model="formattedBelanja[index].ppn" disabled class="form-control text-end"></td>
                <td><input v-model="formattedBelanja[index].pph" disabled class="form-control text-end"></td>

                <td>
                    <button :disabled="!isBelanjaEditing || isSaving" @click="deleteRow(dataBelanjaBahan,index)" class="btn btn-danger btn-sm">
                        <i class="tf-icons bx bx-minus"></i>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>

</div>
<div class="col-sm-12">
    <button @click="tambahBelanjaBahan" v-if="isBelanjaEditing" class="btn btn-warning btn-sm mt-3"><i class="tf-icons bx bx-plus"></i> Tambah Baris</button>
</div>

<div class="col-12 mt-3 text-center">
    <button v-if="!isBelanjaEditing" @click="toggleEdit('belanja')" class="btn btn-primary btn-sm">
        <i class="tf-icons bx bx-edit"></i>
        Edit Data Belanja Bahan
    </button>

    <!-- Tombol Simpan -->
    <button v-if="isBelanjaEditing" @click="saveBelanjaBahan" :disabled="isSaving" class="btn btn-dark btn-sm">
        <i class="tf-icons bx" :class="isSaving ? 'bx-loader bx-spin' : 'bx-save'"></i>
        @{{ isSaving ? 'Menyimpan...' : 'Simpan' }}
    </button>
    <button v-if="isBelanjaEditing" @click="cancelEditing('belanja')" :disabled="isSaving" class="btn btn-danger btn-sm">
        <i class="tf-icons bx bx-cancel-outline"></i>
        Batal Edit
    </button>
</div>