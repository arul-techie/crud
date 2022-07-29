	<?php
include_once('connection.php');
ini_set('display_errors', FALSE);
class manpower {
	
	function __construct(){
		
		$db = new dbObj();
		$conn_string = $db->getConnstring();
		$this->conn = $conn_string;	
		
	}
	
	public function getSkills1(){
		
		$sql = "select * from mst_skillsets";
		$qry_records = pg_query($this->conn,$sql) or die("Problem On Insert Record".pg_last_error());
		$data = pg_fetch_all($qry_records);
		return $data;
		
	}	
	
	public function getSkills(){
		
		$selectfields = array("sid" => "");
		$qry_records = pg_select($this->conn,'mst_skillsets',$selectfields) or die("Problem On Select Record".pg_last_error());
		//var_dump($qry_records);
		if($qry_records){
			
			$resp = $qry_records;
		
		}else{
			
			$resp='Problem On Select Records';
		}	
			
		return $resp;
	}
	
	
	
	
	public function EditSkills(){
		
		$sql = "select * from mst_skillsets where sid=".$_POST['sid'];
		$qry_records = pg_query($this->conn,$sql) or die("Problem On Insert Record".pg_last_error());
		$data = pg_fetch_all($qry_records);
		return $data;
		
	}
	
	public function AddSkills(){
		
		if(isset($_POST['skill_name'])){
			
			$data = $resp = array();
			$sql = "select * from mst_skillsets where lower(skillset)='".strtolower($_POST['skill_name'])."'";
			$qry_records = pg_query($this->conn,$sql) or die("Problem On Insert Record".pg_last_error());
			$rows = pg_num_rows($qry_records);
			if($rows > 0){
				
				$resp['status'] = false;
				
			}else{				
				
				$data['skillset'] = $_POST["skill_name"];
				$data['remarks'] = $_POST["remarks"];
				
				$result = pg_insert($this->conn, 'mst_skillsets' , $data) or die("error to insert employee data");
				$resp['status'] = true;
				$resp['Record'] = $data;
				
			}
			
		}
		
		return $resp;
		
	}
	
	function UpdateSkills() {
		
		$data = $resp = array();
		$resp['status'] = false;
		$data['skillset'] = $_POST["skill_name"];
		$data['remarks'] = $_POST["remarks"];
		$data['sid'] = $_POST["sid"];
		
		$result = pg_update($this->conn, 'mst_skillsets' , $data, array('sid' => $data['sid'])) or die("error to insert employee data");
		
        $resp['status'] = true;
        $resp['Record'] = $data;
        return $resp;
	}
	
	function DeleteSkills1() {
		
		if(isset($_POST['sid'])){
			
			$sql = "Delete FROM mst_skillsets Where sid=".$_POST['sid'];
			$queryRecords = pg_query($this->conn, $sql);
			if($queryRecords) {
				$res = '1';
			} else {
				$res = '0';
			}
			
		}
		
		return $res;
	}
	
	function DeleteSkills(){
		$selectfields = array("sid" => $_POST['sid']);
		$qry_records = pg_delete($this->conn,'mst_skillsets',$selectfields) or die(pg_last_error());
		if($qry_records){
			$res = 'Records Deleted Sucessfully';
		}else{
			$res = 'Problem on Delete Records';
		}
		//exit();
		return $res;
	}

}
?>