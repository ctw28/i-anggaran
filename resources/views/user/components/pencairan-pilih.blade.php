<div class="card mb-3">
    <div class="card-body">
        <label class="form-label fw-bold">Beralih ke Pencairan Lain</label>

        <select class="form-control" v-model="selectedPencairanId" @change="gotoPencairan">
            <option disabled value="">— Pilih Pencairan —</option>
            <option v-for="pencairan in pencairanList" :key="pencairan.id" :value="pencairan.id">
                @{{ pencairan.pencairan_nama }} ( @{{ pencairan.kode_akun.kode }} - @{{ pencairan.kode_akun.nama_akun }})
            </option>
        </select>
    </div>
</div>