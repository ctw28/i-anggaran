<div class="col-12 mb-3">
    <button @click="openEditBelanjaBahanModal" class="btn btn-primary btn-sm">
        <i class="tf-icons bx bx-edit"></i>
        Edit Daftar Belanja Bahan
    </button>
</div>

<div class="table-responsive" style="overflow-x:auto; white-space:nowrap;">
    <table class="table table-striped table-hover" id="belanja-table">
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>Item</th>
                <th>Qty</th>
                <th>Satuan</th>
                <th>Total</th>
                <th>Nilai PPN</th>
                <th>Nilai PPh</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(item, index) in dataBelanjaBahan" :key="index">

                <td class="text-center">@{{ index + 1 }}</td>
                <td>@{{item.item}}</td>
                <td class="text-center">@{{item.qty}}</td>
                <td class="text-center">@{{formatRupiah(item.harga_satuan)}}</td>
                <td class="text-center">@{{formatRupiah(item.nilai)}}</td>
                <td class="text-center">@{{formatRupiah(item.ppn)}}</td>
                <td class="text-center">@{{formatRupiah(item.pph)}}</td>
            </tr>
        </tbody>
    </table>

</div>




<!-- <div class="col-12 mt-3 text-center">
    <button v-if="!isBelanjaEditing" @click="toggleEdit('belanja')" class="btn btn-primary btn-sm">
        <i class="tf-icons bx bx-edit"></i>
        Edit Data Belanja Bahan
    </button>

    <button v-if="isBelanjaEditing" @click="saveBelanjaBahan" :disabled="isSaving" class="btn btn-dark btn-sm me-2">
        <i class="tf-icons bx" :class="isSaving ? 'bx-loader bx-spin' : 'bx-save'"></i>
        @{{ isSaving ? 'Menyimpan...' : 'Simpan' }}
    </button>
    <button v-if="isBelanjaEditing" @click="cancelEditing('belanja')" :disabled="isSaving" class="btn btn-danger btn-sm">
        <i class="tf-icons bx bx-cancel-outline"></i>
        Batal Edit
    </button>
</div> -->