document.addEventListener('DOMContentLoaded', () => {
    //cards
    const cardArray = [
        {
            name: 'red',
            img: 'redSquare.jpeg'
        },
        {
            name: 'red',
            img: 'redSquare.jpeg'
        },
        {
            name: 'orange',
            img: 'orangeSquare.jpeg'
        },
        {
            name: 'orange',
            img: 'orangeSquare.jpeg'
        },
        {
            name: 'yellow',
            img: 'yellowSquare.jpeg'
        },
        {
            name: 'yellow',
            img: 'yellowSquare.jpeg'
        },
        {
            name: 'green',
            img: 'greenSquare.jpeg'
        },
        {
            name: 'green',
            img: 'greenSquare.jpeg'
        },
        {
            name: 'blue',
            img: 'blueSquare.jpeg'
        },
        {
            name: 'blue',
            img: 'blueSquare.jpeg'
        },
        {
            name: 'purple',
            img: 'purpleSquare.jpeg'
        },
        {
            name: 'purple',
            img: 'purpleSquare.jpeg'
        }
    ]
    
    cardArray.sort(() => .5 - Math.random())
    
    const grid = document.querySelector('.grid')
    const resultDisplay = document.querySelector('#result')
    var cardsChosen = []
    var cardsChosenId = []
    var cardsWon = []
    
    
    //board
    function createBoard() {
    for(let i = 0; i < cardArray.length; i++){
        var card = document.createElement('img')
        card.setAttribute('src', 'blankSquare.jpeg')
        card.setAttribute('data-id', i)
        card.addEventListener('click', flipcard)
        grid.appendChild(card)
    }
    }
    
    //matching
    function checkForMatch(){
        var cards = document.querySelectorAll('img')
        const optionOneId = cardsChosenId[0]
        const optionTwoId = cardsChosenId[1]
        if(cardsChosen[0]===cardsChosen[1]){
            alert('You found a match')
            cards[optionOneId].setAttribute('src', 'whiteSquare.jpeg')
            cards[optionTwoId].setAttribute('src', 'whiteSquare.jpeg')
            cards[optionOneId].removeEventListener('click', flipcard)
            cards[optionTwoId].removeEventListener('click', flipcard)
            cardsWon.push(cardsChosen)
        }
        else{
            alert('Sorry, try again')
            cards[optionOneId].setAttribute('src', 'blankSquare.jpeg')
            cards[optionTwoId].setAttribute('src', 'blankSquare.jpeg')
        }
        cardsChosen = []
        cardsChosenId = []
        resultDisplay.textContent = cardsWon.length
        if(cardsWon.length === cardArray.length/2){
            resultDisplay.textContent = 'Congratulations! You found them all'
        }
    }
    //flipping
    function flipcard(){
        var cardId = this.getAttribute('data-id')
        cardsChosen.push(cardArray[cardId].name)
        cardsChosenId.push(cardId)
        this.setAttribute('src', cardArray[cardId].img)
        if(cardsChosen.length === 2){
            setTimeout(checkForMatch, 500)
        }
    }
    
    createBoard()
    })