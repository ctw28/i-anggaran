<h5>Daftar Dokumen</h5>
<button type="button" @click="cetakPerjadin('nominatif')" class="btn btn-dark btn-sm"><i class="bx bx-printer"></i> Cetak Nominatif Perjadin</button>
<hr>
<div class="col-sm-12">
    <h5>Pilih Anggota Perjadin</h5>
    <select class="form-control" v-model="selectedAnggotaIndex" @change="changeAnggota">
        <option value="">Pilih Anggota</option>
        <option v-for="(anggota, index) in perjadinAnggota" :key="anggota.id" :value="index">
            @{{anggota.nip }} - @{{anggota.nama}}
        </option>
    </select>
</div>
<table class="table table-striped">
    <thead>
        <th class="text-center">No</th>
        <th>Item</th>
        <th>Aksi</th>
    </thead>
    <tbody>
        <tr>
            <td class="text-center">1</td>
            <td>Checklist</td>
            <td><button @click="cetakPerjadin('checklist')" class="btn btn-primary btn-sm">Cetak</button></td>
        </tr>
        <tr>
            <td class="text-center">2</td>
            <td>Real Cost</td>
            <td><button @click="cetakPerjadin('realcost')" class="btn btn-primary btn-sm">Cetak</button></td>
        </tr>
        <tr>
            <td class="text-center">3</td>
            <td>Rincian</td>
            <td><button @click="cetakPerjadin('rincian')" class="btn btn-primary btn-sm">Cetak</button></td>
        </tr>
        <tr>
            <td class="text-center">4</td>
            <td>Kwitansi</td>
            <td><button @click="cetakPerjadin('kwitansi')" class="btn btn-primary btn-sm">Cetak</button></td>
        </tr>
    </tbody>
</table>