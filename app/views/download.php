<?php include __DIR__ . '/partials/header.php'; ?>

    <h1>Download File</h1>

    <p>File Name: <?= htmlspecialchars($file['title']) ?></p>

    <form id="download-form" action="/download?id=<?= htmlspecialchars($file['id']) ?>" method="POST">
        <div id="captcha_block"></div>
        <button type="submit">Download</button>
    </form>

    <script type="text/javascript">
        document.getElementById('download-form').addEventListener('submit', function(e) {
            var response = grecaptcha.getResponse();
            if (response.length === 0) {
                e.preventDefault();
                alert('Please complete the CAPTCHA.');
            }
        });
    </script>

<?php include __DIR__ . '/partials/footer.php'; ?>