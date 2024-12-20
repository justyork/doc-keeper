<?php include __DIR__ . '/partials/header.php'; ?>

<h1>Admin Panel</h1>

<ul>
    <li><a href="/subjects">Subjects</a></li>
    <li><a href="/subtopics">Subtopics</a></li>
    <li><a href="/standards">Standards</a></li>
    <li><a href="/resource-types">Resource types</a></li>
</ul>


<div class="table-wrap">
    <table border="1">
        <thead>
        <tr>
            <th>Title</th>
            <th>Date</th>
            <th>Description</th>
            <th>Author</th>
            <th>Email</th>
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
                <td><?= htmlspecialchars($row['datetime']) ?></td>
                <td><?= htmlspecialchars($row['description']) ?></td>
                <td><?= htmlspecialchars($row['author']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['subject_name']) ?></td>
                <td><?= htmlspecialchars($row['subtopic_name']) ?></td>
                <td><?= htmlspecialchars($row['standard_name']) ?></td>
                <td><?= htmlspecialchars($row['resource_type_name']) ?></td>
                <td>
                    <a href="/download?id=<?= htmlspecialchars($row['id']) ?>">Download</a>
                    <a href="/edit?id=<?= htmlspecialchars($row['id']) ?>">Edit</a>
                    <a href="/delete?id=<?= htmlspecialchars($row['id']) ?>" onclick="return confirm('Are you sure?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include __DIR__ . '/partials/footer.php'; ?>
