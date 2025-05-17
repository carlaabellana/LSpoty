<!--Extending from Logged BaseView contains the general elements of the file. For avoid repeating common elements trough pages-->
<?= $this->extend('LogBaseView') ?>

<!--Title of the page will appear on the navbar-->
<?= $this->section('title') ?>
    Create Playlist | LSpoty
<?= $this->endSection() ?>

<!--We link the CSS to format the page-->
<?= $this->section('CSS') ?>
<link rel="stylesheet" href="/CSS/CreatePlaylist_styles.css">
<?= $this->endSection() ?>

<!--Center of the Navbar, allows the user to return to homepage-->
<?= $this->section('centerNav') ?>
<a href="<?= route_to('home.get'); ?>" class="home-link">← Back to Home</a>
<?= $this->endSection() ?>

<!--Content we will render in the page html-->
<?= $this->section('content') ?>
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php $errors = session()->getFlashdata('errors') ?? []; ?>

<main class="create-playlist-main">
    <form id="createPlaylistForm" class="create-content" action="<?= route_to('playlist.store') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <article>
            <label> Title for playlist: </label>
            <input type="text" name="playlist_name" value="<?= esc($old['playlist_name'] ?? '') ?>">
            <?php if (isset($errors['playlist_name'])): ?>
                <div class="error"><?= esc($errors['playlist_name']) ?></div>
            <?php endif; ?>

            <label>Introduce Image</label>
            <input type="file" name="playlist_image" value="<?= esc($old['playlist_image'] ?? '') ?>">
            <?php if (isset($errors['playlist_image'])): ?>
                <div class="error"><?= esc($errors['playlist_image']) ?></div>
            <?php endif; ?>
        </article>

        <footer class="sumbit-button">
            <button type="submit" name="action" value="createPlaylist" class="btn create"> Create </button>
        </footer>
    </form>
    <div id="success-message" style="color: green;"></div>
</main>
<?= $this->endSection() ?>

<?= $this->section('JS') ?>
<script src="<?= base_url('JS/Add_toPlaylist.js') ?>" defer></script>
<?= $this->endSection() ?>

