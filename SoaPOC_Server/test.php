<?php
function getMine($id, $question){
			$bdd=new PDO(sprintf("mysql:host=%s;dbname=%s", "localhost", "proj_bd"),"root","root");
			$req = $bdd->prepare('SELECT reponses from reponses where id_user = ? and question=?');
			$req->execute(array($id, $question));
			$data = $req->fetch(PDO::FETCH_ASSOC);
			return($data["reponses"]);
		}

var_dump(getMine(1,1));

?>
