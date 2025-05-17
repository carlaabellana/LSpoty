<!--Extending from BaseView contains the general elements of the file. For avoid repeating common elements trough pages-->
<?= $this->extend('LogBaseView') ?>

<!--Title of the page will appear on the navbar-->
<?= $this->section('title') ?>
<?= esc($album->name) ?> | LSpoty
<?= $this->endSection() ?>

<!--We link the CSS to format the page-->
<?= $this->section('CSS') ?>
<link rel="stylesheet" href="/CSS/AlbumView.css">
<?= $this->endSection() ?>

<?= $this->section('centerNav') ?>
<a href="<?= base_url('/home'); ?>" class="home-link">← Back to Home</a>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<main class="album-main">

    <article aria-labelledby="album-title">

        <section class="album-banner">
            <figure class="album-image" role="img" aria-label="Album cover">
                <img src="<?= esc($album->cover) ?>"
                     alt="Cover art for <?= esc($album->name) ?>">
            </figure>

            <div class="album-information-I">
                <h1 id="album-title" class="album-title">
                    <?= esc($album->name) ?>
                </h1>
                <p class="artist-name">
                    <?= esc($album->artist) ?>
                </p>
            </div>
        </section>

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

        <article aria-labelledby="album-title">
            <section class="album-tracks">
                <?= $album->generateTrackView() ?>
            </section>

        </article>
    </article>
</main>
<?= $this->endSection() ?>