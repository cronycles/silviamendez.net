<!-- Contact Section -->
<div id="contact" class="text-center">
    <div class="container">
        <div class="section-title center">
            <h2><?= $text_ln['contact_section']['title'] ?></h2>
            <hr>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <div class="col-md-4">
                <i class="fa fa-map-marker fa-2x"></i>
                <p>
                    <?= $vars['city'] ?>
                </p>
            </div>
            <div class="col-md-4">
                <i class="fa fa-envelope-o fa-2x"></i>
                <p> <?= $vars['email'] ?></p>
            </div>
            <div class="col-md-4">
                <i class="fa fa-phone fa-2x"></i>
                <p><?= $vars['telephone'] ?></p>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <h3><?= $text_ln['contact_section']['send_message_text'] ?></h3>
            <form name="sentMessage" id="contactForm" novalidate>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" id="name" class="form-control"
                                   placeholder="<?= $text_ln['contact_section']['name_ph'] ?>" required="required">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="email" id="email" class="form-control"
                                   placeholder="<?= $text_ln['contact_section']['email_ph'] ?>" required="required">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <textarea name="message" id="message" class="form-control" rows="4"
                              placeholder="<?= $text_ln['contact_section']['message_ph'] ?>"
                              required></textarea>
                    <p class="help-block text-danger"></p>
                </div>
                <div id="success"></div>
                <button type="submit" class="btn btn-default"><?= $text_ln['contact_section']['send_button'] ?></button>
            </form>
            <?php include_once("../partials/_socials.php") ?>
        </div>
    </div>
</div>