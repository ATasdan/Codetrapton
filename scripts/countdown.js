const startingMinutes = document.getElementById("countdown").innerHTML;
alert(startingMinutes);
let time = startingMinutes * 60;

const countdownEl = document.getElementById('countdown');
alert("HERE");
setInterval(updateCountdown, 1000);

function updateCountdown(){
    const minutes = Math.floor(time / 60);
    let seconds = time % 60;

    seconds = seconds < 10?'0' +seconds : seconds;

    countdownEl.innerHTML = `${minutes}:${seconds}`;
    time--;
}