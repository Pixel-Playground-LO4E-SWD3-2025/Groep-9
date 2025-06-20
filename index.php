<?php require_once 'header.php'; ?>
<body>
    <main>
      <section> 
         <video class="Auto-video" autoplay loop muted src="video/gustas.mp4"></video> 
       <article>
         <h1>Welcome to the Home Page</h1>
         <P> click to play the games <P>
         <button class="ingang" onclick="location.href='index2.php'">highscores</button>    
      </article>
      
      <button id="playAudio">▶️ Start Music</button>
      <audio id="background-audio" loop>
            <source src="audio/me-gusta-tu.mp3" type="audio/mpeg">
       </audio>
       <script src="js/audio.js" defer></script>
     </section>
 </main>
</body>
<?php require_once 'footer.php'; ?>