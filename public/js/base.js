function changeDeleteFormAction(url, id) {
    var form = document.getElementById('deleteRecordForm');
    form.action = url + id;
}

function validateForm(formId) {
    let inputSelector = '#' + formId + ' input[type="text"]';
    inputSelector += ', #' + formId + ' input[type="password"]';

    let inputs = document.querySelectorAll(inputSelector);
    let isValid = true;
    
    inputs.forEach(function(input) {
        if (input.value.trim() === '') {
            isValid = false;
        }
    });

    if (isValid) {
        document.getElementById(formId).submit();
    } else {
        alert('Please fill in all the fields');
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