document.addEventListener("DOMContentLoaded", function(){
    const playButton = document.getElementById("playAudio");
    const audio = document.getElementById("background-audio");

    playButton.addEventListener("click", function() {
        if (audio.paused) {
            audio.play();
            playButton.innerHTML = "⏸️ Pause Music";
        } else {
            audio.pause();
            playButton.innerHTML = "▶️ Start Music"; 
        }
        console.log ("PauseAudio", audio.paused);
        console.log ("playaudio", audio.played);
    });
});



