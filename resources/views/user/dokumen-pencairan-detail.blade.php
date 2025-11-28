@extends('template')

@section('style')
<!-- Vue Select CDN -->
<link rel="stylesheet" href="https://unpkg.com/vue-select@3.20.2/dist/vue-select.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<style>
    [v-cloak] {
        display: none;
    }

    .dropdown {
        position: absolute;
        /* width: 100%; */
        background: white;
        border: 1px solid #ccc;
        max-height: 200px;
        /* overflow-y: auto; */
        /* overflow-x: auto; */
        /* z-index: 10000; */
        padding: 0;
        margin: 0;
        list-style: none;
    }

    .dropdown li {
        /* position: absolute; */
        z-index: 100000;
        overflow-y: auto;
        width: 100%;

        padding: 8px;
        cursor: pointer;
    }

    .dropdown li:hover {
        background: #f0f0f0;
    }

    tr td {
        padding-left: 2px !important;
        padding-right: 2px !important;
    }

    /* Tabel umum */
    table {
        width: 100%;
        border-collapse: collapse;
    }

    /* Kolom No (kecil saja) */
    #nominal-table th:first-child(1),
    #nominal-table td:first-child(1) {
        width: 10px;
        text-align: center;
    }

    #nominal-table th:first-child(2),
    #nominal-table td:first-child(2) {
        width: 10px;
        text-align: center;
    }

    /* Kolom Nama (paling panjang) */
    #nominal-table th:nth-child(3),
    #nominal-table td:nth-child(3) {
        width: 2500px;
        /* Bisa lebih panjang */
    }

    /* Kolom Golongan (cukup untuk NON-PNS) */
    #nominal-table th:nth-child(4),
    #nominal-table td:nth-child(4) {
        width: 100px;
    }

    /* Kolom Jabatan (agak panjang) */
    #nominal-table th:nth-child(5),
    #nominal-table td:nth-child(5) {
        width: 150px;
    }

    /* Kolom Jumlah (hanya 1-2 digit) */
    #nominal-table th:nth-child(6),
    #nominal-table td:nth-child(6) {
        width: 10px;
        text-align: center;
    }

    /* Kolom Satuan (maks 4 karakter: OH, OJ, dll) */
    #nominal-table th:nth-child(7),
    #nominal-table td:nth-child(7) {
        width: 80px;
        text-align: center;
    }

    /* Kolom Honor, Total, pph, Diterima (cukup lebar agar angka terbaca) */
    #nominal-table th:nth-child(8),
    #nominal-tabletd:nth-child(8),
    /* Honor */
    #nominal-table th:nth-child(9),
    #nominal-table td:nth-child(9),
    /* Total */
    #nominal-table th:nth-child(10),
    #nominal-table td:nth-child(10),
    /* pph */
    #nominal-table th:nth-child(11),
    #nominal-table td:nth-child(11) {
        /* Diterima */
        width: 120px;
        text-align: center;

    }

    /* Inputan dalam tabel */
    td input,
    td select {
        width: 100%;
        padding: 5px;
        box-sizing: border-box;
    }

    /* Untuk input Nama agar lebih panjang */
    #nominal-table td:nth-child(3) input {
        width: 100%;
    }

    /* Inputan Golongan */
    #nominal-table td:nth-child(4) select {
        width: 100%;
    }

    /* Input Jumlah & Satuan (agar lebih kecil) */
    #nominal-table td:nth-child(6) input,
    #nominal-table td:nth-child(7) input {
        width: 100%;
        text-align: center;
    }

    /* Dropdown Nama (Pastikan dropdown tidak terbatas lebarnya) */
    ul.dropdown {
        position: absolute;
        width: 250px;
        /* Bisa lebih panjang dari kolom */
        max-height: 200px;
        overflow-y: auto;
        background: white;
        border: 1px solid #ccc;
        z-index: 1000;
    }
</style>
@endsection
@section('content')
<div id="app" v-cloak>
    <!-- <p v-if="loading">Memuat data...</p> -->
    @include('user/components/pencairan-pilih')
    @include('user/components/pencairan-info')

    <div class="col-12 mt-3">
        <div class="nav-align-top nav-tabs-shadow">
            <ul class="nav nav-tabs" role="tablist">
                @include('user/components/tab-menu')
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="navs-detail" role="tabpanel">
                    <div v-if="isFormNominal" class="row">
                        @include('user/components/detail-form')
                    </div>
                    <div v-if="isFormPerjadin" class="row">
                        @include('user/components/perjadin/detail-form')
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-item-pencairan" role="tabpanel">
                    <div v-if="isNominal" class="row">
                        @include('user/components/nominal/daftar-nominal')
                    </div>
                    <div v-if="isBelanjaBahan" class="row">
                        @include('user/components/belanja-bahan/daftar-belanja-bahan')
                    </div>
                    <div v-if="isPerjadin" class="row">
                        @include('user/components/perjadin/daftar-anggota')
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-npwp" role="tabpanel">
                    @include('user/components/belanja-bahan/belanja-bahan-npwp')
                </div>
                <div class="tab-pane fade" id="navs-cetak" role="tabpanel">
                    @include('user/components/cetak-preview')
                </div>
                <div class="tab-pane fade" id="navs-cetak2" role="tabpanel">
                    @include('user/components/cetak-preview2')
                </div>
                <div class="tab-pane fade" id="navs-cetak-perjadin" role="tabpanel">
                    @include('user/components/perjadin/cetak-list')
                </div>
                <div class="tab-pane fade" id="navs-rincian-perjadin" role="tabpanel">
                    @include('user/components/perjadin/rincian-biaya')
                </div>

            </div>
            @include('user/components/belanja-bahan/belanja-bahan-modals')
        </div>
    </div>
    <!-- diletakkan di sini agar tampil sesuai modals rincian perjadin -->
</div>

@endsection
@section('scripts')
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script src="https://unpkg.com/vue-select@3.20.2"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<!-- pisahkan koding methods vue -->
<script src="{{ asset('js/dokumen-pencairan/methods/pencairan.js?v=1') }}"></script>
<script src="{{ asset('js/dokumen-pencairan/methods/nominal.js?v=1') }}"></script>
<script src="{{ asset('js/dokumen-pencairan/methods/belanja-bahan.js?v=1') }}"></script>
<script src="{{ asset('js/dokumen-pencairan/methods/perjadin.js?v=3') }}"></script>
<script src="{{ asset('js/dokumen-pencairan/methods/lainnya.js?v=1') }}"></script>
<script src="{{ asset('js/dokumen-pencairan/methods/spi.js') }}"></script>
<!-- pisahkan koding default vue -->
<script src="{{ asset('js/dokumen-pencairan/default-data.js?v=1') }}"></script>
<!-- pisahkan koding computed vue -->
<script src="{{ asset('js/dokumen-pencairan/computed.js') }}"></script>
<!-- pisahkan koding watch vue -->
<script src="{{ asset('js/dokumen-pencairan/watch.js') }}"></script>

<script>
    const {
        createApp
    } = Vue;
    let path = window.location.pathname;
    let segments = path.split('/');
    let id = segments[2];

    createApp({
        data() {
            return {
                ...getDefaultState(),
                urls: {
                    urlShowPencairan: "{{route('pencairan.show',':id')}}",
                    urlCetakNominal: "{{route('cetak.nominal',':id')}}",
                    urlCetakNominal: "{{route('cetak.nominal',':id')}}",
                    urlCetakBelanja: "{{route('cetak.belanja',':id')}}",
                    urlGoTo: "{{ route('dokumen-pencairan.detail', ':id') }}",
                    urlCetak: "{{route('cetak',[':id',':kategori',':jenis'])}}",
                    urlPejabat: "{{ route('pejabat.data', [':id', ':type']) }}",
                    urlKirimSPI: "{{route('spi.daftar-usulan.store')}}",
                    urlSaveNominal: "{{ route('daftar.nominal.store') }}",
                    urlNpwpUpdate: "{{route('npwp.update')}}",
                    urlShowNominal: "{{route('daftar.nominal.get',[':id']) }}",
                    urlLoadBelanjaBahan: "{{route('belanja.bahan.get',[':id']) }}",
                    urlStoreBelanjaBahan: "{{ route('belanja.bahan.store') }}",
                    urlShowNpwp: "{{route('npwp.get',':id')}}",
                    urlShowPerjadin: "{{route('perjadin.get',[':id']) }}",
                    urlStorePerjadin: "{{route('perjadin.store')}}",
                    urlSaveAnggotaPerjadin: "{{route('perjadin.anggota.store')}}",
                    urlLoadAnggotaPerjadin: "{{route('perjadin.anggota.index',':id')}}",
                    urlstoreRincian: "{{route('perjadin.rincian.store')}}",
                    urlloadRincian: "{{route('perjadin.anggota.show',':id')}}",
                    urlLoadRealCost: "{{route('perjadin.realcost.index',':id')}}",
                    urlStoreRealCost: "{{route('perjadin.realcost.store')}}",
                }
            }
        },

        computed: Object.assign({},
            pencairanComputed,
        ),
        methods: Object.assign({},
            pencairanMethods,
            nominalMethods,
            perjadinMethods,
            belanjaBahanMethods,
            SPIMethods,
            lainnyaMethods,
        ),
        watch: Object.assign({},
            pencairanWatch,
        ),
        mounted() {
            this.getPencairan();
            this.showPencairan();
            this.fetchJabatan('ppk')
            this.fetchJabatan('bendahara_pengeluaran')
        }
    }).mount("#app");
</script>

@endsection