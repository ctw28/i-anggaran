<table class="table table-striped">
    <thead>
        <th>No</th>
        <th>Item</th>
        <th>Aksi</th>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>Checklist</td>
            <td><button @click="cetakPerjadin('checklist')" class="btn btn-primary btn-sm">Cetak</button></td>
        </tr>
        <tr>
            <td>2</td>
            <td>Real Cost</td>
            <td><button @click="cetakPerjadin('realcost')" class="btn btn-primary btn-sm">Cetak</button></td>
        </tr>
        <tr>
            <td>3</td>
            <td>Rincian</td>
            <td><button @click="cetakPerjadin('rincian')" class="btn btn-primary btn-sm">Cetak</button></td>
        </tr>
        <tr>
            <td>4</td>
            <td>Kwitansi</td>
            <td><button @click="cetakPerjadin('kwitansi')" class="btn btn-primary btn-sm">Cetak</button></td>
        </tr>
    </tbody>
</table>