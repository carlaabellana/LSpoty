<?= $this->extend('BaseView') ?>

<?= $this->section('title') ?>
    Sign In | LSpoty
<?= $this->endSection() ?>

<?= $this->section('CSS') ?>
<link rel="stylesheet" href="/CSS/SignIn.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php if (isset($message)): ?>
    <div class="success-message">
        <?= esc($message) ?>
    </div>
<?php endif; ?>

<form method="post" action="<?= route_to('sign-in.post') ?>">
    <h1>Sign In | LSpoty </h1>
    <label><?= lang('register.email_form') ?></label>
    <input type="text" name="email" value="<?= esc($old['email'] ?? '') ?>">
    <?php if (isset($errors['email'])): ?>
        <div class="error"><?= esc($errors['email']) ?></div>
    <?php endif; ?>

    <label><?= lang('register.password_form') ?></label>
    <input type="password" name="password">
    <?php if (isset($errors['password'])): ?>
        <div class="error"><?= esc($errors['password']) ?></div>
    <?php endif; ?>

    <button type="submit"><?= lang('register.btn_login') ?></button>

    <div class="register-link">
        <p><?= lang('register.no_account') ?><a href="<?= route_to('sign-up.get') ?>"><?= lang('register.register_here') ?> </a></p>
    </div>

</form>


<?= $this->endSection() ?>
