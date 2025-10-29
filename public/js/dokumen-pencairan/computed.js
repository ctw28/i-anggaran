const pencairanComputed = {
kegiatanNama() {
        const kegiatan = this.kegiatanList.find(k => k.id === this.form.kegiatan_id);
    return kegiatan ? kegiatan.kegiatan_nama : "-";
},
kodeAkunKode() {
    const akun = this.kodeAkunList.find(a => a.id === this.form.kode_akun_id);
    return akun ? akun.kode : "-";
},
kodeAkunNama() {
    const akun = this.kodeAkunList.find(a => a.id === this.form.kode_akun_id);
    return akun ? akun.nama_akun : "-";
},
formattedBelanja() {
    return this.dataBelanjaBahan.map(item => ({
        ...item,
        nilai: item.nilai ? Number(item.nilai).toLocaleString('id-ID') : "0",
        ppn: item.ppn ? Number(item.ppn).toLocaleString('id-ID') : "0",
        pph: item.pph ? Number(item.pph).toLocaleString('id-ID') : "0",
    }));
},
formattedDataNominal() {
    return this.dataNominal.map(item => ({
        ...item,
        jumlah: item.jumlah ? item.jumlah.toLocaleString('id-ID') : "0",
        honor: item.honor ? item.honor.toLocaleString('id-ID') : "0",
        total: item.total ? item.total.toLocaleString('id-ID') : "0",
        pph: item.pph ? item.pph.toLocaleString('id-ID') : "0",
        diterima: item.diterima ? item.diterima.toLocaleString('id-ID') : "0"
    }));
},
formattedReferensiUangPerjadin() {
    return {
        ...this.perjadinData,
        uang_harian1: this.perjadinData.uang_harian1 ? this.perjadinData.uang_harian1.toLocaleString('id-ID') : "0",
        uang_penginapan1: this.perjadinData.uang_penginapan1 ? this.perjadinData.uang_penginapan1.toLocaleString('id-ID') : "0",
        uang_harian2: this.perjadinData.uang_harian2 ? this.perjadinData.uang_harian2.toLocaleString('id-ID') : "0",
        uang_penginapan2: this.perjadinData.uang_penginapan2 ? this.perjadinData.uang_penginapan2.toLocaleString('id-ID') : "0",
    };
},
formattedRincian() {
    return {
        ...this.rincianPerjadin,
        uang_harian1: this.rincianPerjadin.uang_harian1 ? this.rincianPerjadin.uang_harian1.toLocaleString('id-ID') : "0",
        uang_harian1_hari: this.rincianPerjadin.uang_harian1_hari ? this.rincianPerjadin.uang_harian1_hari.toLocaleString('id-ID') : "0",
        uang_harian2: this.rincianPerjadin.uang_harian2 ? this.rincianPerjadin.uang_harian2.toLocaleString('id-ID') : "0",
        uang_harian2_hari: this.rincianPerjadin.uang_harian2_hari ? this.rincianPerjadin.uang_harian2_hari.toLocaleString('id-ID') : "0",
        representatif: this.rincianPerjadin.representatif ? this.rincianPerjadin.representatif.toLocaleString('id-ID') : "0",
        representatif_hari: this.rincianPerjadin.representatif_hari ? this.rincianPerjadin.representatif_hari.toLocaleString('id-ID') : "0",
        penginapan1: this.rincianPerjadin.penginapan1 ? this.rincianPerjadin.penginapan1.toLocaleString('id-ID') : "0",
        penginapan1_malam: this.rincianPerjadin.penginapan1_malam ? this.rincianPerjadin.penginapan1_malam.toLocaleString('id-ID') : "0",
        penginapan2: this.rincianPerjadin.penginapan2 ? this.rincianPerjadin.penginapan2.toLocaleString('id-ID') : "0",
        penginapan2_malam: this.rincianPerjadin.penginapan2_malam ? this.rincianPerjadin.penginapan2_malam.toLocaleString('id-ID') : "0",
        tiket_pergi: this.rincianPerjadin.tiket_pergi ? this.rincianPerjadin.tiket_pergi.toLocaleString('id-ID') : "0",
        tiket_pulang: this.rincianPerjadin.tiket_pulang ? this.rincianPerjadin.tiket_pulang.toLocaleString('id-ID') : "0",
        transport_kota_2: this.rincianPerjadin.transport_kota_2 ? this.rincianPerjadin.transport_kota_2.toLocaleString('id-ID') : "0",
        kantor_bst: this.rincianPerjadin.kantor_bst ? this.rincianPerjadin.kantor_bst.toLocaleString('id-ID') : "0",
        transport2: this.rincianPerjadin.transport2 ? this.rincianPerjadin.transport2.toLocaleString('id-ID') : "0",
        transport2: this.rincianPerjadin.transport2 ? this.rincianPerjadin.transport2.toLocaleString('id-ID') : "0",
        airport_tax_pergi: this.rincianPerjadin.airport_tax_pergi ? this.rincianPerjadin.airport_tax_pergi.toLocaleString('id-ID') : "0",
        airport_tax_pulang: this.rincianPerjadin.airport_tax_pulang ? this.rincianPerjadin.airport_tax_pulang.toLocaleString('id-ID') : "0",
    };
},
totalUangHarian1() {
    return this.hitungTotalItemRincian('uang_harian1','uang_harian1_hari');
},
totalUangHarian2() {
    return this.hitungTotalItemRincian('uang_harian2','uang_harian2_hari');
},
totalUangrepsentatif() {
    return this.hitungTotalItemRincian('representatif','representatif_hari');
},
totalUangPenginapan1() {
    return this.hitungTotalItemRincian('penginapan1','penginapan1_malam');
},
totalUangPenginapan2() {
    return this.hitungTotalItemRincian('penginapan2','penginapan2_malam');
},
};