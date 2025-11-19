@extends('template')

@section('style')
<!-- Vue Select CDN -->
<link rel="stylesheet" href="https://unpkg.com/vue-select@3.20.2/dist/vue-select.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<style>
    [v-cloak] {
        display: none;
    }
</style>
@endsection
@section('content')
<div id="pencairan-data-app" v-cloak>
    <div class="row">
        <div class="col-12">

            <!-- HEADER + BUTTON TAMBAH -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="text-primary mb-0">Daftar Pencairan</h4>

                <button class="btn btn-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#pencairanModal">
                    <i class="bx bx-plus"></i> Tambah Pencairan
                </button>
            </div>

            <!-- FILTERS -->
            <div class="card mb-4">
                <div class="card-body">

                    <div class="row g-3">

                        <!-- Filter Kegiatan -->
                        <div class="col-md-4">
                            <label class="form-label">Filter Kegiatan</label>
                            <select class="form-select" v-model="filterKegiatan" @focus="fetchKegiatan">
                                <option value="">Semua Kegiatan</option>
                                <option v-for="k in kegiatanList" :value="k.id">
                                    @{{ k.kegiatan_nama }}
                                </option>
                            </select>
                        </div>
                        <!-- Filter Status -->
                        <div class="col-md-4">
                            <label class="form-label">Status Pencairan</label>
                            <select class="form-select" v-model="filterStatus">
                                <option value="semua">Semua Status</option>
                                <option value="draft">Draft</option>
                                <option value="proses">Proses</option>
                                <option value="selesai">Selesai</option>
                            </select>
                        </div>

                        <!-- Reset Filter -->
                        <div class="col-md-2 d-flex align-items-end">
                            <button class="btn btn-primary w-100" @click="applyFilter">
                                <i class="bx bx-filter"></i> Filter
                            </button>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button class="btn btn-secondary w-100" @click="resetFilter">
                                <i class="bx bx-refresh"></i> Reset
                            </button>
                        </div>

                    </div>

                </div>
            </div>
            <div class="card" v-if="!isFiltered">
                <div class="card-body">
                    <div class="alert alert-secondary mb-0 text-center">
                        Silakan pilih kegiatan terlebih dahulu.
                    </div>
                </div>
            </div>

            <div v-if="isFiltered">

                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row g-3">

                            <!-- Pagu Total -->
                            <div class="col-md-4">
                                <div class="p-3 border rounded bg-light">
                                    <div class="text-muted small">Pagu Total</div>
                                    <div class="fs-4 fw-bold text-primary">
                                        @{{ formatRupiah(dataPencairan.pagu ?? 0, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>

                            <!-- Realisasi -->
                            <div class="col-md-4">
                                <div class="p-3 border rounded bg-light">
                                    <div class="text-muted small">Realisasi</div>
                                    <div class="fs-4 fw-bold text-success">
                                        @{{ formatRupiah(dataPencairan.total_cair ?? 0, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>

                            <!-- Sisa Pagu -->
                            <div class="col-md-4">
                                <div class="p-3 border rounded bg-light">
                                    <div class="text-muted small">Sisa Pagu</div>
                                    <div class="fs-4 fw-bold text-danger">
                                        @{{ formatRupiah(dataPencairan.sisa ?? 0) }}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- TABLE -->
                <div class="card">
                    <div class="card-body">


                        <table class="table table-bordered table-striped align- middle mb-2">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Kode Akun</th>
                                    <th>Pencairan</th>
                                    <th>Anggaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="loading" class="text-center">
                                    <td colspan="4">Memuat data...</td>
                                </tr>
                                <tr v-if="dataPencairan.data.length==0 && !loading" class="text-center">
                                    <td colspan="4">Tidak ada data</td>
                                </tr>

                                <tr v-for="(item, index) in dataPencairan.data" :key="item.id">
                                    <td class="text-center">@{{ index + 1 }}</td>
                                    <td>@{{ item.kode_akun.kode }} - @{{ item.kode_akun.nama_akun }}</td>
                                    <td>@{{ item.pencairan_nama }}</td>
                                    <td>@{{ formatRupiah(item.total_cair) }}</td>
                                    <td class="text-center">

                                        <!-- Detail -->
                                        <button class="btn btn-info btn-sm me-2"
                                            @click="goToDetail(item)">
                                            <i class="bx bx-spreadsheet"></i>
                                        </button>

                                        <!-- Delete -->
                                        <button class="btn btn-danger btn-sm"
                                            @click="hapus(index)">
                                            <i class="bx bx-trash"></i>
                                        </button>

                                    </td>
                                </tr>
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="pencairanModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah Pencairan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @include('user/form-default')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    @endsection
    @section('scripts')
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://unpkg.com/vue-select@3.20.2"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <!-- <script src="{{ asset('js/pencairan-data.js') }}"></script> -->
    <script>
        const {
            createApp
        } = Vue;

        createApp({
            data() {
                return {
                    dataPencairan: [],
                    showTable: false,
                    loading: true,
                    baseUrl: "",
                    form: {
                        kegiatan_id: "",
                        kode_akun_id: "",
                        pencairan_nama: ""
                    },
                    kegiatanList: [],
                    kodeAkunList: [],
                    searchQuery: "",
                    filterKegiatan: "",
                    filterStatus: "semua",
                    isFiltered: 0,

                };
            },
            computed: {

            },
            methods: {
                applyFilter() {
                    this.isFiltered = true
                    this.dataPencairan = [];
                    this.showDataPencairan();
                },
                resetFilter() {
                    this.isFiltered = false
                    this.dataPencairan = [];
                },

                async showDataPencairan() {
                    this.loading = true;
                    try {
                        let response = await axios.get(`/api/pencairan/summary?kegiatan_id=${this.filterKegiatan}&status=${this.filterStatus}`, {
                            headers: {
                                'Authorization': 'Bearer ' + localStorage.getItem('token')
                            }
                        });

                        if (!response.data.status) {
                            this.dataPencairan = [];
                            return;
                        }

                        let hasil = response.data;
                        // return console.log(response);


                        this.dataPencairan = hasil;
                        console.log(this.dataPencairan);
                        // manipulasi is_usul_periksa
                        // this.dataPencairan.forEach(item => {
                        //     item.is_usul_periksa = item.usul !== null;
                        // });

                    } catch (error) {
                        console.error(error);
                    } finally {
                        this.loading = false;
                    }
                },
                async save() {
                    console.log(this.form);
                    let isValid = Object.values(this.form).every(value => value !== "" && value !== null && value !== undefined);


                    if (!isValid) {
                        alert("Data tidak boleh kosong! Pastikan semua kolom terisi.");
                        return;
                    }
                    try {
                        const response = await axios.post("/api/pencairan/simpan", this.form, {
                            headers: {
                                "Authorization": "Bearer " + localStorage.getItem("token")
                            },
                        });

                        if (!response.data.status) throw new Error("Gagal menyimpan data!");

                        const newData = response.data.data;

                        // Tampilkan data terbaru di tabel
                        // this.showDataPencairan();

                        // Tutup modal setelah sukses
                        const modalElement = document.getElementById("pencairanModal");
                        const modalInstance = bootstrap.Modal.getInstance(modalElement);
                        modalInstance.hide();
                        console.log(response);


                        // Redirect ke halaman detail
                        window.location.href = `/pencairan/${newData.id}/detail`;

                    } catch (error) {
                        console.error("Error:", error);
                        alert("Gagal menyimpan data.");
                    }
                    // window.location.href = `/pencairan/10/edit`;

                },
                goToDetail(item) {
                    let url = `/pencairan/${item.id}/detail`;
                    window.location.href = url;
                },
                async fetchKegiatan() {
                    const formData = new FormData();
                    formData.append('id', JSON.parse(localStorage.getItem('tahun_anggaran')).organisasi_rpd);
                    try {
                        let response = await fetch('/api/kegiatan', { // Sesuaikan dengan route
                            headers: {
                                'Authorization': 'Bearer ' + localStorage.getItem('token')
                            },
                            method: 'POST',
                            body: formData
                        });

                        let data = await response.json();
                        // console.log(data.data);

                        if (data.status) {
                            this.kegiatanList = data.data; // Sesuaikan dengan format respons API
                        } else {
                            console.error("Gagal mengambil data kegiatan");
                        }
                    } catch (error) {
                        console.error("Error fetching kegiatan:", error);
                    }
                },
                async fetchAkun() {
                    try {
                        let response = await fetch('/api/kode-akun', { // Sesuaikan dengan route
                            headers: {
                                'Authorization': 'Bearer ' + localStorage.getItem('token')
                            },
                            method: 'GET',
                        });

                        let data = await response.json();
                        // console.log(data.data);

                        if (data.status) {
                            this.kodeAkunList = data.data; // Sesuaikan dengan format respons API
                        } else {
                            console.error("Gagal mengambil data akun");
                        }
                    } catch (error) {
                        console.error("Error fetching akun:", error);
                    }
                },
                async hapus(index) {
                    if (!confirm("Apakah Anda yakin ingin menghapus pencairan ini?"))
                        return
                    if (this.dataPencairan[index].is_usul_periksa) {
                        toastr.options.closeButton = true;
                        toastr.options.positionClass = 'toast-top-center mt-3';
                        toastr.warning("Tidak dapat menghapus karena pencairan telah dikirim untuk diperiksa. <br> Batalkan terlebih dahulu pengusulan agar dapat menghapus");
                        return
                    }
                    try {
                        const response = await axios.get(`/api/pencairan/${this.dataPencairan[index].id}/delete`, {
                            headers: {
                                "Authorization": "Bearer " + localStorage.getItem("token")
                            },
                        });

                        if (!response.data.status) throw new Error("Gagal Hapus data!");
                        toastr.options.closeButton = true;
                        toastr.options.positionClass = 'toast-top-center mt-3';
                        toastr.success("Data terhapus");

                        this.showDataPencairan();
                    } catch (error) {
                        console.error("Error:", error);
                        toastr.options.closeButton = true;
                        toastr.options.positionClass = 'toast-top-center mt-3';
                        toastr.danger("Terjadi kesalahan saat hapus data.");

                    }
                },
                formatRupiah(value) {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0 // Agar tidak ada desimal
                    }).format(value);
                }
            },
            watch: {
                'form.kegiatan_id'(newVal) {
                    if (!this.userEdited) { // Update hanya jika belum diedit manual
                        const selectedKegiatan = this.kegiatanList.find(kegiatan => kegiatan.id === newVal);
                        this.form.pencairan_nama = selectedKegiatan ? selectedKegiatan.kegiatan_nama : '';
                    }
                }
            },
            mounted() {

            }
        }).mount("#pencairan-data-app");
    </script>

    @endsection