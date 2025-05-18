<!-- This HTML will be used to show ALBUM DETAILS -->

<!--Extending from Logged BaseView contains the general elements of the file. For avoid repeating common elements trough pages-->
<?= $this->extend('LogBaseView') ?>

<!--Title of the page will appear on the navbar-->
<?= $this->section('title') ?>
<?= esc($album->name) ?> | LSpoty
<?= $this->endSection() ?>

<!--We link the CSS to format the page-->
<?= $this->section('CSS') ?>
<link rel="stylesheet" href="/CSS/Album.css">
<?= $this->endSection() ?>

<!--Center of the Navbar, allows the user to return to homepage-->
<?= $this->section('centerNav') ?>
<a href="<?= route_to('home.get'); ?>" class="home-link"><?= lang('homepage.return_home')?></a>
<?= $this->endSection() ?>

<!--Content we will render in the page html-->
<?= $this->section('content') ?>
<main class="album-main">

    <!--Here the main album information will be shown-->
    <article aria-labelledby="album-title">
        <section class="album-banner">
            <!--Image of the album cover-->
            <figure class="album-image" role="img" aria-label="Album cover">
                <img src="<?= esc($album->cover) ?>"
                     alt="Cover art for <?= esc($album->name) ?>">
            </figure>

            <div class="album-information-I">
                <!--Album title-->
                <h1 id="album-title" class="album-title">
                    <?= esc($album->name) ?>
                </h1>

                <!--Artist name-->
                <p class="artist-name">
                    <a href="<?= route_to('artist.get', $album->artistId) ?>" class="artist-link">
                    <?= esc($album->artist) ?>
                    </a>
                </p>
            </div>
        </section>

        <!--Here the release date and duration will be showed formatted-->
        <section class="album-information-II">
            <p>
                <?= lang('homepage.releases') ?>
                <time datetime="<?= esc($album->release_date->format('Y-m-d')) ?>">
                    <?php
                    $monthAlbum = $album->release_date->format('n');
                    $dayAlbum = $album->release_date->format('j');
                    $yearAlbum = $album->release_date->format('Y');
                    ?>

                    <?= lang('homepage.month_' . $monthAlbum) ?>
                    <?= esc($dayAlbum) ?>
                    <?= esc($yearAlbum) ?>
                </time>
                &nbsp;|&nbsp;
                <?= lang('homepage.duration') ?>
                <time datetime="<?= esc($album->release_date->format('Y-m-d')) ?>">
                    <?= esc($album->getFormatDuration()) ?>
                </time>
            </p>
        </section>

        <!--A list of tracks of the album will be rendered here-->
        <article aria-labelledby="album-title">
            <section class="album-tracks">
                <?= $album->generateTrackView() ?>
            </section>
        </article>
    </article>
</main>
<?= $this->endSection() ?>