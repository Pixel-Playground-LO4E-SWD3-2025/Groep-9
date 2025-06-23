const gokken = ["Steen","Papier","Schaar"];
const playercontrol = document.getElementById("player");
const computercontrol = document.getElementById("computer");
const gelijkcontrol = document.getElementById("resultaat");
const playerScoreDisplay = document.getElementById("playerScoreDisplay");
const computerScoreDisplay = document.getElementById("computerScoreDisplay");

let playerScore = parseInt(localStorage.getItem('playerScore')) || 0; //zet om naar een heel getal echt rekenen//
let computerScore = parseInt(localStorage.getItem('computerScore')) || 0; //zorgt ervoor dat score altijd een getal is // 


if(playerScoreDisplay && computerScoreDisplay){
playerScoreDisplay.textContent = playerScore; 
computerScoreDisplay.textContent = computerScore;
}


function Game(playerChoice){
    console.log(playerChoice);
    const ComputerChoice = gokken[Math.floor(Math.random() * 3)]; //0.0 tot 0.999, 0.0 tot 2.999, 0.1 of 2, willekeurig keuze//
    let  result = "";

    if(playerChoice === ComputerChoice){
        result = "HET IS GELIJKSPEL!";
    }
    else{
        switch(playerChoice){
            case "Steen":
               result = (ComputerChoice === "Schaar") ? "JE HEBT GEWONNEN!" : "JE HEBT VERLOREN!"; // ternary operator waar of onwaar steen wint van schaar//
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
            localStorage.setItem('playerScore', playerScore); //slaat score op in browser 
            break;
        case "JE HEBT VERLOREN!":
            gelijkcontrol.classList.add("redText");
            computerScore++;
            computerScoreDisplay.textContent = computerScore;
            localStorage.setItem('computerScore', computerScore);  
            break;

    }
}
function resetScores(){
    playerScore = 0 ; 
    computerScore = 0; 
    playerScoreDisplay.textContent = playerScore; 
    computerScoreDisplay.textContent = computerScore;
    localStorage.setItem('playerScore', 0);
    localStorage.setItem('computerScore', 0);
}
//zonder parse scores wordt string 1 + 1 = 11 met scores blijven getallen 1 + 1 = 2