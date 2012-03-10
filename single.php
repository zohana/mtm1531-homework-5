<?php 
require_once 'includes/filter-wrapper.php';
require_once 'includes/db.php';

$id=filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);

if(empty($id)){
	header('Location:index.php');
	exit; //stop php compiler right here and immediately redirect the user.
}
//only connect to the data base if there is an id, because this is after the above if-statement.
//without an ID there is no point connecting to the data base.

// -->prepare() allows us to execute SQL with user input.
$sql = $db->prepare('SELECT id, name, release_date, director
					 FROM movies
					 WHERE id= :id
 
');

//->bindValue()lets us fill in the placeholders in our prepared statement
//:id is a placeholder for us to SECURELY put information from the user
$sql->bindValue(':id',$id, PDO::PARAM_INT);
//performs the sql on the database
$sql->execute();
//gets the results from the sql query and stores them in a variable
//-->fetch()gets a single result
//->fetchAll() gets all possible results
$results=$sql->fetch();

//Redirect the user back to the homepage if there are no data base results
//no results will happen if they change the ?id=4 to include anID that doesnt exist
if(empty($results)){
	header('Location:index.php');
	exit; //stop php compiler right here and immediately redirect the user.
}
?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>MovieList</title>
</head>

<body>
   <h1><?php echo $results['name'];?></h1>
   <p>Release_Date: <?php echo $results['release_date'];?></p>
   <p>Director: <?php echo $results['director'];?></p>


</body>
</html>