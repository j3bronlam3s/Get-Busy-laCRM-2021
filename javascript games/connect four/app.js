document.addEventListener('DOMContentLoaded', () =>{
    const squares = document.querySelectorAll('.grid div')
    const result = document.querySelector('#result')
    const displayCurrentPlayer = documnt.querySelector("#current-player")
    let currentPlayer = 1

    for(var i = 0, len = squares.length; i < len; ++i)

    (function(index){
        //add an onclick to each square
        squares[i].onclick = function(){
            //if the box below is taken you can play on it
            if(squares[index + 7].classList.contains('taken')){
                if(currentPlayer === 1){
                    squares[index].classList.add('taken')
                    squares[index].classList.add('player-one')
                    //change the player
                    currentPlayer = 2
                    displayCurrentPlayer.innerHTML = currentPlayer
                } 
                else if(currentPlayer === 2){
                    squares[index].classList.add('taken')
                    squares[index].classList.add('player-two')
                    //change the player
                    currentPlayer = 1
                    displayCurrentPlayer.innerHTML = currentPlayer
                }
            }
            //invalid square
                else{
                    alert('Inavalid Move')
                }
        }
    })(i)
})

// document.addEventListener('DOMContentLoaded', () => {
//     const squares = document.querySelectorAll('.grid div')
//     const result = document.querySelector('#result')
//     const displayCurrentPlayer = document.querySelector('#current-player')
//     let currentPlayer = 1


//     squares.forEach(element => {
//         element.onclick = function(){
//             if(squares[index + 7].classList.contains('taken')){
//                 if(currentPlayer === 1){
//                     squares[index].classList.add('taken')
//                     squares[index].classList.add('player-one')
//                     currentPlayer = 2
//                     displayCurrentPlayer.innerHTML = currentPlayer
//                 }
//                 else if (currentPlayer === 2){
//                     squares[index].classList.add('taken')
//                     squares[index].classList.add('player-two')
//                     currentPlayer = 1
//                     displayCurrentPlayer.innerHTML = currentPlayer
//                 }
//             } else alert('invalid move')
//         }  
//         }
//     })
// })


    // for(var i = 0, len = squares.length; i < len; i++)

    // (function(index){
    //     squares[i].onclick = function(){
    //         if(squares[index + 7].classList.contains('taken')){
    //             if(currentPlayer === 1){
    //                 squares[index].classList.add('taken')
    //                 squares[index].classList.add('player-one')
    //                 currentPlayer = 2
    //                 displayCurrentPlayer.innerHTML = currentPlayer
    //             }
    //             else if (currentPlayer === 2){
    //                 squares[index].classList.add('taken')
    //                 squares[index].classList.add('player-two')
    //                 currentPlayer = 1
    //                 displayCurrentPlayer.innerHTML = currentPlayer
    //             }
    //         } else alert('invalid move')
    //     }
    // })(i)