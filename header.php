<html>

<head>
    <link rel="shortcut icon" href="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body>
    <header class="header">
        <nav class="nav">
            <div class="logo">
                <a href="/">
                    Oglasi
                </a>
            </div>
            <div class="search">
                <input id="search" type="text" placeholder="pretraga" autocomplete="off">
                <div class="border"></div>
                <div class="border-grey"></div>
                <div id="searchSpiner" class="loader d-none"></div>
                <div id="searchResults" class="d-none">
                </div>
            </div>
            <?php if(is_user_logged_in()){?>
                <p class="login click">
                    <a href="<?php echo wp_logout_url(home_url()); ?>">Izloguj se</a>
                </p>
                <?php  }else{ ?>
                <p id="login" class="login click">
                    Uloguj Se
                </p>
            <?php   } ?>
        </nav>
    </header>
    <div class="meny-top menuScroll">
        <?php include('templates/main_nav.php') ?>
    </div>
    <div class="vertical-devider  menuScroll"></div>
    <div class="main">