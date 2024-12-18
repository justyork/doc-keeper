<?php include __DIR__ . '/partials/header.php'; ?>

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
        <input type="text" minlength="20" name="title" id="title" placeholder="Title" required>
    </div>
    <div class="form-group">
        <label for="author">Author</label>
        <input type="text" name="author" id="author" placeholder="Author" required>
    </div>
    <div class="form-group char-counter">
        <label for="description">Description</label>
        <textarea name="description" id="description" placeholder="Description (min 100 characters)" minlength="100" required></textarea>
    </div>
    <div class="form-group">
        <label for="subject">Subject</label>
        <select name="subject" id="subject" required>
            <option value="">Select Subject</option>
            <?php foreach ($data['subjects'] as $subject): ?>
                <option value="<?= htmlspecialchars($subject['id']) ?>"><?= htmlspecialchars($subject['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="subtopic">Subtopic</label>
        <select name="subtopic" id="subtopic" required>
            <option value="">Select Subtopic</option>
            <?php foreach ($data['subtopics'] as $subtopic): ?>
                <option value="<?= htmlspecialchars($subtopic['id']) ?>"><?= htmlspecialchars($subtopic['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="standard">Standard</label>
        <select name="standard" id="standard" required>
            <option value="">Select Standard</option>
            <?php foreach ($data['standards'] as $standard): ?>
                <option value="<?= htmlspecialchars($standard['id']) ?>"><?= htmlspecialchars($standard['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="resource_type">Resource Type</label>
        <select name="resource_type" id="resource_type" required>
            <option value="">Select Resource Type</option>
            <?php foreach ($data['resource_types'] as $resource_type): ?>
                <option value="<?= htmlspecialchars($resource_type['id']) ?>"><?= htmlspecialchars($resource_type['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="file">File</label>
        <input type="file" name="file" id="file" accept=".pdf,.docx,.doc,.pptx,.ppt,.xlsx,.xls,.ods,.odt,.odp,.txt,.zip,.jpg,.jpeg,.png,.gif">
    </div>
    <div class="form-group">
        <label for="file_url">Google Docs URL</label>
        <input type="url" name="file_url" id="file_url" placeholder="Google Docs URL">
    </div>


    <div id="captcha_block"></div>

    <button type="submit">Submit</button>
</form>

<script>
    document.querySelector('form').addEventListener('submit', function (e) {
        const fileInput = document.querySelector('input[name="file"]');
        const urlInput = document.querySelector('input[name="file_url"]');

        if ((fileInput.value && urlInput.value) || (!fileInput.value && !urlInput.value)) {
            e.preventDefault();
            alert('Please upload either a file or a Google URL, not both.');
            return;
        }

        if (urlInput.value && !urlInput.value.includes('google.com')) {
            e.preventDefault();
            alert('The URL must contain google.com.');
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
        const charCounters = document.querySelectorAll('.char-counter');

        charCounters.forEach(counterContainer => {
            const input = counterContainer.querySelector('input,textarea');
            if (!input) return;

            const minLength = input.getAttribute('minlength') || 20;
            const counter = document.createElement('span');
            counter.className = 'counter';
            counter.textContent = `0/${minLength}`;
            counter.style.display = 'block';
            counter.style.marginTop = '5px';
            counter.style.color = '#666';

            counterContainer.appendChild(counter);

            input.addEventListener('input', () => {
                counter.textContent = `${input.value.length}/${minLength}`;
            });
        });
    });
</script>

<?php include __DIR__ . '/partials/footer.php'; ?>