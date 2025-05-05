<!--Extending from BaseView contains the general elements of the file. For avoid repeating common elements trough pages-->
<?= $this->extend('BaseView') ?>

<!--Title of the page will appear on the navbar-->
<?= $this->section('title') ?>
    LandingPage | LSpoty
<?= $this->endSection() ?>

<?= $this->section('CSS') ?>
<link rel="stylesheet" href="/CSS/LandingPage_styles.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<body>
<!--LSpoty-introduction Section, this is to attract the new user to use the app.-->
<section class="LSpoty-introduction">
    <div class="container">
        <div class="LSpoty-introduction-content">
            <div class="LSpoty-introduction-text">
                <h1 class="LSpoty-introduction-title">LSpoty</h1>
                <p class="LSpoty-introduction-subtitle">Welcome to LSpoty: Discover new beats, build your vibe, and never miss a song.</p>

                <div class="register-buttons">
                    <a href="/sign-in" class="btn sign-in">Sign In</a>
                    <a href="/sign-up" class="btn sign-up">Register</a>
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
                        <span class="statistics-label">Tracks that reach a wide audience and leave a lasting impression</span>
                    </div>
                    <div class="stat">
                        <span class="statistics-number">+800k</span>
                        <span class="statistics-label">Hours streamed, engaging music that captivates listeners</span>
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
        <h2 class="section-title">About LSpoty</h2>
        <div class="LSpoty-about-content">
            <img src="/IMAGES/Music-Streaming-Wars.jpg" alt="LSpoty music Vibes.">

            <!--Text to explain what does LSpoty and which are its key features in a list-->
            <div class="LSpoty-about-text">
                <p>
                    LSpoty is your personal soundscape, an intuitive music app. Built to help you to discover new artists,
                    design your playlists, learn about new albums and tune with trendy music. Whether you like latest
                    chart-toppers, lo-fi tracks, working music, electronic beats... Our engine helps you find them
                    and listen to the best music.
                </p>
                <ul class="LSpoty-about-features">
                    <li><strong>Discover New Music</strong> – Search and discover for new music. Time to listening to something new.</li>
                    <li><strong>Design You Playlists</strong> – Create your playlists, listen to music, and update them to be on tune.</li>
                    <li><strong>Support Emerging Artists</strong> – Connect directly with the artists by searching information about them and their albums.</li>
                    <li><strong>Know about the Latest Albums</strong> – Learn about the new albums which are on trend on the platform.</li>
                </ul>
                <p>
                    Join over 800,000 music lovers who stream with LSpoty every day—where every beat finds its home.
                </p>
            </div>
        </div>
    </div>
</section>

<!--Grid with some images that show some types of music the user will find on LSpoty-->
<section class="LSpoty-portfolio">
    <div class="LSpoty-portfolio-grid">
        <div class="card Item1">
            <img src="/IMAGES/Instruments_Music.jpg" alt="Live Sessions.">
            <div class="card-overlay"><h3>Live Sessions</h3></div>
        </div>
        <div class="card Item2">
            <img src="/IMAGES/Dancing_MUSIC.jpg" alt="Dance Beats.">
            <div class="card-overlay"><h3>Dance Beats</h3></div>
        </div>
        <div class="card Item3">
            <img src="/IMAGES/DJ_Music.jpg" alt="DJ Mixes">
            <div class="card-overlay"><h3>DJ Mixes</h3></div>
        </div>
        <div class="card Item4">
            <img src="/IMAGES/Working_Music.jpg" alt="Study Vibes">
            <div class="card-overlay"><h3>Study Vibes</h3></div>
        </div>
        <div class="card Item5">
            <img src="/IMAGES/Singing_Music.jpg" alt="Studio Sessions">
            <div class="card-overlay"><h3>Studio Sessions</h3></div>
        </div>
        <div class="card Item6">
            <img src="/IMAGES/Anime_Music.jpg" alt="Chill Beats">
            <div class="card-overlay"><h3>Chill Beats</h3></div>
        </div>

    </div>
</section>

</body>
<?= $this->endSection() ?>
