<!--Extending from BaseView contains the general elements of the file. For avoid repeating common elements trough pages-->
<?= $this->extend('LogBaseView') ?>

<!--Title of the page will appear on the navbar-->
<?= $this->section('title') ?>
    Homepage | LSpoty
<?= $this->endSection() ?>

<?= $this->section('CSS') ?>
    <link rel="stylesheet" href="/CSS/HomePage_styles.css">
<?= $this->endSection() ?>

<?= $this->section('centerNav') ?>
    <div id="searchBar">
        <form method="GET" action="<?=base_url('/home')?>">
            <input type="text" name="query" placeholder="<?= lang('HomePage.search')?>" value="<?= htmlspecialchars($_GET['query'] ?? '') ?>" />
            <select name="filter">
                <option value = "">-</option>
                <option value = "tracks"><?= lang('HomePage.option1')?></option>
                <option value = "albums"><?= lang('HomePage.option2')?></option>
                <option value = "artists"><?= lang('HomePage.option3')?></option>
                <option value = "playlists"><?= lang('HomePage.option4')?></option>
            </select>
            <button type="submit"><img src="/IMAGES/SearchButton.png" alt="?"/></button>
        </form>
    </div>
<?= $this->endSection() ?>

<?= $this->section('imgUrl') ?>
    /IMAGES/girl_listening_music.jpg
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <?php if ($type === '') {
        echo '<div id = "albums">'.'<h3>Alums you might like</h3> <div>';
        foreach ($albums['results'] as $album) {
            echo '<div class="albums">
                <a href = "'.base_url("album/".$album["id"]).'">
                    <img src="'.$album["image"].'" alt="">
                    <p>' . $album["name"] . '</p>
                </a>
            </div>';
        }
        echo '</div></div>';

        echo '<div id = "artists">'.'<h3>Artists you might like</h3> <div>';
        foreach ($artists['results'] as $artist) {
            echo '<div class="artists">
                <a href = "'.base_url("artist/".$artist["id"]).'">
                    <img src="'.$artist["image"].'" alt="">
                    <p>' . $artist["name"] . '</p>
                </a>
            </div>';
        }
        echo '</div> </div>';

        echo '<div id = "playlists">'.'<h3>Artists you might like</h3> <div>';
        foreach ($playlists['results'] as $playlist) {
            echo '<div class="playlists">
                <a href = "'.base_url("playlist/".$playlist["id"]).'">
                    <img src="'.$playlists["cover"].'" alt="">
                    <p>' . $playlist["name"] . '</p>
                </a>
            </div>';
        }
        echo '</div></div>';
    } else {
        echo '<div id = "'.$type.'">'.'<h3>your search results:</h3> <div>';
        foreach ($results as $result) {
            echo '<div class="'.$type.'">
            <a href = "'.base_url($type."/".$result["id"]).'">
                    <img src="'.$result["image"].'" alt="">
                    <p>' . $result["name"] . '</p>
                </a>
            </div>';
        }
    }   echo '</div></div>';
    ?>

<?= $this->endSection() ?>
