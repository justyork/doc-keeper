<!-- app/views/templates/edit.php -->
<?php include __DIR__ . '/../partials/header.php'; ?>

<h1>Edit <?= htmlspecialchars($title) ?></h1>

<form action="/<?= htmlspecialchars($viewPath) ?>/?action=update&id=<?= htmlspecialchars($item['id']) ?>" method="post">
    <?php foreach ($fields as $field): if ($field === 'id') continue; ?>
        <div class="form-group">
            <label for="<?= htmlspecialchars($field) ?>"><?= htmlspecialchars(ucfirst($field)) ?></label>
            <input type="text" name="<?= htmlspecialchars($field) ?>" id="<?= htmlspecialchars($field) ?>" value="<?= htmlspecialchars($item[$field]) ?>" required>
        </div>
    <?php endforeach; ?>
    <button type="submit">Save</button>
</form>

<?php include __DIR__ . '/../partials/footer.php'; ?>