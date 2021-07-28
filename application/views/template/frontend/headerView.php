<div id="" class="header">
    <!--/.top-header -->
    <div class="top-header">
        <div class="container">
            <div class="currency ">
                YEEJUB.COM : ร้านหยี่จั๊บทุกอย่าง 20 บาท
            </div>
            <div id="user-line-top" class="user-info pull-right">
                <a href="https://line.me/ti/p/~@yeejub"><img height="20" border="0" alt="kgg.co.th" src="https://scdn.line-apps.com/n/line_add_friends/btn/en.png"></a>
            </div>
            <div id="user-info-top" class="user-info pull-right">
                <div class="dropdown">
                    <a class="current-open" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                        <span>Hi <?php echo ($this->session->userdata('member_fname'))?></span>
                    </a>
                    <ul class="dropdown-menu mega_dropdown" role="menu">
                        <li><a href="{site_url}index/member_index/<?php echo ($this->session->userdata('url_encrypt_id'))?>">ข้อมูลบัญชี</a></li>
                        <li><a href="{site_url}member_login/destroy">ออกจากระบบ</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--/.top-header -->
    <!-- MAIN HEADER -->
    <div class="container main-header">
        <div class="row">
            <div class="col-xs-12 col-sm-3 col-md-2 logo">
                <a href="{site_url}"><img class="img-logo" alt="Kute Shop" src="{base_url}/assets/themes/frontend/assets/img/icon/logo_yeejub.png"></a>
            </div>
            <div class="col-xs-7 col-sm-7 col-md-8 header-search-box">
                <form class="form-inline" action="products.html" method="post">
                    <div class="form-group form-category">
                        <select onchange="select_cat()" class="select-category select2-hidden-accessible" id="select_category" tabindex="-1" aria-hidden="true">
                            <option>แบรนด์ชั้นนำ</option>
                            <option value="10">MARVO</option>
                            <option value="66">MAXTILL</option>
                            <option value="11">MD-TECH</option>
                            <option value="22">MELON</option>
                            <option value="31">Microlab</option>
                            <option value="39">MOBILCAM</option>
                            <option value="42">Music D.j.</option>
                            <option value="27">MYE</option>
                            <option value="62">NAVRA</option>
                            <option value="12">NEOLUTION</option>
                            <option value="13">NOBI</option>
                            <option value="2">NUBWO</option>
                            <option value="45">UGREEN</option>
                        </select>
                    </div>
                    <div class="form-group input-serach">
                        <input type="text" name="search" placeholder="สินค้าที่ต้องการค้นหา">
                    </div>
                    <button type="submit" class="pull-right btn-search"></button>
                </form>
            </div>

            <div id="cart-block" class="col-xs-5 col-sm-2 col-md-2 shopping-cart-box">
                <div id="view_cart_mini">
                    <a class="cart-link" href="cart.html">
                        <span class="title">Shopping cart</span>
                        <span class="total"> items - 0</span>
                    </a>
                    <div class="cart-block">
                        <div class="cart-block-content">
                            <h5 class="cart-title"> Items in my cart</h5>
                            <div class="cart-block-list">
                                <ul>
                                </ul>
                            </div>
                            <div class="toal-cart">
                                <span>Total</span>
                                <span class="toal-price pull-right">0</span>
                            </div>
                            <div class="cart-buttons">
                                <a href="cart.html" class="btn-check-out">View Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- END MANIN HEADER -->
    <div id="nav-top-menu" class="nav-top-menu">
        <div class="container">
            <div class="row fix_menu">
                <div class="col-sm-3" id="box-vertical-megamenus">
                    <div class="box-vertical-megamenus" style="background: none; border: 0px">
                        <h4 class="title" style="background: none;  border: 0px">
                        </h4>
                    </div>
                </div>
                <div id="main-menu" class="col-sm-12 main-menu">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                    <i class="fa fa-bars"></i>
                                </button>
                                <a class="navbar-brand" href="#">MENU</a>
                            </div>
                            <div id="navbar" class="navbar-collapse collapse">
                                <ul class="nav navbar-nav">
                                    <li class="active"><a href="{site_url}">หน้าแรก</a></li>
                                    <li><a href="about-วิธีการสั่งซื้อ-28.html">วิธีการสั่งซื้อ</a></li>
                                    <li><a href="how_payment-วิธีการชำระเงิน.html">วิธีการแจ้งชำระเงิน และการจัดส่ง</a></li>
                                    <li><a href="about-เกี่ยวกับเรา-33.html">เกี่ยวกับเรา </a></li>
                                    <li><a href="contact.html">ติดต่อเรา</a></li>
                                </ul>
                            </div>
                            <!--/.nav-collapse -->
                        </div>
                    </nav>
                </div>
            </div>
            <!-- userinfo on top-->
            <div id="form-search-opntop">
            </div>
            <!-- userinfo on top-->
            <div id="user-info-opntop">
            </div>
            <div id="user-line-opntop">
            </div>
            <!-- CART ICON ON MMENU -->
            <div id="shopping-cart-box-ontop">
                <i class="fa fa-shopping-cart"></i>
                <div class="shopping-cart-box-ontop-content"></div>
            </div>
        </div>
    </div>
</div>