<?php
require '../include/include.inc.php';
require PATH_ROOT.'/mysql/mysql.php';
$interact = new interact();
$interactClick = new interactClick();
//$interact->getAllInfo();
switch ($_POST['type']){
	case "getInteract":
		print ($interact->getAllInfo());
		break;
	case "getInteractExDate":
		print($interact->getAllInfoExDate());
		break;
	case "getInteractClick":
	print($interactClick->getAllInfo($_POST['uid']));
	break;
	case "heartClick":
		$interactClick->upClick($_POST['id'],$_POST['uid']);
		break;
	case "heartClickDel":
		$interactClick->upClickDel($_POST['id'],$_POST['uid']);
		break;
	
};


?>