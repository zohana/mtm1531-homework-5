<?php
require_once 'includes/filter-wrapper.php';
require_once 'includes/db.php';
//var_dump($db);

//->exec() allows us to perform SQL and not expect results
//->query()allows us to perform SQL and expect results
$results = $db->query('SELECT id,name,release_date,director
                       FROM movies 
					   ORDER BY Name ASC'
					  );

?>


<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>MovieList</title>
</head>
<body>


  <ul>
     <?php 
      /*foreach ($results as $dino) {
		echo '<li>'. $dino['dino_name'].'<li>';  
	  }*/
     ?>
 
        <?php foreach ($results as $movie) :?> 
		<li><a href="single.php?id=<?php echo $movie['id'];?>"><?php echo $movie['name'] ; ?></a> 
        &bull;
        <a href ="delete.php?id=<?php echo $movie['id'];?>">Delete</a>
        <a href ="edit.php?id=<?php echo $movie['id'];?>">Edit</a>
        <a href ="add.php?id=<?php echo $movie['id'];?>">Add</a>
       
        </li>
        <?php endforeach; ?>
    </ul>
          
          


</body>
</html>