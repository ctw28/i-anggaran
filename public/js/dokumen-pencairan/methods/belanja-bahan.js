const belanjaBahanMethods = {
    async loadBelanjaBahan() {
        this.isLoading = true;
        try {
            let url = this.urls.urlLoadBelanjaBahan
            url = url.replace(':id', this.pencairan_id)
            let response = await axios.get(url, {
                headers: {
                    "Authorization": "Bearer " + localStorage.getItem("token")
                }
            });
            console.log(response);
    
            // Pastikan response berisi data
            if (response.data.status) {
                this.dataBelanjaBahan = response.data.data; // Simpan data dari API ke dalam state
                console.log(this.dataBelanjaBahan);
    
            } else {
                this.dataBelanjaBahan = [{
                    pencairan_id: this.pencairan_id,
                    item: "",
                    nilai: 0,
                    ppn: 0,
                    pph: 0,
                    jenis: "",
                    urutan: 1,
                }]
            }
            this.getTotalPencairan()

        } catch (error) {
            console.error("Gagal mengambil data nominal:", error);
        } finally {
            this.isLoading = false; // Matikan loading setelah request selesai
        }
    },
    tambahBelanjaBahan() {
        this.dataBelanjaBahan.push({
            pencairan_id: this.pencairan_id,
            item: "",
            nilai: 0,
            ppn: 0,
            pph: 0,
            jenis: "",
            urutan: this.dataBelanjaBahan.length + 1,
        });
    },
    async saveBelanjaBahan() {
        console.log(this.dataBelanjaBahan);
        try {
            this.isSaving = true; // Aktifkan loading indicator
    
            let payload = this.dataBelanjaBahan.map(item => ({
                pencairan_id: item.pencairan_id,
                item: item.item,
                nilai: item.nilai,
                ppn: item.ppn,
                pph: item.pph,
                jenis: item.jenis,
                urutan: item.urutan,
            }));
    
            console.log("Mengirim data:", payload);
            let isValid = payload.every(item => {
                return Object.values(item).every(value => value !== "" && value !== null && value !== undefined);
            });
        
            if (!isValid) {
                alert("Data tidak boleh kosong! Pastikan semua kolom terisi.");
                this.isSaving = false; // Matikan loading indicator
                this.isBelanjaEditing = true; // mode tidak edit
                return;
            }
            let response = await axios.post(this.urls.urlStoreBelanjaBahan, {
                id: this.pencairan_id,
                data: payload
            }, {
                headers: {
                    "Authorization": "Bearer " + localStorage.getItem("token") // Kalau pakai JWT
                }
            });
    
    
            if (response.status) {
                toastr.options.closeButton = true;
                toastr.options.positionClass = 'toast-top-center mt-3';
                toastr.success('Sukses');
                this.isSaving = false; // Matikan loading indicator
                this.isBelanjaEditing = false; // mode tidak edit
                this.loadBelanjaBahan()
                this.getTotalPencairan('belanja')
            } else {
                toastr.options.closeButton = true;
                toastr.options.positionClass = 'toast-top-center mt-3';
                toastr.error('Gagal menyimpan data');
            }
        } catch (error) {
            console.error("Terjadi kesalahan:", error);
            toastr.options.closeButton = true;
            toastr.options.positionClass = 'toast-top-center mt-3';
            toastr.error("Terjadi kesalahan saat menyimpan data.");
        }
    },
    calculateBelanjaBahan(index) {
        // console.log(this.dataBelanjaBahan[index].nilai);
        let ppnHasil = 0
        let pphHasil = 0
        let pajakNpwp = 0.015
        if (this.dataBelanjaBahan[index].jenis != "fc" && this.dataBelanjaBahan[index].jenis != "snack" && this.dataBelanjaBahan[index].nilai > 2000000) {
            ppnHasil = this.dataBelanjaBahan[index].nilai * (100 / 111) * 0.11
        }
        if (ppnHasil > 0 && this.dataBelanjaBahan[index].jenis != "fc") {
            pphHasil = (this.dataBelanjaBahan[index].nilai - ppnHasil) * pajakNpwp
        }
        // console.log(this.dataBelanjaBahan[index].nilai * (100 / 111) * 0.11);
        // console.log(pphHasil);
    
        this.dataBelanjaBahan[index].ppn = ppnHasil.toFixed(0)
        this.dataBelanjaBahan[index].pph = pphHasil.toFixed(0)
    },    

    handleNpwpChange() {
        console.log("NPWP berubah:", this.isNpwp);

        // Jika memilih "Tidak Ada NPWP", langsung simpan ke API
        if (!this.isNpwp) {
            this.saveNpwp();
        }
    },
    async loadNpwp() {
        try {
            let url = this.urls.urlShowNpwp
            url = url.replace(':id', this.pencairan_id)
            let response = await axios.get(url, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            });
            console.log(response.data);
            if (response.data.data.length != 0) {
                this.isNpwp = true
                this.perusahaan.npwp = response.data.data.npwp
                this.perusahaan.npwp_nama = response.data.data.npwp_nama
                this.perusahaan.npwp_alamat = response.data.data.npwp_alamat
            }

        } catch (error) {
            console.error("Error fetching kegiatan:", error);
        }
    },
    async saveNpwp() {
        // return alert(this.isNpwp)
        console.log(this.perusahaan);
        try {
            let payload = {
                pencairan_id: this.pencairan_id,
                is_ada_npwp: this.isNpwp,
                npwp: this.isNpwp ? this.perusahaan.npwp : "", // Ikuti baris 1 jika aktif
                npwp_nama: this.isNpwp ? this.perusahaan.npwp_nama : "", // Ikuti baris 1 jika aktif
                npwp_alamat: this.isNpwp ? this.perusahaan.npwp_alamat : "", // Ikuti baris 1 jika aktif
            };

            console.log("Mengirim data:", payload);
            let url = this.urls.urlNpwpUpdate
            let response = await axios.post(url, {
                data: payload
            }, {
                headers: {
                    "Authorization": "Bearer " + localStorage.getItem("token") // Kalau pakai JWT
                }
            });

            if (response.status) {
                toastr.options.closeButton = true;
                toastr.options.positionClass = 'toast-top-center mt-3';
                toastr.success('Sukses');
            } else {
                toastr.options.closeButton = true;
                toastr.options.positionClass = 'toast-top-center mt-3';
                toastr.error('Gagal menyimpan data');
            }
        } catch (error) {
            console.error("Terjadi kesalahan:", error);
            toastr.options.closeButton = true;
            toastr.options.positionClass = 'toast-top-center mt-3';
            toastr.error("Terjadi kesalahan saat menyimpan data.");
        } finally {
            this.isNpwp = this.isNpwp;
        }

}
}
