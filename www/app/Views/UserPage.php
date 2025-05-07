<!--Extending from BaseView contains the general elements of the file. For avoid repeating common elements trough pages-->
<?= $this->extend('LogBaseView') ?>

<!--Title of the page will appear on the navbar-->
<?= $this->section('title') ?>
UserPage | LSpoty
<?= $this->endSection() ?>

<?= $this->section('CSS') ?>
<link rel="stylesheet" href="/CSS/UserView_styles.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<body>
<section class="user-content">
    <div class="user-image">
        <img src="/IMAGES/Dancing_MUSIC.jpg" alt="Dance Beats.">
    </div>
    <div class="user-data">
        <h1 class="user-name">Username</h1>
        <h3 class="user-email">Email</h3>
        <p class="user-age">age:</p>
    </div>
</section>

<div class="data-buttons">
    <button class="btn update">Change Data</button>
    <button class="btn delete">Delete Account</button>
</div>

</body>
<?= $this->endSection() ?>
