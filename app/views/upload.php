<?php include __DIR__ . '/partials/header.php'; ?>

<h1>Upload</h1>

<?php if (isset($_GET['success'])): ?>
    <div class="success-messages">
        <p>Upload successful!</p>
    </div>
<?php endif; ?>

<?php if (!empty($errors)): ?>
    <div class="error-messages">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

    <form action="/" method="POST" enctype="multipart/form-data">
        <div class="form-group char-counter">
            <label for="title">Title</label>
            <input type="text" minlength="20" name="title" id="title" placeholder="Title" value="<?= htmlspecialchars($bag['title'] ?? '') ?>" required>
        </div>
        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" name="author" id="author" placeholder="Author" value="<?= htmlspecialchars($bag['author'] ?? '') ?>" required>
        </div>
        <div class="form-group char-counter">
            <label for="description">Description</label>
            <textarea name="description" id="description" placeholder="Description (min 100 characters)" minlength="100" required><?= htmlspecialchars($bag['description'] ?? '') ?></textarea>
        </div>
        <div class="form-group">
            <label for="subject">Subject</label>
            <select name="subject" id="subject" required>
                <option value="">Select Subject</option>
                <?php foreach ($data['subjects'] as $subject): ?>
                    <option value="<?= htmlspecialchars($subject['id']) ?>" <?= (isset($bag['subject']) && $bag['subject'] == $subject['id']) ? 'selected' : '' ?>><?= htmlspecialchars($subject['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="subtopic">Subtopic</label>
            <select name="subtopic" id="subtopic" required>
                <option value="">Select Subtopic</option>
                <?php foreach ($data['subtopics'] as $subtopic): ?>
                    <option value="<?= htmlspecialchars($subtopic['id']) ?>" <?= (isset($bag['subtopic']) && $bag['subtopic'] == $subtopic['id']) ? 'selected' : '' ?>><?= htmlspecialchars($subtopic['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="standard">Standard</label>
            <select name="standard" id="standard" required>
                <option value="">Select Standard</option>
                <?php foreach ($data['standards'] as $standard): ?>
                    <option value="<?= htmlspecialchars($standard['id']) ?>" <?= (isset($bag['standard']) && $bag['standard'] == $standard['id']) ? 'selected' : '' ?>><?= htmlspecialchars($standard['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="resource_type">Resource Type</label>
            <select name="resource_type" id="resource_type" required>
                <option value="">Select Resource Type</option>
                <?php foreach ($data['resource_types'] as $resource_type): ?>
                    <option value="<?= htmlspecialchars($resource_type['id']) ?>" <?= (isset($bag['resource_type']) && $bag['resource_type'] == $resource_type['id']) ? 'selected' : '' ?>><?= htmlspecialchars($resource_type['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="file">File</label>
            <input type="file" name="file" id="file" accept=".pdf,.docx,.doc,.pptx,.ppt,.xlsx,.xls,.ods,.odt,.odp,.txt,.zip,.jpg,.jpeg,.png,.gif">
        </div>
        <div class="form-group">
            <label for="file_url">Google Docs URL</label>
            <input type="url" name="file_url" id="file_url" placeholder="Google Docs URL" value="<?= htmlspecialchars($bag['file_url'] ?? '') ?>">
        </div>

        <div id="captcha_block"></div>

        <button type="submit">Submit</button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            initCounter();
        });
    </script>

<?php include __DIR__ . '/partials/footer.php'; ?>