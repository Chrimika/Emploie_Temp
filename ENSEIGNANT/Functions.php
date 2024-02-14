<?php
	function AjoutEnseignant($first_name, $last_name, $email, $password, $id_ue)
	{
		include '../../db_conn.php';
		$sql = "CALL InsertEnseignant(?, ?, ?, ?, ?)";
		try {
	      $resultat = $conn->prepare($sql);

	      if($resultat && $first_name!=''){
	        $resultat->execute([$first_name, $last_name, $email, $password, $id_ue]);
	        $resultat->closeCursor();
	        return true;
	      }
	      return false;
	    }catch(PDOExeption $e){
	      echo "Erreur :" . $e->getMessage();
	    }
	}
	
?>