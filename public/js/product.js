function updateProductForm(data, productId) {
    document.getElementById("updateProductForm").action = `products/${productId}`;
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
}

function showProduct(productId) {
    fetchData(`/api/products/${productId}`)
        .then(data => {
            updateProductForm(data, productId);
        })
        .catch(error => handleFetchError(error, 'Error in showProduct:'));

    document.getElementById("updateProductModalBtn").click();
}