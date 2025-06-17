<?php require_once 'header.php'; ?>
<?php 

if(isset($_POST['registreer'])){

    $gebruikersnaam = $_POST['gebruikersnaam'];
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];

    if(empty($gebruikersnaam) || empty($email) || empty($wachtwoord)){
        $error = "Vul alles in!";
    }
    else{
        $wachtwoord_hash = password_hash($wachtwoord);

        $insertUser = "INSERT INTO users(gebruikersnaam, email, wachtwoord) VALUES (? , ? , ?)";
        $stmt = $conn->prepare($insertUser);
        $stmt ->execute([$gebruikersnaam, $email, $wachtwoord_hash]);

        $success = "Account is successvol gemaakt!";
        
    }#catch(PDOException $e){
       # $error = "Er ging iets mis bij het maken van je account.";
    #}
  
}
?>