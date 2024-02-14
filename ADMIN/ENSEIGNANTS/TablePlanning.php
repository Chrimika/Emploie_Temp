<?php
	$sql = "SELECT e.id, first_name, last_name, email, u.nom AS ue, password FROM enseignant e, ue u WHERE u.id = id_ue";
    $resultat = $conn->query($sql);
    while ($row = $resultat->fetch(PDO::FETCH_ASSOC)) {
        echo 
	        "<tr>
                <td>{$row['id']}</td>
                <td>{$row['first_name']}</td>
                <td>{$row['last_name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['ue']}</td>
                <td>{$row['password']}</td>
                <td>
                    <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#modalModifier{$row['id']}'>Modifier</button>
                    <a href='supprimer.php?id={$row['id']}'>Supprimer</a>
                </td>
	         </tr>";

	         // Modal pour la modification
        echo "<div class='modal fade' id='modalModifier{$row['id']}' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h5 class='modal-title' id='exampleModalLabel'>Modifier Enseignant</h5>
                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>
                        <div class='modal-body'>
                            <!-- Formulaire de modification ici -->
                            <form action='traiter_modification.php' method='post'>
                                <input type='hidden' name='idEnseignant' value='{$row['id']}'>
                                <label for='nom'>Nom :</label>
                                <input type='text' name='nom' value='{$row['last_name']}' required>
                                <!-- Ajoutez d'autres champs selon vos besoins -->
                                <button type='submit' class='btn btn-primary'>Enregistrer les modifications</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>";
    }
?>