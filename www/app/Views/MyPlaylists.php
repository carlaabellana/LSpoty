<!--Extending from the Logged BaseView contains the general elements of the file. For avoid repeating common elements trough pages -->
<?= $this->extend('LogBaseView') ?>

<!--Title of the page will appear on the navbar-->
<?= $this->section('title') ?>
<?= lang('homepage.playlist_title')?> | LSpoty
<?= $this->endSection() ?>

<!--We link the CSS to format the page-->
<?= $this->section('CSS') ?>
<link rel="stylesheet" href="/CSS/MyPlaylists_cards.css">
<?= $this->endSection() ?>

<!--We link the JavaScript to format the page-->
<?= $this->section('scripts') ?>
<script src="/JS/MyPlaylists.js"></script>
<?= $this->endSection() ?>

<!--Center of the Navbar, allows the user to return to homepage-->
<?= $this->section('centerNav') ?>
<a href="<?= base_url('/home') ?>" class="home-link"><?= lang('homepage.return_home')?></a>
<?= $this->endSection() ?>

<!--Content we will render in the page html-->
<?= $this->section('content') ?>
<div class="playlist-dashboard">
    <div class="playlist-sidebar">
        <h2><?= lang('homepage.my_playlists')?></h2>
        <a href="<?= route_to('playlist.create') ?>" class="create-btn"><?= lang('homepage.new_playlist')?></a>
        <div class="playlist-list">
            <?php foreach ($playlists as $playlist): ?>
                <div class="playlist-card" data-id="<?= $playlist['id'] ?>">
                    <?php
                    $coverFile = WRITEPATH . '../public/uploads/' . $playlist['cover'];
                    $coverUrl = file_exists($coverFile) && !empty($playlist['cover'])
                        ? base_url('/uploads/' . $playlist['cover'])
                        : base_url('/IMAGES/default_cover.jpg');
                    ?>
                    <img src="<?= $coverUrl ?>" alt="Cover" class="playlist-cover">
                    <span><?= esc($playlist['name']) ?></span>

                    <a href="<?= route_to('my-playlists.concrete', $playlist['id']) ?>" class="btn btn-view create-btn " role="button">
                        +
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div id="playlist-detail" class="playlist-detail">
        <p><?= lang('homepage.playlist_details')?></p>
    </div>
</div>
<?= $this->endSection() ?>
