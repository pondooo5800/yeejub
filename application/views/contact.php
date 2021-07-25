        <!-- Inner Banner -->
        <div class="inner-banner bg-shape2 bg-color2">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="conatiner">
                        <div class="inner-title text-center">
                            <h3><?php echo lang('nav_contact');  ?></h3>
                            <ul>
                                <li>
                                    <a href="{base_url}index"><?php echo lang('nav_home'); ?></a>
                                </li>
                                <li>
                                    <i class="fas fa-chevron-right"></i>
                                </li>
                                <li>
                                    <?php echo lang('nav_contact');  ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Inner Banner End -->        <!-- Contact Area -->
        <div class="contact-area pt-100 pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="contact-item">
                            <div class="icon-contact text-center"><i class="far fa-clock"></i></div>
                            <h3>10:00 AM - 7:00 PM</h3>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="contact-item">
                            <div class="icon-contact text-center"><i class="fas fa-map-marker-alt"></i></div>
                            <h3><?php echo lang('ct_footer_addr');  ?></h3>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 offset-md-3 offset-lg-0">
                        <div class="contact-item text-center">
                            <div class="icon-contact"><i class="flaticon-telephone"></i></div>
                            <h3>
                                <a href="tel:061-848-1948">
                                    061-848-1948
                                </a>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact Area End -->

        <!-- Contact Form -->
        <div class="contact-form pb-70">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-6 p-0">
                        <div class="contact-img">
                        <img src="{base_url}assets/images/gallery/13.jpg" alt="Contact Images">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-area">
                            <div class="form-section">
                                <h2><?php echo lang('c_h1');  ?></h2>
                                <form action="<?php echo site_url('send_mail/send');?>" method="post">
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="form-group">
                                                <input type="text" name="name" id="name" class="form-control" placeholder="<?php echo lang('c_m1');  ?>">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-sm-6">
                                            <div class="form-group">
                                                <input type="email" name="email" id="email" class="form-control " placeholder="<?php echo lang('c_m2');  ?>">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-sm-6">
                                            <div class="form-group">
                                                <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="<?php echo lang('c_m3');  ?>">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="form-group">
                                                <input type="text" name="msg_subject" id="msg_subject" class="form-control" placeholder="<?php echo lang('c_m4');  ?>">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <textarea name="message" class="form-message textarea-hight" id="message" cols="30" rows="5" placeholder="<?php echo lang('c_m5');  ?>"></textarea>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12">
                                            <button type="submit" class="default-btn1 btn-two">
                                                <?php echo lang('c_sm');  ?>
                                            </button>
                                            <div id="msgSubmit" class="h3 text-center hidden"></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact Form End -->

