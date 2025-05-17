<!--Extending from BaseView contains the general elements of the file. For avoid repeating common elements trough pages-->
<?= $this->extend('BaseView') ?>

<!--Title of the page will appear on the navbar-->
<?= $this->section('title') ?>
    LandingPage | LSpoty
<?= $this->endSection() ?>

<!--We link the CSS to format the page-->
<?= $this->section('CSS') ?>
<link rel="stylesheet" href="/CSS/LandingPage_styles.css">
<?= $this->endSection() ?>

<!--Content we will render in the page html-->
<?= $this->section('content') ?>
<body>
<!--LSpoty-introduction Section, this is to attract the new user to use the app.-->
<section class="LSpoty-introduction">
    <div class="container">
        <div class="LSpoty-introduction-content">
            <div class="LSpoty-introduction-text">
                <h1 class="LSpoty-introduction-title"><?= lang('landing.title') ?></h1>
                <p class="LSpoty-introduction-subtitle"><?= lang('landing.subtitle') ?></p>

                <div class="register-buttons">
                    <a href="<?= route_to('sign-in.get') ?>" class="btn sign-in"><?= lang('landing.btn_signin') ?></a>
                    <a href="<?= route_to('sign-up.get') ?>" class="btn sign-up"><?= lang('landing.btn_register') ?></a>
                </div>

                <!--Links to the social media of LSpoty.-->
                <nav class="socialMedia-links">
                    <a href="#" class="socialMedia-icon">YT</a>
                    <a href="#" class="socialMedia-icon">IG</a>
                    <a href="#" class="socialMedia-icon">FB</a>
                    <a href="#" class="socialMedia-icon">X</a>
                </nav>

                <!--Statistics to show the new user how popular is the page (not real only for example).-->
                <div class="statistics">
                    <div class="statistic">
                        <span class="statistics-number">+250k</span>
                        <span class="statistics-label"><?= lang('landing.stat_tracks') ?></span>
                    </div>
                    <div class="stat">
                        <span class="statistics-number">+800k</span>
                        <span class="statistics-label"><?= lang('landing.stat_hours') ?></span>
                    </div>
                </div>
            </div>
            <div class="LSpoty-introduction-image">
                <img src="/IMAGES/girl_listening_music.jpg" alt="Woman listening to music using LSpoty.">
                <div class="signature">LSpoty</div>
            </div>
        </div>
    </div>
</section>

<!--LSpoty-about section, this part is used to inform the user which are the main characteristics and functionalities of the app.-->
<section class="LSpoty-about">
    <div class="container">
        <h2 class="section-title"><?= lang('landing.about_heading') ?></h2>
        <div class="LSpoty-about-content">
            <img src="/IMAGES/Music-Streaming-Wars.jpg" alt="LSpoty music Vibes.">

            <!--Text to explain what does LSpoty and which are its key features in a list-->
            <div class="LSpoty-about-text">
                <p><?= lang('landing.about_intro') ?></p>
                <ul class="LSpoty-about-features">
                    <li><?= lang('landing.feature_1') ?></li>
                    <li><?= lang('landing.feature_2') ?></li>
                    <li><?= lang('landing.feature_3') ?></li>
                    <li><?= lang('landing.feature_4') ?></li>
                </ul>
                <p><?= lang('landing.join_us') ?></p>
            </div>
        </div>
    </div>
</section>

<!--Grid with some images that show some types of music the user will find on LSpoty-->
<section class="LSpoty-portfolio">
    <div class="LSpoty-portfolio-grid">
        <div class="card Item1">
            <img src="/IMAGES/Instruments_Music.jpg" alt="Live Sessions.">
            <div class="card-overlay"><h3><?= lang('landing.card_1') ?></h3></div>
        </div>
        <div class="card Item2">
            <img src="/IMAGES/Dancing_MUSIC.jpg" alt="Dance Beats.">
            <div class="card-overlay"><h3><?= lang('landing.card_2') ?></h3></div>
        </div>
        <div class="card Item3">
            <img src="/IMAGES/DJ_Music.jpg" alt="DJ Mixes">
            <div class="card-overlay"><h3><?= lang('landing.card_3') ?></h3></div>
        </div>
        <div class="card Item4">
            <img src="/IMAGES/Working_Music.jpg" alt="Study Vibes">
            <div class="card-overlay"><h3><?= lang('landing.card_4') ?></h3></div>
        </div>
        <div class="card Item5">
            <img src="/IMAGES/Singing_Music.jpg" alt="Studio Sessions">
            <div class="card-overlay"><h3><?= lang('landing.card_5') ?></h3></div>
        </div>
        <div class="card Item6">
            <img src="/IMAGES/Anime_Music.jpg" alt="Chill Beats">
            <div class="card-overlay"><h3><?= lang('landing.card_6') ?></h3></div>
        </div>

    </div>
</section>

</body>
<?= $this->endSection() ?>
