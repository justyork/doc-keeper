<?php include __DIR__ . '/partials/header.php'; ?>

<div class="login-container">
    <form method="POST" action="/login">
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter Password" required>
        </div>
        <div class="form-group">
            <button type="submit">Login</button>
        </div>
        <?php if (isset($error) && $error != null): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
    </form>
</div>

<?php include __DIR__ . '/partials/footer.php'; ?>