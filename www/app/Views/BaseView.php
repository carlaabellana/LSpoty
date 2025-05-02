<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $this->renderSection('title') ?></title>
    <?= $this->renderSection('CSS') ?>
    <style>
        body{
            margin: 0;
        }
        #content{
            margin: 10px;
            margin-top: 134px;
        }
        #logo{
            height: 70px;
            cursor: pointer;
            margin: 20px;
            border-radius: 30%;
        }
        #right {
            margin-right: 40px;
        }
        header {
            background-color: #ffcdb2;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

    </style>
</head>
    <body>
        <header>
            <a href="<?=base_url('/home');?>"><img src="<?=base_url('/logoTemp.png');?>" alt="Logo" id="logo"></a>
            <!--center nav: para poner algo en el centro de la barra de nav (nada / seach bar)-->
            <div><?=$this->renderSection('centerNav')?></div>
            <!--side nav: para poner algo en el lado de la barra de nav ex (botones log in / boton myplaylists, user, log out /+ boton main menu etc)-->
            <div id="right"><?=$this->renderSection('sideNav')?></div>
        </header>
        <div id="content">
            <?= $this->renderSection('content') ?>
        </div>
    </body>
</html>
