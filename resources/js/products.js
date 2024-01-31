document.addEventListener("DOMContentLoaded", function() {
    const subCategoryIdInput = document.getElementById("sub_category_id");
    const categorySelect = document.getElementById("category");
    const subCategorySelects = document.querySelectorAll("[id^='sub_category_']");

    categorySelect.addEventListener("change", function() {
        const selectedCategoryId = categorySelect.value;

        subCategorySelects.forEach(function(subCategorySelect) {
            subCategorySelect.classList.add("hidden");
        });

        const selectedSubCategorySelect = document.getElementById(
            `sub_category_${selectedCategoryId}`);
        if (selectedSubCategorySelect) {
            selectedSubCategorySelect.classList.remove("hidden");
        }
    });

    subCategorySelects.forEach(function(subCategorySelect) {
        subCategorySelect.addEventListener("change", function() {
            subCategoryIdInput.value = subCategorySelect.value;
        });
    });
});

function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;

    if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode !== 8 && charCode !== 46 &&
        charCode !== 9) {
        return false;
    }

    return true;
}