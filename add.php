<!--for validation we need php,as to chk if ryt data is inputted inside the text field-->
<?php

require_once 'includes/filter-wrapper.php';
require_once 'includes/db.php';
$errors = array();

$name = filter_input(INPUT_POST, 'name',FILTER_SANITIZE_STRING);
$release_date = filter_input(INPUT_POST,'release_date',FILTER_SANITIZE_STRING);
$director = filter_input(INPUT_POST,'director',FILTER_SANITIZE_STRING);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(empty($name)){
		$errors['name'] = true;
	}
	
	if(empty($release_date)){
		$errors['release_date']=true;
	}
	
	if(empty($director)){
		$errors['director']=true;
	}
	
	if(empty($errors)){
	    require_once 'includes/db.php';
		
		$sql = $db->prepare('
		   INSERT INTO movies(name,release_date,director)
		   VALUES(:name, :release_date, :director)
		   ');
		$sql->bindValue(':name', $name,PDO::PARAM_STR);
		$sql->bindValue(':release_date', $release_date, PDO::PARAM_STR);
		$sql->bindValue(':director', $director, PDO::PARAM_STR);
		//$sql->bindValue(':id', $id,PDO::PARAM_INT);
		$sql->execute();
		
		header('Location:index.php');
		exit;
	}
}

?>



<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Add to a MovieList</title>
</head>
<body>
      
    <form method= "post" action="add.php">
      <div>
         <label for="name">Movie Name<?php if (isset($errors['name'])):?> <strong>is required</strong><?php endif;?></label>
         <input id = "name" name="name" value="<?php echo $name; ?>"required>
      </div>
      <div>
         <label for="release_date">Release Date<?php if (isset($errors['release_date'])):?> <strong>is required</strong><?php endif;?></label>
         <input id = "release_date" name="release_date" value="<?php echo $release_date; ?>" required>
      </div>
       <div>
         <label for="director">Director<?php if (isset($errors['director'])):?> <strong>is required</strong><?php endif;?></label>
         <input id = "director" name="director" value="<?php echo $director; ?>" required>
      </div>
         <button type="submit">Add</button>
    </form>
         

</body>
</html>