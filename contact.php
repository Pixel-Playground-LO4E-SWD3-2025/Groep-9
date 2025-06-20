<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="contacteer ons voor meer informatie over onze sociale netwerk game.">
    <meta name="keywords" content="contact, social, network, game">
    <meta name="author" content="raay">
    <title>Home</title>
</head>
<body>
     
</body>
</html>

<?php require_once 'header.php'; ?>
<body>
    <main>
      <section> 
           <video class="skycolor" autoplay loop muted src = "video/Skycolor.mp4"></video> 
           <article>
                            <form action="login_process.php" methode="POST">
                     <label for ="Username">Naam:</label>
                     <input type="text" id="username" name="username" required>
                     <label for ="email">E-mail: </label>
                     <input type="Email" id="email" name="email" required>
                     <label for="password">Wat voor reden:</label>
                     <input type="password" id="password" name="password" required>
                     <button id="inlogbutton" type ="submit">Login</button>
                </form>
           </article>
    </section>
</body>
<?php require_once 'footer.php'; ?>