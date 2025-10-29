const { createApp } = Vue;

createApp({
    data() {
        return {
            dataPencairan: [],
            showTable: false,
            loading: true,
            baseUrl: "",
            form: {
                kegiatan: "",
                kodeAkun: ""
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
            let url = this.baseUrl
            this.loading = true;
            try {
                let response = await axios.get(url, {
                    headers: { 'Authorization': 'Bearer ' + localStorage.getItem('token') }
                });
                console.log(response);
                
                if (!response.data.status) {
                    this.dataPencairan = [];
                    this.showTable = false;
                    return;
                }

                this.dataPencairan = response.data.data;
                this.showTable = true;
            } catch (error) {
                console.error('Error:', error);
            } finally {
                this.loading = false;
            }
        },
        async save() {
            // console.log(this.form.kodeAkun);
            
            try {
                const response = await axios.post("/api/pencairan/simpan", this.form, {
                    headers: { "Authorization": "Bearer " + localStorage.getItem("token") },
                });

                if (!response.data.status) throw new Error("Gagal menyimpan data!");

                const newData = response.data.data;

                // Tampilkan data terbaru di tabel
                this.showDataPencairan();

                // Tutup modal setelah sukses
                const modalElement = document.getElementById("pencairanModal");
                const modalInstance = bootstrap.Modal.getInstance(modalElement);
                modalInstance.hide();

                // Redirect ke halaman detail
                window.location.href = `/pencairan/${newData.id}/edit`;

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
                    headers: { 'Authorization': 'Bearer ' + localStorage.getItem('token') },
                    method: 'POST',
                    body: formData
                });

                let data = await response.json();
                console.log(data.data);
                
                if (data.status) {
                    this.kegiatanList = data.data.kegiatan; // Sesuaikan dengan format respons API
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
                    headers: { 'Authorization': 'Bearer ' + localStorage.getItem('token') },
                    method: 'GET',
                });

                let data = await response.json();
                console.log(data.data);
                
                if (data.status) {
                    this.kodeAkunList = data.data; // Sesuaikan dengan format respons API
                } else {
                    console.error("Gagal mengambil data akun");
                }
            } catch (error) {
                console.error("Error fetching akun:", error);
            }
        },
        hapus(id) {
            if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                console.log("Menghapus ID:", id);
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
