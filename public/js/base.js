// js revealing module pattern [DONE]
// 1 middleware file [DONE]
// product img preview [DONE]
// 1 category table [DONE]
// show error above input field [DONE]
// sort product by category [DONE]
// keep selection & search inp after refresh [DONE]
// mail
// 100% test [DONE]

const AppUtils = (function () {
    function changeDeleteFormAction(url, id) {
        const form = document.getElementById('deleteRecordForm');
        form.action = url + id;
    }

    function validateForm(formId) {
        let inputSelector = `#${formId} input[type="text"], #${formId} input[type="password"], #${formId} input[type="email"]`;

        const inputs = document.querySelectorAll(inputSelector);
        let isValid = true;

        inputs.forEach(function (input) {
            if (input.value.trim() === '') {
                isValid = false;
    
                const errorMessage = document.createElement('span');
                errorMessage.textContent = 'This field is required';
                errorMessage.className = 'text-rose-600 text-sm ml-2';

                const label = input.previousElementSibling;
                if (label && label.nodeName.toLowerCase() === 'label') {
                    label.appendChild(errorMessage);
                    setTimeout(function () {
                        errorMessage.remove();
                    }, 2000);
                }
            }
        });

        if (isValid) {
            document.getElementById(formId).submit();
        }
    }

    function fetchData(url) {
        return fetch(url)
            .then(response => response.json())
            .catch(error => {
                console.error('Error fetching data:', error);
                throw error;
            });
    }

    function handleFetchError(error, customMessage) {
        console.error(customMessage, error);
        throw error;
    }

    return {
        changeDeleteFormAction: changeDeleteFormAction,
        validateForm: validateForm,
        fetchData: fetchData,
        handleFetchError: handleFetchError
    };
})();