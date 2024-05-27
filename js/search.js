// Obtener referencia al campo de entrada y a la tabla de resultados
const searchInput = document.getElementById('searchInput');
const searchResults = document.querySelector('#searchResults tbody');

// Escuchar el evento 'input' en el campo de búsqueda
searchInput.addEventListener('input', () => {
    // Obtener el valor del campo de búsqueda
    const query = searchInput.value.trim();

    // Realizar una solicitud AJAX al script PHP de búsqueda
    fetch(`../admin/search.php?query=${query}`)
        .then(response => response.json())
        .then(data => {
            // Limpiar la tabla de resultados
            searchResults.innerHTML = '';

            // Iterar sobre los resultados y agregar filas a la tabla
            data.forEach(row => {
                const tr = document.createElement('tr');
                tr.innerHTML = `<td>${row.columna1}</td><td>${row.columna2}</td>`;
                // Agregar más celdas según sea necesario
                searchResults.appendChild(tr);
            });
        })
        .catch(error => console.error('Error al obtener datos:', error));
});
