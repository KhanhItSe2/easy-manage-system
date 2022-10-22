<?php
if (!isset($_SESSION['is_login_admin'])) {
    header('Location: http://localhost:8888/index.php');
}
?>
<nav!AdSidebar html>
    <html lang="en" dir="ltr">

    <head>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      
        <link href="{{asset('public/../assets/css/style.css')}}" rel="stylesheet">;
        <link href="{{('../Data/db.php')}}">;
        <link href="{{('../function.php')}}">;
    </head>

    <body>
     
        <link href= "{{asset('../header.php')}}" >;
        <link href= "{{asset('./adsidebar.php')}}" >;


    </body>

    </html>