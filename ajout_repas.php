<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Ajout repas</title>
    <ul class="nav justify-content-center">
        <li class="nav-item">
            <a class="nav-link " href="index.php">Le Bon Barquette</a>
        </li>
    </ul>
</head>
<body>
<form method="POST">
    <div class="container">
        <div class="form-group">
            <label for="">Nom du repas : </label>
            <input type="text" name="nom" id="nom" class="form-control" placeholder="" aria-describedby="helpId" value="<?php if (isset($nom)) {
																																echo $nom;
																															} ?>" />
        </div>
        <div class="form-group">
            <label for="">Description :</label>
            <input type="text" name="description" id="description" class="form-control" placeholder="" aria-describedby="helpId" value="<?php if (isset($description)) {
																																echo $description;
																															} ?>" />
        </div>
        <div class="form-group">
            <label for="">Prix :</label>
            <input type="" name="prix" id="prix" class="form-control" placeholder="" aria-describedby="helpId" value="<?php if (isset($prix)) {
																																echo $prix;
																															} ?>" />
        </div>
        <div class="form-group">
            <label for="">Photo :</label>
            <input type="" name="photo" id="photo" class="form-control" placeholder="" aria-describedby="helpId" value="<?php if (isset($photo)) {
																																echo $photo;
																															} ?>" />
        </div>
        <input class ="btn black" type="submit" name="forminscription" value="Soumettre" />
     </div>
</form>
</body>
</html>

<?php
	include('Repas.php');
	$db = new PDO("mysql:host=127.0.0.1;dbname=bonbarquette", "root", "");


	if(isset($_POST["nom"])){
	$repas=new Repas();
	$repas->setId(NULL);
	$repas->setNom($_POST["nom"]);
	$repas->setDescription($_POST["description"]);
	$repas->setPrix($_POST["prix"]);
	$repas->setPhoto($_POST["photo"]);

	$requete=$db->prepare("INSERT INTO repas (id,nom,description,prix,photo) values (:id,:nom,:description,:prix,:photo)");
	$requete->execute(dismount($repas));
	//var_dump($db->lastInsertId());
	}


	function dismount($object) {
    	$reflectionClass = new ReflectionClass(get_class($object));
    	$array = array();
    	foreach ($reflectionClass->getProperties() as $property) {
        	$property->setAccessible(true);
        	$array[$property->getName()] = $property->getValue($object);
        	$property->setAccessible(false);
    	}
    	return $array;
	}
	
	?>