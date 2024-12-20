<?php include __DIR__ . '/partials/header.php'; ?>

<h1>Edit File</h1>

<form action="/edit?id=<?= htmlspecialchars($file['id']) ?>" method="POST">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="<?= htmlspecialchars($file['title']) ?>" required>
    </div>
    <div class="form-group">
        <label for="author">Author</label>
        <input type="text" name="author" id="author" value="<?= htmlspecialchars($file['author']) ?>" required>
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
    <button type="submit">Update</button>
</form>


    <script>

        document.addEventListener('DOMContentLoaded', function () {
            initCounter();

            const subjectSelect = document.getElementById('subject');
            const subtopicSelect = document.getElementById('subtopic');
            const standardSelect = document.getElementById('standard');
            subjectSelect.addEventListener('change', function () {
                const subjectId = this.value;
                fetch(`/api?action=subtopics&id=${subjectId}`)
                    .then(response => response.json())
                    .then(data => {
                        subtopicSelect.innerHTML = '<option value="">Select Subtopic</option>';
                        data.forEach(subtopic => {
                            subtopicSelect.innerHTML += `<option value="${subtopic.id}">${subtopic.name}</option>`;
                        });
                        subtopicSelect.dispatchEvent(new Event('change'));
                    });
            });

            subtopicSelect.addEventListener('change', function () {
                const subtopicId = this.value;
                fetch(`/api?action=standards&id=${subtopicId}`)
                    .then(response => response.json())
                    .then(data => {
                        standardSelect.innerHTML = '<option value="">Select Standard</option>';
                        data.forEach(standard => {
                            standardSelect.innerHTML += `<option value="${standard.id}">${standard.name}</option>`;
                        });
                    });
            });
        });
    </script>
<?php include __DIR__ . '/partials/footer.php'; ?>