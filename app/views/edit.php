<?php include __DIR__ . '/partials/header.php'; ?>

<h1>Edit File</h1>

<form action="/edit?id=<?= htmlspecialchars($file['id']) ?>" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="<?= htmlspecialchars($file['title']) ?>" required>
    </div>
    <div class="form-group">
        <label for="author">Author</label>
        <input type="text" name="author" id="author" value="<?= htmlspecialchars($file['author']) ?>" required>
    </div>
    <div class="form-group">
        <label for="author">Email</label>
        <input type="text" name="email" id="email" value="<?= htmlspecialchars($file['email']) ?>" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" required><?= htmlspecialchars($file['description']) ?></textarea>
    </div>
    <div class="form-group">
        <label for="subject">Subject</label>
        <select name="subject" id="subject" required>
            <?php foreach ($subjects as $subject): ?>
                <option value="<?= htmlspecialchars($subject['id']) ?>" <?= $file['subject'] == $subject['id'] ? 'selected' : '' ?>><?= htmlspecialchars($subject['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="subtopic">Subtopic</label>
        <select name="subtopic" id="subtopic" required>
            <?php foreach ($subtopics as $subtopic): ?>
                <option value="<?= htmlspecialchars($subtopic['id']) ?>" <?= $file['subtopic'] == $subtopic['id'] ? 'selected' : '' ?>><?= htmlspecialchars($subtopic['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="standard">Standard</label>
        <select name="standard" id="standard" required>
            <?php foreach ($standards as $standard): ?>
                <option value="<?= htmlspecialchars($standard['id']) ?>" <?= $file['standard'] == $standard['id'] ? 'selected' : '' ?>><?= htmlspecialchars($standard['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="resource_type">Resource Type</label>
        <select name="resource_type" id="resource_type" required>
            <?php foreach ($resource_types as $resource_type): ?>
                <option value="<?= htmlspecialchars($resource_type['id']) ?>" <?= $file['resource_type'] == $resource_type['id'] ? 'selected' : '' ?>><?= htmlspecialchars($resource_type['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="file">File</label>
        <input type="file" name="file" id="file" accept="<?=implode(',', $allowedExtensions)?>">

        <?php if ($file['file_type'] === 'file') :?>
            <a href="<?= htmlspecialchars($file['file_path']) ?>" target="_blank">Download</a>
        <?php endif; ?>
    </div>
    <div class="form-group">
        <label for="file_url">Google Docs URL</label>
        <input type="url" name="file_url" id="file_url" placeholder="Google Docs URL" value="<?= htmlspecialchars($file['file_url'] ?? '') ?>">
    </div>

    <button type="submit">Update</button>
</form>


    <script>

        document.addEventListener('DOMContentLoaded', function () {
            fileChecker(true);
            initCounter();

            fieldsOnChange();
        });
    </script>
<?php include __DIR__ . '/partials/footer.php'; ?>