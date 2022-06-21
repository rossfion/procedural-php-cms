<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="CMS built using procedural PHP and MySQLi">
        <meta name="author" content="Fionn Ross">

        <title><?php
            if (isset($page_title)) {
                echo '- ' . h($page_title);
            }
            ?><?php
            if (isset($preview) && $preview) {
                echo ' [PREVIEW]';
            }
            ?></title>

        <!-- Bootstrap Core CSS -->
        <link href="<?php echo url_for('/stylesheets/bootstrap.min.css'); ?>" media="all" rel="stylesheet" />

        <!-- Custom CSS -->
        <link href="<?php echo url_for('/stylesheets/blog-home.css'); ?>" media="all" rel="stylesheet">

        <link href="<?php echo url_for('/stylesheets/styles.css'); ?>" media="all" rel="stylesheet">

        <link href="<?php echo url_for('/stylesheets/public.css'); ?>" media="all" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>