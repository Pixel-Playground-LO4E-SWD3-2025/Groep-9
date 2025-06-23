<?php 
session_start();

require_once 'connection.php';
$db = Database::getInstance();
$conn = $db->getConnection();

// var_dump($_POST); // Alleen gebruiken als je wilt debuggen, anders UITZETTEN!

if ($_SERVER["REQUEST_METHOD"] == "POST"){ //controleer hoe data komt 
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['username'])){ // controleert of beide voorwaarden waar zijn
    $username = $_GET['username'];
    $email = $_GET['email'] ?? '';
    $password = $_GET['password'] ?? '';
}else{
    $_SESSION['error'] = "Geen data ontvangen. Ga terug naar het loginformulier.";
    header('Location: inloggen.php');
    exit();
}
//OF beide moet waar zijn // 
if(empty($username) || empty($email) || empty($password)){ //controleert velden niet leeg zijn 
    $_SESSION['error'] = "Je moet alles verplicht invullen";
    header('Location: inloggen.php');
    exit();
}

try{
    $stmt = $conn -> prepare("SELECT * FROM users WHERE username = :username AND email = :email");
    $stmt ->bindParam(':username', $username); //veilige variable BP injection// 
    $stmt ->bindParam(':email', $email);
    $stmt -> execute();
    if ($stmt-> rowCount() > 0 ){ //hoeveel rijen 0 beinvoeld// 
        $user = $stmt ->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password, $user['password'])){
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['id'] = $user['id']; // Voor andere pagina's die $_SESSION['id'] gebruiken
            header('Location: ingelogd.php');
            exit();
        }else{
            $_SESSION['error'] = "Onjuist wachtwoord";
            header('Location: inloggen.php');
            exit();
        }
    }else{
        $_SESSION['error'] = "Gebruiker niet gevonden";
        header('Location: inloggen.php');
        exit();
    }
}catch(PDOException $e){
    error_log("Database fout:" . $e->getMessage());
    $_SESSION['error'] = "Er is een fout opgetreden. Probeer het later opnieuw.";
    header('Location: inloggen.php');
    exit();
}
?>