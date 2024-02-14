<?php
session_start();
	if(isset($_POST['heure1']) &&
		isset($_POST['jour1']) &&
		isset($_POST['heure2']) &&
		isset($_POST['jour2']) &&
		isset($_SESSION['id_ens']) ){

		include '../db_conn.php';
		$sql = "CALL InsertPlanning(?,?,?)";
		$sql2 = "CALL InsertPlanning(?,?,?)";

		$requete = $conn->prepare($sql);
		$requete->execute([$_SESSION['id_ens'], $_POST['heure1'], $_POST['jour1']]);

		$requete2 = $conn->prepare($sql2);
		$requete->execute([$_SESSION['id_ens'], $_POST['heure2'], $_POST['jour2']]);

		$_SESSION['Notif'] = "Inserer avec succes";
		header("Location: Acceuil.php");
	}
	
?>