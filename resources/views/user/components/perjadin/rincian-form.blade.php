<h5 class="mb-3 section-title">Waktu dan Rincian Biaya Perjadin</h5>
<div class="mb-3">
    <div class="row">
        <div class="col-3">
            <label class="form-label" for="tanggal_pergi">Tanggal Pergi</label>
            <input type="date" class="form-control" v-model="rincianPerjadin.tanggal_pergi" />
        </div>
        <div class="col-3">
            <label class="form-label" for="tanggal_pulang">Tanggal Pulang</label>
            <input type="date" class="form-control" v-model="rincianPerjadin.tanggal_pulang" />
        </div>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped" id="tabel-rincian">
        <thead>
            <th>Jenis Pengeluaran</th>
            <th>Biaya</th>
        </thead>
        <tbody>
            <tr>
                <td>Uang Harian 1</td>
                <td>
                    <div class="row">
                        <div class="col-4">
                            <input type="text" @input="formatRibuan(rincianPerjadin, 'non-array', 'uang_harian1', $event.target.value)" class="form-control nilai" value="0" v-model="formattedRincian['uang_harian1']" placeholder="Uang Harian">
                        </div>
                        <div class="col-2">
                            <input type="text" @input="formatRibuan(rincianPerjadin, 'non-array', 'uang_harian1_hari', $event.target.value)" class="form-control nilai" value="0" v-model="formattedRincian['uang_harian1_hari']" placeholder="Jumlah Hari">
                        </div>
                        <div class="col-4" id="total">
                            Rp. @{{ totalUangHarian1 }}
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Uang Harian 2</td>
                <td>
                    <div class="row">
                        <div class="col-4">
                            <input type="text" @input="formatRibuan(rincianPerjadin, 'non-array', 'uang_harian2', $event.target.value)" class="form-control nilai" value="0" v-model="formattedRincian['uang_harian2']" placeholder="Uang Harian 2">
                        </div>
                        <div class="col-2">
                            <input type="text" @input="formatRibuan(rincianPerjadin, 'non-array', 'uang_harian2_hari', $event.target.value)" class="form-control nilai" value="0" v-model="formattedRincian['uang_harian2_hari']" placeholder="Jumlah Hari 2">
                        </div>
                        <div class="col-4" id="total">
                            Rp. @{{ totalUangHarian2 }}
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Uang Representatif</td>
                <td>
                    <div class="row">
                        <div class="col-4">
                            <input type="text" @input="formatRibuan(rincianPerjadin, 'non-array', 'representatif', $event.target.value)" class="form-control nilai" value="0" v-model="formattedRincian['representatif']" placeholder="Uang Representatif">
                        </div>
                        <div class="col-2">
                            <input type="text" @input="formatRibuan(rincianPerjadin, 'non-array', 'representatif_hari', $event.target.value)" class="form-control nilai" value="0" v-model="formattedRincian['representatif_hari']" placeholder="Jumlah Hari">
                        </div>
                        <div class="col-4" id="total">
                            Rp. @{{ totalUangrepsentatif }}
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Biaya Penginapan 1</td>
                <td>
                    <div class="row">
                        <div class="col-4">
                            <input type="text" @input="formatRibuan(rincianPerjadin, 'non-array', 'penginapan1', $event.target.value)" class="form-control nilai" value="0" v-model="formattedRincian['penginapan1']" placeholder="Biaya Penginapan 1">
                        </div>
                        <div class="col-2">
                            <input type="text" @input="formatRibuan(rincianPerjadin, 'non-array', 'penginapan1_malam', $event.target.value)" class="form-control nilai" value="0" v-model="formattedRincian['penginapan1_malam']" placeholder="Jumlah Malam">
                        </div>
                        <div class="col-4" id="total">
                            Rp. @{{ totalUangPenginapan1 }}
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Biaya Penginapan 2</td>
                <td>
                    <div class="row">
                        <div class="col-4">
                            <input type="text" @input="formatRibuan(rincianPerjadin, 'non-array', 'penginapan2', $event.target.value)" class="form-control nilai" value="0" v-model="formattedRincian['penginapan2']" placeholder="Biaya Penginapan 2">

                        </div>
                        <div class="col-2">
                            <input type="text" @input="formatRibuan(rincianPerjadin, 'non-array', 'penginapan2_malam', $event.target.value)" class="form-control nilai" value="0" v-model="formattedRincian['penginapan2_malam']" placeholder="Jumlah Malam">

                        </div>
                        <div class="col-4" id="total">
                            Rp. @{{ totalUangPenginapan2 }}
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Tiket Pergi</td>
                <td>
                    <div class="col-4">
                        <input type="text" @input="formatRibuan(rincianPerjadin, 'non-array', 'tiket_pergi', $event.target.value)" class="form-control" value="0" v-model="formattedRincian['tiket_pergi']" placeholder="Tiket Pergi">
                    </div>
                </td>
            </tr>
            <tr>
                <td>Tiket Pulang</td>
                <td>
                    <div class="col-4">
                        <input type="text" @input="formatRibuan(rincianPerjadin, 'non-array', 'tiket_pulang', $event.target.value)" class="form-control" value="0" v-model="formattedRincian['tiket_pulang']" placeholder="Tiket Pulang">
                    </div>
                </td>
            </tr>
            <tr>
                <td>Transport 2</td>
                <td>
                    <div class="col-4">
                        <input type="text" @input="formatRibuan(rincianPerjadin, 'non-array', 'transport_kota_2', $event.target.value)" class="form-control" value="0" v-model="formattedRincian['transport_kota_2']" placeholder="Transport 2">
                    </div>
                </td>
            </tr>
            <tr>
                <td>Kantor - B/S/T** (PP)</td>
                <td>
                    <div class="col-4">
                        <input type="text" @input="formatRibuan(rincianPerjadin, 'non-array', 'kantor_bst', $event.target.value)" class="form-control" value="0" v-model="formattedRincian['kantor_bst']" placeholder="Kantor - B/S/T** (PP)">
                    </div>
                </td>
            </tr>
            <tr>
                <td>B/S/T** - Lokasi (PP)</td>
                <td>
                    <div class="col-4">
                        <input type="text" @input="formatRibuan(rincianPerjadin, 'non-array', 'transport2', $event.target.value)" class="form-control" value="0" v-model="formattedRincian['transport2']" placeholder="B/S/T** - Lokasi (PP)">
                    </div>
                </td>
            </tr>
            <tr>
                <td>Airport Tax Pergi</td>
                <td>
                    <div class="col-4">
                        <input type="text" @input="formatRibuan(rincianPerjadin, 'non-array', 'airport_tax_pergi', $event.target.value)" class="form-control" value="0" v-model="formattedRincian['airport_tax_pergi']" placeholder="Airport Tax Pergi">
                    </div>
                </td>
            </tr>
            <tr>
                <td>Airport Tax Pulang</td>
                <td>
                    <div class="col-4">
                        <input type="text" @input="formatRibuan(rincianPerjadin, 'non-array', 'airport_tax_pulang', $event.target.value)" class="form-control" value="0" v-model="formattedRincian['airport_tax_pulang']" placeholder="Airport Tax Pulang">
                    </div>
                </td>
            </tr>
        </tbody>

    </table>
    <button type="button" @click="storeRincian" class="btn btn-dark btn-sm mb-3">Simpan Rincian</button>

</div>
<!-- <button type="button" onclick="saveRealCost()" class="btn btn-dark btn-sm mb-3">Simpan</button> -->
<h5 class="mb-3 section-title">Real Cost</h5>

<div class="table-responsive">

    <table class="table table-striped">
        <thead>
            <th>Aksi</th>
            <th>Item / Uraian</th>
            <th>Jumlah</th>
            <thead>Hapus</th>
            </thead>
        <tbody id="tabel-real-cost">

        </tbody>

    </table>
    <button type="button" @click="storeRealCost" class="btn btn-primary btn-sm mb-3">Tambah Real Cost</button>
</div>