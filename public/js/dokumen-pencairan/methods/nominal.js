const nominalMethods = {
async showDetailNominal() {
    try {
        let response = await axios.get(`/api/pencairan-detail/${id}`, {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            }
        });

        console.log(response);
        if (response.data.status) {
            let data = response.data.data;

            // Pastikan ppk dan bendahara tidak undefined sebelum ambil .id
            data.ppk = data.ppk?.id || null;
            data.bendahara = data.bendahara?.id || null;
            data.dasar.isSK = data.dasar?.isSK || false;
            data.dasar.isSuratTugas = data.dasar?.isSuratTugas || false;
            data.dasar.isKuitansi = data.dasar?.isKuitansi || false;

            Object.assign(this.detail, data);
        }
    } catch (error) {
        console.error("Gagal mengambil data:", error);
        toastr.options.closeButton = true;
        toastr.options.positionClass = 'toast-top-center mt-3';
        toastr.error("Terjadi kesalahan saat mengambil data.");
    } finally {
        this.isLoading = false;
    }
},
tambahBaris() {
    let referensi
    if(this.dataNominal.length==0) 
    referensi = {}
        else
    referensi = this.isReferensiRow1 ? this.dataNominal[0] : {};

    this.dataNominal.push({
        pencairan_id: this.pencairan_id,
        nama: "", // Tetap kosong
        pegawai_nomor_induk: "", // Tetap kosong
        golongan: "", // Tetap kosong
        jabatan: this.isReferensiRow1 ? referensi.jabatan : "", // Ikuti baris 1 jika aktif
        jumlah: this.isReferensiRow1 ? referensi.jumlah : 0, // Ikuti baris 1 jika aktif
        satuan: this.isReferensiRow1 ? referensi.satuan : "",
        honor: this.isReferensiRow1 ? referensi.honor : 0, // Ikuti baris 1 jika aktif
        total: 0,
        pph: 0,
        diterima: 0,
        no_rek: "-",
        bank: "-",
        urutan: this.dataNominal.length + 1,
    });
},

async saveNominal() {
    // console.log("Data disimpan:", this.dataNominal);
    console.log(this.dataNominal);
    let payload = this.dataNominal.map(item => ({
        pencairan_id: item.pencairan_id,
        nama: item.nama,
        pegawai_nomor_induk: item.pegawai_nomor_induk || '-',
        golongan: item.golongan,
        jabatan: item.jabatan,
        jumlah: item.jumlah,
        satuan: item.satuan,
        honor: item.honor,
        total: item.total,
        pph: item.pph,
        diterima: item.diterima,
        no_rek: item.no_rek,
        bank: item.bank,
        urutan: item.urutan,
    }));
    // Cek apakah ada data yang kosong
    let isValid = payload.every(item => {
        return Object.values(item).every(value => value !== "" && value !== null && value !== undefined);
    });

    if (!isValid) {
        alert("Data tidak boleh kosong! Pastikan semua kolom terisi.");
        return;
    }
    try {
        this.isSaving = true; // Aktifkan loading indicator
        // console.log("Mengirim data:", payload);

        let response = await axios.post(this.urls.urlSaveNominal, {
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
            toastr.success("Data berhasil disimpan!");

        } else {
            toastr.options.closeButton = true;
            toastr.options.positionClass = 'toast-top-center mt-3';
            toastr.error("Gagal disimpan!");
        }
    } catch (error) {
        console.error("Terjadi kesalahan:", error);
        toastr.options.closeButton = true;
        toastr.options.positionClass = 'toast-top-center mt-3';
        toastr.error("Terjadi kesalahan saat menyimpan data.");
    } finally {
        
        this.isSaving = false; // Matikan loading indicator
        this.isNominalEditing = false; // mode tidak edit
        this.getTotalPencairan()
    }
},
async showNominal() {
    this.isLoading = true;
    try {
        let url = this.urls.urlShowNominal
        url = url.replace(':id', this.pencairan_id)
        let response = await axios.get(url, {
            headers: {
                "Authorization": "Bearer " + localStorage.getItem("token")
            }
        });
        // console.log(response);

        // Pastikan response berisi data
        if (response.data.status) {
            this.dataNominal = response.data.data; // Simpan data dari API ke dalam state
            this.dataNominal.map((item, index) => {
                this.searchQuery[index] = item.nama;
            })
            // console.log(this.dataNominal);

        } else {
            this.dataNominal = [{
                pencairan_id: "",
                pegawai_nomor_induk: "",
                nama: "",
                golongan: "",
                jabatan: "",
                jumlah: 0,
                satuan: "",
                honor: 0,
                total: 0,
                pph: 0,
                diterima: 0,
                no_rek: "-",
                bank: "-",
                urutan: 1,
            }]
            this.searchQuery = []
        }
        // console.log(this.dataNominal);
        this.getTotalPencairan()
        
    } catch (error) {
        console.error("Gagal mengambil data nominal:", error);
    } finally {
        this.isLoading = false; // Matikan loading setelah request selesai
    }
},

};