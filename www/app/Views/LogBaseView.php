<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $this->renderSection('title') ?></title>
    <?= $this->renderSection('CSS') ?>
    <link rel="stylesheet" href="/CSS/BaseView_styles.css">
</head>
<body>
<header>
    <a href="<?= base_url('/home ');?>"><img src="<?= base_url('/logoTemp.png');?>" alt="Logo" id="logo"></a>
    <!--center nav: para poner algo en el centro de la barra de nav (nada / seach bar)-->
    <div id="center"><?=$this->renderSection('centerNav')?></div>
    <div id ='right'>
        <a id="My">my playlists 💕</a>
        <a><img src="<?=$this->renderSection('imgUrl')?>" id="userImg"></a>
        <button>bye</button>
    </div>
</header>

<div id="content">
    <?= $this->renderSection('content') ?>
</div>
</body>
</html>