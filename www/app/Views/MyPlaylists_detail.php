<div class="playlist-detail-header">
    <?php
    $coverPath = WRITEPATH . '../public/uploads/' . $playlist['cover'];
    $coverUrl = file_exists($coverPath) && !empty($playlist['cover'])
        ? base_url('/uploads/' . $playlist['cover'])
        : base_url('/IMAGES/default_cover.jpg');
    ?>
    <img src="<?= $coverUrl ?>" class="playlist-cover" alt="cover">

    <div class="playlist-meta">
        <form action="<?= base_url('my-playlists/' . $playlist['id']) ?>" enctype="multipart/form-data" method="post" class="rename-form">
            <?= csrf_field() ?>
            <div class="form-image">
                <label for="cover"><?= lang('HomePage.p_form_img') ?></label>
                <input type="file" name="cover" id="cover" accept="image/*" class="form-file" />
            </div>
            <input type="text" name="name" value="<?= esc($playlist['name']) ?>" class="playlist-name-input" />
            <button type="submit" class="save-btn"><?= lang('HomePage.update_playlist')?></button>
        </form>
        <button id="delete-playlist-btn" data-id="<?= $playlist['id'] ?>" class="delete-btn"><?= lang('homepage.delete') ?>
        </button>
    </div>
</div>

