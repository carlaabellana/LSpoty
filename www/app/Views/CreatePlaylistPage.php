<!-- This HTML will be used to show CREATE PLAYLIST -->

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

<?= $this->section('scripts') ?>
<script src="/JS/CreatePlaylist.js"></script>
<?= $this->endSection() ?>

<!--Center of the Navbar, allows the user to return to homepage-->
<?= $this->section('centerNav') ?>
<a href="<?= route_to('home.get'); ?>" class="home-link"><?= lang('homepage.return_home')?></a>
<?= $this->endSection() ?>

<!--Content we will render in the page html-->
<?= $this->section('content') ?>
<!--A flash data message is set to show the success-->
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<!--A flash data is set to show errors-->
<?php $errors = session()->getFlashdata('errors') ?? []; ?>

<!--Here the form of the page will be displayed-->
<main class="create-playlist-main">
    <form id="createPlaylistForm" class="create-content" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <article>
            <!--Elements of the form related to the title sending, input and errors-->
            <label><?= lang('homepage.p_form_title')?></label>
            <input type="text" name="playlist_name" value="<?= esc($old['playlist_name'] ?? '') ?>">
            <?php if (isset($errors['playlist_name'])): ?>
                <div class="error"><?= esc($errors['playlist_name']) ?></div>
            <?php endif; ?>

            <!--Elements of the form related to the image sending, input and errors-->
            <label><?= lang('homepage.p_form_img')?></label>
            <input type="file" name="playlist_image" value="<?= esc($old['playlist_image'] ?? '') ?>">
            <?php if (isset($errors['playlist_image'])): ?>
                <div class="error"><?= esc($errors['playlist_image']) ?></div>
            <?php endif; ?>
        </article>

        <!--The button to send the form is rendered here-->
        <footer class="sumbit-button">
            <button type="submit" name="action" value="createPlaylist" class="btn create"><?= lang('homepage.create')?></button>
        </footer>
    </form>
    <!--Success message-->
    <div id="success-message" style="color: green;"></div>
</main>
<?= $this->endSection() ?>
