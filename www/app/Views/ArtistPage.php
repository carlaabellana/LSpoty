<?= $this->extend('LogBaseView') ?>

<?= $this->section('title') ?>
Artist | LSpoty
<?= $this->endSection() ?>

<?= $this->section('CSS') ?>
<link rel="stylesheet" href="/CSS/ArtistView_styles.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<main class="artist-main"
<section class="artist-banner">
    <figure class="artist-image">
        <img src="<?= esc($artist_image) ?>" alt="Artist picture">
    </figure>
    <div class="artist-info">
        <h1 class="artist-name"><?= esc($artist_Date) ?></h1>
        <p class="artist-joined">Joined: <?= esc($join_date) ?></p>
    </div>
</section>

<section class="artist-albums">
    <h2>Albums</h2>
    <div class="album-list">
        <?php foreach ($albumsList as $album): ?>
            <div class="album-card">
                <img src="<?= esc($album['image']) ?>" alt="<?= esc($album['name']) ?> cover">
                <p class="album-title"><?= esc($album['name']) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>
</main>
<?= $this->endSection() ?>
