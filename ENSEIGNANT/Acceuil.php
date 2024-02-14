<?php
session_start();
$email = $_SESSION['email'];
$password = $_SESSION['password'];

	include '../db_conn.php';
		$sql2 = "SELECT nom FROM jours";
		$sql3 = "SELECT heure FROM heurs_debuts";

	    try {
	      // Exécuter la requête
	      $resultat2 = $conn->query($sql2);
	      $resultat3 = $conn->query($sql3);

	      // Vérifier si la requête a réussi
	      if ($resultat2) {
	          // Initialiser une liste pour stocker les valeurs de l'attribut "nom"
	          $listeNoms = array();
	          $listeNoms2 = array();

	          // Parcourir les résultats et ajouter les valeurs à la liste
	          while ($row = $resultat2->fetch(PDO::FETCH_ASSOC)) {
	              $listeNoms[] = $row['nom'];
	          }
	           while ($row2 = $resultat3->fetch(PDO::FETCH_ASSOC)) {
	              $listeNoms2[] = $row2['heure'];
	          }
	      } else {
	          // En cas d'erreur dans la requête
	          echo "Erreur dans la requête : " . $conn->errorInfo();
	      }
	    }catch(PDOExeption $e){
	      echo "Erreur :" . $e->getMessage();
	    }
?>
<!DOCTYPE html>
<html lang="en">


<!-- index.html  21 Nov 2019 03:44:50 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Dashboard</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="../assets/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="../assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='../assets/img/favicon.ico' />
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                <i data-feather="maximize"></i>
              </a></li>
            <li>
              <form class="form-inline mr-auto mx-4">
                <div class="search-element">
                  <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="200">
                  <button class="btn" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </form>
            </li>
          </ul>
        </div>
        <ul class="navbar-nav navbar-right">
          <div class="mx-4">
            <?php
              $sql4 = "SELECT e.id AS id, first_name, nom  FROM enseignant e, ue WHERE ((email = ? AND password = ?)) AND (e.id_ue = ue.id)";
              $requete = $conn->prepare($sql4);
              $requete->execute([$_SESSION['email'], $_SESSION['password']]);
              $ligne = $requete->fetch(PDO::FETCH_ASSOC);
              $nom = $ligne['first_name'];
              $id_e = $ligne['id'];
              $nom_ue = $ligne['nom'];
              $_SESSION['id_ens'] = $id_e;
              $_SESSION['nom_ue'] = $nom_ue;
              echo "<h2>Nom : $nom</h2>";
            ?>
          </div> 
          <div class="mx-4">
            <?php
              echo "<h2>UE : $nom_ue</h2>";
            ?>
          </div> 
          <form method="POST" action="logout.php">
            <button class="btn btn-dark submit">logout</button>
          </form>
          
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            MAIN
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Tablea de bord</li>
            <li class="dropdown active">
              <a href="index.html" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
                 
          </ul>
        </aside>
      </div>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
        	<?php
            if(isset($_SESSION['Notif'])){
              $notif = $_SESSION['Notif'];
              echo "<div class = \"alert alert-warning text-center\"> $notif </div>";
            }
        	?>
          <div class="row ">
          	<form action="InsertHeurs.php" method="post" class="row">
          		<div>
            	<?php
                        if (!empty($listeNoms)) {
                            echo "<label for=\"jour1\">Jour :</label>";
                            echo "<select id=\"jour1\" name=\"jour1\" class=\"form-control\">";
                            foreach ($listeNoms as $nom) {
                                echo "<option value=\"$nom\">$nom</option>";
                            }
                            echo "</select>";
                        } else {
                            echo "<p>Aucun nom trouvé.</p>";
                        }
                 ?>
            </div>
            <div>
            	<?php
                        if (!empty($listeNoms2)) {
                            echo "<label for=\"heure2\">Heure :</label>";
                            echo "<select id=\"heure2\" name=\"heure2\" class=\"form-control\">";
                            foreach ($listeNoms2 as $nom2) {
                                echo "<option value=\"$nom2\">$nom2</option>";
                            }
                            echo "</select>";
                        } else {
                            echo "<p>Aucun nom trouvé.</p>";
                        }
                    ?>
            </div>
            <div class="ml-4">
            	<?php
                        if (!empty($listeNoms)) {
                            echo "<label for=\"jour2\">Jour :</label>";
                            echo "<select id=\"jour2\" name=\"jour2\" class=\"form-control\">";
                            foreach ($listeNoms as $nom) {
                                echo "<option value=\"$nom\">$nom</option>";
                            }
                            echo "</select>";
                        } else {
                            echo "<p>Aucun nom trouvé.</p>";
                        }
                 ?>
            </div>
            <div>
            	<?php
                        if (!empty($listeNoms2)) {
                            echo "<label for=\"heure1\">Heure :</label>";
                            echo "<select id=\"heure1\" name=\"heure1\" class=\"form-control\">";
                            foreach ($listeNoms2 as $nom2) {
                                echo "<option value=\"$nom2\">$nom2</option>";
                            }
                            echo "</select>";
                        } else {
                            echo "<p>Aucun nom trouvé.</p>";
                        }
                ?>
            </div>
            
            <div class="my-4 text-center w-25">
              <button type="submit" class="btn btn-primary">Valider</button>
            </div>
          	</form>
            


          </div>
          

      <footer class="main-footer">
        <div class="footer-left">

        </div>
        <div class="footer-right">
        </div>
      </footer>
    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="../assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <script src="../assets/bundles/apexcharts/apexcharts.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="../assets/js/page/index.js"></script>
  <!-- Template JS File -->
  <script src="../assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="../assets/js/custom.js"></script>
</body>

</html>