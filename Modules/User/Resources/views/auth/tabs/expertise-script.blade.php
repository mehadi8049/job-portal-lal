<!-- Place this script after the form (still inside the foreach) -->
<script>
    (function() {
        // Protect globals per card
        let expId = {{ $experience->id }};
        let input = document.getElementById("expertise-input-" + expId);
        let container = document.getElementById("expertise-container-" + expId);
        let hiddenContainer = document.getElementById("expertise-hidden-" + expId);
        // The form that wraps this input (closest ancestor <form>)
        let form = input.closest('form');

        // Load existing tags from server (expects array or null)
        let existingTags = @json($experience->area_of_expertise ?? []);

        // Create visible tag + hidden input
        function addTag(value) {
            if (!value || !value.trim()) return;
            value = value.trim();

            // Avoid duplicate values (optional)
            // check existing hidden inputs
            let existing = Array.from(hiddenContainer.querySelectorAll('input[type="hidden"]'))
                .some(i => i.value === value);
            if (existing) {
                input.value = '';
                return;
            }

            // visible tag
            let tagElem = document.createElement("span");
            tagElem.className = "badge badge-info mr-2 mb-2 p-2";
            tagElem.style.fontSize = "14px";
            tagElem.style.display = "inline-flex";
            tagElem.style.alignItems = "center";
            tagElem.style.cursor = "default";
            tagElem.innerHTML = `
            ${escapeHtml(value)}
            <button type="button" aria-label="remove tag" title="Remove" style="border:0;background:transparent;color:inherit;padding:0;margin-left:6px;cursor:pointer;font-weight:bold;">&times;</button>
        `;

            // hidden input (this one will be posted)
            let hiddenInput = document.createElement("input");
            hiddenInput.type = "hidden";
            hiddenInput.name = "area_of_expertise[]";
            hiddenInput.value = value;

            // append
            hiddenContainer.appendChild(hiddenInput);
            container.insertBefore(tagElem, input);

            // remove handler
            tagElem.querySelector('button').addEventListener('click', function() {
                tagElem.remove();
                hiddenInput.remove();
            });

            input.value = '';
            input.focus();
        }

        // Simple HTML escape for tag text
        function escapeHtml(str) {
            return String(str)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }

        // Initialize existing tags
        if (Array.isArray(existingTags)) {
            existingTags.forEach(t => addTag(t));
        }

        // Keydown on the input — prevent form submit, add tag on Enter
        input.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                // prevent the form from submitting
                e.preventDefault();
                e.stopPropagation();
                addTag(input.value);
                return;
            }

            // optional: allow Backspace to delete last tag when input empty
            if (e.key === 'Backspace' && input.value.trim() === '') {
                let hiddenInputs = hiddenContainer.querySelectorAll('input[type="hidden"]');
                if (hiddenInputs.length > 0) {
                    let lastHidden = hiddenInputs[hiddenInputs.length - 1];
                    // remove its visible tag (assumes same index order)
                    let visibleTags = container.querySelectorAll('span.badge');
                    if (visibleTags.length) visibleTags[visibleTags.length - 1].remove();
                    lastHidden.remove();
                }
            }
        });

        // As a fallback, block Enter at the form level only when the target is our input
        if (form) {
            form.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && e.target === input) {
                    e.preventDefault();
                    e.stopPropagation();
                }
            });
        }

        // OPTIONAL: click container to focus input
        container.addEventListener('click', function() {
            input.focus();
        });

    })
    ();
</script>
