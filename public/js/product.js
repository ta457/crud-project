function showProduct(productId) {
    fetchData( `http://localhost:8088/api/products/${productId}`)
        .then(data => {
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
        })
        .catch(error => console.error('Error in showProduct:', error));

    const trigger = document.getElementById("updateProductModalBtn");
    trigger.click();
}
