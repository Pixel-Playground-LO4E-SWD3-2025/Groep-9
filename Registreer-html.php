<?php require_once 'header.php' ?>
<?php require 'Registreer.php' ?>

<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreren - PixelGame</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main> 
        <section>
            <article class = "register">
                <h1> Account Aanmaken </h1>

                <?php if(isset($error)): ?> 
                <p id="error"><?php echo $error; ?></p>
                <?php endif; ?>

                <?php if(isset($success)); ?>
                <p id="success"><?php echo $succes; ?><p>
                <?php endif; ?>
            
              <?php if(!isset($succes)):?>
              <form method = "POST" action="">
                 <label for="gebruikersnaam">Gebruikersnaam:</label>
                 <input type= "text" name= "gebruikersnaam" id="gebruikersnaam" required>

                 <label for="email">Email:</label>
                 <input type="email" name="email" id="email" required>

                 <label for="wachtwoord">Wachtwoord:</label>
                 <input type="password" name="wachtwoord" id="wachtwoord" required>

                 <button type="submit" name="registreer">Account Aanmaken</button>
              </form>

               <p>Heb je al een account ? <a href= 'inloggen.php'> Log hier in</a></p>
 
           </article>
        </section>
    </main>
</body>
<?php require_once 'footer.php' ?>        