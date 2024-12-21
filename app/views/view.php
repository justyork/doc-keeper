<?php include __DIR__ . '/partials/header.php'; ?>

    <h1>Uploaded Files</h1>

    <form method="GET" action="/view">
        <select name="subject" id="subject">
            <option value="">All Subjects</option>
            <?php foreach ($subjects as $subject): ?>
                <option value="<?= htmlspecialchars($subject['id']) ?>" <?= isset($_GET['subject']) && $_GET['subject'] == $subject['id'] ? 'selected' : '' ?>><?= htmlspecialchars($subject['name']) ?></option>
            <?php endforeach; ?>
        </select>
        <select name="subtopic" id="subtopic">
            <option value="">All Subtopics</option>
            <?php foreach ($subtopics as $subtopic): ?>
                <option value="<?= htmlspecialchars($subtopic['id']) ?>" <?= isset($_GET['subtopic']) && $_GET['subtopic'] == $subtopic['id'] ? 'selected' : '' ?>><?= htmlspecialchars($subtopic['name']) ?></option>
            <?php endforeach; ?>
        </select>
        <select name="standard" id="standard">
            <option value="">All Standards</option>
            <?php foreach ($standards as $standard): ?>
                <option value="<?= htmlspecialchars($standard['id']) ?>" <?= isset($_GET['standard']) && $_GET['standard'] == $standard['id'] ? 'selected' : '' ?>><?= htmlspecialchars($standard['name']) ?></option>
            <?php endforeach; ?>
        </select>
        <select name="resource_type">
            <option value="">All Resource Types</option>
            <?php foreach ($resource_types as $resource_type): ?>
                <option value="<?= htmlspecialchars($resource_type['id']) ?>" <?= isset($_GET['resource_type']) && $_GET['resource_type'] == $resource_type['id'] ? 'selected' : '' ?>><?= htmlspecialchars($resource_type['name']) ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Filter</button>
    </form>

<div class="table-wrap">
    <table border="1">
        <thead>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Author</th>
            <th>Date</th>
            <th>Subject</th>
            <th>Subtopic</th>
            <th>Standard</th>
            <th>Resource Type</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['title']) ?></td>
                <td><?= htmlspecialchars($row['description']) ?></td>
                <td><?= htmlspecialchars($row['author']) ?></td>
                <td><?= htmlspecialchars($row['datetime']) ?></td>
                <td><?= htmlspecialchars($row['subject_name']) ?></td>
                <td><?= htmlspecialchars($row['subtopic_name']) ?></td>
                <td><?= htmlspecialchars($row['standard_name']) ?></td>
                <td><?= htmlspecialchars($row['resource_type_name']) ?></td>
                <td>
                    <a href="/download?id=<?= htmlspecialchars($row['id']) ?>">Download</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            fieldsOnChange();
        });
    </script>
<?php include __DIR__ . '/partials/footer.php'; ?>