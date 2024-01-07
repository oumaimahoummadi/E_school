<!-- 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/uploadStyle.css">
    <title>deposer un cours</title>
</head>
<body>
    <h1>deposer un cours</h1>
    <form method="POST" enctype="multipart/form-data" action="uploadFile.php">
        <input type="file" name="fichier" id="" /><br/>
        <input type="submit" name="uploadFile" value="envoyer fichier"/>
    
    </form>
</body>
</html>
<?php 
    // if(!empty($_FILES)){
    //     $file_name=$_FILES['fichier']['name'];
    //     $fileExtension=".".strtolower(substr(strrchr($_FILES['fichier']['name'],'.'),1));
    //     $nameTemp=$_FILES['fichier']['tmp_name'];
    //     $fileDestination="../uploadedFiles/".$file_name;
    //     $validExitension=array('.pdf','.exe','.docx','.vid','.png','.jpg','.jpeg');
    //     if(in_array($fileExtension,$validExitension)){
    //         $resultat=move_uploaded_file($nameTemp,$fileDestination);
    //         if($resultat){
               
    //             $bdd = new PDO('mysql:host=localhost;dbname=enseignement_a_distance','root', '');
    //             $req=$bdd->prepare('INSERT INTO cours(intitule, file_url) VALUES (?,?)');
    //             $req->execute(array($file_name,$fileDestination));

    //             echo "votre fichier a bien transferee!";
    //         }
    //         else{
    //             echo "il ya une erreur";
    //         }
    //     }
    //     else{
    //         echo 'format non supporte!';
    //     }

        

    // }
   
    



    // if(isset($_POST['uploadFile'])){
    //     if($_FILES['fichier']['error']>0)
    //         {
    //             echo ' error ';
    //             die;
    //         }
        // $fileExtension=".".strtolower(substr(strrchr($_FILES['fichier']['name'],'.'),1));
        // if(!in_array($fileExtension,$validExitension))
        //     {
        //         echo 'format non supporte!';
        //         die;
        //     }
        // $file_name=$_FILES['fichier']['name'];

        // $nameTemp=$_FILES['fichier']['tmp_name'];
        // $nameUnique=md5(uniqid(rand(),true));
        // $fileDestination="../uploadedFiles/".$nameUnique.$fileExtension;
        // $resultat=move_uploaded_file($nameTemp,$fileDestination);
        // $req=$connectDb->prepare('INSERT INTO cours(intitule,url) VALUES (?,?)');
        // $req->execute(array($file_name,$fileDestination));
        // if($resultat){
        //     echo "votre fichier a bien transferee!";
        // }
    // }
?> -->