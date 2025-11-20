<!-- Modal -->
<div class="modal fade" id="rincianModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Pencairan : @{{ form.pencairan_nama }} <br>
                    Anggota Perjadin : @{{rincianNama}}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <select class="form-control" v-model="selectedAnggotaIndex" @change="changeAnggota">
                            <option value="">Pilih Anggota</option>
                            <option v-for="(anggota, index) in perjadinAnggota" :key="anggota.id" :value="index">
                                @{{anggota.nip }} - @{{anggota.nama}}
                            </option>
                        </select>
                    </div>
                </div>
                <ul class="nav nav-tabs mb-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link active" id="data" role="tab" data-bs-toggle="tab" data-bs-target="#show-rincian" aria-controls="navs-justified-home" aria-selected="true"><i class="tf-icons bx bx-home me-1"></i> Rincian</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#show-realcost" aria-controls="navs-justified-home" aria-selected="true"><i class="tf-icons bx bx-form me-1"></i> Real Cost</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link " role="tab" data-bs-toggle="tab" data-bs-target="#show-perjadin-cetak" aria-controls="navs-justified-home" aria-selected="true"><i class="tf-icons bx bx-printer me-1"></i> Cetak</button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="show-rincian" role="tabpanel">
                        @include('user/components/perjadin/rincian-form')
                    </div>
                    <div class="tab-pane fade" id="show-realcost" role="tabpanel">
                        @include('user/components/perjadin/realcost-form')
                    </div>
                    <div class="tab-pane fade" id="show-perjadin-cetak" role="tabpanel">
                        @include('user/perjadin/cetak-list')
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>