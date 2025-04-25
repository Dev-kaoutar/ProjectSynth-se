<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sortie d'Article</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="/code/CSS/style.css" />
    <link rel="stylesheet" href="/code/CSS/styleListes.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />

    <style>
        .article-row {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-bottom: 10px;
        }

        .actions {
            display: flex;
            gap: 6px;
            align-items: center;
            /* margin-bottom: 10px; */
        }

        .add-icon {
            font-size: 35px;
            color: #1793d5;
            cursor: pointer;
            padding: 10px;
        }
    </style>
</head>

<body>
    <?php include 'header.php' ?>
    <div class="form-container">
        <h2>Sortie d'Article</h2>
        <form id="sortieForm">
            <div class="form-grid">
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="destinataire" placeholder="Nom du destinataire" required />
                </div>
                <div class="input-group">
                    <i class="fas fa-calendar-alt"></i>
                    <input type="date" name="date_sortie" required />
                </div>
            </div>

            <div class="article-row">
                <div class="input-group input-group-full">
                    <i class="fas fa-tag"></i>
                    <input type="text" name="nom" placeholder="Nom d'article" required>
                </div>
                <div class="input-group input-group-full">
                    <i class="fas fa-box-open"></i>
                    <input type="number" name="quantite_sortie" placeholder="Quantité sortie" min="1" required />
                </div>
                <i class="fas fa-plus-circle add-icon" onclick="ajouterSortie()" title="Ajouter une sortie"></i>
            </div>

            <table id="tableSorties">
                <thead>
                    <tr>
                        <th>Destinataire</th>
                        <th>Date</th>
                        <th>Nom d'article</th>
                        <th>Quantité</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

            <button type="submit" class="button">Valider la sortie</button>
        </form>
    </div>

    <script>
        function ajouterSortie() {
            const destinataire = document.querySelector("input[name='destinataire']").value;
            const date_sortie = document.querySelector("input[name='date_sortie']").value;
            const nom = document.querySelector("input[name='nom']").value;
            const quantite = document.querySelector("input[name='quantite_sortie']").value;

            if (!destinataire || !date_sortie || !nom || !quantite) {
                alert("Veuillez remplir tous les champs.");
                return;
            }

            const sortie = {
                destinataire,
                date_sortie,
                nom,
                quantite
            };
            let sorties = JSON.parse(localStorage.getItem("sorties")) || [];
            sorties.push(sortie);
            localStorage.setItem("sorties", JSON.stringify(sorties));

            insererSortieDansTableau(sortie);
            document.getElementById("tableSorties").style.display = "table";
        }

        function insererSortieDansTableau(sortie) {
            const tbody = document.querySelector("#tableSorties tbody");
            const ligne = document.createElement("tr");
            ligne.innerHTML = `
        <td>${sortie.destinataire}</td>
        <td>${sortie.date_sortie}</td>
        <td>${sortie.nom}</td>
        <td>${sortie.quantite}</td>
        <td class="actions">
          <button onclick="modifierSortie(this)" class="edit"><i class="fas fa-edit"></i></button>
          <button onclick="supprimerSortie(this)" class="delete"><i class="fas fa-trash-alt"></i></button>
        </td>
      `;
            tbody.appendChild(ligne);
        }

        function chargerSorties() {
            const sorties = JSON.parse(localStorage.getItem("sorties")) || [];
            if (sorties.length > 0) {
                document.getElementById("tableSorties").style.display = "table";
                sorties.forEach(insererSortieDansTableau);
            } else {
                document.getElementById("tableSorties").style.display = "none";
            }
        }

        function supprimerSortie(btn) {
            const ligne = btn.parentElement.parentElement;
            const index = ligne.rowIndex - 1;
            ligne.remove();

            let sorties = JSON.parse(localStorage.getItem("sorties")) || [];
            sorties.splice(index, 1);
            localStorage.setItem("sorties", JSON.stringify(sorties));
        }

        function modifierSortie(btn) {
            const ligne = btn.closest("tr").children;
            document.querySelector("input[name='destinataire']").value = ligne[0].textContent;
            document.querySelector("input[name='date_sortie']").value = ligne[1].textContent;
            document.querySelector("input[name='nom']").value = ligne[2].textContent;
            document.querySelector("input[name='quantite_sortie']").value = ligne[3].textContent;

            btn.closest("tr").remove();
        }

        document.getElementById("sortieForm").addEventListener("submit", function(e) {
            e.preventDefault();
            localStorage.removeItem("sorties");
            const tbody = document.querySelector("#tableSorties tbody");
            while (tbody.firstChild) {
                tbody.removeChild(tbody.firstChild);
            }
            document.getElementById("tableSorties").style.display = "none";
            this.reset();
        });

        window.onload = chargerSorties;
    </script>
</body>

</html>

</body>

</html>