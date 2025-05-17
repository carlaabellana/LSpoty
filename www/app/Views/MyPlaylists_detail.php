<div class="playlist-detail-header">
    <?php
    $coverPath = WRITEPATH . '../public/uploads/' . $playlist['cover'];
    $coverUrl = file_exists($coverPath) && !empty($playlist['cover'])
        ? base_url('/uploads/' . $playlist['cover'])
        : base_url('/IMAGES/default_cover.jpg');
    ?>
    <img src="<?= $coverUrl ?>" class="playlist-cover" alt="cover">

    <div class="playlist-meta">
        <form action="<?= base_url('/my-playlists/' . $playlist['id']) ?>" method="post" class="rename-form">
            <?= csrf_field() ?>
            <input type="text" name="name" value="<?= esc($playlist['name']) ?>" class="playlist-name-input" />
            <button type="submit" class="save-btn">Save</button>
        </form>

        <a href="<?= base_url('/delete-playlist/' . $playlist['id']) ?>" class="delete-btn">Delete Playlist</a>
    </div>
</div>

<div class="playlist-tracks">
    <h3>Tracks</h3>
    <p>♫ Tracks coming soon… </p>
</div>

<div class="playlist-player">
    <button class="player-btn">⏮</button>
    <button class="player-btn">⏸</button>
    <button class="player-btn">⏭</button>
    <input type="range" min="0" max="100" value="0" class="progress-bar" />
</div>
