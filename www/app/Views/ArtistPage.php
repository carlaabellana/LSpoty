<!-- This HTML will be used to show ARTIST DETAILS -->

<!--Extending from the Logged BaseView contains the general elements of the file. For avoid repeating common elements trough pages -->
<?= $this->extend('LogBaseView') ?>

<!--Title of the page will appear on the navbar-->
<?= $this->section('title') ?>
Artist | LSpoty
<?= $this->endSection() ?>

<!--We link the CSS to format the page-->
<?= $this->section('CSS') ?>
<link rel="stylesheet" href="/CSS/ArtistView_style.css">
<?= $this->endSection() ?>

<!--Center of the Navbar, allows the user to return to homepage-->
<?= $this->section('centerNav') ?>
<a href="<?= route_to('home.get'); ?>" class="home-link"><?= lang('homepage.return_home')?></a>
<?= $this->endSection() ?>

<!--Content we will render in the page html-->
<?= $this->section('content') ?>
<main class="artist-main"
    <!--Main information of the artis will be showed here-->
    <section class="artist-banner">
        <!--Artist profile picture-->
        <figure class="artist-image">
            <img src="<?= esc($artist_image) ?>" alt="Artist picture" onerror="this.onerror=null;this.src='/IMAGES/Generic_Artist.jpg'" >
        </figure>

        <!--artist name and join date will be showed here-->
        <div class="artist-info">
            <h1 class="artist-name"><?= esc($artist_Date) ?></h1>
            <p class="artist-joined"><?= lang('HomePage.union')?> <?= esc($join_date) ?></p>
        </div>
    </section>

    <!--A list with all the albums will be rendered here, upon clicked we can see more of them-->
    <section class="artist-albums">
        <h2><?= lang('HomePage.albums')?></h2>
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
