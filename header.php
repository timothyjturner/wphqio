<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
            bloginfo('name');
            if (wp_title('', false)) {
                echo '|';
            } else {
                echo bloginfo('description');
            } wp_title('');
        ?>
    </title>

    <?php wp_head(); ?>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-04G4MEWXLN"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-04G4MEWXLN');
    </script>
</head>

<body <?php body_class(); ?>>

<?php $header = get_field('header', 'option'); ?>

<header class="global-header">
    <div class="container">
        <div class="row align-center">
            <div class="header-logo col-md-3">
                <a href="/"><img src="<?=$header['logo']['url']?>"></a>
            </div>

            <div class="header-nav col-md-9">
                <div class="nav-wrapper">
                    <?php 	
                        wp_nav_menu( array( 'theme_location'=>'main-menu', 'container_class'=>'main-menu' ) ); 
                    ?>
                </div>
            </div>
        </div>
    </div>
</header>
