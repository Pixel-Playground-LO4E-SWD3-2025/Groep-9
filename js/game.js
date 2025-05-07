const gokken = ["steen","papier","schaar"];
const playercontrol = document.getElementById("player");
const computercontrol = document.getElementById("computer");
const gelijkcontrol = document.getElementById("resultaat");
const playerscore = document.getElementById("playerscoredisplay");
const computerscore = document.getElementById("computerscoredisplay");


function Game(playerChoice){
    const computer = gokken[Math.floor(Math.random() * 3)];
    let = result = "";

    if(playerChoice === computer){
        result = "HET IS GELIJKSPEL!"
    }
    else{
        switch(playerChoice){
            case "Steen":
                (computer === "steen") ? "JE HEBT GEWONNEN!" : "JE HEBT VERLOREN!";
            break;

            case "Papier":
                (computer === "papier") ? "JE HEBT GEWONNEN!" : "JE HEBT VERLOREN!";

            break;

            case "Schaar":
                (computer === "schaar") ? "JE HEBT GEWONNEN!" : "JE HEBT VERLOREN!";
        
        } 
    }

    playercontrol.textContent = `PLAYER: ${playerChoice}`;
    computercontrol.textContent = `Computer: ${playerChoice}`;  
    gelijkcontrol.textContent = result;

    gelijkcontrol.classList.remove("greenText", "redText");

    switch(result){
        case "JE HEBT GEWONNEN!":
            gelijkcontrol.classList.add("greenText");
            break;
        case "JE HEBT VERLOREN!":
            gelijkcontrol.classList.add("redText");
            break;
    }
}