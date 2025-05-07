<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name ="keywords" content="">
    <meta name="author" content="David">
    <title>SideGame</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/game.js" defer></script>
</head>
<?php require_once 'header.php'; ?>
<body>
    <main>
        <section>
        <h1>Steen - Papier - Schaar</h1>
        <article class="spel">
              <button  oneclick="Game('steen')">👊</button>
              <button  oneclick="Game('papier')">🤚</button>
              <button  oneclick="Game('schaar')">✌️</button>
             </article>
         <article>
            <h3 id="player">PLAYER:</h3>
            <h3 id="AI">COMPUTER:</h3>
            <h3 id="resultaat"></h3>
           </article>
         <article>
            <h4 class="score">Player Score:
                <span id="playerscoredisplay">0</span>
            </h4>
         </article>
         <article>
         <h4 class="score">Computer Score:
                <span id="computerscoredisplay">0</span>
            </h4>
         </article>
        </section>
    </main>
</body>
    <?php require_once 'footer.php'; ?>

 
     
  