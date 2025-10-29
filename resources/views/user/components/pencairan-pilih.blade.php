<div class="row mb-3">
    <div class="col-sm-12">
        <select class="form-control" v-model="selectedPencairanId">
            <option value="">Pilih Pencairan</option>
            <option v-for="pencairan in pencairanList" :key="pencairan.id" :value="pencairan.id">
                @{{ pencairan.pencairan_nama }} ( @{{ pencairan.kode_akun.kode }} - @{{ pencairan.kode_akun.nama_akun }})
            </option>
        </select>
        <button type="button" @click="gotoPencairan" class="btn btn-dark btn-sm mt-2">Beralih Pencairan</button>
    </div>
</div>