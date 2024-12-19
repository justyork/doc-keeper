
function initCounter() {
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