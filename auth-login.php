<?php
session_start();
include 'db_conn.php';
  $email = isset($_POST['email']) ? $_POST['email'] : '';
  $pass = isset($_POST['password']) ? $_POST['password'] : '';


  try {
    // Appeler la fonction en utilisant une requête SQL SELECT
    $query = "SELECT CountMatchingTeachers(?, ?) AS result";
    $query2 = "SELECT CountMatchingAdmin(?, ?) AS result";
    $stmt = $conn->prepare($query);
    $stmt2 = $conn->prepare($query2);

    // Vérifier si la préparation de la requête a réussi
    if ($stmt) {
        // Binder les paramètres
        $stmt->bindParam(1, $email, PDO::PARAM_STR);
        $stmt->bindParam(2, $pass, PDO::PARAM_STR);

        $stmt2->bindParam(1, $email, PDO::PARAM_STR);
        $stmt2->bindParam(2, $pass, PDO::PARAM_STR);

        // Exécuter la requête
        $stmt->execute();
        $stmt2->execute();
        // Récupérer le résultat dans une variable
        $result = $stmt->fetch(PDO::FETCH_ASSOC)['result'];
        $result2 = $stmt2->fetch(PDO::FETCH_ASSOC)['result'];
        // Afficher le résultat (à des fins de test)
        if($result > 0){
          $_SESSION['email'] = $email;
          $_SESSION['password'] = $password;
          header("Location: ENSEIGNANT/Acceuil.php");
          exit;
        }
        if($result2>0){
          header("Location: ADMIN/index.php");
          exit;
        }

        // Fermer la requête
        $stmt->closeCursor();
    } else {
        // En cas d'erreur dans la préparation de la requête
        echo "Erreur dans la préparation de la requête : " . $connexion->errorInfo()[2];
    }

    // Fermer la connexion à la base de données
    $connexion = null;
} catch (PDOException $e) {
    // Gérer les erreurs de connexion ou d'exécution de la requête
    echo "Erreur : " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Otika - Admin Dashboard Template</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/bundles/bootstrap-social/bootstrap-social.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Login</h4>
              </div>
              <div class="card-body">
                <form method="post" action="auth-login.php" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Please fill in your email
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Password</label>
                      <div class="float-right">
                        <a href="auth-forgot-password.html" class="text-small">
                          Forgot Password?
                        </a>
                      </div>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                      please fill in your password
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Remember Me</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>
                <div class="text-center mt-4 mb-3">
                  <div class="text-job text-muted">Login With Social</div>
                </div>
                <div class="row sm-gutters">
                  <div class="col-6">
                    <a class="btn btn-block btn-social btn-facebook">
                      <span class="fab fa-facebook"></span> Facebook
                    </a>
                  </div>
                  <div class="col-6">
                    <a class="btn btn-block btn-social btn-twitter">
                      <span class="fab fa-twitter"></span> Twitter
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="mt-5 text-muted text-center">
              Don't have an account? <a href="auth-register.html">Create One</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- General JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>
</body>


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->
</html>