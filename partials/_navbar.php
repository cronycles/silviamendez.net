<div id="nav">
    <nav class="navbar navbar-custom">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i></button>
                <a class="navbar-left page-scroll" href="#page-top">
                    <img src="../img/logo-white_v3.0.png" width="180" alt="<?= $text['name'] . " " . $text['surname1'] ?>">
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden"><a href="#page-top"></a></li>
                    <li><a class="page-scroll" href="#about"><?= $text_ln['nav']['about'] ?></a></li>
                    <li><a class="page-scroll" href="#skills"><?= $text_ln['nav']['skills'] ?></a></li>
                    <li><a class="page-scroll" href="#portfolio"><?= $text_ln['nav']['portfolio'] ?></a></li>
                    <li><a class="page-scroll" href="#contact"><?= $text_ln['nav']['contact'] ?></a></li>
                    <li><a class="page-scroll" href="/<?= $alternate_language1 ?>/"><?= $text_ln['nav']['alternate_language1'] ?></a></li>
                </ul>
            </div>
        </div>
    </nav>
</div>