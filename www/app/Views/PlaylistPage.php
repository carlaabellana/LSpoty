<!--Extending from BaseView contains the general elements of the file. For avoid repeating common elements trough pages-->
<?= $this->extend('LogBaseView') ?>

<!--Title of the page will appear on the navbar-->
<?= $this->section('title') ?>
<?= esc($playlist['playlist_title']) ?> | LSpoty
<?= $this->endSection() ?>

<!--We link the CSS to format the page-->
<?= $this->section('CSS') ?>
<link rel="stylesheet" href="/CSS/PlaylistView_styles.css">
<?= $this->endSection() ?>

<?= $this->section('centerNav') ?>
<a href="<?= base_url('/home'); ?>" class="home-link">← Back to Home</a>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<main class="playlist-main">

    <article aria-labelledby="playlist-title">

        <section class="playlist-banner">
            <figure class="playlist-image" role="img" aria-label="Playlist Cover">

            </figure>

            <div class="playlist-information-I">
                <h1 id="playlist-title" class="playlist-title">
                    <?= esc($playlist['playlist_title']) ?>
                </h1>
                <p class="user-name"><strong>User Creator: </strong> <?= esc($playlist['playlist_user']) ?> </p>
                <p><strong>Creation Date: </strong> <?= esc($playlist['playlist_creationDate']) ?> </p>
                <p><strong>Total length: </strong> <?= esc($playlistDuration) ?></p>
            </div>
        </section>

        <section class="track-list">
            <?php if (empty($tracks)): ?>
                <p>This playlist is empty.</p>
            <?php else: ?>

                <?php foreach ($tracks as $track): ?>
                    <div class="track-info">
                        <?= $track->generateView('playlist') ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </section>
    </article>
</main>
<?= $this->endSection() ?>
