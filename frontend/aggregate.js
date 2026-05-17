function aggregate(type) {

    fetch("../backend/aggregate.php?type=" + type)
        .then(response => {

            // avgByGender → le backend renvoie du TEXTE
            if (type === 'avgByGender') {
                return response.text();
            }

            // topStudent → maintenant aussi du TEXTE (résumé)
            if (type === 'topStudent') {
                return response.text();
            }

            // Sécurité : sinon JSON
            return response.json();
        })
        .then(data => {
            const result = document.getElementById("result");

            // Si c'est du texte → afficher tel quel
            if (typeof data === 'string') {
                result.textContent = data;
            } 
            // Sinon → JSON formaté
            else {
                result.textContent = JSON.stringify(data, null, 2);
            }
        });
}
