
function fileChecker(canBeEmpty = false) {
    document.querySelector('form').addEventListener('submit', function (e) {
        const fileInput = document.querySelector('input[name="file"]');
        const urlInput = document.querySelector('input[name="file_url"]');

        let fileValidation = canBeEmpty ? false : (!fileInput.value && !urlInput.value);
        if ((fileInput.value && urlInput.value) || fileValidation) {
            e.preventDefault();
            alert('Please upload either a file or a Google URL, not both.');
            return;
        }

        if (urlInput.value && !urlInput.value.includes('google.com')) {
            e.preventDefault();
            alert('The URL must contain google.com.');
        }
    });
}
function initCounter() {
    const charCounters = document.querySelectorAll('.char-counter');

    charCounters.forEach(counterContainer => {
        const input = counterContainer.querySelector('input,textarea');
        if (!input) return;

        const minLength = input.getAttribute('minlength') || 0;
        const counter = document.createElement('span');
        counter.className = 'counter';
        counter.style.display = 'block';
        counter.style.marginTop = '5px';
        counter.style.color = '#666';

        counterContainer.appendChild(counter);

        const updateCounter = () => {
            counter.textContent = `${input.value.length}/${minLength}`;
        };

        input.addEventListener('input', updateCounter);
        updateCounter(); // Initial count
    });
}

function fieldsOnChange() {
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
}