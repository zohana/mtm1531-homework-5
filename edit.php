<?php

require_once 'includes/db.php';
$errors = array();

$id = filter_input(INPUT_GET, 'id',FILTER_SANITIZE_NUMBER_INT);

if(empty($id)) {
	header('Location:index.php');
}

$name = filter_input(INPUT_POST, 'Name',FILTER_SANITIZE_STRING);
$release_date = filter_input(INPUT_POST,'Release_Date',FILTER_SANITIZE_STRING);
$director = filter_input(INPUT_POST,'Director',FILTER_SANITIZE_STRING);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(empty($movie)){
		$errors['Name'] = true;
	}
	
	if(empty($release_date)){
		$errors['Release_Date']=true;
	}
	
	if(empty($director)){
		$errors['Director']=true;
	}
	
	if(empty($errors)){
	    require_once 'includes/db.php';
		
		$sql = $db->prepare('
		   UPDATE movies
		   SET Name = :Name, Release_Date = :release_date, Director =:director
		   WHERE id = :id
		   ');
		$sql->bindValue(':Name', $Nmae,PDO::PARAM_STR);
		$sql->bindValue(':Release_Date', $release_date, PDO::PARAM_STR);
		$sql->bindValue(':Director', $director, PDO::PARAM_STR);
		$sql->bindValue(':id', $id,PDO::PARAM_INT);
		$sql->execute();
		
		header('Location:index.php');
		exit;
	}
} else{
     require_once 'includes/db.php';
	 
	 $sql = $db->prepare('
	 SELECT id, Name, Release_Date, Director
	 FROM movies
	 WHERE id = :id
	 ');
	 
	 $sql->bindValue(':id', $id, PDO::PARAM_INT);
	 $sql->execute();
	 $results = $sql->fetch();
	 
	 $name= $results['Name'];
	 $release_date = $results['Release_Date'];
	 $director= $results['Director'];
}

?>



<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Edit a MovieList</title>
</head>
<body>
      
    <form method= "post" action="edit.php?id=<?php echo $id; ?>">
      <div>
         <label for="name">Movie Name<?php if (isset($errors['Name'])):?> <strong>is required</strong><?php endif;?></label>
         <input id = "name" name="name" value="<?php echo $name; ?>"required>
      </div>
      <div>
         <label for="release_date">Release Date<?php if (isset($errors['Release_Date'])):?> <strong>is required</strong><?php endif;?></label>
         <input id = "release_date" name="release_date" value="<?php echo $release_date; ?>" required>
      </div>
       <div>
         <label for="director">Director<?php if (isset($errors['Director'])):?> <strong>is required</strong><?php endif;?></label>
         <input id = "director" name="director" value="<?php echo $director; ?>" required>
      </div>
         <button type="submit">Edit</button>
    </form>
         

</body>
</html>