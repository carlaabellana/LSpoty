<?= $this->extend('LogBaseView') ?>

<?= $this->section('title') ?>
    Perfil | LSpoty
<?= $this->endSection() ?>

<?= $this->section('CSS') ?>
    <link rel="stylesheet" href="/CSS/UserPage_styles.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="profile-container">
        <h2>User Profile</h2>

        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert success"><?= session()->getFlashdata('success') ?></div>
        <?php elseif(session()->getFlashdata('error')): ?>
            <div class="alert error"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form action="/profile" method="post" enctype="multipart/form-data" class="profile-form">
            <?= csrf_field() ?>

            <label>Username:</label>
            <input type="text" name="username" value="<?= esc($user['username']) ?>" required>

            <label>Age:</label>
            <input type="number" name="age" value="<?= esc($user['age']) ?>">

            <label>New Password:</label>
            <input type="password" name="password" placeholder="Deja vacío si no quieres cambiarla">

            <label>Confirm Password:</label>
            <input type="password" name="confirm_password">

            <label>Profile Picture:</label>
            <input type="file" name="profile_picture">

            <?php if (!empty($user['profile_picture'])): ?>
                <p>Foto actual:</p>
                <img src="/uploads/<?= esc($user['profile_picture']) ?>" width="100">
            <?php endif; ?>

            <input type="submit" value="Actualizar perfil">
        </form>

        <form action="/profile/delete" method="post" onsubmit="return confirm('¿Estás seguro de eliminar tu cuenta?');">
            <?= csrf_field() ?>
            <button type="submit" class="delete-btn">Eliminar cuenta</button>
        </form>
    </div>
<?= $this->endSection() ?>