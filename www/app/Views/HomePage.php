<!--Extending from BaseView contains the general elements of the file. For avoid repeating common elements trough pages-->
<?= $this->extend('LogBaseView') ?>

<!--Title of the page will appear on the navbar-->
<?= $this->section('title') ?>
    Homepage | LSpoty
<?= $this->endSection() ?>

<?= $this->section('CSS') ?>
    <link rel="stylesheet" href="/CSS/HomePage_styles.css">
<?= $this->endSection() ?>

<?= $this->section('centerNav') ?>
    <div id="searchBar">
        <form method="GET" action="<?=base_url('/home')?>">
            <input type="text" name="query" placeholder="Search..." value="<?= htmlspecialchars($_GET['query'] ?? '') ?>" />
            <select name="filter">
                <option value = ""> - </option>
                <option value = "tracks">Tracks</option>
                <option value = "albums">Albums</option>
                <option value = "artists">Artist</option>
                <option value = "playlists">Playlist</option>
            </select>
            <button type="submit"><img src="/IMAGES/SearchButton.png" alt="?"/></button>
        </form>
    </div>
<?= $this->endSection() ?>

<?= $this->section('imgUrl') ?>
    /IMAGES/girl_listening_music.jpg
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?= $this->endSection() ?>
