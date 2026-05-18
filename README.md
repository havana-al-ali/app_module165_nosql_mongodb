# Application Module 165 – MongoDB  
Projet : app_module165_Havana_Maryam

## 📌 1. Architecture générale

L’application est composée de trois parties :

### Frontend  
- HTML / CSS / JavaScript  
- Interface simple avec 5 boutons :  
  - Filtrer : Étudiantes  
  - Filtrer : Bachelor  
  - Trier : Score de math  
  - Agrégation : Moyenne par genre  
  - Agrégation : Meilleur élève  
- Affichage des résultats dans une zone dédiée.

###  Backend (PHP)  
- `filter.php` → filtrage  
- `sort.php` → tri  
- `aggregate.php` → agrégations  
- `connect.php` → connexion MongoDB  
- Utilisation du driver officiel MongoDB (Composer).

###  Base de données  
- MongoDB standalone  
- Collection contenant les données des élèves (math, reading, writing, gender, etc.)

---

## 📌 2. Fonctionnalités (les 3 affichages demandés)

L’application propose **3 affichages différents**, chacun utilisant **une commande MongoDB différente**, comme exigé dans l’évaluation.

---

###  1) Filtrage — Afficher un nombre de documents

**Boutons :**  
- *Filtrer : Étudiantes*  
- *Filtrer : Bachelor*

**Commande MongoDB :**  
`find()` + `countDocuments()`

**Fonctionnement :**  
Quand l’utilisateur clique sur un bouton, l’application filtre les documents selon un critère (ex : `gender = female`, `parental level of education = bachelor's degree`).

**Résultat affiché :**  
➡️ Un **nombre** (ex : `517 étudiantes`)

**Objectif :**  
Montrer un filtrage simple dans MongoDB.

---

###  2) Tri — Afficher le meilleur élève selon un score

**Bouton :**  
- *Trier : Score de math*

**Commande MongoDB :**  
`find().sort().limit(1)`

**Fonctionnement :**  
L’application récupère l’élève ayant le meilleur score dans un champ donné (ex : math).

**Résultat affiché :**  
➡️ Un **document JSON** contenant l’élève avec le meilleur score.

**Objectif :**  
Montrer un tri décroissant et une sélection du top 1.

---

###  3) Agrégation — Résumé statistique

**Boutons :**  
- *Agrégation : Moyenne par genre*  
- *Agrégation : Meilleur élève*

**Commandes MongoDB :**  
- `$match` + `$group` + `$avg`  
- `$addFields` + `$sort` + `$limit`

**Fonctionnement :**  
L’application exécute un pipeline d’agrégation pour produire un résumé lisible.

**Résultat affiché :**

####  Moyenne par genre
