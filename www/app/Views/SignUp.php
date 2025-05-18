<!-- This HTML will be used to show USER REGISTER -->

<!--Extending from the BaseView contains the general elements of the file. For avoid repeating common elements trough pages -->
<?= $this->extend('BaseView') ?>

<!--Title of the page will appear on the navbar-->
<?= $this->section('title') ?>
    Sign Up | LSpoty
<?= $this->endSection() ?>

<!--We link the CSS to format the page-->
<?= $this->section('CSS') ?>
<link rel="stylesheet" href="/CSS/SignUp_styles.css">
<?= $this->endSection() ?>

<!--Content we will render in the page html-->
<?= $this->section('content') ?>
<!--Form in which the user will enter their information to sign up-->
<form method="post" action="<?= route_to('sign-up.post') ?>" enctype="multipart/form-data">

    <!--Title of the form-->
    <h1><?= lang('register.title_register')?> | LSpoty </h1>

    <!--Input to allow the user to introduce their username-->
    <label><?= lang('register.username_form') ?></label>
    <input type="text" name="username" value="<?= esc($old['username'] ?? '') ?>">

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

    <!--Input to allow the user to repeat their password and show errors-->
    <label><?= lang('register.repeat_form') ?></label>
    <input type="password" name="repeat_password">
    <?php if (isset($errors['repeat_password'])): ?>
        <div class="error"><?= esc($errors['repeat_password']) ?></div>
    <?php endif; ?>

    <!--Input to allow the user to introduce their profile picture and show errors-->
    <label><?= lang('register.profile_picture_form') ?></label>
    <input type="file" name="profile_pic">
    <?php if (isset($errors['profile_pic'])): ?>
        <div class="error"><?= esc($errors['profile_pic']) ?></div>
    <?php endif; ?>

    <!--Button to submit the formulary-->
    <button type="submit"><?= lang('register.btn_form') ?></button>

    <!--Link to access the sign in page if needed-->
    <div class="register-link">
        <p><?= lang('register.yes_account') ?><a href="<?= route_to('sign-in.get') ?>"><?= lang('register.login_here') ?> </a></p>
    </div>
</form>
<?= $this->endSection() ?>
