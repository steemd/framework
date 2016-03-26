<div style="height: 80px;"></div>
<nav class="navbar navbar-default navbar-fixed-bottom">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Dev Mode</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">GET<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <pre>
                                <?php print_r($_GET); ?>
                            </pre>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">POST<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <pre>
                                <?php print_r($_POST); ?>
                            </pre>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">COOKIE<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <pre>
                                <?php print_r($_COOKIE); ?>
                            </pre>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">SESSION<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <pre>
                                <?php print_r($_SESSION); ?>
                            </pre>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">SERVER<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <pre style ="max-width: 640px; min-width: 250px; max-height: 500px;">
                                <?php print_r($_SERVER); ?>
                            </pre>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>