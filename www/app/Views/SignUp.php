<?= $this->extend('BaseView') ?>

<?= $this->section('title') ?>
    Sign Up | LSpoty
<?= $this->endSection() ?>

<?= $this->section('CSS') ?>
<link rel="stylesheet" href="/CSS/SignUp_styles.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<form method="post" action="<?= route_to('sign-up.post') ?>" enctype="multipart/form-data">
    <h1><?= lang('register.title_register')?> | LSpoty </h1>

    <label><?= lang('register.username_form') ?></label>
    <input type="text" name="username" value="<?= esc($old['username'] ?? '') ?>">

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

    <label><?= lang('register.repeat_form') ?></label>
    <input type="password" name="repeat_password">
    <?php if (isset($errors['repeat_password'])): ?>
        <div class="error"><?= esc($errors['repeat_password']) ?></div>
    <?php endif; ?>

    <label><?= lang('register.profile_picture_form') ?></label>
    <input type="file" name="profile_pic">
    <?php if (isset($errors['profile_pic'])): ?>
        <div class="error"><?= esc($errors['profile_pic']) ?></div>
    <?php endif; ?>
    <button type="submit"><?= lang('register.btn_form') ?></button>

    <div class="register-link">
        <p><?= lang('register.yes_account') ?><a href="<?= route_to('sign-in.get') ?>"><?= lang('register.login_here') ?> </a></p>
    </div>

</form>
<?= $this->endSection() ?>
