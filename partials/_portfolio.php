<div id="portfolio">
    <div class="container">
        <div class="section-title text-center center">
            <h2><?= $text_ln['portfolio_section']['title'] ?></h2>
            <hr>
        </div>
        <div class="categories">
            <ul class="cat">
                <li>
                    <ol class="type">
                        <li><a href="#" data-filter="*"
                               class="active"><?= $text_ln['portfolio_section']['categories']['all'] ?></a></li>
                        <li><a href="#" data-filter=".web"><?= $text_ln['portfolio_section']['categories']['web'] ?></a>
                        </li>
                        <li><a href="#"
                               data-filter=".design"><?= $text_ln['portfolio_section']['categories']['design'] ?></a>
                        </li>
                        <li><a href="#"
                               data-filter=".branding"><?= $text_ln['portfolio_section']['categories']['branding'] ?></a>
                        </li>
                        <li><a href="#"
                               data-filter=".video"><?= $text_ln['portfolio_section']['categories']['video'] ?></a>
                        </li>
                        
                    </ol>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="row">
            <div class="portfolio-items">
                <?php
                for ($i = 0; $i < sizeof($vars['projects']['projects']); $i++) {
                    ?>
                    <div class="col-sm-6 col-md-3 col-lg-3 <?= $vars['projects']['projects'][$i]['category'] ?>">
                        <div class="portfolio-item" data-toggle="modal" data-target="#modal-project_<?= $i + 1 ?>">
                            <div class="hover-bg">
                                <div class="hover-text">
                                    <h4><?= $text_ln['portfolio_section']['projects'][$i]['title'] ?></h4>
                                    <small><?= $text_ln['portfolio_section']['projects'][$i]['category'] ?></small>
                                </div>
                                <img src="<?= $vars['projects']['imgs_path'] . '/' . $vars['projects']['projects'][$i]['img'] ?>"
                                     class="img-responsive"
                                     alt="<?= $text_ln['portfolio_section']['projects'][$i]['title'] ?>">
                            </div>
                        </div>
                    </div>

                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <?php
    for ($i = 0;
         $i < sizeof($vars['projects']['projects']);
         $i++) {
        ?>
        <!-- Modales -->
        <div class="modal fade" id="modal-project_<?= $i + 1 ?>" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= $text_ln['portfolio_section']['projects'][$i]['title'] ?></h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-7">
                                    <!-- Carousel Start-->
                                    <div id="myCarousel_<?= $i + 1 ?>" class="carousel slide">
                                        <!-- Carousel items -->
                                        <div class="carousel-inner">
                                            <?php
                                            for ($j = 0; $j < sizeof($vars['projects']['projects'][$i]['carousel']); $j++) {
                                                ?>
                                                <div class="<?= $j == 0 ? "active" : "" ?> item">
                                                    <?php
                                                    if ($vars['projects']['projects'][$i]['carousel'][$j]['type'] == 'img') {
                                                        ?>
                                                        <img src="<?= $vars['projects']['projects'][$i]['carousel'][$j]['url'] ?>"
                                                             width="800"
                                                             height="533">
                                                        <?php
                                                    } else if ($vars['projects']['projects'][$i]['carousel'][$j]['type'] == 'video') {
                                                        ?>
                                                        <div class="embed-responsive embed-responsive-16by9">
                                                            <iframe class="embed-responsive-item" width="560"
                                                                    height="315"
                                                                    src="<?= $vars['projects']['projects'][$i]['carousel'][$j]['url'] ?>"
                                                                    frameborder="0">
                                                            </iframe>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <a class="left carousel-control" href="#myCarousel_<?= $i + 1 ?>" role="button"
                                           data-slide="prev">
                                            <i class="fa fa-chevron-left" aria-hidden="true"></i>
                                            <span class="sr-only"><?= $text_ln['portfolio_section']['carousel']['previous'] ?></span>
                                        </a>
                                        <a class="right carousel-control" href="#myCarousel_<?= $i + 1 ?>" role="button"
                                           data-slide="next">
                                            <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                            <span class="sr-only"><?= $text_ln['portfolio_section']['carousel']['next'] ?></span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <?= $text_ln['portfolio_section']['projects'][$i]['description'] ?>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary"
                                data-dismiss="modal"><?= $text_ln['portfolio_section']['carousel']['close'] ?></button>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }
    ?>
</div>
