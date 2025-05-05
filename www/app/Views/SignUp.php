<?= $this->extend('BaseView') ?>

<?= $this->section('title') ?>
Sign Up | LSpoty
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<style>
    body {
        background: linear-gradient(to bottom, #FFCDb2, #FFB4A2);
        font-family: 'Poppins', sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    form {
        background-color: #fff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(181, 130, 140, 0.3);
        width: 100%;
        max-width: 400px;
    }

    h1 {
        color: #B5828C;
        font-size: 28px;
        margin-bottom: 20px;
        text-align: center;
    }

    label {
        display: block;
        margin-top: 15px;
        font-weight: 600;
        color: #E5989B;
    }

    input[type="text"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        border: 2px solid #FFB4A2;
        border-radius: 8px;
        margin-top: 5px;
        box-sizing: border-box;
        font-size: 14px;
        transition: border-color 0.3s ease;
    }

    input[type="text"]:focus,
    input[type="password"]:focus {
        outline: none;
        border-color: #E5989B;
    }

    button {
        margin-top: 20px;
        width: 100%;
        padding: 12px;
        background-color: #B5828C;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #A06A77;
    }

    .error {
        margin-top: 5px;
        color: #B00020;
        font-size: 13px;
    }
</style>

<form method="post" action="/sign-up">
    <h1>Sign Up | LSpoty </h1>
    <label>Email:</label>
    <input type="text" name="email" value="<?= esc($old['email'] ?? '') ?>">
    <?php if (isset($errors['email'])): ?>
        <div class="error" style="color:red; font-size:13px;"><?= esc($errors['email']) ?></div>
    <?php endif; ?>

    <label>Password:</label>
    <input type="password" name="password">
    <?php if (isset($errors['password'])): ?>
        <div class="error" style="color:red; font-size:13px;"><?= esc($errors['password']) ?></div>
    <?php endif; ?>

    <label>Repeat Password:</label>
    <input type="password" name="repeat_password">
    <?php if (isset($errors['repeat_password'])): ?>
        <div class="error" style="color:red; font-size:13px;"><?= esc($errors['repeat_password']) ?></div>
    <?php endif; ?>
    <button type="submit">Register</button>
</form>
<?= $this->endSection() ?>
