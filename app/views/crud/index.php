<!-- app/views/templates/index.php -->
<?php include __DIR__ . '/../partials/header.php'; ?>

<h1><?= htmlspecialchars($title) ?></h1>

<table border="1">
    <thead>
    <tr>
        <?php foreach ($columns as $column): ?>
            <th><?= htmlspecialchars($column) ?></th>
        <?php endforeach; ?>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($items as $item): ?>
        <tr>
            <?php foreach ($columns as $column): ?>
                <td><?= htmlspecialchars($item[$column]) ?></td>
            <?php endforeach; ?>
            <td>
                <a href="/<?= htmlspecialchars($viewPath) ?>/?action=edit&id=<?= htmlspecialchars($item['id']) ?>">Edit</a>
                <a href="/<?= htmlspecialchars($viewPath) ?>/?action=delete&id=<?= htmlspecialchars($item['id']) ?>" onclick="return confirm('Are you sure?');">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<a href="/<?= htmlspecialchars($viewPath) ?>/?action=create">Create New</a>

<?php include __DIR__ . '/../partials/footer.php'; ?>