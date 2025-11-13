const getDefaultState = () => ({
    pencairan_id: "",
    totalPencairan: 0,
    isPencairanEditing: false,
    pencairanList: [],
    selectedPencairanId: "",
    form: {
        kegiatan_id: "",
        kode_akun_id: "",
        pencairan_nama: ""
    },
    data: {
        kegiatan_nama: "",
        kode_akun_kode: "",
        kode_akun_nama: ""
    },
    isDetailEditing: false,
    detail: {
        pencairan_id: "",
        nomor_sk: "",
        tanggal_sk: "",
        tanggal_dokumen: "",
        tanggal_lunas: "2025-01-01",
        penerima_nama: "",
        penerima_2: "",
        penerima_jabatan: "",
        penerima_nomor: "",
        kuitansi_nomor: "",
        sptjb_nomor: "",
        sptjk_nama: "",
        sptjk_nip: "",
        sptjk_jabatan: "",
        ppk: "",
        bendahara: "",
        dasar: {
            isSK: '0',
            isSuratTugas: '0',
            isKuitansi: '0'
        },
    },

    golonganList: [
        "I/a", "I/b", "I/c", "I/d",
        "II/a", "II/b", "II/c", "II/d",
        "III/a", "III/b", "III/c", "III/d",
        "IV/a", "IV/b", "IV/c", "IV/d", "IV/e",
        "NON-PNS"
    ],
    kegiatanList: [],
    kodeAkunList: [],
    ppkList: [],
    bendaharaList: [],

    isKirimPpk: false,
    isKirimSpi: false,

    isLoadingEdit: false, // Tambahkan indikator loading
    //NOMINAL
    dataNominal: [{
        pencairan_id: "",
        pegawai_nomor_induk: "",
        nama: "",
        golongan: "",
        jabatan: "",
        jumlah: 0,
        harga_satuan: 0,
        honor: 0,
        total: 0,
        pph: 0,
        diterima: 0,
        no_rek: "-",
        bank: "-",
        urutan: 1,
    }],
    isNominal: false, // Tambahkan indikator loading
    isNominalEditing: false,
    isFormNominal: false,
    isSaving: false, //status ketika sedang proses simpan data

    //NOMINAL AMPRA
    isReferensiSimpeg: true, //agar bisa kontrol aktif/tidak aktif pencarian pegawai dari simpeg
    isReferensiRow1: true, //agar baris ke 2 3 4 dst mengikut baris 1 ketika tambah baris

    //BELANJA BAHAN
    dataBelanjaBahan: [{
        pencairan_id: "",
        item: "",
        nilai: 0,
        qty: 1,
        harga_satuan: 0,
        ppn: 0,
        pph: 0,
        jenis: "-",
        urutan: 1,
        isPpn: false,
        isPph22: false,
        isPph23: false,

    }],
    isBelanjaBahan: false, // Tambahkan indikator loading
    isBelanjaEditing: false,
    //BELANJA BAHAN NPWP
    isNpwp: false,
    perusahaan: {
        pencairan_id: "",
        is_ada_npwp: false,
        npwp: "",
        npwp_nama: "",
        npwp_alamat: "",
    },

    //PENCARIAN PEGAWAI KE SIMPEG
    searchQuery: [], //ampra - input nama
    searchResults: [], //ampra - simpan hasil pegawai yang dicari dari searchQuery: []
    activeDropdown: null, // ampra - Untuk mengontrol dropdown aktif
    searchResultsGlobal: [], // detail-form - Simpan hasil pegawai (penerima dan sptjk)
    activeDropdownGlobal: null, // detail-form - Untuk mengontrol dropdown aktif


    //PERJADIN
    isPerjadin: false,
    isFormPerjadin: false,
    perjadinData: {
        'pencairan_id': "",
        'tgl_mulai': "",
        'tgl_selesai': "",
        'kota_tujuan': "",
        'tanggal_dokumen': "",
        'no_surat_tugas': "",
        'tanggal_surat_tugas': "",
        'uang_harian1': "",
        'uang_penginapan1': "",
        'uang_harian2': 0,
        'uang_penginapan2': 0,
    },
    perjadin_id: "",
    isAddAnggota: false,
    selectedAnggotaIndex: "",
    perjadinAnggota: [], // Data anggota yang diambil dari fetch API
    anggotaId : '',
    newAnggota: { // Data sementara sebelum ditambahkan ke tabel
        perjadin_id: "",
        nama: "",
        nip: "",
        jabatan: "",
    },
    rincianNama: "",
    rincianNIP: "",
    rincianJabatan: "",
    rincianPerjadin: { // Data sementara sebelum ditambahkan ke tabel
        perjadin_id: 0,
        perjadin_anggota_id: 0,
        tanggal_pergi: "",
        tanggal_pulang: "",
        uang_harian1: 0,
        uang_harian1_hari: 0,
        uang_harian2: 0,
        uang_harian2_hari: 0,
        representatif: 0,
        representatif_hari: 0,
        penginapan1: 0,
        penginapan1_malam: 0,
        penginapan2: 0,
        penginapan2_malam: 0,
        tiket_pergi: 0,
        tiket_pulang: 0,
        transport_kota_2: 0,
        kantor_bst: 0,
        transport2: 0,
        airport_tax_pergi: 0,
        airport_tax_pulang: 0,
    },
    realCost: [{ // Data sementara sebelum ditambahkan ke tabel
        perjadin_anggota_id: "",
        item: "",
        nilai: "",
    }],
    //untuk cetak
    jenis: 'nominal',
    daftarDokumenNominal: [
      { id: 'ampra', label: 'Ampra', checked: false },
      { id: 'kuitansi', label: 'Kuitansi', checked: false },
      { id: 'rekap', label: 'Rekap', checked: false },
      { id: 'sptjb', label: 'SPTJB', checked: false },
      { id: 'spm', label: 'SPM', checked: false },
      { id: 'spi', label: 'SPI', checked: false },
      { id: 'ppspm', label: 'PPSPM', checked: false },
      { id: 'sptjk', label: 'SPTJK', checked: false },
    ],
    daftarDokumenBelanjaBahan: [
      { id: 'kuitansi-belanja-bahan', label: 'Kuitansi', checked: false },
      { id: 'rekap-belanja-bahan', label: 'Rekap', checked: false },
      { id: 'sptjb-belanja-bahan', label: 'SPTJB', checked: false },
      { id: 'spm-belanja-bahan', label: 'SPM', checked: false },
      { id: 'spi-belanja-bahan', label: 'SPI', checked: false },
      { id: 'ppspm-belanja-bahan', label: 'PPSPM', checked: false },
      { id: 'sptjk-belanja-bahan', label: 'SPTJK', checked: false },
    ]
});
