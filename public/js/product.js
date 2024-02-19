const ProductModule = (function () {
    function updateProductForm(data, productId) {
        document.getElementById("updateProductForm").action = `products/${productId}`;

        const cateSelect = document.getElementById("update-category_id");
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
    }

    function showProduct(url, productId) {
        AppUtils.fetchData(url)
            .then(data => {
                updateProductForm(data, productId);
            })
            .catch(error => AppUtils.handleFetchError(error, 'Error in showProduct:'));

        document.getElementById("updateProductModalBtn").click();
    }

    return {
        updateProductForm: updateProductForm,
        showProduct: showProduct
    };
})();

// handle show product modal when click on table row
document.addEventListener('DOMContentLoaded', function () {
    const productRows = document.querySelectorAll('tr');

    productRows.forEach(function (row) {
        row.addEventListener('click', function () {
            const apiUrl = row.getAttribute('data-route');
            const productId = apiUrl.split('/').pop();
            ProductModule.showProduct(apiUrl, productId);
        });
    });
});

// handle preview img in create / update product modal
function createPreviewImg(imageInput, previewDiv) {
    imageInput.addEventListener('change', function () {
        previewDiv.innerHTML = '';

        if (imageInput.files && imageInput.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                // create img and append to preview div
                const imgElement = document.createElement('img');
                imgElement.src = e.target.result;
                imgElement.className = 'w-40 h-40 rounded-lg';
                previewDiv.appendChild(imgElement);

                // create delete img button and append to preview div
                const deleteButton = document.createElement('button');
                deleteButton.className = 'rm-img-preview-btn';
                deleteButton.textContent = 'x';
                deleteButton.addEventListener('click', function () {
                    previewDiv.removeChild(imgElement);
                    previewDiv.removeChild(deleteButton);
                    imageInput.value = '';
                });
                previewDiv.appendChild(deleteButton);
            };

            reader.readAsDataURL(imageInput.files[0]);
        }
    });
}

document.addEventListener('DOMContentLoaded', function () {
    const imageCreateInp = document.getElementById('img');
    const imageUpdateInp = document.getElementById('update-img');
    const previewCreate = document.getElementById('preview-create');
    const previewUpdate = document.getElementById('preview-update');

    createPreviewImg(imageCreateInp, previewCreate);
    createPreviewImg(imageUpdateInp, previewUpdate);
});

// prevent delete product btn open show product modal
document.addEventListener('DOMContentLoaded', function () {
    const deleteProductBtns = document.querySelectorAll('.prod-delete-btn');

    deleteProductBtns.forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.stopPropagation();
        });
    });
});

// handle select category filter
document.addEventListener('DOMContentLoaded', function () {
    AppUtils.handleSelectFilter('category_id', '/products');
});