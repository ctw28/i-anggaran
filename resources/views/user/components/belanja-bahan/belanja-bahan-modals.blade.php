<div class="modal fade" id="modalEditBelanja" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Edit Belanja Bahan : @{{ form.pencairan_nama }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" @click="closeEditBelanjaBahanModal"></button>
            </div>

            <div class="modal-body">
                <small class="text-muted">
                    <ul class="mb-2">
                        <li><b>PPN</b>: 11%</li>
                        <li><b>PPh 22</b>: 1,5% (ada NPWP) / 3% (tidak ada NPWP)</li>
                        <li><b>PPh 23</b>: 2% (ada NPWP) / 4% (tidak ada NPWP)</li>
                    </ul>
                </small>

                <table class="table table-striped table-hover" id="belanja-table">
                    <thead>
                        <tr class="text-center">
                            <th style="width:60px">Urut</th>
                            <th style="width:50px">No</th>
                            <th style="width:400px">Item</th>
                            <th style="width:80px">Qty</th>
                            <th style="width:100px">Satuan</th>
                            <th style="width:140px">Total</th>
                            <th style="width:60px">PPN</th>
                            <th style="width:60px">PPh 22</th>
                            <th style="width:60px">PPh 23</th>
                            <th style="width:140px">Nilai PPN</th>
                            <th style="width:140px">Nilai PPh</th>
                            <th style="width:70px">Hapus</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="(item, index) in dataBelanjaBahan" :key="index">
                            <td class="text-center" style="width:60px">
                                <a v-if="isBelanjaEditing" href="#" @click.prevent="moveUp(dataBelanjaBahan, index)">
                                    <i class="tf-icons bx bx-chevron-up"></i>
                                </a>
                                <a v-if="isBelanjaEditing" href="#" @click.prevent="moveDown(dataBelanjaBahan, index)">
                                    <i class="tf-icons bx bx-chevron-down"></i>
                                </a>
                            </td>

                            <td class="text-center" style="width:50px">@{{ index + 1 }}</td>
                            <td style="width:400px">
                                <textarea
                                    v-model="item.item"
                                    rows="2"
                                    :disabled="!isBelanjaEditing || isSaving"
                                    class="form-control"></textarea>
                            </td>


                            <td style="width:80px">
                                <input v-model.number="item.qty" @input="updateTotal(index)" :disabled="!isBelanjaEditing || isSaving" class="form-control text-end">
                            </td>

                            <td style="width:100px">
                                <input v-model="item.harga_satuan" @input="updateTotal(index)" :disabled="!isBelanjaEditing || isSaving" class="form-control text-end">
                            </td>

                            <td style="width:140px">
                                <input v-model="formattedBelanja[index].nilai"
                                    :disabled="!isBelanjaEditing || isSaving"
                                    class="form-control text-end"
                                    @input="formatRibuan(dataBelanjaBahan, index, 'nilai', $event.target.value)">
                            </td>

                            <td class="text-center" style="width:60px">
                                <input type="checkbox" v-model="item.isPpn" :disabled="!isBelanjaEditing || isSaving" @change="calculateBelanjaBahan(index)">
                            </td>

                            <td class="text-center" style="width:60px">
                                <input type="checkbox" v-model="item.isPph22" :disabled="!isBelanjaEditing || isSaving" @change="calculateBelanjaBahan(index)">
                            </td>

                            <td class="text-center" style="width:60px">
                                <input type="checkbox" v-model="item.isPph23" :disabled="!isBelanjaEditing || isSaving" @change="calculateBelanjaBahan(index)">
                            </td>

                            <td style="width:140px">
                                <input v-model="formattedBelanja[index].ppn" disabled class="form-control text-end">
                            </td>

                            <td style="width:140px">
                                <input v-model="formattedBelanja[index].pph" disabled class="form-control text-end">
                            </td>

                            <td style="width:70px" class="text-center">
                                <button :disabled="!isBelanjaEditing || isSaving" @click="deleteRow(dataBelanjaBahan,index)" class="btn btn-danger btn-sm">
                                    <i class="tf-icons bx bx-minus"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="col-sm-12">
                    <button @click="tambahBelanjaBahan" v-if="isBelanjaEditing" class="btn btn-warning btn-sm mt-3"><i class="tf-icons bx bx-plus"></i> Tambah Baris</button>
                </div>

            </div>

            <div class="modal-footer">

                <!-- Tombol Simpan -->
                <button v-if="!isBelanjaEditing" @click="toggleEdit('belanja')" class="btn btn-warning btn-sm me-2">
                    <i class="tf-icons bx bx-edit"></i>
                    Edit
                </button>
                <button v-if="isBelanjaEditing" @click="saveBelanjaBahan" :disabled="isSaving" class="btn btn-dark btn-sm me-2">
                    <i class="tf-icons bx" :class="isSaving ? 'bx-loader bx-spin' : 'bx-save'"></i>
                    @{{ isSaving ? 'Menyimpan...' : 'Simpan' }}
                </button>
                <button @click="closeEditBelanjaBahanModal" data-bs-dismiss="modal" :disabled="isSaving" class="btn btn-secondary btn-sm">
                    <i class="tf-icons bx bx-cancel-outline"></i>
                    Keluar
                </button>
            </div>
        </div>
    </div>
</div>