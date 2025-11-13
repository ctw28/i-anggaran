const pencairanMethods = {
    async getPencairan() {
        let id = JSON.parse(localStorage.getItem('tahun_anggaran'))?.organisasi_rpd
        try {
            let response = await axios.get(`/api/pencairan/${id}/data`, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            });
            // console.log(response);

            if (!response.data.status) {
                this.pencairanList = [];
                return;
            }

            this.pencairanList = response.data.data;
        } catch (error) {
            console.error('Error:', error);
        }
    },
    async showPencairan() {
        try {
            let url = this.urls.urlShowPencairan = this.urls.urlShowPencairan.replace(':id', id)
            let response = await axios.get(url, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            });
            // console.log(response);
    
            this.kegiatanList = response.data.data;
            this.pencairan_id = response.data.data.id || "-";
            this.detail.pencairan_id = this.pencairan_id;
            this.selectedPencairanId = this.pencairan_id;
            this.perjadinData.pencairan_id = this.pencairan_id;
            this.form.kegiatan_id = response.data.data.kegiatan_id || "-";
            this.form.kode_akun_id = response.data.data.kode_akun_id || "-";
            this.form.pencairan_nama = response.data.data.pencairan_nama || "-";
            this.data.kegiatan_nama = response.data.data.kegiatan.kegiatan_nama || "-";
            this.data.kode_akun_kode = response.data.data.kode_akun.kode || "-";
            this.data.kode_akun_nama = response.data.data.kode_akun.nama_akun || "-";
            // console.log(response.data.data);
            if (response.data.data.kode_akun.jenis_pencairan == "nominal"){
                this.isNominal = true
                this.showDetailNominal()
                this.showNominal();
                this.isFormNominal = true
            }
            if (response.data.data.kode_akun.jenis_pencairan == "belanja_bahan"){
                this.isBelanjaBahan = true
                this.isFormNominal = true
                this.showDetailNominal()
                this.loadNpwp()
                this.loadBelanjaBahan(); // Ambil data saat modal dibuka
            }
            if (response.data.data.kode_akun.jenis_pencairan == "perjadin"){
                this.isPerjadin = true
                this.isFormPerjadin = true
                this.showDetailPerjadin()
            }        
        } catch (error) {
            console.error("Error fetching kegiatan:", error);
        }
    },
    editDetail(){
        this.isDetailEditing = true
    },
    cancelEditDetail(){
        this.isDetailEditing = false
    },
    async detailSave() {
        try {
            console.log(this.detail);
            
            let isValid = Object.values(this.detail).every(value => value !== "" && value !== null && value !== undefined);


            if (!isValid) {
                alert("Data tidak boleh kosong! Pastikan semua kolom terisi.");
                return;
            }
            let response = await axios.post(`/api/pencairan-detail`, this.detail, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            });
            toastr.options.closeButton = true;
            toastr.options.positionClass = 'toast-top-center mt-3';
            toastr.success(response.data.message);
            this.showDetailNominal(); // Refresh data setelah update
            this.isDetailEditing = false

        } catch (error) {
            toastr.options.closeButton = true;
            toastr.options.positionClass = 'toast-top-center mt-3';
            toastr.error("Terjadi kesalahan saat memperbarui data:", error);
            console.error("Gagal memperbarui data:", error);
        } finally {
            this.isLoading = false;
        }
    },
    gotoPencairan(){
        if (!this.selectedPencairanId) {
            alert("Pilih pencairan terlebih dahulu!");
            return;
        }
        
        let url = this.urls.urlGoTo;
        url = url.replace(':id', this.selectedPencairanId);
        
        window.location.href = url;
    },
    async updatePencairan() {
        if (this.isLoading) return;
        this.isLoading = true;
    
        try {
            let response = await axios.put(`/api/pencairan/${this.pencairan_id}`, this.form, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            });
    
            toastr.options.closeButton = true;
            toastr.options.positionClass = 'toast-top-center mt-3';
            toastr.success(response.data.message);
            this.isPencairanEditing = false;
            this.showPencairan(); // Refresh data setelah update
        } catch (error) {
            console.error("Gagal memperbarui data:", error);
            toastr.options.closeButton = true;
            toastr.options.positionClass = 'toast-top-center mt-3';
            toastr.error("Terjadi kesalahan saat memperbarui data.");
        } finally {
            this.isLoading = false;
        }
    },
    async editPencairan() {
        if (this.isLoadingEdit) return;
        this.isLoadingEdit = true;
        try {
            await this.fetchAkun();
            await this.fetchKegiatan();
            this.isPencairanEditing = true;
        } catch (error) {
            console.error("Gagal memuat kegiatan:", error);
        } finally {
            this.isLoadingEdit = false; // Pasti akan dieksekusi
        }
    },
    getTotalPencairan(){
        this.totalPencairan = 0;
        if(this.isNominal){
            this.dataNominal.map(item => {
                this.totalPencairan = this.totalPencairan + item.total
            })
        }
        if(this.isBelanjaBahan){
            this.dataBelanjaBahan.map(item => {
                this.totalPencairan = this.totalPencairan + parseFloat(item.nilai)
            })
        }

    }
}
