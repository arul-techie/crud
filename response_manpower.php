<?php
include('manpower_class.php');

switch($_POST['type']){
	
	case 'GetSkills':
		$obj_manpower = new manpower();
		$get_skills = $obj_manpower->getSkills();
		echo json_encode($get_skills);
	break;
	
	case 'AddSkills':
		$obj_manpower = new manpower();
		$add_skills = $obj_manpower->AddSkills();
		echo json_encode($add_skills);
	break;
	
	case 'EditSkills':
		$obj_manpower = new manpower();
		$edit_skills = $obj_manpower->EditSkills();
		echo json_encode($edit_skills);
	break;
	
	case 'UpdateSkills':
		$obj_manpower = new manpower();
		$update_skills = $obj_manpower->UpdateSkills();
		echo json_encode($update_skills);
	break;
	
	case 'DeleteSkills':
		$obj_manpower = new manpower();
		$delete_skills = $obj_manpower->DeleteSkills();
		echo json_encode($delete_skills);
	break;
	
}
?>