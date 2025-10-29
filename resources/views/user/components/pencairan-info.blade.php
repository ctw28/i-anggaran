<div class="row">
    <div class="col-md-7 col-xxl-7 mb-6">
        <div class="card h-100">
            <div class="d-flex align-items-end row">
                <div class="col-12">
                    <div class="card-body">
                        <h5 class="card-title mb-1 text-nowrap">Informasi Pencairan</h5>
                        <div v-if="!isPencairanEditing">
                            <p><strong>Akun :</strong> @{{ data.kode_akun_kode }} - @{{ data.kode_akun_nama }}<br>
                                <strong>Kegiatan :</strong> @{{ data.kegiatan_nama }}<br>
                                <strong>Nama Pencairan :</strong> @{{ form.pencairan_nama }}
                            </p>
                            <button class="btn btn-warning btn-sm me-2" @click="editPencairan" :disabled="isLoadingEdit">
                                <span v-if="isLoadingEdit">⏳ Loading...</span>
                                <span v-else><i class="icon-base bx bx-pencil me-1"></i> Edit</span>
                            </button>
                            <button class="btn btn-success btn-sm"><i class="icon-base bx bx-check me-1"></i> Tandai Selesai</button>

                        </div>
                        <form v-else @submit.prevent="updatePencairan">
                            <div class="mb-3">
                                <label class="form-label">Kode Akun</label>
                                <select v-model="form.kode_akun_id" class="form-control" disabled>
                                    <option value="">Pilih Akun</option>
                                    <option v-for="kodeAkun in kodeAkunList" :key="kodeAkun.id" :value="kodeAkun.id">
                                        @{{ kodeAkun.kode }} - @{{ kodeAkun.nama_akun }}
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kegiatan</label>
                                <select v-model="form.kegiatan_id" class="form-control">
                                    <option value="">Pilih Kegiatan</option>
                                    <option v-for="kegiatan in kegiatanList" :key="kegiatan.id" :value="kegiatan.id">
                                        @{{ kegiatan.kegiatan_nama }} (Pagu: @{{ formatRupiah(kegiatan.jumlah_biaya) }})
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Pencairan</label>
                                <textarea class="form-control" v-model="form.pencairan_nama"></textarea>
                            </div>

                            <button type="submit" class="btn btn-warning btn-sm me-1">✔️ Simpan</button>
                            <button type="button" class="btn btn-secondary btn-sm" @click="cancel">❌ Batal</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5 col-xxl-5 mb-6">
        <div class="card h-100">
            <div class="d-flex align-items-end row">
                <div class="col-12">
                    <div class="card-body">
                        Total Pencairan <h5 class="card-title text-primary mb-2">@{{formatRupiah(totalPencairan)}}</h5>

                        <h5 class="card-title mt-3 text-nowrap">Status Dokumen</h5>
                        <button v-if="!isKirimPpk" class="btn btn-danger btn-sm me-2" :disabled="isKirimSpi" data-bs-toggle="modal" data-bs-target="#backDropModal">
                            <span><i class="icon-base bx bx-send me-1"></i> Kirim ke PPK</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#backDropModal">
    Launch modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="backDropModalTitle">Konfirmasi</h5>
            </div>
            <div class="modal-body">
                <p>Yaking mengirim dokumen ke SPI? setelah terkirim ke SPI maka data dokumen tidak dapat diubah lagi </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Tidak jadi</button>
                <button @click="sendSPI" type="button" class="btn btn-dark">Ya, Kirim ke SPI</button>
            </div>
        </form>
    </div>
</div>