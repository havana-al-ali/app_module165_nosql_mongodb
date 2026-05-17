function filter(type) {
    fetch("../backend/filter.php?type=" + type)
        .then(r => r.json())
        .then(data => {
            document.getElementById("result").textContent =
                JSON.stringify(data, null, 2);
        });
}
