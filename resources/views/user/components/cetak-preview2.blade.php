   <div class="card-body">
       <h5 class="card-title mb-3">
           <i class="bx bx-printer me-2 text-primary"></i> Pilih Dokumen yang Akan Dicetak
       </h5>

       <div class="row">
           <!-- Daftar dokumen nominal -->
           <div class="col-md-12" v-if="isNominal">
               <div class="list-group">
                   <label v-for="doc in daftarDokumenNominal" :key="doc.id" class="list-group-item d-flex align-items-center">
                       <input type="checkbox" v-model="doc.checked" class="form-check-input me-2">
                       <span>@{{ doc.label }}</span>
                   </label>
               </div>
           </div>

           <!-- Daftar dokumen belanja bahan -->
           <div class="col-md-12" v-if="isBelanjaBahan">
               <div class="list-group">
                   <label v-for="doc in daftarDokumenBelanjaBahan" :key="doc.id" class="list-group-item d-flex align-items-center">
                       <input type="checkbox" v-model="doc.checked" class="form-check-input me-2">
                       <span>@{{ doc.label }}</span>
                   </label>
               </div>
           </div>
       </div>

       <div class="mt-3">
           <button class="btn btn-primary" @click="printSelected">
               <i class="bx bx-printer me-1"></i> Cetak Terpilih
           </button>
       </div>

       <!-- Tempat iframes akan dimasukkan -->
       <div id="iframe-container" style="display:none;"></div>
   </div>