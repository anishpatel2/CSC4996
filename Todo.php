<?php
if (isset($_POST['add'])) {
	$username = "root";
	$password = "";
	$hostname = "localhost";
    try{
		$db = new PDO("mysql:hostname=localhost;dbname=todolist","root","");
	}
	catch(PDOException $exc)
	{
		echo 'Connection Failed ';
		exit();
	}
	$TaskName = $_POST['taskname'];
	$TaskDes = $_POST['taskdes'];
	$test = "INSERT INTO `tasks`(`TaskName`, `TaskDes`) VALUES (:TaskName,:TaskDes)";
	$result = $db->prepare($test);
	$exec = $result->execute(array(":TaskName"=>$TaskName,":TaskDes"=>$TaskDes));
	if($exec)
	{
		echo 'Task Successfully Added To To-Do List';
	}
	else
	{
		echo 'error';
	}
}
if (isset($_GET['view'])) {
	$username = "root";
	$password = "";
	$hostname = "localhost";
    try{
		$db = new PDO("mysql:hostname=localhost;dbname=todolist","root","");
	}
	catch(PDOException $exc)
	{
		echo 'Connection Failed ';
		exit();
	}
	echo '<table><tr>';
	echo '<th> Task ID </th>';
	echo '<th> Task Name</th>';		
	echo '<th> Task Description </th></tr>';
	$test1 = "SELECT * FROM `tasks`"; 
	$query = $db->prepare($test1);
	$query->execute();
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $row)
	{	
		echo '<tr><td>';
		echo htmlentities($row['TaskNum']);
		echo '</td><td>';
		echo htmlentities($row['TaskName']);
		echo '</td>';
		echo '<td>';
		echo htmlentities($row['TaskDes']);
		echo '</td></tr>';
	}	
	echo '</table>';
}
if (isset($_POST['delete'])) 
{
	$username = "root";
	$password = "";
	$hostname = "localhost";
    try{
		$db = new PDO("mysql:hostname=localhost;dbname=todolist","root","");
	}
	catch(PDOException $exc)
	{
		echo 'Connection Failed ';
		exit();
	}
    $id = $_POST['taskname'];
    $test2 = $db->prepare( "DELETE FROM tasks WHERE TaskNum = '$id'" );
    $test2->execute();
	if($test2)
	{
		echo 'Successfully Deleted Task';
	}
	else
	{
		echo 'Error in Deleting Task';
	}
}
$db = null;
?>