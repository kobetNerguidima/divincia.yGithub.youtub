<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if (isset($_POST["nom"]) &&isset($_POST["prenom"]) &&isset($_POST["Date de Naissance"]) &&isse($_POST["Nationalité"]) &&isset($_POST["Adresse Postale"]) &&isset($_POST["ville"]) &&isset($_POST["code postale"]) &&isset($_POST["pays"]) &&isset($_POST["adresse-E-mail"]) &&isset($_POST["numero telephone"]) &&isset($_POST["niveau d'etude"]))  {
        $nom=$_POST["nom"];
        $prenom=$_POST["prenom"];
        $email=$_POST["Date Naissance"];
        $Nationalite=$_POST["Nationalité"];
        $Adressepostale=$_POST["adresse postale"];
        $ville=$_POST["ville"];
        $pays=$_POST["pays"];
        $adresseEmail=$_POST["adresse-E-mail"];
        $numerotelephone=$_POST["numero telephone"];
        $niveaudetude=$_POST["niveau d'etude"];
        
        $host="localhost";
        $user="root";
        $pwd="";
        $db="estm";
        $con=mysqli_connect($host,$user,$pwd,$db);
        if (!$con) {
            die("Error connexion ...".mysqli_connect_error());
        }
        $req="INSERT INTO opinions(nom,prenom,email)VALUES('$nom','$prenom','$email','  $Nationalite', '$Adressepostale',$ville',$codepostale','$pays','$adresseEmail','$numerotelephone','$niveaudetude')";
        if (mysqli_query($con,$req)) {
            echo"<h2>enregistrement a été effectué avec succès</h2>";
        }
    }
?>
<a href="javascript:history.back()">Essayez à nouveau</a><br>
<a href="opinions.php">Voir les autres opinions</a>
</body>
</html>