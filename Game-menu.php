<?php require_once 'header.php'; ?>
  <body>
    <main>
        <section>
           <video class="skycolor" autoplay loop muted src= "video/Skycolor.mp4"></video>
            <article>
            <h1 class="welkom">Kies je Game</h1>
            </article>
            <?php 
            $blockClass = 'Game-block';
            $gameName = 'Steen-Papier-Schaar';
            $gameImage = 'img/Steen-Papier-Schaar.png';
            $gameAlt = 'Steen-Papier-Schaar';
            $gameInfo = 'Steen-Papier-Schaar is een eenvoudig maar leuke game tegen de computer, het is een geweldige manier om je reflexen te testen kan jij hem verslaan?!';
            $gameLink = 'Steen-papier-schaar.php';
            include 'game-template.php';
            ?>

            <?php 
            $blockClass ='Game-block2';
            $gameName='Dino Game';
            $gameImage = 'img/Dino.png';
            $gameAlt = 'Dino Game';
            $gameInfo = 'Spring met de dino over rode blokken. Gebruik spatie om te springen. Raak je een blok? Dan ben je af. Overleef zo lang mogelijk!?!';
            $gameLink = 'dino-game.php';
            include 'game-template.php';
            ?>
          
    </section>  
  </main>
</body>

  
<?php require_once 'footer.php'; ?>