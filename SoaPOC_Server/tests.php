<?php
require_once('identifiants.php');

class bddWebService{
	private $password;
	private $db_settings = array(
	'host' =>'localhost',
	'port'=>'8889',
	'username'=>'root',
	'password'=>'root', 
	'dbname'=>'proj_bd'
 );
	public function __construct($mdp){
		$this->password = $mdp;
	}
	private function auth($str){
		return(hash("SHA512", $str.$this->password));

	}
	public function getAll(){

		$data = "";
		$bdd=new PDO(sprintf("mysql:host=%s;dbname=%s", $this->db_settings["host"], $this->db_settings["dbname"]),$this->db_settings["username"],$this->db_settings["password"]);
		$req = $bdd->query("select q.question, ifnull(a.count_a, 0), ifnull(b.count_b, 0), ifnull(c.count_c, 0), ifnull(d.count_d, 0), ifnull(e.count_e, 0), ifnull(f.count_f, 0) from 
							(select question FROM reponses) q
							left join (select question, count(*) as count_a from reponses where reponses like '%a%' group by question) a on q.question = a.question
							LEFT JOIN (select question, count(*) as count_b from reponses where reponses like '%b%' group by question) b on q.question = b.question
							LEFT JOIN (select question, count(*) as count_c from reponses where reponses like '%c%' group by question) c on q.question = c.question
							LEFT JOIN (select question, count(*) as count_d from reponses where reponses like '%d%' group by question) d on q.question = d.question
							LEFT JOIN (select question, count(*) as count_e from reponses where reponses like '%e%' group by question) e on q.question = e.question
							LEFT JOIN (select question, count(*) as count_f from reponses where reponses like '%f%' group by question) f on q.question = f.question
							group by a.question
							order by q.question asc");

		while($out = $req->fetch(PDO::FETCH_ASSOC)){
			$data.=implode(',', $out);
			$data.=";";
		}
		
		return($data.'-'.$this->auth($data));
	
	}
	public function getOne($question){
		$bdd=new PDO(sprintf("mysql:host=%s;dbname=%s", $this->db_settings["host"], $this->db_settings["dbname"]),$this->db_settings["username"],$this->db_settings["password"]);
		$req = $bdd->prepare("select q.question, ifnull(a.count_a,0), ifnull(b.count_b, 0), ifnull(c.count_c, 0), ifnull(d.count_d,0), ifnull(e.count_e,0), ifnull(f.count_f,0) from 
							(select :question as question) q
							LEFT JOIN (select question, count(*) as count_a from reponses where reponses like '%a%' HAVING question=:question) a on q.question = a.question
							LEFT JOIN (select question, count(*) as count_b from reponses where reponses like '%b%' HAVING question=:question) b on q.question = b.question
							LEFT JOIN (select question, count(*) as count_c from reponses where reponses like '%c%' HAVING question=:question) c on q.question = c.question
							LEFT JOIN (select question, count(*) as count_d from reponses where reponses like '%d%' HAVING question=:question) d on q.question = d.question
							LEFT JOIN (select question, count(*) as count_e from reponses where reponses like '%e%' HAVING question=:question) e on q.question = e.question
							LEFT JOIN (select question, count(*) as count_f from reponses where reponses like '%f%' HAVING question=:question) f on q.question = f.question
							group by a.question
							order by q.question asc");
		$req->execute(array('question' => $question ));
		$data = $req->fetch(PDO::FETCH_ASSOC);
		$strData = implode(",",$data);

		return($strData.'-'.$this->auth($strData));

	}

	public function getId($ip, $device_data){
		$bdd=new PDO(sprintf("mysql:host=%s;dbname=%s", $this->db_settings["host"], $this->db_settings["dbname"]),$this->db_settings["username"],$this->db_settings["password"]);
		$req = $bdd->prepare("INSERT INTO `user`(`ip`, `device`) VALUES (?,?)");
		$req->execute(array($ip, $device_data));
		return($bdd->lastInsertId());
	}

	public function submitAns($id, $question, $reponse, $auth){
		if (hash('SHA512', $id.'-'.$question.'-'.$reponse.'-'.$this->password)){
			$bdd=new PDO(sprintf("mysql:host=%s;dbname=%s", $this->db_settings["host"], $this->db_settings["dbname"]),$this->db_settings["username"],$this->db_settings["password"]);
			$req=$bdd->prepare("INSERT INTO `reponses`(`id_user`, `question`, `reponses`) VALUES (?,?,?)");
			return($req->execute(array($id, $question, $reponse)));

		}
		else{
			return(403);
		}
	}



}
$service = new bddWebService("Poney");
var_dump($service->submitAns(1,7,"a,b", hash('SHA512', "1-7-a,b-Poney")));

?>