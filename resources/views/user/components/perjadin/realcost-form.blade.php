<h5 class="mb-3 section-title">Riilcost</h5>

<div class="table-responsive">
    <!-- Tabel Read Only -->
    <table class="table table-striped align-middle" v-if="!isEditingRealCost">
        <thead class="table-light">
            <tr>
                <th class="text-center">#</th>
                <th>Item / Uraian</th>
                <th>Jumlah (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(rc, index) in realCostsAnggota" :key="rc.id">
                <td class="text-center">@{{ index + 1 }}</td>
                <td>@{{ rc.item }}</td>
                <td>@{{ formatRupiah(rc.nilai) }}</td>
            </tr>
        </tbody>
    </table>
    <!-- Tombol -->
    <button type="button"
        v-if="!isEditingRealCost"
        @click="editRealCost"
        class="btn btn-warning btn-sm mb-2">
        Edit Real Cost
    </button>
    <!-- Tombol Mode Edit -->
    <div v-if="isEditingRealCost" class="mb-2">
        <button class="btn btn-success btn-sm me-2" @click="storeRealCost">
            Simpan
        </button>
        <button class="btn btn-secondary btn-sm" @click="cancelRealCost">
            Batal
        </button>
    </div>

    <!-- Tabel Edit -->
    <table class="table table-bordered align-middle" v-if="isEditingRealCost">
        <thead class="table-light">
            <tr>
                <th class="text-center">#</th>
                <th style="width: 40%">Item / Uraian</th>
                <th class="text-end">Jumlah</th>
                <th class="text-center">Hapus</th>
            </tr>
        </thead>

        <tbody>
            <tr v-for="(rc, index) in realCostsAnggota" :key="index">
                <td class="text-center">@{{ index + 1 }}</td>
                <td>
                    <input type="text" v-model="rc.item">
                </td>
                <td>
                    <input type="number" v-model.number="rc.nilai">
                </td>
                <!-- Hapus Row -->
                <td class="text-center">
                    <button class="btn btn-danger btn-xxs"
                        @click="realCostsAnggota.splice(index, 1)">
                        <i class="bx bx-trash"></i>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- Tambah Baris -->
    <button v-if="isEditingRealCost"
        type="button"
        @click="addRealCostRow"
        class="btn btn-primary btn-sm mt-2">
        +
    </button>

</div>