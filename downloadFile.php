
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>telecharger un cours </title>
</head>
<body>
    <h1>les cours depose</h1>
   <?php 
 $bdd = new PDO('mysql:host=localhost;dbname=enseignement_a_distance','root', '');
   $req=$bdd->query('SELECT intitule,file_url FROM cours');
   while($data=$req->fetch()){
       echo $data['intitule'].':'.'<a href="'.$data['file_url'].'"> telecharger '.$data['intitule'].'</a> <br/>';
   }
   ?>
</body>
</html>