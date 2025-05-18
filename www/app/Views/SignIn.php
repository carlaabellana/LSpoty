<!-- This HTML will be used to show USER LOGIN -->

<!--Extending from the BaseView contains the general elements of the file. For avoid repeating common elements trough pages -->
<?= $this->extend('BaseView') ?>

<!--Title of the page will appear on the navbar-->
<?= $this->section('title') ?>
    Sign In | LSpoty
<?= $this->endSection() ?>

<!--We link the CSS to format the page-->
<?= $this->section('CSS') ?>
<link rel="stylesheet" href="/CSS/SignIn_styles.css">
<?= $this->endSection() ?>

<!--Content we will render in the page html-->
<?= $this->section('content') ?>
<!--Here a message will appear in case of success-->
<?php if (isset($message)): ?>
    <div class="success-message">
        <?= esc($message) ?>
    </div>
<?php endif; ?>

<!--Form in which the user will enter their information to sign in-->
<form method="post" action="<?= route_to('sign-in.post') ?>">

    <!--Title of the form-->
    <h1><?= lang('register.title_login')?> | LSpoty </h1>

    <!--Input to allow the user to introduce their email and show errors-->
    <label><?= lang('register.email_form') ?></label>
    <input type="text" name="email" value="<?= esc($old['email'] ?? '') ?>">
    <?php if (isset($errors['email'])): ?>
        <div class="error"><?= esc($errors['email']) ?></div>
    <?php endif; ?>

    <!--Input to allow the user to introduce their password and show errors-->
    <label><?= lang('register.password_form') ?></label>
    <input type="password" name="password">
    <?php if (isset($errors['password'])): ?>
        <div class="error"><?= esc($errors['password']) ?></div>
    <?php endif; ?>

    <!--Button to submit the formulary-->
    <button type="submit"><?= lang('register.btn_login') ?></button>

    <!--Link to access the sign up page if needed-->
    <div class="register-link">
        <p><?= lang('register.no_account') ?><a href="<?= route_to('sign-up.get') ?>"><?= lang('register.register_here') ?> </a></p>
    </div>

</form>


<?= $this->endSection() ?>
