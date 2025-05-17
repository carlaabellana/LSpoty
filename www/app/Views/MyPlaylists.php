<?= $this->extend('LogBaseView') ?>

<?= $this->section('title') ?>My Playlists | LSpoty<?= $this->endSection() ?>

<?= $this->section('CSS') ?>
<link rel="stylesheet" href="/CSS/MyPlaylists_styles.css">
<?= $this->endSection() ?>

<?= $this->section('centerNav') ?>
<a href="<?= base_url('/home') ?>" class="home-link">← Home</a>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="playlist-dashboard">
    <div class="playlist-sidebar">
        <h2>My Playlists🎧</h2>
        <a href="<?= route_to('playlist.create') ?>" class="create-btn">+ New Playlist</a>
        <div class="playlist-list">
            <?php foreach ($playlists as $playlist): ?>
                <div class="playlist-card" data-id="<?= $playlist['id'] ?>">
                    <?php
                    $coverFile = WRITEPATH . '../public/uploads/' . $playlist['cover'];
                    $coverUrl = file_exists($coverFile) && !empty($playlist['cover'])
                        ? base_url('/uploads/' . $playlist['cover'])
                        : base_url('/IMAGES/default_cover.jpg');
                    ?>
                    <img src="<?= $coverUrl ?>" alt="Cover" class="playlist-cover">
                    <span><?= esc($playlist['name']) ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div id="playlist-detail" class="playlist-detail">
        <p>Select a playlist to view details</p>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const playlistCards = document.querySelectorAll('.playlist-card');

        playlistCards.forEach(card => {
            card.addEventListener('click', function () {
                const playlistId = this.dataset.id;

                fetch(`/my-playlists/ajax/${playlistId}`)
                    .then(response => {
                        if (!response.ok) throw new Error('Acceso denegado');
                        return response.text();
                    })
                    .then(html => {
                        document.getElementById('playlist-detail').innerHTML = html;

                        if (!document.querySelector('link[href="/CSS/MyPlaylists_detail.css"]')) {
                            const link = document.createElement('link');
                            link.rel = 'stylesheet';
                            link.href = '/CSS/MyPlaylists_detail_styles.css';
                            document.head.appendChild(link);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('No se pudo cargar la playlist.');
                    });
            });
        });
    });
</script>

<?= $this->endSection() ?>
