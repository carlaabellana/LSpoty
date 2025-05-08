<!--Extending from BaseView contains the general elements of the file. For avoid repeating common elements trough pages-->
<?= $this->extend('LogBaseView') ?>

<!--Title of the page will appear on the navbar-->
<?= $this->section('title') ?>
UserPage | LSpoty
<?= $this->endSection() ?>

<?= $this->section('CSS') ?>
<link rel="stylesheet" href="/CSS/UserPage_styles.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<body>
<?php if (empty($editUserMode)): ?>
    <section class="user-content">
        <article>
            <section class="user-image">
                <?php if (! empty($userPage_data['profile_picture'])): ?>
                    <img src="<?= base_url('uploads/' . esc($userPage_data['profile_picture'])) ?>"
                         alt="Foto de <?= esc($userPage_data['username']) ?>">
                <?php else: ?>
                    <img src="/IMAGES/default_image.png" alt="Generic user image.">
                <?php endif; ?>
            </section>

            <section class="user-data">
                <h1 class="user-name"><?= esc($userPage_data['username']) ?></h1>
                <h3 class="user-email"><?= esc($userPage_data['email']) ?></h3>
                <p class="user-age"><?= lang('register.age') ?> <?= esc($userPage_data['age']) ?></p>
            </section>
        </article>
        <footer class="data-buttons">
            <a href="<?= route_to('profile.get') . '?edit=1' ?>" class="btn update"><?= lang('register.change_data') ?></a>
            <button class="btn delete"><?= lang('register.delete_data') ?></button>
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
                <input type="text" name="age">
                <?php if (isset($errors['age'])): ?>
                    <div class="error"><?= esc($errors['age']) ?></div>
                <?php endif; ?>
            </article>

            <footer class="data-buttons">
                <button type="submit" name="action" value="updateAccount" class="btn save"><?= lang('register.save_data') ?></button>
                <button type="submit"  name="action" value="deleteAccount" class="btn cancel" id="cancelBtn"><?= lang('register.cancel') ?></button>
            </footer>
        </form>
    </div>
<?php endif; ?>
</body>
<?= $this->endSection() ?>