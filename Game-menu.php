<?php require_once 'header.php'; ?>
  <body>
    <main>
        <section>
           <video class="skycolor" autoplay loop muted src= "video/Skycolor.mp4"></video>
            <article>
            <h1 class="welkom">Kies je Game</h1>
          </article>
              <article class="Game-block">
                 <p class="Gamenaam">Steen-Papier-Schaar</p>
                 <img class="Game-img" src="img/Steen-Papier-Schaar.png" alt="Steen-Papier-Schaar">
                 <p class="Gameinfo">Steen-Papier-Schaar is een eenvoudig maar leuke game tegen de computer, 
                  het is een geweldige manier om je reflexen te testen kan jij hem verslaan?!</p>
                  <button class="ingang" onclick="location.href='Steen-papier-schaar.php'">Play Games</button>
              </article>
              <article class="Game-block2">
                 <p class="Gamenaam">tic_tac_toe</p>
                 <img class="Game-img" src="img/tic_tac_toe.png" alt="Tic_tac_toe">
                 <p class="Gameinfo">tic tac toe is een klassiek bordspel dat je nu online kunt spelen. Speel tegen vrienden of alleen en geniet van dit strategische spel.</p>
                  <button class="ingang" onclick="location.href='tic_tac_toe.php'">Play Games</button>
              </article>
        </section>  
</main>
</body>

  
<?php require_once 'footer.php'; ?>