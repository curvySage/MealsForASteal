<!DOCTYPE html>
<html>
<head>
    <title><?php if(isset($title)) echo $title; ?></title>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <!-- Controller Specific JS/CSS -->
    <?php if(isset($client_files_head)) echo $client_files_head; ?>
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/styles.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/mealsforasteal.js"></script>
</head>

<?php if(isset($content)) echo $content; ?>

<?php if(isset($client_files_body)) echo $client_files_body; ?>

</html>