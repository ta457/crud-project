function fetchData(url) {
    return fetch(url)
        .then(response => response.json())
        .catch(error => {
            console.error('Error fetching data:', error);
            throw error;
        });
}

function changeDeleteFormAction(url, id) {
    var form = document.getElementById('deleteRecordForm');
    form.action = url + id;
}