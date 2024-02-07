<?php 
    session_start();
    include '../../db_conn.php';

    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
    $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $ue = isset($_POST['ue']) ? $_POST['ue'] : '';
    $password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_BCRYPT) : '';

    $sql2 = "SELECT nom FROM ue";
    try {
      // Exécuter la requête
      $resultat2 = $conn->query($sql2);

      // Vérifier si la requête a réussi
      if ($resultat2) {
          // Initialiser une liste pour stocker les valeurs de l'attribut "nom"
          $listeNoms = array();

          // Parcourir les résultats et ajouter les valeurs à la liste
          while ($row = $resultat2->fetch(PDO::FETCH_ASSOC)) {
              $listeNoms[] = $row['nom'];
          }
      } else {
          // En cas d'erreur dans la requête
          echo "Erreur dans la requête : " . $conn->errorInfo();
      }
    }catch(PDOExeption $e){
      echo "Erreur :" . $e->getMessage();
    }

    $indiceSelect = array_search($ue, $listeNoms);
    $indiceSelect++;

    $sql = "CALL InsertEnseignant(?, ?, ?, ?, ?)";
    try {
      // Exécuter la requête
      $resultat = $conn->prepare($sql);

      if($resultat && $first_name!=''){
        //$resultat->bind_param("ssssi", $first_name, $last_name, $email, $password, $indiceSelect);
        $resultat->execute([$first_name, $last_name, $email, $password, $indiceSelect]);
        $resultat->closeCursor();
      }
    }catch(PDOExeption $e){
      echo "Erreur :" . $e->getMessage();
    }
  // Requête SQL pour récupérer les valeurs de l'attribut "nom" de la table "ue"
?>
<!DOCTYPE html>
<html lang="en">


<!-- auth-register.html  21 Nov 2019 04:05:01 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Dashboard</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="../../assets/css/app.min.css">
  <link rel="stylesheet" href="../../assets/bundles/jquery-selectric/selectric.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="../../assets/css/style.css">
  <link rel="stylesheet" href="../../assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="../../assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='../../assets/img/favicon.ico' />
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Register</h4>
              </div>
              <div class="card-body">
                <form method="post" action="auth-register.php">
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="first_name">First Name</label>
                      <input id="first_name" type="text" class="form-control" name="first_name" autofocus>
                    </div>
                    <div class="form-group col-6">
                      <label for="last_name">Last Name</label>
                      <input id="last_name" type="text" class="form-control" name="last_name">
                    </div>
                    <?php
                        if (!empty($listeNoms)) {
                            echo "<label for=\"ue\">UE de l'enseignant :</label>";
                            echo "<select id=\"ue\" name=\"ue\" class=\"form-control\">";
                            foreach ($listeNoms as $nom) {
                                echo "<option value=\"$nom\">$nom</option>";
                            }
                            echo "</select>";
                        } else {
                            echo "<p>Aucun nom trouvé.</p>";
                        }
                    ?>
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email">
                    <div class="invalid-feedback">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                        <label for="password" class="d-block">Password</label>
                        <input id="password" type="text" class="form-control" data-indicator="pwindicator" name="password">
                        <div id="pwindicator" class="pwindicator">
                            <div class="bar"></div>
                            <div class="label"></div>
                        </div>
                        <button onclick="generatePassword()" class="btn btn-primary" type="button">Générer un mot de passe</button>
                    </div>
                    
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="agree" class="custom-control-input" id="agree">
                      <label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      Register
                    </button>
                  </div>
                </form>
              </div>
              <div class="mb-4 text-muted text-center">
                Already Registered? <a href="auth-login.html">Login</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- General JS Scripts -->
  <script>
        function generatePassword() {
            // Longueur du mot de passe
            var length = 10;

            // Caractères autorisés
            var characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

            // Générer le mot de passe
            var password = '';
            for (var i = 0; i < length; i++) {
                password += characters[Math.floor(Math.random() * characters.length)];
            }

            // Mettre à jour la valeur du champ de mot de passe
            document.getElementById('password').value = password;
        }
    </script>
  <script src="../../assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <script src="../../assets/bundles/jquery-pwstrength/jquery.pwstrength.min.js"></script>
  <script src="../../assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="../../assets/js/page/auth-register.js"></script>
  <!-- Template JS File -->
  <script src="../../assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="../../assets/js/custom.js"></script>
</body>


<!-- auth-register.html  21 Nov 2019 04:05:02 GMT -->
</html>