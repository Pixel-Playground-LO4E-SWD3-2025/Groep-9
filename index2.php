<?php require_once 'header.php'; ?>
<body>
    <main>
     <section>
         <video class="skycolor" autoplay loop muted src = "video/Skycolor.mp4"></video>
        <article>
          <h1 class="welkom">Menu</h1>
       </article>

      <article class="Block">
          <section class="Slide">
            <img src="img/pixel-logo.png" alt="Slide 1" class="Slide-image">
          <P class="Slide-text">Welkom bij PixelGame</p>
         </section>

         <section class="Slide">
          <img src="img/RockPaperScissors.png" alt="slide 2" class="Slide-image2">
          <p class="Slide-text">Ontdek de wereld vol gratis spelletjes in je browser!</p>
        </section>

        <section class="Slide">
          <img src="img" alt="slide 3" class="Slide-image">
          <p class="Slide-text">Geniet van een verscheidenheid aan spellen.</p>
        </section>
      </article>

       <article class="Scoreboard">
        <p id="score">Highscore:</p>
      </article>
      <script src="js/Slideshow.js" defer></script>
    </section>
</main>
</body>
<?php require_once 'footer.php'; ?>