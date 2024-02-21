<?php
	$host = '127.0.0.1';
	$dbname = 'bde_platform';
	$username = 'root';
	$password = 'root';
		
	$dsn = "mysql:host=$host;dbname=$dbname";

	$sql = "SELECT * FROM 'event'";
	 
	try{
	 $pdo = new PDO($dsn, $username, $password);
	 $stmt = $pdo->prepare($sql);
	 
	 if($stmt === false){
		die("Erreur");
	 }
	 
	}catch (PDOException $e){
		echo $e->getMessage();
	}
?>
<section id="event">
    <ul>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
            <li><?php echo $row['nom_event']; ?></li>
        <?php endwhile; ?>
    </ul>
</section>
