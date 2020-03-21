<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<h1>Silahkan Login</h1>
    <form action="" method="post">
    <table>
        <tr>
            <td>Username</td>
            <td>
            : <input type="text" name="username" required>
            </td>
        </tr>
        <tr>
            <td> Password </td>
            <td>
                : <input type="password" name="password" required>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                : <input type="submit" value="Login">
            </td>
        </tr>
        <tr>
            <td></td>
            <td>: <a href="<?= base_url('login/register') ?>">Daftar</a></td>
        </tr>
    </table>
    </form>
</body>
</html>