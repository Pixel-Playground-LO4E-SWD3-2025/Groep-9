  <?php require_once 'header.php'; ?>
<body>
    <main>
        <section>
        <h1>Steen - Papier - Schaar</h1>
        <article class="spel">
              <button  onclick="Game('Steen')">👊</button>
              <button  onclick="Game('Papier')">🤚</button>
              <button  onclick="Game('Schaar')">✌️</button>
             </article>
         <article>
            <h3 id="player">PLAYER:</h3>
            <h3 id="computer">COMPUTER:</h3>
            <h3 id="resultaat"></h3>
           </article>
         <article>
            <h4 class="score">Player Score:
                <span id="playerScoreDisplay">0</span>
            </h4>
         </article>
         <article>
         <h4 class="score">Computer Score:
                <span id="computerScoreDisplay">0</span>
            </h4>
         </article>
        </section>
    </main>
</body>
    <?php require_once 'footer.php'; ?>

 
     
  