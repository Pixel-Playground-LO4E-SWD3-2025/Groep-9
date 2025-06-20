<?php require_once 'header.php'; ?>
<?php 
include_once 'connection.php'; 
$db = Database::getInstance();
$conn = $db->getConnection();
if(isset($_POST['registreer'])){

    $gebruikersnaam = $_POST['gebruikersnaam'];
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];

    if(empty($gebruikersnaam) || empty($email) || empty($wachtwoord)){
        $error = "Vul alles in!";
    }
    else{
        try{
        $wachtwoord_hash = password_hash($wachtwoord, PASSWORD_DEFAULT);

        $insertUser = "INSERT INTO users(username, email, password) VALUES (? , ? , ?)";
        $stmt = $conn->prepare($insertUser);
        $stmt ->execute([$gebruikersnaam, $email, $wachtwoord_hash]);

        $_SESSION['login'] = true;
        $_SESSION['gebruikersnaam'] = $gebruikersnaam;

        header('Location: inloggen.php');
        exit();

        $success = "Account is successvol gemaakt!";
      
    
        
    }catch(PDOException $e){
       $error = "Er ging iets mis bij het maken van je account.";
    }
  

  
  }
}
?>




