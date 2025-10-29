const lainnyaMethods = {
    async fetchAkun() {
        try {
            let response = await fetch('/api/kode-akun', { // Sesuaikan dengan route
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                method: 'GET',
            });
    
            let data = await response.json();
            if (data.status) {
                this.kodeAkunList = data.data; // Sesuaikan dengan format respons API
            } else {
                console.error("Gagal mengambil data akun");
            }
        } catch (error) {
            console.error("Error fetching akun:", error);
        }
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
            if (data.status) {
                this.kegiatanList = data.data; // Sesuaikan dengan format respons API
            } else {
                console.error("Gagal mengambil data kegiatan");
            }
        } catch (error) {
            console.error("Error fetching kegiatan:", error);
        }
    },
    async fetchJabatan(type) {
        let url = this.urls.urlPejabat.replace(":id", 33).replace(":type", type);
    
        try {
            let response = await fetch(url, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                method: 'GET',
            });
    
            if (!response.ok) {
                throw new Error('Terjadi kesalahan saat mengambil data.');
            }
    
            let data = await response.json();
    
            if (type === 'ppk') {
                this.ppkList = data.data;
            } else if (type === 'bendahara_pengeluaran') {
                this.bendaharaList = data.data;
            }
        } catch (error) {
            console.error('Error:', error);
        }
    },
    showPreviewCetak(kategori) {
        console.log(this.pencairan_id);
        let jenis = "nominal"
        if (this.isBelanjaBahan)
            jenis = "belanja"
        let url = this.urls.urlCetak
        url = url.replace(':id', this.pencairan_id)
        url = url.replace(':kategori', kategori)
        url = url.replace(':jenis', jenis)
    
    
        document.querySelector('#show-' + kategori).innerHTML = `<a href="${url}" target="_blank" class="btn btn-dark" ><i class="tf-icons bx bx-printer"></i> Cetak</a>
                                                                <iframe src="${url}" width="100%" height="1000vh"></iframe>
                                                                `
    },
    cancel() {
        this.isPencairanEditing = false;
    },
    formatRupiah(value) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0 // Agar tidak ada desimal
        }).format(value);
    },
    
    async fetchPegawai(fieldOrIndex) {
        console.log(fieldOrIndex);
    
        if (!this.isReferensiSimpeg) return;
    
        // Cek apakah ini pencarian global atau untuk daftar nominal
        let isGlobalSearch = typeof fieldOrIndex === "string"; // true jika 'penerima' atau 'sptjk'
    
        let query
        if(isGlobalSearch && fieldOrIndex=="anggota")
            query = this.newAnggota['nama']
        else
        query = isGlobalSearch ?
            this.detail[fieldOrIndex + "_nama"] // Ambil dari detail.penerima_nama atau detail.sptjk_nama
            :
            this.searchQuery[fieldOrIndex]; // Ambil dari daftar nominal
    
        if (!query || query.length < 3) {
            if (isGlobalSearch) {
                this.searchResultsGlobal = [];
            } else {
                this.searchResults[fieldOrIndex] = [];
            }
            return;
        }
    
        let formData = new FormData();
        formData.append("q", query);
    
        try {
            let response = await axios.post("https://simpeg.iainkendari.ac.id/api/juara/search", formData);
            console.log(response.data);
    
            let results = response.data.map((item) => ({
                nama: item.nama,
                pegawai_nomor_induk: item.nip,
                golongan: item.gol,
                jabatan: item.jabatan
            }));
    
            if (isGlobalSearch) {
                this.searchResultsGlobal = results; // Simpan hasil untuk pencarian global
                this.activeDropdownGlobal = fieldOrIndex;
            } else {
                this.searchResults[fieldOrIndex] = results; // Simpan hasil untuk pencarian per baris
                this.activeDropdown = fieldOrIndex;
            }
        } catch (error) {
            console.error("Error fetching pegawai:", error);
        }
    },
    
    selectPegawai(fieldOrIndex, pegawai) {
        let isGlobalSearch = typeof fieldOrIndex === "string";
    
        if (isGlobalSearch) {
            // Untuk penerima & SPTJK
            if (fieldOrIndex == "anggota"){
                this.newAnggota['nama'] = pegawai.nama;
                this.newAnggota['nip'] = pegawai.pegawai_nomor_induk;
            }
            else{

                this.detail[fieldOrIndex + "_nama"] = pegawai.nama;
                if (fieldOrIndex == "penerima")
                    this.detail[fieldOrIndex + "_nomor"] = pegawai.pegawai_nomor_induk;
                else
                    this.detail[fieldOrIndex + "_nip"] = pegawai.pegawai_nomor_induk;
        
            }
            this.activeDropdownGlobal = null;
        } else {
            // Untuk daftar nominal
            this.dataNominal[fieldOrIndex].pencairan_id = this.pencairan_id;
            this.dataNominal[fieldOrIndex].nama = pegawai.nama;
            this.dataNominal[fieldOrIndex].pegawai_nomor_induk = pegawai.pegawai_nomor_induk;
    
            this.searchQuery[fieldOrIndex] = pegawai.nama; // Isi input dengan nama pegawai
            this.searchResults[fieldOrIndex] = []; // Kosongkan hasil pencarian
            this.activeDropdown = null; // Sembunyikan dropdown
            this.dataNominal[fieldOrIndex].golongan = pegawai.golongan; // Set golongan sesuai data pegawai
        }
    },
    hideDropdown(fieldOrIndex) {
        let isGlobalSearch = typeof fieldOrIndex === "string";
    
        setTimeout(() => {
            if (isGlobalSearch) {
                this.activeDropdownGlobal = null;
            } else {
                this.activeDropdown = null;
            }
        }, 200);
    },

    moveUp(array, index) {
        if (index > 0) {
            // Tukar data di dataNominal
            let tempData = array[index];
            array.splice(index, 1);
            array.splice(index - 1, 0, tempData);

            // Tukar data di searchQuery agar tetap sinkron
            let tempQuery = this.searchQuery[index];
            this.searchQuery.splice(index, 1);
            this.searchQuery.splice(index - 1, 0, tempQuery);
            this.updateUrutan(array);


        }
    },
    moveDown(array, index) {
        if (index < array.length - 1) {
            // Tukar data di dataNominal
            let tempData = array[index];
            array.splice(index, 1);
            array.splice(index + 1, 0, tempData);

            // Tukar data di searchQuery agar tetap sinkron
            let tempQuery = this.searchQuery[index];
            this.searchQuery.splice(index, 1);
            this.searchQuery.splice(index + 1, 0, tempQuery);
            this.updateUrutan(array);


        }
    },
    updateUrutan(array) {
        array.forEach((item, idx) => {
            item.urutan = idx + 1; // Urutan dimulai dari 1
        });
    },
    deleteRow(array, index) {
        array.splice(index, 1);
        // if(array.length==0)
            // alert('habsmi bari')
    },
    toggleEdit(jenis) {
        switch (jenis) {
            case "nominal":
                if (this.isNominalEditing) {
                    this.saveNominal(); // Simpan hanya jika sedang dalam mode edit
                }
                this.isNominalEditing = !this.isNominalEditing;
                break;
            case "belanja":
                if (this.isBelanjaEditing) {
                    this.saveBelanjaBahan(); // Simpan hanya jika sedang dalam mode edit
                }
                this.isBelanjaEditing = !this.isBelanjaEditing;
                break;
            default:
                console.warn("Jenis tidak dikenal:", jenis);
        }
    },

    calculate(index) {
        let item = this.dataNominal[index];
        let total = (item.jumlah || 0) * (item.honor || 0);
        item.total = total;
        let persenpph = this.getpphRate(item.golongan);
        item.pph = (total * persenpph) / 100;
        item.diterima = total - item.pph;
        // item.jumlah = persenpph;
    },

    getpphRate(golongan) {
        return ["IV/a", "IV/b", "IV/c", "IV/d", "IV/e"].includes(golongan) ? 15 : 5;
        // return (golongan.startsWith('IV')) ? 15 : 5;
    },
    formatRibuan(array, index, key, value) {
        if(typeof index === "string")
            array[key] = parseInt(value.replace(/\./g, '')) || 0;
        else
            array[index][key] = parseInt(value.replace(/\./g, '')) || 0;
    },
    cancelEditing(jenis) {
        let konfirmasi = confirm('Yakin cancel? perubahan tidak akan tersimpan')
        if (!konfirmasi) return
        if (jenis == "belanja") {
            this.isBelanjaEditing = false
            this.loadBelanjaBahan()
        } else {
            this.isNominalEditing = false
            this.showNominal()
        }
    },
}
