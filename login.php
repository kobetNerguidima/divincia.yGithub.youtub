 <div class="container">
        <h2>Inscrire un nouvel Étudiant</h2>
        <form action="process_inscription.php" method="POST">
            <label for="cne">CNE :</label>
            <input type="text" id="cne" name="cne" required>

            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required>

            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" required>

            <label for="date_naissance">Date de Naissance :</label>
            <input type="date" id="date_naissance" name="date_naissance" required>

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>

            <label for="telephone">Téléphone :</label>
            <input type="text" id="telephone" name="telephone">

            <label for="adresse">Adresse :</label>
            <textarea id="adresse" name="adresse"></textarea>

            <label for="date_inscription">Date d'Inscription :</label>
            <input type="date" id="date_inscription" name="date_inscription" value="<?php echo date('Y-m-d'); ?>" required>

            <label for="filiere">Filière :</label>
            <select id="filiere" name="filiere_id" required>
                <option value="">Sélectionner une filière</option>
                <option value="Genie informatique">GI</option>
                <option value="Genie electrique">GE</option>
                <option value="IAT">IAT</option>
                <option value="GEnie civil">GC</option>
                <option value="gestion d'entreprise">GEE</option>
                <?php
                include 'config.php';
                $result = $conn->query("SELECT id_filiere, nom_filiere FROM filiere");
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['id_filiere'] . "'>" . htmlspecialchars($row['nom_filiere']) . "</option>";
                }
                $conn->close();
                ?>
            </select>

            <label for="niveau">Niveau :</label>
            <select id="niveau" name="niveau_id" required>
                <option value="">Sélectionner un niveau</option>
                <option value="DUT">DUT</option>
                <option value="Licence1">Licence1</option>
                <option value="Master2">Master2</option>
            </select>

            <label for="groupe">Groupe :</label>
            <select id="groupe" name="groupe_id" required>
                <option value="">Sélectionner un groupe</option>
                <option value="groupe1">groupe1</option>
                <option value="groupe2">groupe2</option>
            </select>

            <label for="sous_groupe">Sous-groupe (optionnel) :</label>
            <select id="sous_groupe" name="sous_groupe_id">
                <option value="">Sélectionner un sous-groupe</option>
                <option value="tp1/td1">tp1/td1</option>
                <option value="tp2/td2">tp2/td2</option>
            </select>

            <label for="password">Mot de passe initial :</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Inscrire l'étudiant</button>
        </form>
    </div>
