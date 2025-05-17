<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?= $this->renderSection('title') ?></title>
        <?= $this->renderSection('CSS') ?>
        <link rel="stylesheet" href="/CSS/BaseView.css">
    </head>
    <body>
        <header>
            <a href="<?= base_url('/home ');?>"><img src="<?= base_url('/logoTemp.png');?>" alt="Logo" id="logo"></a>
            <!--center nav: para poner algo en el centro de la barra de nav (nada / seach bar)-->
            <div id="center"><?=$this->renderSection('centerNav')?></div>
            <div id ='right'>
                <a id="My" href="<?= url_to('my-playlists.index') ?>"><?= lang('HomePage.myPlaylists')?>💕</a>

                <div>
                    <a href="<?= url_to('profile.get') ?>" style="display:inline-block; border:none; background:none; padding:0; cursor:pointer;">
                        <img src="<?= esc($globalUserImgUrl ?? base_url('IMAGES/default_image.png')) ?>" id="userImg" alt="User Image">
                    </a>
                </div>

                <form action="<?= site_url('logout') ?>" method="post" style="display:inline">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn cancel"><?= lang('HomePage.bye')?></button>
                </form>
            </div>
        </header>

        <div id="content">
            <?= $this->renderSection('content') ?>
        </div>

        <script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
        <?= $this->renderSection('scripts') ?>
    </body>
</html>