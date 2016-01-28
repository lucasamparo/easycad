<?php
	require_once('../models/bootstrap.php');
	session_start();
	if(!($_SESSION['easycad']['logado'])){
		header('Location: index.php');
	}
?>