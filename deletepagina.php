<?php require_once 'header.php'; ?>
<?php 

require_once 'connection.php';


if(!isset($_SESSION['user_id'])){
    header('location: inloggen.php');
    exit();
}
$user_id = $_SESSION['user_id'];

if(isset($_POST['Confirm_delete']) && $_POST['Confirm_delete'] == 'Ja'){


try{
  $deleteUser = "DELETE FROM users WHERE id = ?";
  $stmt = $conn->prepare($deleteUser);
  $stmt->execute([$user_id]);
  session_destroy();
  header('location: index.php');

}catch (PDOException $e){
    
     $_SESSION['error'] = "Er is een fout opgetreden bij het verwijderen van je account. Probeer het Later opnieuw.";
     header('location: profiel.php');
     exit();

   }
}

if(isset($_POST['Confirm_delete']) && $_POST['Confirm_delete'] == 'Nee'){
    header('location: profiel.php');
}
?>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Verwijderd</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <section>
           <video class="skycolor" autoplay loop muted src= "video/Skycolor.mp4"></video>
            <article class="account-deleted">
                <h1><strong>Account verwijderen</strong></h1>
                <P><strong>Let Op!</strong></p>
                <p>Weet je zeker dat je account wil verwijderen?</p>

                <form  method="POST" action="">
                    <button type="submit" name="Confirm_delete" value="Ja" class="verwijder-Ja">
                        Ja, verwijder mijn account 
                    </button>
                    <button type="submit" name="Confirm_delete" value="Nee" class="verwijder-Nee">
                        Nee, ga terug
                    </button>
                </form>
                <a class="Registreer-button" href="Registreer.php">Registreer een nieuw account</a>
            </article>
        </section>
   </main>
</body>
</html>
<?php require_once 'footer.php';  


//&& controleert of beide voorwaarden waar zijn (logische EN-operator)//
// || = OF een van beide moet waar zijn //
// ! = Niet maak waar onwaar en andersom //
?> 