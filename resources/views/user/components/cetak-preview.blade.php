<div class="row">
    <div class="col-md-2 col-sm-2 col-12 mb-3 mb-md-0 p-0">
        <div class="list-group" role="tablist" v-if="isNominal">
            <a class="list-group-item list-group-item-action" @click="showPreviewCetak('ampra')" data-bs-toggle="list" href="#show-ampra" aria-selected="false" role="tab" tabindex="-1">Ampra</a>
            <a class="list-group-item list-group-item-action" @click="showPreviewCetak('kuitansi')" data-bs-toggle="list" id="kuitansi" href="#show-kuitansi" aria-selected="false" role="tab" tabindex="-1">Kuintasi</a>
            <a class="list-group-item list-group-item-action" @click="showPreviewCetak('rekap')" data-bs-toggle="list" id="rekap" href="#show-rekap" aria-selected="false" role="tab" tabindex="-1">Rekap</a>
            <a class="list-group-item list-group-item-action" @click="showPreviewCetak('sptjb')" data-bs-toggle="list" id="sptjb" href="#show-sptjb" aria-selected="false" role="tab" tabindex="-1">SPTJB</a>
            <a class="list-group-item list-group-item-action" @click="showPreviewCetak('spm')" data-bs-toggle="list" id="spm" href="#show-spm" aria-selected="true" role="tab">SPM</a>
            <a class="list-group-item list-group-item-action" @click="showPreviewCetak('spi')" data-bs-toggle="list" id="spi" href="#show-spi" aria-selected="true" role="tab">SPI</a>
            <a class="list-group-item list-group-item-action" @click="showPreviewCetak('ppspm')" data-bs-toggle="list" id="spi" href="#show-ppspm" aria-selected="true" role="tab">PPSPM</a>
            <a class="list-group-item list-group-item-action" @click="showPreviewCetak('sptjk')" data-bs-toggle="list" id="sptjk" href="#show-sptjk" aria-selected="true" role="tab">SPTJK</a>
        </div>
        <div class="list-group" role="tablist" v-if="isBelanjaBahan">
            <a class="list-group-item list-group-item-action" @click="showPreviewCetak('kuitansi-belanja-bahan')" data-bs-toggle="list" id="kuitansi" href="#show-kuitansi-belanja-bahan" aria-selected="false" role="tab" tabindex="-1">Kuintasi</a>
            <a class="list-group-item list-group-item-action" @click="showPreviewCetak('rekap-belanja-bahan')" data-bs-toggle="list" id="rekap" href="#show-rekap-belanja-bahan" aria-selected="false" role="tab" tabindex="-1">Rekap</a>
            <a class="list-group-item list-group-item-action" @click="showPreviewCetak('sptjb-belanja-bahan')" data-bs-toggle="list" id="sptjb" href="#show-sptjb-belanja-bahan" aria-selected="false" role="tab" tabindex="-1">SPTJB</a>
            <a class="list-group-item list-group-item-action" @click="showPreviewCetak('spm-belanja-bahan')" data-bs-toggle="list" id="spm" href="#show-spm-belanja-bahan" aria-selected="true" role="tab">SPM</a>
            <a class="list-group-item list-group-item-action" @click="showPreviewCetak('spi-belanja-bahan')" data-bs-toggle="list" id="spi" href="#show-spi-belanja-bahan" aria-selected="true" role="tab">SPI</a>
            <a class="list-group-item list-group-item-action" @click="showPreviewCetak('ppspm-belanja-bahan')" data-bs-toggle="list" id="spi" href="#show-ppspm-belanja-bahan" aria-selected="true" role="tab">PPSPM</a>
            <a class="list-group-item list-group-item-action" @click="showPreviewCetak('sptjk-belanja-bahan')" data-bs-toggle="list" id="sptjk" href="#show-sptjk-belanja-bahan" aria-selected="true" role="tab">SPTJK</a>
        </div>
    </div>
    <div class="col-md-10 col-12">
        <div class="tab-content p-0" v-if="isNominal">
            <div class="tab-pane fade" id="show-ampra" role="tabpanel" aria-labelledby="list-home-list"></div>
            <div class="tab-pane fade" id="show-kuitansi" role="tabpanel" aria-labelledby="list-home-list"></div>
            <div class="tab-pane fade" id="show-rekap" role="tabpanel" aria-labelledby="list-profile-list"></div>
            <div class="tab-pane fade" id="show-sptjb" role="tabpanel" aria-labelledby="list-messages-list"></div>
            <div class="tab-pane fade" id="show-spm" role="tabpanel" aria-labelledby="list-settings-list"></div>
            <div class="tab-pane fade" id="show-sptjk" role="tabpanel" aria-labelledby="list-settings-list"></div>
            <div class="tab-pane fade" id="show-spi" role="tabpanel" aria-labelledby="list-settings-list"></div>
            <div class="tab-pane fade" id="show-ppspm" role="tabpanel" aria-labelledby="list-settings-list"></div>
        </div>
        <div class="tab-content p-0" v-if="isBelanjaBahan">
            <div class="tab-pane fade" id="show-kuitansi-belanja-bahan" role="tabpanel" aria-labelledby="list-home-list"></div>
            <div class="tab-pane fade" id="show-rekap-belanja-bahan" role="tabpanel" aria-labelledby="list-profile-list"></div>
            <div class="tab-pane fade" id="show-rekap-belanja-bahan" role="tabpanel" aria-labelledby="list-profile-list"></div>
            <div class="tab-pane fade" id="show-sptjb-belanja-bahan" role="tabpanel" aria-labelledby="list-messages-list"></div>
            <div class="tab-pane fade" id="show-spm-belanja-bahan" role="tabpanel" aria-labelledby="list-settings-list"></div>
            <div class="tab-pane fade" id="show-sptjk-belanja-bahan" role="tabpanel" aria-labelledby="list-settings-list"></div>
            <div class="tab-pane fade" id="show-spi-belanja-bahan" role="tabpanel" aria-labelledby="list-settings-list"></div>
            <div class="tab-pane fade" id="show-ppspm-belanja-bahan" role="tabpanel" aria-labelledby="list-settings-list"></div>
        </div>
    </div>
</div>