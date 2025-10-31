@extends('template')

@section('style')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<style>
    [v-cloak] {
        display: none;
    }

    #rpd-table th:nth-child(2) {
        max-width: 100px;
    }

    #rpd-data tr td {
        padding: 0;
    }

    #rpd-data tr td input {
        padding: 2px;
    }
</style>
@endsection
@section('content')
<div id="app" v-cloak>
    <div class="col-lg-12 mb-4 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-sm-12">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Daftar Kegiatan Tahun Anggaran @{{tahun_anggaran}}</h5>
                        <div v-if="!isKegiatanTambah && !isKegiatanEdit" class="mb-3">
                            <button @click="tambah" class="btn btn-primary btn-sm me-2"><i class="tf-icons bx bx-plus"></i> Kegiatan</button>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#importModal"><i class="tf-icons bx bx-import"></i> Import Kegiatan (.xls)</button>
                        </div>
                        <div v-if="isKegiatanTambah || isKegiatanEdit">
                            <h3>Form Tambah Kegiatan</h3>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <form @submit.prevent="simpan">
                                        <label class="form-label">Sub Kegiatan</label>
                                        <input class="form-control" placeholder="Contoh: 2132.BGC.002.051.MN" v-model="sub_kegiatan_kode" type="text" required="required">
                                        <label class="form-label">Nama Kegiatan</label>
                                        <textarea class="form-control" placeholder="Isi Nama Kegiatan" v-model="kegiatan.kegiatan_nama" required="required"></textarea>
                                        <label class="form-label">Pagu Kegiatan</label>
                                        <input
                                            class="form-control"
                                            placeholder="Isi Pagu Kegiatan"
                                            :value="formatRupiah(kegiatan.jumlah_biaya)"
                                            @input="kegiatan.jumlah_biaya = unformatRupiah($event.target.value)"
                                            type="text"
                                            required /> <label class="form-label">Sumber Dana</label>
                                        <select class="form-control" v-model="kegiatan.sumber_dana" required="required">
                                            <option value="">Pilih Sumber Dana</option>
                                            <option value="RM">RM</option>
                                            <option value="PNBP">PNBP</option>
                                        </select>
                                        <div class="mt-3">
                                            <button class='btn btn-primary btn-sm me-2'>
                                                <span v-if="!isKegiatanEdit">Simpan</span>
                                                <span v-else><i class="icon-base bx bx-pencil me-1"></i> Update</span></button>
                                            <button class='btn btn-danger btn-sm' @click='batalTambah'>Batal</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="data-table">
                                <thead class="text-center align-middle">
                                    <th rowspan="2">No</th>
                                    <th rowspan="2">Program</th>
                                    <th rowspan="2">Kode Akun</th>
                                    <th rowspan="2">Pagu</th>
                                    <th rowspan="2">Aksi</th>
                                </thead>
                                <tbody>
                                    <tr v-if="loading">
                                        <td colspan="6" class="text-center">Memuat data...</td>
                                    </tr>
                                    <tr v-if="kegiatanData.length === 0">
                                        <td colspan="6" class="text-center text-muted">Kegiatan belum ditambahkan,silahkan tambahkan kegiatan / import kegiatan</td>
                                    </tr>
                                    <tr v-else v-for="(item, index) in kegiatanData" :key="index">
                                        <td class="text-center">@{{index+1}}</td>
                                        <td>@{{item.kegiatan_nama}}</td>
                                        <td>@{{item.sub_kegiatan_kode1}}.@{{item.sub_kegiatan_kode2}}.@{{item.sub_kegiatan_kode3}}.@{{item.sub_kegiatan_kode4}}.@{{item.sub_kegiatan_kode5}}</td>
                                        <td>Rp. @{{formatRupiah(item.jumlah_biaya)}} (@{{item.sumber_dana}})</td>
                                        <td>
                                            <button :disabled="isKegiatanTambah || isKegiatanEdit" class="btn btn-sm btn-warning me-1" @click="edit(index)"><i class="tf-icons bx bx-pencil"></i></button>
                                            <button :disabled="isKegiatanTambah || isKegiatanEdit" class="btn btn-sm btn-danger" @click="hapus(index)"><i class="tf-icons bx bx-trash"></i></button>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="importModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title " id="modalFullTitle">Import Kegiatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12 mb-3">
                        <p>sebelum import silahkan download format format import kegiatan <a class="btn btn-secondary btn-sm" href="{{asset('/')}}assets/format-import-kegiatan-juara.xlsx">Download format di sini!</a></p>
                        <label for="dipa_pagu" class="form-label">Upload File di Sini (.xls)</label>
                        <input type="file" class="form-control" id="file_import" @change="handleFileUpload">
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="import-table">
                            <thead class="align-middle text-center text-bold">
                                <tr>
                                    <th>No</th>
                                    <th>Sub Kegiatan</th>
                                    <th>Kegiatan / Program</th>
                                    <th>Pagu</th>
                                    <th>Sumber Dana</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(row, index) in rows_import_kegiatan" :key="index" :class="{'table-danger': row.status === false,'table-success': row.status === true}">
                                    <td><input class="form-control" v-model="row.no" /></td>
                                    <td><input class="form-control" v-model="row.sub_kegiatan" /></td>
                                    <td><input class="form-control" v-model="row.kegiatan_nama" /></td>
                                    <td><input class="form-control" :value="formatRupiah(row.jumlah_biaya)"
                                            @input="row.jumlah_biaya = unformatRupiah($event.target.value)" /></td>
                                    <td><input class="form-control" v-model="row.sumber_dana" /></td>
                                    <td>@{{row.status_message}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <button v-if="rows_import_kegiatan.length > 0"
                            type="button" @click="simpanSemuaImport" class="btn btn-primary">Import Kegiatan</button>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Keluar</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.17.2/dist/xlsx.full.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script src="https://unpkg.com/vue-select@3.20.2"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script>
    const {
        createApp
    } = Vue;

    createApp({
        data() {
            return {
                tahun_anggaran: JSON.parse(localStorage.getItem('tahun_anggaran'))?.tahun,
                loading: false,
                isKegiatanTambah: false,
                isKegiatanEdit: false,
                kegiatanData: [],
                sub_kegiatan_kode: "",
                kegiatan: {
                    organisasi_rpd_id: null,
                    parent_id: null,
                    kode_akun_id: null,
                    sub_kegiatan_kode1: '',
                    sub_kegiatan_kode2: '',
                    sub_kegiatan_kode3: '',
                    sub_kegiatan_kode4: '',
                    sub_kegiatan_kode5: '',
                    kegiatan_nama: '',
                    volume: null,
                    satuan: null,
                    jumlah_biaya: 0,
                    sumber_dana: '', // contoh: 'RM' atau 'PNBP'
                    urutan: 0
                },
                rows_import_kegiatan: [],
                urls: {
                    urlKegiatanData: "{{route('kegiatan.data')}}",
                    urlKegiatanSimpan: "{{route('kegiatan.store')}}",
                    urlKegiatanDelete: "{{route('kegiatan.delete',':id')}}",
                }
            };
        },
        computed: {},
        methods: {
            async loadKegiatan() {
                this.loading = true;
                try {
                    let response = await axios.post(this.urls.urlKegiatanData, {
                        id: JSON.parse(localStorage.getItem('tahun_anggaran'))?.organisasi_rpd
                    }, {
                        headers: {
                            "Authorization": "Bearer " + localStorage.getItem("token") // Kalau pakai JWT
                        }
                    });
                    if (!response.data.status) {
                        this.kegiatanData = [];
                        return;
                    }
                    this.kegiatanData = response.data.data;
                    console.log(this.kegiatanData);

                } catch (error) {
                    console.error('Error:', error);
                } finally {
                    this.loading = false;
                }
            },
            async hapus(index) {
                let conf = confirm('yakin hapus? jika sudah ada RPD pada kegiatan ini, maka akan ikut terhapus')
                if (!conf) return
                try {
                    let url = this.urls.urlKegiatanDelete
                    url = url.replace(':id', this.kegiatanData[index].id)

                    let response = await axios.get(url, {
                        headers: {
                            "Authorization": "Bearer " + localStorage.getItem("token") // Kalau pakai JWT
                        }
                    });
                    if (!response.data.status) throw new Error("Gagal Hapus data!");
                    toastr.options.closeButton = true;
                    toastr.options.positionClass = 'toast-top-center mt-3';
                    toastr.success("Data terhapus");

                    this.loadKegiatan();
                } catch (error) {
                    console.error("Error:", error);
                    toastr.options.closeButton = true;
                    toastr.options.positionClass = 'toast-top-center mt-3';
                    toastr.error("Terjadi kesalahan saat hapus data.");
                }
            },
            tambah() {
                this.isKegiatanTambah = true
            },
            edit(index) {
                this.isKegiatanEdit = true
                const item = this.kegiatanData[index];
                this.kegiatan = {
                    ...item
                };
                const kodeArray = [
                    item.sub_kegiatan_kode1,
                    item.sub_kegiatan_kode2,
                    item.sub_kegiatan_kode3,
                    item.sub_kegiatan_kode4,
                    item.sub_kegiatan_kode5
                ].filter(Boolean); // buang yang null/undefined
                this.sub_kegiatan_kode = kodeArray.join('.');
            },
            batalTambah() {
                this.isKegiatanTambah = false
                this.isKegiatanEdit = false
                this.resetForm()
            },
            async simpan() {
                const kodeSplit = this.sub_kegiatan_kode.split('.');
                this.kegiatan.organisasi_rpd_id = JSON.parse(localStorage.getItem('tahun_anggaran')).organisasi_rpd;
                this.kegiatan.sub_kegiatan_kode1 = kodeSplit[0] || null;
                this.kegiatan.sub_kegiatan_kode2 = kodeSplit[1] || null;
                this.kegiatan.sub_kegiatan_kode3 = kodeSplit[2] || null;
                this.kegiatan.sub_kegiatan_kode4 = kodeSplit[3] || null;
                this.kegiatan.sub_kegiatan_kode5 = kodeSplit[4] || null;
                this.kegiatan.jumlah_biaya = this.kegiatan.jumlah_biaya || 0;
                axios.post(this.urls.urlKegiatanSimpan, this.kegiatan, {
                        headers: {
                            'Authorization': 'Bearer ' + localStorage.getItem('token')
                        },
                    })
                    .then(response => {
                        console.log(response);

                        // Berhasil simpan
                        this.resetForm(); // reset isian form
                        this.loadKegiatan(); // refresh list
                        toastr.options.closeButton = true;
                        toastr.options.positionClass = 'toast-top-center mt-3';
                        if (this.isKegiatanEdit) {
                            toastr.success("Kegiatan berhasil diperbarui");
                        } else {
                            toastr.success("Kegiatan berhasil ditambahkan");
                        }
                    })
                    .catch(error => {
                        alert("Gagal simpan");
                        console.error(error);
                    });
            },
            resetForm() {
                this.isKegiatanTambah = false
                this.isKegiatanEdit = false
                this.sub_kegiatan_kode = '';
                this.kegiatan = {
                    organisasi_rpd_id: null,
                    parent_id: null,
                    kode_akun_id: null,
                    sub_kegiatan_kode1: null,
                    sub_kegiatan_kode2: null,
                    sub_kegiatan_kode3: null,
                    sub_kegiatan_kode4: null,
                    sub_kegiatan_kode5: null,
                    kegiatan_nama: '',
                    volume: null,
                    satuan: null,
                    jumlah_biaya: '',
                    sumber_dana: '',
                    urutan: 1
                };
            },
            formatRupiah(angka) {
                if (!angka || angka == '') return 0;
                return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            },
            unformatRupiah(angka) {
                if (!angka || angka == '') return 0;
                return angka.replace(/\./g, '');
            },
            handleFileUpload(event) {
                const file = event.target.files[0];
                const reader = new FileReader();

                reader.onload = (e) => {
                    const data = new Uint8Array(e.target.result);
                    const workbook = XLSX.read(data, {
                        type: 'array'
                    });
                    const sheetName = workbook.SheetNames[0];
                    const worksheet = workbook.Sheets[sheetName];
                    const jsonDataRaw = XLSX.utils.sheet_to_json(worksheet, {
                        defval: ''
                    });

                    // 🔧 Bersihkan nama kolom (header) dari spasi atau karakter aneh
                    const jsonData = jsonDataRaw.map(row => {
                        const cleanRow = {};
                        for (let key in row) {
                            const cleanKey = key.trim().replace(/\s+/g, '_'); // hapus spasi dan ubah jadi underscore
                            cleanRow[cleanKey] = row[key];
                        }
                        return cleanRow;
                    });

                    console.log(jsonData);

                    this.rows_import_kegiatan = jsonData.map((item, i) => ({
                        no: item.no || i + 1,
                        sub_kegiatan: item.sub_kegiatan || '',
                        kegiatan_nama: item.program_kegiatan || '',
                        jumlah_biaya: item.jumlah_biaya || 0,
                        sumber_dana: item.sumber_dana || '',
                        status_message: 'Belum disimpan'
                    }));
                };

                reader.readAsArrayBuffer(file);
            },

            async simpanSemuaImport() {
                const organisasi_rpd = JSON.parse(localStorage.getItem('tahun_anggaran')).organisasi_rpd;

                for (const [index, row] of this.rows_import_kegiatan.entries()) {
                    if (row.status === true) continue; // Lewati yang sudah sukses

                    const kodeSplit = row.sub_kegiatan?.split('.') || [];
                    const payload = {
                        organisasi_rpd_id: organisasi_rpd,
                        sub_kegiatan_kode1: kodeSplit[0] || null,
                        sub_kegiatan_kode2: kodeSplit[1] || null,
                        sub_kegiatan_kode3: kodeSplit[2] || null,
                        sub_kegiatan_kode4: kodeSplit[3] || null,
                        sub_kegiatan_kode5: kodeSplit[4] || null,
                        jumlah_biaya: row.jumlah_biaya || 0,
                        sub_kegiatan: row.sub_kegiatan,
                        kegiatan_nama: row.kegiatan_nama,
                        sumber_dana: row.sumber_dana,
                        urutan: index + 1,
                    };

                    try {
                        const res = await axios.post(this.urls.urlKegiatanSimpan, payload, {
                            headers: {
                                'Authorization': 'Bearer ' + localStorage.getItem('token')
                            }
                        });

                        this.rows_import_kegiatan[index].status = true;
                        this.rows_import_kegiatan[index].status_message = '✅ Berhasil disimpan';
                        console.log('Sukses simpan:', res.data);
                    } catch (error) {
                        const message = error?.response?.data?.message || 'Terjadi kesalahan saat menyimpan';
                        this.rows_import_kegiatan[index].status = false;
                        this.rows_import_kegiatan[index].status_message = `❌ ${message}`;
                        console.error('Gagal simpan:', message);
                    }
                }

                // Tampilkan notifikasi ringkas setelah semua proses
                // toastr.options.closeButton = true;
                // toastr.options.positionClass = 'toast-top-center mt-3';
                // toastr.success("Proses simpan impor selesai");

                // Refresh data kegiatan utama
                this.loadKegiatan();
            }


        },
        mounted() {
            this.loadKegiatan();
        }
    }).mount("#app");
</script>
@endsection