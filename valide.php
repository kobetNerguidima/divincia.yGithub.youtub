<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     <?php
    if (isset($_POST["nom"])  &&isset($_POST["email"])) {
        $nom=$_POST["nom"];
        $prenom=$_POST["email"];
       
        $host="localhost";
        $user="root";
        $pwd="";
        $db="estm";
        $con=mysqli_connect($host,$user,$pwd,$db);
        if (!$con) {
            die("Error connexion ...".mysqli_connect_error());
        }
        $req="INSERT INTO opinions(nomemail)VALUES('$nom','$email')";
        if (mysqli_query($con,$req)) {
            echo"<h2>votre message a été envoyer avec succès</h2>";
        }
    }
?>

</body>
</html>