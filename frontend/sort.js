function sortData(field) {
    fetch("../backend/sort.php?field=" + field)
        .then(r => r.json())
        .then(data => {
            document.getElementById("result").textContent =
                JSON.stringify(data, null, 2);
        });
}
