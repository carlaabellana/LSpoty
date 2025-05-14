<!--Extending from BaseView contains the general elements of the file. For avoid repeating common elements trough pages-->
<?= $this->extend('LogBaseView') ?>

<!--Title of the page will appear on the navbar-->
<?= $this->section('title') ?>
Album | LSpoty
<?= $this->endSection() ?>

<!--We link the CSS to format the page-->
<?= $this->section('CSS') ?>
<link rel="stylesheet" href="/CSS/AlbumView_styles.css">
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<!--Main where all the content of the page will be stored-->
<main class="album-main">
    <!--Article which contains the general info of the album-->
    <article aria-labelledby="album-title">
        <!--Section in which will appear the image of the album, the title and artist name-->
        <section class="album-banner">
            <figure class="album-image" role="img" aria-label="Album cover">
                <img src="<?= esc($album_Cover) ?>" alt="Album cover">
            </figure>
            <div class="album-information-I">
                <h1 id="album-title" class="album-title"><?= esc($album_Name) ?></h1>
                <p class="artist-name"><?= esc($artist_Name) ?></p>
            </div>
        </section>
        <!--Section in which will appear the date of release and the duration of the album-->
        <section class="album-information-II">
            <p>
                <?= lang('homepage.releases') ?> <time datetime="<?= esc($album_ReleaseDate) ?>"><?= esc($album_DisplayReleaseDate) ?></time>
                &nbsp;|&nbsp;
                <?= lang('homepage.duration') ?> <time datetime="<?= esc($album_ReleaseDate) ?>"><?= esc($album_DisplayReleaseDate) ?></time>
            </p>
        </section>


    </article>
</main>

<?= $this->endSection() ?>