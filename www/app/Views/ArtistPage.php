<?= $this->extend('LogBaseView') ?>

<?= $this->section('title') ?>
Artist | LSpoty
<?= $this->endSection() ?>

<?= $this->section('CSS') ?>
<link rel="stylesheet" href="/CSS/ArtistView.css">
<?= $this->endSection() ?>

<?= $this->section('centerNav') ?>
<a href="<?= route_to('home.get'); ?>" class="home-link">← Back to Home</a>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<main class="artist-main"
<section class="artist-banner">
    <figure class="artist-image">
        <img src="<?= esc($artist_image) ?>" alt="Artist picture" onerror="this.onerror=null;this.src='/IMAGES/Generic_Artist.jpg'" >
    </figure>
    <div class="artist-info">
        <h1 class="artist-name"><?= esc($artist_Date) ?></h1>
        <p class="artist-joined"><?= lang('HomePage.union')?> <?= esc($join_date) ?></p>
    </div>
</section>

<section class="artist-albums">
    <h2>Albums</h2>
    <div class="album-list">
        <?php foreach ($albumsList as $album): ?>
        <a href="<?= route_to('album.get', $album['id']) ?>" class="album-card">
                <img src="<?= esc($album['image']) ?>" alt="<?= esc($album['name']) ?> cover">
                <p class="album-title"><?= esc($album['name']) ?></p>
        </a>
        <?php endforeach; ?>
    </div>
</section>
</main>
<?= $this->endSection() ?>
