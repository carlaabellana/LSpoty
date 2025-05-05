<?= $this->extend('BaseView') ?>

<?= $this->section('title') ?>
Sign Up | LSpoty
<?= $this->endSection() ?>

<?= $this->section('CSS') ?>
<link rel="stylesheet" href="/CSS/IntroForm_styles.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<form method="post" action="/sign-up">
    <h1><?= lang('register.title_register') ?></h1>
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
    <button type="submit"><?= lang('register.btn_form') ?> </button>

    <div class="register-link">
        <p><?= lang('register.yes_account') ?><a href="<?= site_url('sign-in') ?>"><?= lang('register.login_here') ?> </a></p>
    </div>

</form>
<?= $this->endSection() ?>
