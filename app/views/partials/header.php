<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <script type="text/javascript">
        var onloadCallback = function() {
            grecaptcha.render('captcha_block', {
                'sitekey' : '<?= env('RECAPTCHA_SITEKEY'); ?>'
            });
        };
    </script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
            async defer>
    </script>
</head>
<body>
<nav>
    <a href="/">Upload</a>
    <a href="/view">View Files</a>
    <a href="/admin">Admin Panel</a>
    <?php if (isset($_SESSION['logged_in'])): ?>
        <a href="/logout">Logout</a>
    <?php endif; ?>
</nav>
<div class="container content">