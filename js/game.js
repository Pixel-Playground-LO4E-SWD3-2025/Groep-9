const gokken = ["Steen","Papier","Schaar"];
const playercontrol = document.getElementById("player");
const computercontrol = document.getElementById("computer");
const gelijkcontrol = document.getElementById("resultaat");
const playerScoreDisplay = document.getElementById("playerScoreDisplay");
const computerScoreDisplay = document.getElementById("computerScoreDisplay");

let playerScore =0;
let computerScore =0;

function Game(playerChoice){
    console.log(playerChoice);
    const ComputerChoice = gokken[Math.floor(Math.random() * 3)];
    let = result = "";

    if(playerChoice === ComputerChoice){
        result = "HET IS GELIJKSPEL!";
    }
    else{
        switch(playerChoice){
            case "Steen":
               result = (ComputerChoice === "Schaar") ? "JE HEBT GEWONNEN!" : "JE HEBT VERLOREN!";
            break;

            case "Papier":
               result = (ComputerChoice === "Steen") ? "JE HEBT GEWONNEN!" : "JE HEBT VERLOREN!";

            break;

            case "Schaar":
               result = (ComputerChoice === "Papier") ? "JE HEBT GEWONNEN!" : "JE HEBT VERLOREN!";
            break;
        
        } 
    }

    playercontrol.textContent = `PLAYER: ${playerChoice}`;
    computercontrol.textContent = `COMPUTER: ${ComputerChoice}`;  
    gelijkcontrol.textContent = result;

    gelijkcontrol.classList.remove("greenText", "redText");

    switch(result){
        case "JE HEBT GEWONNEN!":
            gelijkcontrol.classList.add("greenText");
            playerScore++;
            playerScoreDisplay.textContent = playerScore;
            break;
        case "JE HEBT VERLOREN!":
            gelijkcontrol.classList.add("redText");
            computerScore++;
            computerScoreDisplay.textContent = computerScore;
            break;

    }
}