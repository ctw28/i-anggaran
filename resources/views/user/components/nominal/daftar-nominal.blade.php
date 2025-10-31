<!-- Checkbox Pengaturan -->
<div v-if="isNominalEditing" class="form-check form-switch mb-2">
    <input class="form-check-input" type="checkbox" id="is_referensi_simpeg" v-model="isReferensiSimpeg">
    <label class="form-check-label" for="is_referensi_simpeg">
        Gunakan Referensi SIMPEG (untuk Nama, Golongan)
    </label>
</div>
<div v-if="isNominalEditing" class="form-check form-switch mb-4">
    <input class="form-check-input" type="checkbox" id="is_referensi_row1" v-model="isReferensiRow1">
    <label class="form-check-label" for="is_referensi_row1">
        Samakan dengan baris 1 (Untuk Jabatan, Jumlah dan Honor)
    </label>
</div>

<div>
    <!-- <div class="table-responsive"> -->
    <table class="table table-striped table-hover" id="nominal-table">
        <thead>
            <tr class="text-center">
                <th><span v-if="isNominalEditing">Urut</span></th>
                <th>No</th>
                <th>Nama</th>
                <th>Golongan</th>
                <th>Jabatan</th>
                <th>Jumlah</th>
                <th>Satuan</th>
                <th>Honor</th>
                <th>Total</th>
                <th>PPH</th>
                <th>Diterima</th>
                <th v-if="isNominalEditing">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(item, index) in dataNominal" :key="index">
                <td class="text-center">
                    <a v-if="isNominalEditing" href="#" @click.prevent="moveUp(dataNominal, index)"><i class="tf-icons bx bx-chevron-up"></i></a>
                    <a v-if="isNominalEditing" href="#" @click.prevent="moveDown(dataNominal, index)"><i class="tf-icons bx bx-chevron-down"></i></a>
                </td>
                <td class="text-center">@{{ index + 1 }}</td>
                <td style="position: relative;">
                    <!-- Input untuk mencari pegawai -->
                    <input
                        type="text"
                        v-model="searchQuery[index]"
                        @input="fetchPegawai(index)"
                        @focus="activeDropdown = index"
                        @blur="handleManualInput(index)"
                        placeholder="Cari Pegawai..."
                        :disabled="!isNominalEditing || isSaving"
                        class="form-control">

                    <!-- Dropdown hasil pencarian -->
                    <ul v-if="activeDropdown === index && searchResults[index]?.length" class="dropdown">
                        <li v-for="pegawai in searchResults[index]" :key="pegawai.nip"
                            @mousedown.prevent="selectPegawai(index, pegawai)">
                            @{{ pegawai.nip }} - @{{ pegawai.nama }}
                        </li>
                    </ul>
                </td>
                </td>
                <td>
                    <select v-model="item.golongan" @change="calculate(index)" :disabled="!isNominalEditing || isSaving" class="form-control">
                        <option value="">Pilih Golongan</option>
                        <option v-for="golongan in golonganList" :key="golongan" :value="golongan">
                            @{{ golongan }}
                        </option>
                    </select>
                </td>
                <td><input isNominalEditing v-model="item.jabatan" :disabled="!isNominalEditing || isSaving" class="form-control"></td>
                <td>
                    <input type="text" v-model="formattedDataNominal[index].jumlah"
                        @input="formatRibuan(dataNominal,index, 'jumlah', $event.target.value)" class="form-control" :disabled="!isNominalEditing || isSaving">
                </td>
                <td><input isNominalEditing v-model="item.satuan" :disabled="!isNominalEditing || isSaving" class="form-control"></td>
                <td>
                    <input type="text" v-model="formattedDataNominal[index].honor"
                        @input="formatRibuan(dataNominal, index, 'honor', $event.target.value)" class="form-control" :disabled="!isNominalEditing || isSaving">
                </td>
                <td>@{{ formattedDataNominal[index].total }}</td>
                <td>@{{ formattedDataNominal[index].pph }}</td>
                <td>@{{ formattedDataNominal[index].diterima }}</td>
                <td>
                    <button @click="deleteRow(dataNominal,index)" :disabled="!isNominalEditing || isSaving" class="btn btn-danger btn-sm"><i class="tf-icons bx bx-minus"></i></button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<div class="col-12 mt-3">
    <button v-if="isNominalEditing" @click="tambahBaris" class="btn btn-warning btn-sm mt-3">
        <i class="tf-icons bx bx-plus"></i> Tambah Baris
    </button>
</div>
<div class="col-12 mt-3 text-center">

    <!-- Tombol Edit -->
    <button v-if="!isNominalEditing" @click="toggleEdit('nominal')" class="btn btn-primary btn-sm">
        <i class="tf-icons bx bx-edit"></i>
        Edit Data Nominal
    </button>

    <!-- Tombol Simpan -->
    <button v-if="isNominalEditing" @click="saveNominal" :disabled="isSaving" class="btn btn-dark btn-sm me-2">
        <i class="tf-icons bx" :class="isSaving ? 'bx-loader bx-spin' : 'bx-save'"></i>
        @{{ isSaving ? 'Menyimpan...' : 'Simpan' }}
    </button>
    <a href="#" v-if="isNominalEditing || isSaving" @click.prevent="cancelEditing('nominal')">
        Batal Edit
    </a>
</div>