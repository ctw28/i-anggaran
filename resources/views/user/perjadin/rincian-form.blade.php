<h5 class="mb-3 section-title">Waktu dan Rincian Biaya Perjadin</h5>
<div class="mb-3">
    <div class="row">
        <div class="col-3">
            <label class="form-label" for="tanggal_pergi">Tanggal Pergi</label>
            <input type="date" class="form-control" id="tanggal_pergi" />

        </div>
        <div class="col-3">
            <label class="form-label" for="tanggal_pulang">Tanggal Pulang</label>
            <input type="date" class="form-control" id="tanggal_pulang" />
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
                            <input type="text" oninput="toNumber(this); hitung(this)" class="form-control nilai" value="0" id="uang_harian1" placeholder="Uang Harian">

                        </div>
                        <div class="col-2">
                            <input type="text" oninput="toNumber(this); hitung(this)" class="form-control nilai" value="0" id="uang_harian1_hari" placeholder="Jumlah Hari">

                        </div>
                        <div class="col-4" id="total">
                            Rp. 1.000.000
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Uang Harian 2</td>
                <td>
                    <div class="row">
                        <div class="col-4">
                            <input type="text" oninput="toNumber(this); hitung(this)" class="form-control nilai" value="0" id="uang_harian2" placeholder="Uang Harian 2">

                        </div>
                        <div class="col-2">
                            <input type="text" oninput="toNumber(this); hitung(this)" class="form-control nilai" value="0" id="uang_harian2_hari" placeholder="Jumlah Hari 2">

                        </div>
                        <div class="col-4" id="total">
                            Rp. 1.000.000
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Uang Representatif</td>
                <td>
                    <div class="row">
                        <div class="col-4">
                            <input type="text" oninput="toNumber(this); hitung(this)" class="form-control nilai" value="0" id="representatif" placeholder="Uang Representatif">

                        </div>
                        <div class="col-2">
                            <input type="text" oninput="toNumber(this); hitung(this)" class="form-control nilai" value="0" id="representatif_hari" placeholder="Jumlah Hari">

                        </div>
                        <div class="col-4" id="total">
                            Rp. 1.000.000
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Biaya Penginapan 1</td>
                <td>
                    <div class="row">
                        <div class="col-4">
                            <input type="text" oninput="toNumber(this); hitung(this)" class="form-control nilai" value="0" id="penginapan1" placeholder="Biaya Penginapan 1">

                        </div>
                        <div class="col-2">
                            <input type="text" oninput="toNumber(this); hitung(this)" class="form-control nilai" value="0" id="penginapan1_malam" placeholder="Jumlah Malam">

                        </div>
                        <div class="col-4" id="total">
                            Rp. 1.000.000
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Biaya Penginapan 2</td>
                <td>
                    <div class="row">
                        <div class="col-4">
                            <input type="text" oninput="toNumber(this); hitung(this)" class="form-control nilai" value="0" id="penginapan2" placeholder="Biaya Penginapan 2">

                        </div>
                        <div class="col-2">
                            <input type="text" oninput="toNumber(this); hitung(this)" class="form-control nilai" value="0" id="penginapan2_malam" placeholder="Jumlah Malam">

                        </div>
                        <div class="col-4" id="total">
                            Rp. 1.000.000
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Tiket Pergi</td>
                <td>
                    <div class="col-4">
                        <input type="text" oninput="toNumber(this)" class="form-control" value="0" id="tiket_pergi" placeholder="Tiket Pergi">
                    </div>
                </td>
            </tr>
            <tr>
                <td>Tiket Pulang</td>
                <td>
                    <div class="col-4">

                        <input type="text" oninput="toNumber(this)" class="form-control" value="0" id="tiket_pulang" placeholder="Tiket Pulang">
                    </div>
                </td>
            </tr>
            <tr>
                <td>Transport 2</td>
                <td>
                    <div class="col-4">

                        <input type="text" oninput="toNumber(this)" class="form-control" value="0" id="transport_kota_2" placeholder="Transport 2">
                    </div>
                </td>
            </tr>
            <tr>
                <td>Kantor - B/S/T** (PP)</td>
                <td>
                    <div class="col-4">

                        <input type="text" oninput="toNumber(this)" class="form-control" value="0" id="kantor_bst" placeholder="Kantor - B/S/T** (PP)">
                    </div>
                </td>
            </tr>
            <tr>
                <td>B/S/T** - Lokasi (PP)</td>
                <td>
                    <div class="col-4">

                        <input type="text" oninput="toNumber(this)" class="form-control" value="0" id="transport2" placeholder="B/S/T** - Lokasi (PP)">
                    </div>
                </td>
            </tr>
            <tr>
                <td>Airport Tax Pergi</td>
                <td>
                    <div class="col-4">

                        <input type="text" oninput="toNumber(this)" class="form-control" value="0" id="airport_tax_pergi" placeholder="Airport Tax Pergi">
                    </div>
                </td>
            </tr>
            <tr>
                <td>Airport Tax Pulang</td>
                <td>
                    <div class="col-4">

                        <input type="text" oninput="toNumber(this)" class="form-control" value="0" id="airport_tax_pulang" placeholder="Airport Tax Pulang">
                    </div>
                </td>
            </tr>
        </tbody>

    </table>
    <button type="button" onclick="saveRincian()" class="btn btn-dark btn-sm mb-3">Simpan Rincian</button>

</div>