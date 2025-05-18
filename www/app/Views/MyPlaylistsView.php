<!-- This HTML will be used to show MY PLAYLISTS -->

<!--Extending from Logged BaseView contains the general elements of the file. For avoid repeating common elements trough pages-->
<?= $this->extend('LogBaseView') ?>

<!--Title of the page will appear on the navbar-->
<?= $this->section('title') ?>
My playlists | LSpoty
<?= $this->endSection() ?>

<!--We link the CSS to format the page-->
<?= $this->section('CSS') ?>
<link rel="stylesheet" href="/CSS/ConcretePlaylist.css">
<?= $this->endSection() ?>

<!--Center of the Navbar, allows the user to return to homepage-->
<?= $this->section('centerNav') ?>
<a href="<?= route_to('home.get'); ?>" class="home-link"><?= lang('homepage.return_home')?></a>
<?= $this->endSection() ?>

<!--Content we will render in the page html-->
<?= $this->section('content') ?>
<main class="playlist-main">
    <article aria-labelledby="playlist-title">

        <!--Here the general information of the playlist will be shown-->
        <section class="playlist-banner">
            <!--Cover of the playlist-->
            <figure class="playlist-image" role="img" aria-label="Playlist Cover">
                <?php
                $coverUrl = ! empty($cover)
                    ? base_url('uploads/' . esc($cover))
                    : base_url('IMAGES/default_cover.jpg');
                ?>
                <img src="<?= $coverUrl ?>" alt="Playlist Cover">
            </figure>

            <!--Data of playlist like title, the user who created it, date of creation and duration of the playlist-->
            <div class="playlist-information-I">
                <h1 id="playlist-title" class="playlist-title">
                    <?= esc($playlist_title) ?>
                </h1>
                <p class="user-name"><strong><?= lang('HomePage.user')?></strong> <?= esc($playlist_user)?> </p>
                <p><strong><?= lang('HomePage.creation')?></strong> <?= esc($playlist_creationDate) ?> </p>
                <p><strong><?= lang('HomePage.duration')?></strong> <?= esc($playlistDuration) ?> </p>
            </div>
        </section>

        <!--Here all the tracks of the playlist will be uploaded into the view-->
        <section class="track-list">
            <!--Message to indicate that the playlist is empty-->
            <?php if (empty($tracks)): ?>
                <p class="empty-msg"><?= lang('HomePage.empty_playlist') ?></p>
            <?php else: ?>
            <!--We render each track into the view with its data-->
                <?php foreach ($tracks as $track): ?>
                    <div class="track-item">
                        <div class="track-cover">
                            <img src="<?= esc($track['cover'] ?? '/IMAGES/default_track.jpg') ?>" alt="<?= esc($track['name']) ?> cover">
                        </div>
                        <!--General info of the track is rendered here-->
                        <div class="track-meta">
                            <p class="track-title"><?= esc($track['name']) ?></p>
                            <p class="track-artist"><?= esc($track['artist_name']) ?></p>
                            <p class="track-duration"><?= gmdate('i:s', $track['duration']) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>
    </article>

    <!--Her we build a playlist array populated with tracks to help JavaScript to understand the data-->
    <?php
    //Population of tracks with corresponding URL to play, the title, artist and cover.
    $playlistJsArray = array_map(function($t){
        return [
            'url'    => html_entity_decode($t['player_url']),
            'title'  => $t['name'],
            'artist' => $t['artist_name'],
            'cover'  => $t['cover'] ?? '/IMAGES/default_track.jpg',
        ];
    }, $tracks);

    //The JSON array is encoded so the JS can understand the data
    $playlistJson = json_encode($playlistJsArray, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
    ?>

    <!--Bar to control the reproduction of the playlist-->
    <div class="playlist-player">
        <audio id="audio-player"></audio>
        <button id="prev-btn" class="player-btn">⏮</button>
        <button id="play-btn" class="player-btn">⏸</button>
        <button id="next-btn" class="player-btn">⏭</button>
        <button id="repeat-btn" class="player-btn repeat-btn">🔁</button>
        <input id="progress-bar" type="range" min="0" max="100" value="0" class="progress-bar" />
    </div>
</main>
<?= $this->endSection() ?>


<!--Here we can pass the JSON array populated with the tracks, the JS will control the playlist player.-->
<?= $this->section('scripts') ?>
<script>
    window.playlistData = <?= $playlistJson ?>;
</script>
<script src="<?= base_url('JS/play.js') ?>"></script>
<?= $this->endSection() ?>


