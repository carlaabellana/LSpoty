<!--Extending from BaseView contains the general elements of the file. For avoid repeating common elements trough pages-->
<?= $this->extend('LogBaseView') ?>

<!--Title of the page will appear on the navbar-->
<?= $this->section('title') ?>
My playlists | LSpoty
<?= $this->endSection() ?>

<!--We link the CSS to format the page-->
<?= $this->section('CSS') ?>

<?= $this->endSection() ?>

<?= $this->section('centerNav') ?>
<a href="<?= base_url('/home'); ?>" class="home-link">← Back to Home</a>
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<main class="create-playlist-main">
    <p>Arrived to my playlists</p>
    <a href="<?= route_to('playlist.create') ?>" class="btn btn-create" role="button">
        Create Playlist
    </a>
</main>
<?= $this->endSection() ?>
