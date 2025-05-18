<!--This header will be shown to the registered users-->
<!doctype html>
<html lang="en">
    <head>
        <!--Basic metadata for characters & responsiveness-->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="<?= csrf_hash() ?>">


        <!--Page title rendered in a child view section-->
        <title><?= $this->renderSection('title') ?></title>

        <!--CSS styles that will be rendered in achild section-->
        <?= $this->renderSection('CSS') ?>
        <link rel="stylesheet" href="/CSS/BaseView.css">
        <?= $this->renderSection('JS') ?>
    </head>
    <body>


        <header>
            <!--Button to access the homepage-->
            <a href="<?= route_to('home.get'); ?>"><img src="<?= base_url('/logoTemp.png');?>" alt="Logo" id="logo"></a>
            <!--center nav: para poner algo en el centro de la barra de nav (nada / seach bar)-->
            <div id="center"><?=$this->renderSection('centerNav')?></div>
            <div id ='right'>

                <!--Button to allow the user to navigate to my playlists-->
                <a id="My" href="<?= url_to('my-playlists.index') ?>"><?= lang('HomePage.myPlaylists')?>💕</a>

                <!--Image of the user will be rendered here and allows the user to go to profile page-->
                <div>
                    <a href="<?= url_to('profile.get') ?>" style="display:inline-block; border:none; background:none; padding:0; cursor:pointer;">
                        <img src="<?= esc($globalUserImgUrl ?? base_url('IMAGES/default_image.png')) ?>" id="userImg" alt="User Image">
                    </a>
                </div>

                <!--Button to allow the user to logout from the app-->
                <form action="<?= site_url('logout') ?>" method="post" style="display:inline">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn cancel"><?= lang('HomePage.bye')?></button>
                </form>
            </div>
        </header>

        <!--Main content of the page will be rendered here as a child section-->
        <div id="content">
            <?= $this->renderSection('content') ?>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <?= $this->renderSection('scripts') ?>
    </body>
</html>