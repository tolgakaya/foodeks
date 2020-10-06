<div class="modal fade" id="optionModal" tabindex="-1" role="dialog" aria-labelledby="optionModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="optionModalLabel">Ürün Seçenek Bilgisi</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <div class="form-group">
                        <label for="option">Seçenek</label>
                        <input type="text" class="form-control" id="option" aria-describedby="optionHelp"
                            placeholder="Seçenek giriniz">
                        <small id="optioHelp" class="form-text text-muted">Seçenek
                            giriniz</small>
                    </div>
                    <div class="form-group">
                        <label for="optionFee">Fiyat</label>
                        <input type="number" class="form-control" id="optionFee" aria-describedby=" optionFeeHelp"
                            placeholder="Seçenek ekstra fiyat giriniz">
                        <small id="optionFeeHelp" class="form-text text-muted">Seçenek
                            ekstra fiyat
                            giriniz</small>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                <button type="button" id="btnOptionSave" class="btn btn-primary">Kaydet</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="extraModal" tabindex="-1" role="dialog" aria-labelledby="extraModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="extraModalLabel">Ürün Ekstra Bilgisi</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <div class="form-group">
                        <label for="extra">Eksta</label>
                        <input type="text" class="form-control" id="extra" aria-describedby="
                                                        extraHelp" placeholder="Ekstra giriniz">
                        <small id="extraHelp" class="form-text text-muted">Ürün yanında
                            verilebilecek extra ürün bilgisi giriniz.Örnek, salata
                            vb</small>
                    </div>
                    <div class="form-group">
                        <label for="extraFee">Fiyat</label>
                        <input type="number" class="form-control" id="extraFee" aria-describedby="extraFeeHelp"
                            placeholder="Ekstra fiyat giriniz">
                        <small id="extraFeeHelp" class="form-text text-muted">Burada
                            girdiğiniz fiyat extra ürün seçilmesi halinde ürün fiyatına
                            eklenecektir.</small>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                <button type="button" id="btnExtraSave" class="btn btn-primary">Kaydet</button>
            </div>
        </div>
    </div>
</div>