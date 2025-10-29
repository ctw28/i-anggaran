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
<div id="pencairan-data-app" v-cloak data-url="{{ route('pencairan.get', '2') }}">
    <p v-if="loading">Memuat data...</p>
    <div class="col-12">
        <div class="row">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title text-primary">Daftar Pencairan</h5>
                    <button class="btn btn-primary mb-3" data-bs-toggle="modal"
                        data-bs-target="#pencairanModal"><i class="tf-icons bx bx-plus"></i> Buat Dokumen Pencairan</button>
                    <table class="table table-striped table-bordered">
                        <thead class="text-center align-middle">
                            <tr>
                                <th>No</th>
                                <th>Kegiatan</th>
                                <th>Kode Akun</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in dataPencairan" :key="item.id">
                                <td>@{{ index + 1 }}</td>
                                <td>
                                    @{{ item.pencairan_nama }}
                                </td>
                                <td>
                                    @{{ item.kode_akun.kode }} - @{{ item.kode_akun.nama_akun }}
                                </td>
                                <td>
                                    <button class="btn btn-info btn-sm"
                                        :data-url="'{{ route('dokumen-pencairan.detail', ['id' => '__ID__']) }}'.replace('__ID__', item.id)"
                                        @click="goToDetail($event)">
                                        <i class="tf-icons bx bx-spreadsheet"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" @click="hapus(index)">
                                        <i class="tf-icons bx bx-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
                };
            },
            computed: {
                // Filter kegiatan berdasarkan searchQuery
                filteredKegiatan() {
                    if (!this.searchQuery) return this.kegiatanList;
                    return this.kegiatanList.filter(kegiatan =>
                        kegiatan.nama.toLowerCase().includes(this.searchQuery.toLowerCase())
                    );
                }
            },
            methods: {
                async showDataPencairan() {
                    this.loading = true;
                    let id = JSON.parse(localStorage.getItem('tahun_anggaran'))?.organisasi_rpd
                    try {
                        let response = await axios.get(`/api/pencairan/${id}/data`, {
                            headers: {
                                'Authorization': 'Bearer ' + localStorage.getItem('token')
                            }
                        });
                        console.log(response);

                        if (!response.data.status) {
                            this.dataPencairan = [];
                            this.showTable = false;
                            return;
                        }

                        this.dataPencairan = response.data.data;
                        this.dataPencairan.map((item, index) => {
                            if (item.usul != null)
                                item.is_usul_periksa = true
                            else
                                item.is_usul_periksa = false
                        })
                        this.showTable = true;
                        console.log(this.dataPencairan);

                    } catch (error) {
                        console.error('Error:', error);
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
                goToDetail(event) {
                    let url = event.currentTarget.getAttribute("data-url");
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
                let appElement = document.getElementById("pencairan-data-app");
                if (appElement) {
                    this.baseUrl = appElement.dataset.url;
                }
                this.showDataPencairan();
            }
        }).mount("#pencairan-data-app");
    </script>

    @endsection