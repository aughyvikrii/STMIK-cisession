<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
    <p>
        Selamat datang <b><?= $this->session->userdata('username') ?></b> <br/>
        Terakhir Login : <?= $this->session->userdata('last_login') ?> <br/>
        Jumlah Login : <?= $this->session->userdata('login_count') ?>
    </p>
    <a href="<?= site_url('login/logout') ?>">Logout</a>
</body>
</html>