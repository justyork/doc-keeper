<!-- app/views/templates/create.php -->
<?php include __DIR__ . '/../partials/header.php'; ?>

<h1>Create <?= htmlspecialchars($title) ?></h1>

<form action="/<?= htmlspecialchars($viewPath) ?>/?action=store" method="post">
    <?php foreach ($fields as $field): if ($field === 'id') continue; ?>
        <div class="form-group">
            <label for="<?= htmlspecialchars($field) ?>"><?= htmlspecialchars(ucfirst($field)) ?></label>
            <input type="text" name="<?= htmlspecialchars($field) ?>" id="<?= htmlspecialchars($field) ?>" required>
        </div>
    <?php endforeach; ?>
    <input type="submit" value="Save"/>
</form>

<?php include __DIR__ . '/../partials/footer.php'; ?>