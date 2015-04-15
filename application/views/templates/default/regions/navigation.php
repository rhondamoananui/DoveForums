<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            {logo}
        </div>
        <div id="navbar" class="collapse navbar-collapse">

            <ul class="nav navbar-nav">
                {links}
                <li>{link}</li>
                {/links}
            </ul>

            <ul class="nav navbar-nav navbar-right">

                <li class="dropdown">

                    <?php if($this->ion_auth->logged_in() === TRUE) { ?>

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-user fa-fw"></i> {username} <span class="caret"></span></a>

                    <?php } else { ?>

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-user fa-fw"></i> Account <span class="caret"></span></a>

                    <?php } ?>

                    <ul class="dropdown-menu">

                        <?php if($this->ion_auth->logged_in() === TRUE) { ?>

                            <li>{profile_link}</li>
                            <li>{settings_link}</li>

                            <?php if($this->ion_auth->is_admin() === TRUE) { ?>

                                <li>{dashboard_link}</li>

                            <?php } ?>

                            <li class="divider"></li>
                            <li>{logout_link}</li>


                        <?php } else { ?>

                            <li>{login_link}</li>
                            <li>{register_link}</li>

                        <?php } ?>

                    </ul>

                </li>

            </ul>

        </div>

    </div>

</nav>