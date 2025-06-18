<article class ="<?php echo $blockClass; ?>">
    <P class="Gamenaam"><?php echo $gameName; ?> <p>
    <img class= "Game-img" src="<?php echo $gameImage; ?>" alt="<?php echo $gameAlt; ?>">
    <P class = "Gameinfo"><?php echo $gameInfo; ?> </p>
    <button class="ingang" onclick="window.location.href='<?php echo $gameLink; ?>'">Play Games</button>
</article>