<!--Extending from Logged BaseView contains the general elements of the file. For avoid repeating common elements trough pages-->
<?= $this->extend('LogBaseView') ?>

<!--Title of the page will appear on the navbar-->
<?= $this->section('title') ?>
My playlists | LSpoty
<?= $this->endSection() ?>

<!--We link the CSS to format the page-->
<?= $this->section('CSS') ?>

<?= $this->endSection() ?>

<!--Center of the Navbar, allows the user to return to homepage-->
<?= $this->section('centerNav') ?>
<a href="<?= route_to('home.get'); ?>" class="home-link"><?= lang('homepage.return_home')?></a>
<?= $this->endSection() ?>

<!--Content we will render in the page html-->
<?= $this->section('content') ?>
<main class="create-playlist-main">
    <p>Arrived to my playlists</p>
    <a href="<?= route_to('playlist.create') ?>" class="btn btn-create" role="button">
        Create Playlist
    </a>
</main>
<?= $this->endSection() ?>
