<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $this->renderSection('title') ?></title>
    <?= $this->renderSection('CSS') ?>
    <link rel="stylesheet" href="/CSS/BaseView_Style.css">
</head>
    <body>
        <header>
            <a href="<?= route_to('home.get'); ?>"><img src="<?= base_url('/logoTemp.png');?>" alt="Logo" id="logo"></a>
            <!--center nav: para poner algo en el centro de la barra de nav (nada / seach bar)-->
            <div id="center"><?=$this->renderSection('centerNav')?></div>
            <!--side nav: para poner algo en el lado de la barra de nav ex (botones log in / boton myplaylists, user, log out /+ boton main menu etc)-->
            <div id="right"></div>
        </header>

        <div id="content">
            <?= $this->renderSection('content') ?>
        </div>
    </body>
</html>
