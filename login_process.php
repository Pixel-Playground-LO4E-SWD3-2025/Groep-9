<?php 
session_start();

require_once 'connection.php';

echo "<pre>Debug info: </pre>";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    echo"<p>POST data ontvangen</p>";
}elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['username'])){
    $username = $_GET['username'];
    $email = $_GET['email'] ?? '';
    $password = $_GET['password'] ?? '';
    
    echo "<p>GET data ontvangen</p>";
}else{
    echo "<p>Geen data ontvangen. Ga terug naar het loginformulier.</p>";
    echo "<a herf='inloggen.php'>Terug naar login</a>";
    exit();
}
    
    echo "<p>Ontvangen gegevens:<br>";
    echo "Username: " . htmlspecialchars($username). "<br>";
    echo "Email:" .htmlspecialchars($email) . "<br>";
    echo "Password: [verborgen voor veiligheid]</p>";

    if(empty($username) || empty($email) || empty($password)){
        $_SESSION['error'] = "Je moet alles verplicht invullen";
        echo "<p> Fout: je moet alles verplicht invullen</p>";
        echo "<a href='inloggen.php'>Terug naar login</a>";
        exit();
    }

    try{

        echo "<p>Database connectie wordt gemaakt...</p>";

        $stmt = $conn -> prepare("SELECT * FROM users WHERE username = :username AND email = :email");
        $stmt ->bindParam('username', $username);
        $stmt ->bindParam('email', $email);
        $stmt -> execute();

        if ($stmt-> rowCount() > 0 ){
            $user = $stmt ->fetch();
            echo "<p>Gebruiker gevonden, wachtwoord wordt gecontroleerd...</p>";

            if ($password == 'password'){
                echo "<p>Wachtwoord correct!</p>";

                $_SESSION['user_id'] = $user->id;
                $_SESSION['úsername'] = $user->username;

                echo "<p>Redirecting naar index.php in 3 seconden...</p>";
                echo "<script>setTimeout(function(){ windows.location = 'index.php'; }, 3000);</script>";

            }else{
                $_SESSION['error'] = "Onjuiste wachtwoord";
                echo "<p>Fout: Onjuiste wachtwoord</p>";
                echo "<a href='inloggen.php'>Terug naar login</a>";
            }
        }else{
            $_SESSION['error'] = "Gebruiker niet gevonden";
            echo "<p> Fout: Gebruiker niet gevonden</p>";
            echo "<a href='inloggen.php'>Terug naar login</a>";
        }
    }catch(PDOException $e){
        $_SESSION['error'] = "Database fout: " . $e->getMessage();
        echo "<p>Database fout: " . $e->getMessage() . "</p>";
        echo "<a href='inloggen.php'>Terug naar login</a>";
    }

?>