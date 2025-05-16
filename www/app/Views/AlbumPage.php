<!--Extending from BaseView contains the general elements of the file. For avoid repeating common elements trough pages-->
<?= $this->extend('LogBaseView') ?>

<!--Title of the page will appear on the navbar-->
<?= $this->section('title') ?>
<?= esc($album->name) ?> | LSpoty
<?= $this->endSection() ?>

<!--We link the CSS to format the page-->
<?= $this->section('CSS') ?>
<link rel="stylesheet" href="/CSS/AlbumView_styles.css">
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
                    <?= esc($album->release_date->format('F j, Y')) ?>
                </time>
                &nbsp;|&nbsp;
                <time datetime="<?= esc($album->release_date->format('Y-m-d')) ?>">
                    <?= esc($album->total_duration) ?>
                </time>
            </p>
        </section>

        <section class="track-listing" aria-labelledby="track-list-heading">
            <h2 id="track-list-heading" class="visually-hidden">Track List</h2>
        </section>

<?= $this->endSection() ?>