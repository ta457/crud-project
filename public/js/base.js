function fetchData(url) {
    return fetch(url)
        .then(response => response.json())
        .catch(error => {
            console.error('Error fetching data:', error);
            throw error; // Re-throw the error to handle it later if needed
        });
}


export { fetchData };