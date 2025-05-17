<!--Extending from BaseView contains the general elements of the file. For avoid repeating common elements trough pages-->
<?= $this->extend('LogBaseView') ?>

<!--Title of the page will appear on the navbar-->
<?= $this->section('title') ?>
    Create Playlist | LSpoty
<?= $this->endSection() ?>

<!--We link the CSS to format the page-->
<?= $this->section('CSS') ?>
<link rel="stylesheet" href="/CSS/CreatePlaylist_styles.css">
<?= $this->endSection() ?>

<?= $this->section('centerNav') ?>
<a href="<?= base_url('/home'); ?>" class="home-link">← Back to Home</a>
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<main class="create-playlist-main">
    <form id="createPlaylistForm" class="create-content" action="<?= route_to('playlist.store') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <article>
            <label> Title for playlist: </label>
            <input type="text" name="playlistname">
            <div class="error" id="playlistName-error"></div>

            <label>Introduce Image</label>
            <input type="file" name="playlist_image">
            <div class="error" id="playlistImage-error"></div>

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

