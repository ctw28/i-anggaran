<li class="nav-item">
    <button
        type="button"
        class="nav-link active"
        role="tab"
        data-bs-toggle="tab"
        data-bs-target="#navs-detail"
        aria-controls="navs-detail"
        aria-selected="true">
        <span class="d-none d-sm-inline-flex align-items-center">
            <i class="icon-base bx bx-home icon-sm me-1"></i>Detail Dokumen
        </span>
        <i class="icon-base bx bx-home icon-sm d-sm-none"></i>
    </button>
</li>
<li class="nav-item">
    <button
        type="button"
        class="nav-link"
        role="tab"
        data-bs-toggle="tab"
        data-bs-target="#navs-item-pencairan"
        aria-controls="navs-item-pencairan"
        aria-selected="false">
        <span v-if="isNominal" class="d-none d-sm-inline-flex align-items-center"><i class="icon-base bx bx-grid icon-sm me-1"></i> Daftar Nominal</span>
        <span v-if="isBelanjaBahan" class="d-none d-sm-inline-flex align-items-center"><i class="icon-base bx bx-grid icon-sm me-1"></i> Daftar Belanja Bahan</span>
        <span v-if="isPerjadin" class="d-none d-sm-inline-flex align-items-center"><i class="icon-base bx bx-grid icon-sm me-1"></i> Anggota Perjadin</span>
    </button>
</li>
<li class="nav-item" v-if="!isPerjadin">
    <button
        type="button"
        class="nav-link"
        role="tab"
        data-bs-toggle="tab"
        data-bs-target="#navs-cetak"
        aria-controls="navs-cetak"
        aria-selected="false">
        <span class="d-none d-sm-inline-flex align-items-center"><i class="icon-base bx bx-eye icon-sm me-1"></i> Preview Dokumen</span>
        <i class="icon-base bx bx-message-square icon-sm d-sm-none"></i>
    </button>
</li>
<li class="nav-item" v-if="!isPerjadin">
    <button
        type="button"
        class="nav-link"
        role="tab"
        data-bs-toggle="tab"
        data-bs-target="#navs-cetak2"
        aria-controls="navs-cetak"
        aria-selected="false">
        <span class="d-none d-sm-inline-flex align-items-center"><i class="icon-base bx bx-printer icon-sm me-1"></i> Cetak Dokumen</span>
        <i class="icon-base bx bx-message-square icon-sm d-sm-none"></i>
    </button>
</li>