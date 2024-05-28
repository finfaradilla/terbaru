<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset PAssword</title>
</head>
<body>
    <p>Click the link below to reset your password:</p>
    <a href="<?= base_url('Auth/reset_password/'.$token) ?>">Reset Password</a>
</body>
</html>