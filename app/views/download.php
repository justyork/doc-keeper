<?php include __DIR__ . '/partials/header.php'; ?>

    <h1>Download File</h1>
    <table>
        <tr>
            <td>Title:</td>
            <td><?= htmlspecialchars($file['title']) ?></td>
        </tr>
        <tr>
            <td>Description:</td>
            <td><?= htmlspecialchars($file['description']) ?></td>
        </tr>
        <tr>
            <td>Author:</td>
            <td><?= htmlspecialchars($file['author']) ?></td>
        </tr>
        <tr>
            <td>Subject:</td>
            <td><?= htmlspecialchars($file['subject']) ?></td>
        </tr>
        <tr>
            <td>Subtopic:</td>
            <td><?= htmlspecialchars($file['subtopic']) ?></td>
        </tr>
        <tr>
            <td>Standard:</td>
            <td><?= htmlspecialchars($file['standard']) ?></td>
        </tr>
        <tr>
            <td>Resource Type:</td>
            <td><?= htmlspecialchars($file['resource_type']) ?></td>
        </tr>
        <tr>
            <td>Datetime:</td>
            <td><?= htmlspecialchars($file['datetime']) ?></td>
        </tr>

        <tr>
            <td>File type:</td>
            <td><?= htmlspecialchars($file['file_type']) ?></td>
        </tr>


    </table>

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