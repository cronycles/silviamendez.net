<div id="about">
    <div class="container">
        <div class="section-title text-center center">
            <h2><?= $text_ln['about_section']['title'] ?></h2>
            <hr>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <img src="../img/about_v1.0.jpg" width="270" height="270" class="img-responsive"
                     alt="<?= $text['name'] . " " . $text['surname1'] ?>">
            </div>
            <div class="col-md-8 col-md-offset-2">
                <div class="about-text">
                    <?= $text_ln['about_section']['text'] ?>
                    <p class="text-center">
                        <a class="btn btn-primary" href="https://cdn.silviamendez.net/CV_SilviaMendez_<?=$current_language?>.pdf"
                           target="_blank">
                            <i class="fa fa-download"></i>
                            <?= $text_ln['about_section']['download_cv_button'] ?>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
