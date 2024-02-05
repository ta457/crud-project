document.addEventListener('DOMContentLoaded', function() {
    let checkboxGroups = document.querySelectorAll('.checkbox-group');

    checkboxGroups.forEach(function(group) {
        let fullAccessCheckbox = group.querySelector('input[type="checkbox"][id^="full-"]');
        let otherCheckboxes = group.querySelectorAll('input[type="checkbox"]:not([id^="full-"])');

        // select/deselect all when full-access checkbox is checked/unchecked
        fullAccessCheckbox.addEventListener('change', function() {
            if (fullAccessCheckbox.checked) {
                otherCheckboxes.forEach(function(checkbox) {
                    checkbox.checked = true;
                });
            } else {
                otherCheckboxes.forEach(function(checkbox) {
                    checkbox.checked = false;
                });
            }
        });

        // uncheck the full-access checkbox when non-full-access checkbox is unchecked
        otherCheckboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                if (!checkbox.checked && fullAccessCheckbox.checked) {
                    fullAccessCheckbox.checked = false;
                }
            });
        });
    });
});