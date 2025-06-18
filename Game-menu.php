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
                 <p class="Gamenaam">Dino Game</p>
                 <img class="Game-img" src="img/Dino.png" alt="Dino Game">
                 <p class="Gameinfo">Spring met de dino over rode blokken.
                  Gebruik spatie om te springen.
                  Raak je een blok? Dan ben je af.
                  Overleef zo lang mogelijk!?!</p>
                  <button class="ingang" onclick="location.href='dino-game.php'">Play Games</button>
              </article>
        </section>      
</main>
</body>

  
<?php require_once 'footer.php'; ?>