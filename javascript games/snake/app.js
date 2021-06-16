document.addEventListener('DOMContentLoaded', () => {
const squares = document.querySelectorAll('.grid div');
const scoreDisplay = document.querySelector('span');
const startBtn = document.querySelector('.start');

const width = 10;
let currentIndex = 0; //first div
let appleIndex = 0; //first div
let currentSnake = [2, 1, 0]; //2-head, 0-tail, 2-body
let direction = 1;
let score = 0;
let speed = 0.9;
let interval = 0;
let intervalTime = 500;

function startGame(){
    currentSnake.forEach(index => squares[index].classList.remove('snake'));
    squares[appleIndex].classList.remove('apple');
    clearInterval(interval);
    score = 0;
    randomApple()
    direction = 1;
    scoreDisplay.innerHTML = score;
    currentSnake = [2, 1, 0];
    currentIndex = 0;
    currentSnake.forEach(index => squares[index].classList.add('snake'));
    interval = setInterval(moveOutcomes, intervalTime)
}

function moveOutcomes(){
    //collision
    if(
        (currentSnake[0]+width >= (width*width) && direction === width) || //hits bottom
        (currentSnake[0]%width === width -1 && direction === 1) || //hits right
        (currentSnake[0]%width === 0 && direction === -1) || //hits left
        (currentSnake[0]-width < 0 && direction === -width) || //hits top
        squares[currentSnake[0]+direction].classList.contains('snake') //self
    ) {
        return clearInterval(interval);
    }
    const tail = currentSnake.pop();
    squares[tail].classList.remove('snake');
    currentSnake.unshift(currentSnake[0]+direction);
    //apple
    if(squares[currentSnake[0]].classList.contains('apple')){
        squares[currentSnake[0]].classList.remove('apple');
        squares[tail].classList.add('snake');
        currentSnake.push(tail)
        ++score;
        randomApple();
        scoreDisplay.textContent = score;
        clearInterval(interval);
        intervalTime = intervalTime*speed;
        interval = setInterval(moveOutcomes, intervalTime);
    }
    squares[currentSnake[0]].classList.add('snake');

}

function control(e){
    squares[currentIndex].classList.remove('snake');

    if(e.keyCode === 39){
        direction = 1; //right
    } 
    else if(e.keyCode === 38){
        direction = -width; //up
    }
    else if(e.keyCode === 37){
        direction = -1 //left
    }
    else if(e.keyCode === 40){
        direction = +width; //down
    }
}

function randomApple(){
    do{
        appleIndex = Math.floor(Math.random() * squares.length);
    }
    while(squares[appleIndex].classList.contains('snake'))
    squares[appleIndex].classList.add('apple')
}

document.addEventListener('keyup', control);
startBtn.addEventListener('click', startGame);
})