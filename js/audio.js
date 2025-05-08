document.addEventListener("DOMContentLoaded", function(){
    const audio = document.getElementById("background-audio");
    const playButton = document.getElementById("playAudio");

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



