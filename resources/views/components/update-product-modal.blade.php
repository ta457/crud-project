<button type="button" id="updateProductModalBtn" data-modal-target="updateProductModal" data-modal-toggle="updateProductModal" class="hidden">
</button>

<!-- Main modal -->
<div id="updateProductModal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Update product
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="updateProductModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form id="updateProductForm" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <img id="product-img" src="" alt="product_img" class="w-40 h-40 rounded-lg">
                    </div>
                    @if ($user->hasPermission('update-product'))
                        <div>
                            <label for="img" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Change product image
                            </label>
                            <input type="file" name="img" id="update-img"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        </div>
                    @endif
                    <div>
                        <label for="update-sub_category_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product category</label>
                        <select name="sub_category_id" id="sub_category_id-select"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @foreach ($subCategories as $subCategory)
                                <option value="{{ $subCategory->id }}">
                                    {{ $subCategory->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="update-name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product name</label>
                        <input type="text" name="name" id="update-name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type product name" value="">
                    </div>
                    <div>
                        <label for="update-description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product description</label>
                        <input type="text" name="description" id="update-description"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type product description" value="">
                    </div>
                    <div>
                        <label for="update-price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                            price</label>
                        <input min="0" type="number" name="price" id="update-price"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type product price" value="">
                    </div>
                    <div>
                        <label for="update-quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                            quantity</label>
                        <input min="0" type="number" name="quantity" id="update-quantity"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type product quantity" value="">
                    </div>
                </div>
                @if ($user->hasPermission('update-product'))
                    <div class="max-w-lg">
                        <button onclick="validateForm('updateProductForm')"
                            class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800"
                            type="button">
                            Save
                        </button>
                    </div>
                @endif 
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        document.getElementById('updateProductModalBtn').click();
    });
</script>
