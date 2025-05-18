<!--This header will be shown to the non registered users-->

<!doctype html>
<html lang="en">
<head>
    <!--Basic metadata for characters & responsiveness-->
    <meta charset="UTF-8">

    <!--Page title rendered in a child view section-->
    <title><?= $this->renderSection('title') ?></title>

    <!--CSS styles that will be rendered in achild section-->
    <?= $this->renderSection('CSS') ?>
    <link rel="stylesheet" href="/CSS/BaseView_Style.css">
</head>
    <body>
        <header>
            <!--Button to access the homepage-->
            <a href="<?= route_to('home.get'); ?>"><img src="<?= base_url('/logoTemp.png');?>" alt="Logo" id="logo"></a>
            <!--center nav: para poner algo en el centro de la barra de nav (nada / seach bar)-->
            <div id="center"><?=$this->renderSection('centerNav')?></div>
            <!--side nav: para poner algo en el lado de la barra de nav ex (botones log in / boton myplaylists, user, log out /+ boton main menu etc)-->
            <div id="right"></div>
        </header>

        <!--Main content of the page will be rendered here as a child section-->
        <div id="content">
            <?= $this->renderSection('content') ?>
        </div>
    </body>
</html>
