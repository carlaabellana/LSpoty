<!-- This HTML will be used to show PLAYLIST DETAILS -->

<!--Extending from Logged BaseView contains the general elements of the file. For avoid repeating common elements trough pages-->
<?= $this->extend('LogBaseView') ?>

<!--Title of the page will appear on the navbar-->
<?= $this->section('title') ?>
<?= esc($playlist['playlist_title']) ?> | LSpoty
<?= $this->endSection() ?>

<!--We link the CSS to format the page-->
<?= $this->section('CSS') ?>
<link rel="stylesheet" href="/CSS/PlaylistView.css">
<?= $this->endSection() ?>

<!--Center of the Navbar, allows the user to return to homepage-->
<?= $this->section('centerNav') ?>
<a href="<?= route_to('home.get'); ?>" class="home-link"><?= lang('homepage.return_home')?></a>
<?= $this->endSection() ?>

<!--Content we will render in the page html-->
<?= $this->section('content') ?>
<main class="playlist-main">
    <article aria-labelledby="playlist-title">

        <!--Here the general information of the playlist will be shown-->
        <section class="playlist-banner">
            <!--Cover of the playlist-->
            <figure class="playlist-image" role="img" aria-label="Playlist Cover">
                <img src="/IMAGES/playlistCover.jpg" alt="Playlist Cover" >
            </figure>

            <!--Data of playlist like title, the user who created it, date of creation and duration of the playlist-->
            <div class="playlist-information-I">
                <h1 id="playlist-title" class="playlist-title">
                    <?= esc($playlist['playlist_title']) ?>
                </h1>
                <p class="user-name"><strong><?= lang('HomePage.user')?></strong> <?= esc($playlist['playlist_user']) ?> </p>
                <p><strong><?= lang('HomePage.creation')?></strong> <?= esc($playlist['playlist_creationDate']) ?> </p>
                <p><strong><?= lang('HomePage.duration')?></strong> <?= esc($playlistDuration) ?></p>
                <button type="button" class="add-playlist"><?= lang('HomePage.save')?></button>
            </div>
        </section>

        <!--Here all the tracks of the playlist will be uploaded into the view-->
        <section class="track-list">
            <?php if (empty($tracks)): ?>
                <p><?= lang('HomePage.empty_playlist')?></p>
            <?php else: ?>

                <?php foreach ($tracks as $track): ?>
                    <div class="track-info">
                        <?= $track->generateView('playlist') ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </section>
    </article>
</main>
<?= $this->endSection() ?>
