<!-- This HTML will be used to show USER PROFILE -->

<!--Extending from the Logged BaseView contains the general elements of the file. For avoid repeating common elements trough pages -->
<?= $this->extend('LogBaseView') ?>

<!--Title of the page will appear on the navbar-->
<?= $this->section('title') ?>
UserPage | LSpoty
<?= $this->endSection() ?>

<!--We link the CSS to format the page-->
<?= $this->section('CSS') ?>
<link rel="stylesheet" href="/CSS/Profile.css">
<?= $this->endSection() ?>

<!-- Center of the Navbar, allows the user to return to homepage -->
<?= $this->section('centerNav') ?>
    <a href="<?= route_to('home.get'); ?>" class="home-link"><?= lang('homepage.return_home')?></a>
<?= $this->endSection() ?>

<!--Content we will render in the page html-->
<?= $this->section('content') ?>
<?php if (empty($editUserMode)): ?>
    <section class="user-content">
        <article>
            <section class="user-image">
                <?php
                $profilePic = $userPage_data['profile_pic'] ?? '';
                $isUpload = !empty($profilePic) && !str_contains($profilePic, 'default');
                ?>
                <img src="<?= base_url($isUpload ? 'uploads/' . $profilePic : 'IMAGES/default_image.png') ?>"
                     alt="Foto de <?= esc($userPage_data['username'] ?? 'usuario') ?>">
            </section>

            <section class="user-data">
                <h1 class="user-name"><?= esc($userPage_data['username']) ?></h1>
                <h3 class="user-email"><?= esc($userPage_data['email']) ?></h3>
                <p class="user-age"><?= lang('register.age') ?> <?= esc($userPage_data['age']) ?></p>
            </section>
            <section>
                <img src="<?= base_url('/qr') ?>" alt="QR personalizado" class="qr-image">
            </section>
        </article>
        <footer class="data-buttons">
            <a href="<?= route_to('profile.get') . '?edit=1' ?>" class="btn update"><?= lang('register.change_data') ?></a>
            <form action="<?= route_to('profile.post') ?>" method="post" onsubmit="return confirm('¿Estás seguro de que quieres eliminar tu cuenta? Esta acción no se puede deshacer.');">
                <?= csrf_field() ?>
                <button type="submit" name="action" value="deleteAccount" class="btn delete"><?= lang('register.delete_data') ?></button>
            </form>
        </footer>
    </section>
<?php else: ?>
    <div id="edit-mode">
        <form action="<?= route_to('profile.post') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <article>

                <label><?= lang('register.profile_picture') ?></label>
                <input type="file" name="profile_pic">
                <?php if (isset($errors['profile_pic'])): ?>
                    <div class="error"><?= esc($errors['profile_pic']) ?></div>
                <?php endif; ?>

                <label><?= lang('register.username_form') ?></label>
                <input type="text" name="username">
                <?php if (isset($errors['username'])): ?>
                    <div class="error"><?= esc($errors['username']) ?></div>
                <?php endif; ?>

                <label><?= lang('register.password_form') ?></label>
                <input type="password" name="password">
                <?php if (isset($errors['password'])): ?>
                    <div class="error"><?= esc($errors['password']) ?></div>
                <?php endif; ?>

                <label><?= lang('register.age') ?></label>
                <input type="number" name="age" min="0" max="100" step="1">
                <?php if (isset($errors['age'])): ?>
                    <div class="error"><?= esc($errors['age']) ?></div>
                <?php endif; ?>
            </article>

            <footer class="data-buttons">
                <button type="submit" name="action" value="updateAccount" class="btn save"><?= lang('register.save_data') ?></button>
                <button type="submit" class="btn cancel" id="cancelBtn" onclick="history.back()"><?= lang('register.cancel') ?></button>
            </footer>
        </form>
    </div>
<?php endif; ?>
<?= $this->endSection() ?>