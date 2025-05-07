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
            <input type="text" name="query" placeholder="<?= lang('HomePage.search')?>" value="<?= htmlspecialchars($_GET['query'] ?? '') ?>" />
            <select name="filter">
                <option value = "tracks"><?= lang('HomePage.option1')?></option>
                <option value = "albums"><?= lang('HomePage.option2')?></option>
                <option value = "artists"><?= lang('HomePage.option3')?></option>
                <option value = "playlists"><?= lang('HomePage.option4')?></option>
            </select>
            <button type="submit"><img src="/IMAGES/SearchButton.png" alt="?"/></button>
        </form>
    </div>
<?= $this->endSection() ?>

<?= $this->section('imgUrl') ?>
    /IMAGES/girl_listening_music.jpg
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <p><?=implode( " ", $results[0])?></p>
<?= $this->endSection() ?>
