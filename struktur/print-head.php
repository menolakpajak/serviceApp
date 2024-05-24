<div id="head" class="row rounded">
    <div class="col-8">
        <div class="row pt-2 ps-3">
            <img src="../imgs/logo/only-logo-terang.png" class="col-6 h-100 p-1 gx-0 w-25">
            <div class="col-6 gx-0 d-flex align-items-center">
                <div>
                    <h3 class="m-0 font-head head-color">Digital Repair</h3>
                    <h6 class="m-0 font-head">
                        Jl. Tukad Pancoran IV <br>block A4 no 12B <br>
                        Denpasar - Bali <br>
                        08980000703</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4 d-flex text-end justify-content-end align-items-center">
        <?php if ($data['save_as'] == 'invoice') : ?>
            <h1 class="text-primary mb-0 font-stamp">INVOICE</h1>
        <?php else : ?>
            <h1 class="text-warning mb-0 font-stamp">QUOTATION</h1>
        <?php endif; ?>
    </div>
</div>