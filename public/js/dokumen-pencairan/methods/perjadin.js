const perjadinMethods = {
    async savePerjadin() {
        
        console.log("Mengirim data:", this.perjadinData);
        // return
        let isValid = Object.entries(this.perjadinData).every(([key, value]) => {
            // Lewati validasi untuk uang_harian2 dan uang_penginapan2
            if (key === 'uang_harian2' || key === 'uang_penginapan2') return true;
        
            return value !== "" && value !== null && value !== undefined;
        });
        if (!isValid) {
            alert("Data tidak boleh kosong! Pastikan semua kolom terisi.");
            return;
        }
        try {
            this.isSaving = true; // Aktifkan loading indicator
            let url = this.urls.urlStorePerjadin
            let response = await axios.post(url, this.perjadinData, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
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
            this.isDetailEditing = false; // Matikan loading indicator
            this.isSaving = false; // Matikan loading indicator
            this.isBelanjaEditing = false; // mode tidak edit
        }
    },
    async showDetailPerjadin() {
        try {
            let url = this.urls.urlShowPerjadin
            url = url.replace(':id', id)
            let response = await axios.get(url, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            });
            console.log(response.data);
            if (response.data.status) {
                let data = response.data.data;
                this.perjadin_id = data.id
                
                this.perjadinData.uang_harian1 = data?.referensi_uang?.[0]?.uang_harian;
                this.perjadinData.uang_penginapan1 = data?.referensi_uang?.[0]?.uang_penginapan;
                this.perjadinData.uang_harian2 = data?.referensi_uang?.[1]?.uang_harian;
                this.perjadinData.uang_penginapan2 = data?.referensi_uang?.[1]?.uang_penginapan;
                Object.assign(this.perjadinData, data);
                                this.loadAnggota()

            }
            else{
                perjadinData= {
                    'pencairan_id': id,
                    'tgl_mulai': "",
                    'tgl_selesai': "",
                    'kota_tujuan': "",
                    'tanggal_dokumen': "",
                    'no_spd': "",
                    'no_surat_tugas': "",
                    'tanggal_surat_tugas': "",
                    'uang_harian1': "",
                    'uang_penginapan1': "",
                    'uang_harian2': 0,
                    'uang_penginapan2': 0,
                }            }
        } catch (error) {
            console.error("Gagal mengambil data:", error);
            toastr.options.closeButton = true;
            toastr.options.positionClass = 'toast-top-center mt-3';
            toastr.error("Terjadi kesalahan saat mengambil data.");
        } finally {
            this.isLoading = false;
        }
    },
    addAnggota() {
        this.isAddAnggota = true
        this.newAnggota = { perjadin_id: this.perjadin_id, nama: "", nip: "", jabatan: "" };
    },
    cancelAddAnggota() {
        this.isAddAnggota = false
    },
    async saveAnggota() {
        let url = this.urls.urlSaveAnggotaPerjadin
        console.log(this.newAnggota);
        
        let response = await axios.post(url, this.newAnggota, {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            }
        });
        console.log(response);
        if (response.status) {
            toastr.options.closeButton = true;
            toastr.options.positionClass = 'toast-top-center mt-3';
            toastr.success('Sukses');
            this.loadAnggota()
            this.isAddAnggota = false

        }
    },
    async loadAnggota() {
        let url = this.urls.urlLoadAnggotaPerjadin
        url = url.replace(":id", this.perjadin_id)
        let response = await axios.get(url, {
            headers: {'Authorization': 'Bearer ' + localStorage.getItem('token')}
        });
        console.log(response);
        if (response.status) {
            this.perjadinAnggota = response.data.data
        }
    },
    async deletePerjadin() {
        let konfirm = confirm('yakin hapus? semua data terkait perjadin ini akan ikut terhapus')
        if (!konfirm) return
        let url = '{{route("perjadin.delete",":id")}}'
        url = url.replace(":id", button.dataset.id)
        let sendRequest = await fetch(url, {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },
            method: "GET",
        })
        response = await sendRequest.json()
        console.log(response);
        if (response.status) {
            toastr.options.closeButton = true;
            toastr.options.positionClass = 'toast-top-center mt-3';
            toastr.success('Sukses hapus');
            showPerjadin(document.querySelector('#show-data-sesi').dataset.id)
        }
    },
    changeAnggota(){
        if (this.selectedAnggotaIndex === null) {
            alert("Pilih anggota terlebih dahulu!");
            return;
        }

        // Panggil loadRincian() dengan index yang dipilih
        this.loadRincian(this.selectedAnggotaIndex);
    },
    async loadRincian(index){
        // alert(this.perjadinAnggota[index]['id'])
        try {
            this.anggotaId = this.perjadinAnggota[index]['id']
            // alert(this.anggotaId)

            let url = this.urls.urlloadRincian
            url = url.replace(':id', this.perjadinAnggota[index]['id'])
            let response = await axios.get(url, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            });
            console.log(response.data);
            if (response.data.status) {
                if(response.data.data.rincian==null){
                    const mulai = new Date(this.perjadinData.tgl_mulai);
                    const selesai = new Date(this.perjadinData.tgl_selesai);
                    const selisihHari = Math.ceil((selesai - mulai) / (1000 * 60 * 60 * 24));


                    this.rincianPerjadin = {
                        perjadin_id: this.perjadin_id,
                        perjadin_anggota_id: this.perjadinAnggota[index]['id'],
                        tanggal_pergi: this.perjadinData.tgl_mulai,
                        tanggal_pulang: this.perjadinData.tgl_selesai,
                        uang_harian1: this.perjadinData.uang_harian1,
                        uang_harian1_hari: selisihHari+1,
                        uang_harian2: this.perjadinData.uang_harian2,
                        uang_harian2_hari: (
                        !this.perjadinData.uang_harian2 || this.perjadinData.uang_harian2 == 0
                            ? 0
                            : selisihHari + 1
                        ),
                        representatif: 0,
                        representatif_hari: 0,
                        penginapan1: this.perjadinData.uang_penginapan1,
                        penginapan1_malam: selisihHari,
                        penginapan2: this.perjadinData.uang_penginapan2,
                        penginapan2_malam: (
                        !this.perjadinData.uang_penginapan2
                            ? 0
                            : selisihHari
                        ),
                        tiket_pergi: 0,
                        tiket_pulang: 0,
                        transport_kota_2: 0,
                        kantor_bst: 0,
                        transport2: 0,
                        airport_tax_pergi: 0,
                        airport_tax_pulang: 0,
                    }
                }
                else{
                    this.rincianPerjadin = response.data.data.rincian
                }
                this.selectedAnggotaIndex = index
                console.log(this.rincianPerjadin);
                this.rincianNama =  response.data.data.nama
                this.rincianNIP =  response.data.data.nip
                this.rincianJabatan =  response.data.data.jabatan
                this.rincianAnggotaSelected =  response.data.data.id
            }
            this.loadRealCost(this.perjadinAnggota[index]['id'])
        } catch (error) {
            console.error("Gagal mengambil data:", error);
            toastr.options.closeButton = true;
            toastr.options.positionClass = 'toast-top-center mt-3';
            toastr.error("Terjadi kesalahan saat mengambil data.");
        } finally {
            this.isLoading = false;
        }

    },
    async storeRincian(){
        try {
            this.isSaving = true; // Aktifkan loading indicator
            console.log("Mengirim data:", this.rincianPerjadin);
            let url = this.urls.urlstoreRincian
            let response = await axios.post(url, this.rincianPerjadin, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
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
            this.isSaving = false; // Matikan loading indicator
            this.isBelanjaEditing = false; // mode tidak edit
        }

    },
    async loadRealCost(anggotaId) {
        let url = this.urls.urlLoadRealCost
        url = url.replace(':id', anggotaId)
        let sendRequest = await fetch(url, {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },
            method: "GET",
        })
        response = await sendRequest.json()
        console.log(response);
        this.realCostsAnggota = response.data
        this.currentAnggotaId = anggotaId

    },
    editRealCost() {
        this.isEditingRealCost = true;
    },
    cancelRealCost() {
        this.isEditingRealCost = false;
        this.loadRealCost(this.currentAnggotaId); // reload data awal
    },
    addRealCostRow() {
        this.realCostsAnggota.push({
            perjadin_anggota_id: this.currentAnggotaId,
            item: "",
            nilai: 0,
        });
    },
    hitungTotalItemRincian(jumlahlUang, jumlahHari) { //ini dipanggil di computed
        const uang = parseInt(this.rincianPerjadin[jumlahlUang] || 0);
        const hari = parseInt(this.rincianPerjadin[jumlahHari] || 0);
        return (uang * hari).toLocaleString('id-ID');
    },
    async storeRealCost() {
        // Validasi frontend dulu
        for (let rc of this.realCostsAnggota) {
            if (!rc.item || rc.item.trim() === "") {
                alert("Item / uraian tidak boleh kosong.");
                return;
            }
            if (rc.nilai === null || rc.nilai === "" || isNaN(rc.nilai)) {
                alert("Nilai tidak boleh kosong dan harus angka.");
                return;
            }
        }

        this.loadingSave = true;

        let payload = {
            perjadin_anggota_id: this.currentAnggotaId,
            items: this.realCostsAnggota,
        };

        try {
            let url = this.urls.urlStoreRealCost;
            let response = await axios.post(url, payload, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            });

            if (response.data.status) {
                alert("Real cost berhasil disimpan!");
                this.isEditingRealCost = false;
                this.loadRealCost(this.currentAnggotaId);
            }

        } catch (error) {
            if (error.response?.data?.details) {
                alert("Gagal menyimpan:\n" + error.response.data.details.join("\n"));
            } else {
                alert("Terjadi kesalahan: " + error.message);
            }

        } finally {
            this.loadingSave = false;
        }
    },

    async deleteRealCost(button) {
        let konfirm = confirm('yakin hapus?')
        if (!konfirm) return
        var row = button.closest('tr');
        let dataSend = new FormData()
        dataSend.append('id', row.dataset.id);

        let url = '{{route("perjadin.real-cost.delete")}}'
        let sendRequest = await fetch(url, {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },
            method: "POST",
            body: dataSend
        })
        response = await sendRequest.json()
        console.log(response);
        if (response.status) {
            toastr.options.closeButton = true;
            toastr.options.positionClass = 'toast-top-center mt-3';
            toastr.success('Sukses');
            row.remove();
        }
    },
    cetakPerjadin(kategori) {
    // if (!this.anggotaId) {
    //   alert("ID anggota belum tersedia!");
    //   return;
    // }

    // Misal route-nya: /cetak/perjadin/{anggotaId}/{kategori}
    const url = `/anggota/${this.anggotaId}/kategori/${kategori}/cetak`;

    // Buka di tab baru untuk cetak
    window.open(url, '_blank');
  },
  async deleteAnggota(anggotaId) {
        let konfirm = confirm('yakin hapus anggota?')
        if (!konfirm) return
        let url = this.urls.urlDeleteAnggotaPerjadin;
        url = url.replace(':id', anggotaId)


        let response = await axios.delete(url, {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            }
        });
            
        console.log(response);
        if (response.status) {
                                this.loadAnggota()

            toastr.options.closeButton = true;
            toastr.options.positionClass = 'toast-top-center mt-3';
            toastr.success('Sukses');
            row.remove();
        }
    },
}