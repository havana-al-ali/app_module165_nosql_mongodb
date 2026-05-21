function sortData(field) {
    localStorage.clear();

    const resultSort = document.getElementById("result-sort");

    // Cacher avant d'afficher un nouveau résultat
    resultSort.style.display = "none";

    fetch("../backend/sort.php?field=" + field)
        .then(r => r.json())
        .then(s => {

            resultSort.innerHTML = `
                <strong>Meilleur élève :</strong><br><br>
                Genre : ${s.gender}<br>
                Race : ${s["race/ethnicity"]}<br>
                Éducation : ${s["parental level of education"]}<br>
                Lunch : ${s.lunch}<br>
                Préparation : ${s["test preparation course"]}<br><br>
                Math : ${s["math score"]}<br>
                Lecture : ${s["reading score"]}<br>
                Écriture : ${s["writing score"]}<br><br>
                <strong>Moyenne : ${s.average}</strong>
            `;

            // Montrer la carte
            resultSort.style.display = "block";
        });
}

function resetSortUI() {
    localStorage.clear();

    const resultSort = document.getElementById("result-sort");

    // Cacher la carte
    resultSort.style.display = "none";

    // Vider le contenu
    resultSort.innerHTML = "";

    console.log("Tri réinitialisé.");
}
