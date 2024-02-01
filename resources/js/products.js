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

function showProduct(productId) {
    document.getElementById("updateProductForm").action = `products/${productId}`;

    fetch(`http://localhost:8088/api/products/${productId}`)
        .then(response => response.json())
        .then(data => {
            // target the sub_category_id-select, set the option with same category name as selected
            const cateSelect = document.getElementById("sub_category_id-select");
            const cateOptions = cateSelect.options;
            for (let i = 0; i < cateOptions.length; i++) {
                if (cateOptions[i].text === data.data.category) {
                    cateOptions[i].selected = true;
                    break;
                }
            }
            
            document.getElementById("update-name").value = data.data.name;
            document.getElementById("update-description").value = data.data.description;
            document.getElementById("update-price").value = data.data.price;
            document.getElementById("update-quantity").value = data.data.quantity;
            document.getElementById("product-img").src = data.data.img;
        })
        .catch(error => console.error('Error fetching product data:', error));

    const trigger = document.getElementById("updateProductModalBtn");
    trigger.click();
}