<div class="collapse navbar-collapse" id="main-header-collapse">

    <ul id="primary-nav"
        class="main-nav nav align-items-lg-stretch justify-content-lg-end"
        data-submenu-options='{ "toggleType":"fade", "handler":"mouse-in-out" }'>

        <li class="<?php echo $pageCodeName == "manufacturers" ? "active" : "menu-item-has-children megamenu megamenu-fullwidth" ?>">
            <a href="/en/manufacturer">
                <span class="link-icon"></span>
                <span class="link-txt">
                    <span class="link-ext"></span>
                    <span class="txt">
                        Manufacturers
                        <span class="submenu-expander">
                            <i class="fa fa-angle-down"></i>
                        </span>
                    </span>
                </span>
            </a>
        </li>
        <li class="<?php echo $pageCodeName == "distributors" ? "active" : "menu-item-has-children megamenu megamenu-fullwidth" ?>">
            <a href="/en/distributor">
                <span class="link-icon"></span>
                <span class="link-txt">
                    <span class="link-ext"></span>
                    <span class="txt">
                        Distributors
                        <span class="submenu-expander">
                            <i class="fa fa-angle-down"></i>
                        </span>
                    </span>
                </span>
            </a>
        </li>
        <li class="menu-item-has-children megamenu megamenu-fullwidth">
            <a href="/en/healthcare-provider">
                <span class="link-icon"></span>
                <span class="link-txt">
                    <span class="link-ext"></span>
                    <span class="txt">
                        Healthcare providers
                        <span class="submenu-expander">
                            <i class="fa fa-angle-down"></i>
                        </span>
                    </span>
                </span>
            </a>
        </li>
        <li class="<?php echo $pageCodeName == "about" ? "active" : "menu-item-has-children megamenu megamenu-fullwidth" ?>">
            <a href="/en/about">
                <span class="link-icon"></span>
                <span class="link-txt">
                    <span class="link-ext"></span>
                    <span class="txt">
                        About
                        <span class="submenu-expander">
                            <i class="fa fa-angle-down"></i>
                        </span>
                    </span>
                </span>
            </a>
        </li>
        <?php if(!$isAuth): ?>
            <li class="menu-item-has-children">
                <a href="/en/auth/signin">
                    <span class="link-icon"></span>
                    <span class="link-txt">
                    <span class="link-ext"></span>
                    <span class="txt">
                        Login
                        <span class="submenu-expander">
                            <i class="fa fa-angle-down"></i>
                        </span>
                    </span>
                </span>
                </a>
            </li>
        <?php endif; ?>
    </ul><!-- /#primary-nav  -->
</div><!-- /#main-header-collapse -->
<div class="header-module">
    <?php if($isAuth): ?>
        <a href="/en/dashboard" class="btn btn-default btn-bordered round">
            <span class="btn-txt">My Account</span>
        </a>
    <?php else: ?>
        <a href="/en/auth/signup" class="btn btn-default btn-bordered round">
            <span class="btn-txt">Sign Up</span>
        </a>
    <?php endif; ?>
</div>