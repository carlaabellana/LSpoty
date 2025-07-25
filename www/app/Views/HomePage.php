<!-- This HTML will be used to show the HOMEPAGE -->

<!--Extending from Logged BaseView contains the general elements of the file. For avoid repeating common elements trough pages-->
<?= $this->extend('LogBaseView') ?>

<!--Title of the page will appear on the navbar-->
<?= $this->section('title') ?>
    Homepage | LSpoty
<?= $this->endSection() ?>

<!-- Center of the Navbar, allows the user to return to homepage -->
<?= $this->section('CSS') ?>
    <link rel="stylesheet" href="/CSS/HomePage.css">
    <link rel="stylesheet" href="/CSS/PopUpTrack.css">

<?= $this->endSection() ?>

<!--Content we will render in the page html-->
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
    <!--generate view for searchs with no filter-->
    <?php
    if ($type === '') {
        if ($albums !== []) {
            echo '<div id = "albums">'.'<h3>'.lang("Homepage.AlbumsMessage").'</h3> <div>';
            foreach ($albums as $album) {
                echo '<div class="albums">
                <a href = "'.base_url("album/".$album->id).'">
                    <img src="'.$album->cover.'" alt="">
                    <p>' . $album->name . '</p>
                </a>
            </div>';
            }
            echo '</div></div>';
        }

        if ($artists['results'] !== []) {
            echo '<div id = "artists">'.'<h3>'.lang("Homepage.ArtistsMessage").'</h3> <div>';
            foreach ($artists['results'] as $artist) {
                if ($artist["image"] === ""){
                    $artist["image"] = "/IMAGES/artistPfp.jpg";
                }
                echo '<div class="artists">
                <a href = "'.base_url("artist/".$artist["id"]).'">
                    <img src="'.$artist["image"].'" alt="">
                    <p>' . $artist["name"] . '</p>
                </a>
            </div>';
            }
            echo '</div> </div>';
        }

        if ($playlists['results'] !== []) {
            echo '<div id = "playlists">'.'<h3>'.lang("Homepage.PlaylistsMessage").'</h3> <div>';
            foreach ($playlists['results'] as $playlist) {
                echo '<div class="playlists">
                <a href = "'.base_url("playlist/".$playlist["id"]).'">
                    <img src="'.$playlists["cover"].'" alt="">
                    <p>' . $playlist["name"] . '</p>
                </a>
            </div>';
            }
            echo '</div></div>';
        }
        if ($albums === [] && $artists['results'] === [] && $playlists['results'] === []) {
            echo '<h3>'.lang("Homepage.NoResultsMessage").'</h3> ';
        }

    } elseif ($type !== 'track') {
        if ($results !== []) {
            // generate the view for non-empty results that are filtered (except tracks)
            echo '<div id = "'.$type.'s">'.'<h3>'.lang("Homepage.SearchMessage").'</h3> <div>';
            foreach ($results as $result) {
                if (!isset($result["image"]) || ($result["image"] === "" && $type === "track")) {
                    $result["image"] = "/IMAGES/playlistCover.jpg";
                }
                if ($result["image"] === "" && $type === "artist") {
                    $result["image"] = "/IMAGES/artistPfp.jpg";
                }
                echo '<div class="'.$type.'s">
            <a href = "'.base_url($type."/".$result["id"]).'">
                    <img src="'.$result["image"].'" alt="">
                    <p>' . $result["name"] . '</p>
                </a>
            </div>';
            }
            echo '</div></div>';
        } else {
            echo '<h3>'.lang("Homepage.NoResultsMessage").'</h3> ';
        }
    } else {
        // generate the view for non-empty results that are filtered as tracks
        if ($results !== []) {
            echo '<div id = "'.$type.'s">'.'<h3>'.lang("Homepage.TracksMessage").'</h3> <div>';
            foreach ($results as $track) {
                echo $track->generateView('playlist');
            }
        }else {
            echo '<h3>'.lang("Homepage.NoResultsMessage").'</h3>';
        }
    }
    //include the popUp view
    include("AddTrackPopUp.php");
    ?>
<?= $this->endSection() ?>

<!--Script to add the ajax-->
<?= $this->section('scripts') ?>
    <script src="<?= base_url('/JS/AddTrackPopUp.js') ?>"></script>
<?= $this->endSection() ?>
