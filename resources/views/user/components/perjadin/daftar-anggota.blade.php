<div class="nav-align-top mb-4">
    <div class="tab-pane fade active show mt-3" id="show-anggota" role="tabpanel">
        <button type="button" v-if="!isAddAnggota" @click="addAnggota" class="btn btn-primary btn-sm me-2"><i class="bx bx-plus"></i> Tambah Anggota</button>
        <!-- <div class="my-3" id="tambah-anggota-form"> -->
        <div v-if="isAddAnggota" class="mt-3" id="tambah-anggota-form">
            <div class="col-12">
                <div class="mb-3">
                    <div class="row">
                        <div class="col-3">
                            <label class="form-label" for="anggota_nama">Nama Anggota</label>
                            <input type="text" v-model="newAnggota.nama" @input="fetchPegawai('anggota')"
                                @focus="activeDropdownGlobal = 'anggota'" @blur="hideDropdown('anggota')"
                                placeholder="Cari Pegawai..." class="form-control">

                            <ul v-if="activeDropdownGlobal === 'anggota' && searchResultsGlobal.length" class="dropdown">
                                <li v-for="pegawai in searchResultsGlobal" :key="pegawai.pegawai_nomor_induk"
                                    @mousedown.prevent="selectPegawai('anggota', pegawai)">
                                    @{{ pegawai.pegawai_nomor_induk }} - @{{ pegawai.nama }}
                                </li>
                            </ul>

                        </div>
                        <div class="col-3">
                            <label class="form-label" for="anggota_nip">NIP</label>
                            <input type="text" class="form-control" v-model="newAnggota.nip" placeholder="NIP Pegawai" />
                        </div>
                        <div class="col-4">
                            <label class="form-label" for="anggota_jabatan">Jabatan</label>
                            <input type="text" class="form-control" v-model="newAnggota.jabatan" placeholder="Jabatan" />
                        </div>

                        <div class="row">
                            <div class="col-12 mt-3">
                                <button type="button" @click="saveAnggota" class="btn btn-dark btn-sm me-2">Simpan</button>
                                <button type="button" @click="cancelAddAnggota" class="btn btn-warning btn-sm">Batal</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 mt-3">
                <div class="card card-action mb-4">
                    <div class="card-header align-items-center">
                        <h5 class="card-action-title mb-0">Anggota Perjadin</h5>
                        <div class="card-action-element">
                            <!-- <button type="button" onclick="addAnggota()" class="btn btn-primary btn-sm"><i class="bx bx-plus"></i></button> -->
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-stripped table-hover">
                            <thead>
                                <th>No</th>
                                <th>NIP</th>
                                <th>NAMA</th>
                                <th>JABATAN</th>
                                <th>AKSI</th>
                            </thead>
                            <tbody>
                                <tr v-for="(anggota, index) in perjadinAnggota">
                                    <td>@{{ index + 1 }}</td>
                                    <td>@{{ anggota.nip }}</td>
                                    <td>@{{ anggota.nama }}</td>
                                    <td>@{{ anggota.jabatan }}</td>
                                    <td>
                                        <!--     <button type="button" data-bs-toggle="modal" data-bs-target="#rincianModal" @click="loadRincian(index)" class="btn btn-primary me-2">
                                            <i class="bx bx-detail"></i>
                                        </button> -->
                                        <button type="button" @click="deleteAnggota(anggota.id)" class="btn btn-danger btn-sm">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>