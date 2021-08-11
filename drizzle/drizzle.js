var rainfallButton = document.querySelector("#rainfallButton");
var rainjarButton = document.querySelector("#rainjarButton");
var rainfallDisplay = document.querySelector("#rainfallDisplay");
var rainjarDisplay = document.querySelector("#rainjarDisplay");

var innerDisplay = document.querySelector("#innerDisplay")
var rainfallEditDisplay = document.querySelector("#rainfallEditDisplay");
var jarEditDisplay = document.querySelector("#jarEditDisplay");
var drizzleEditDisplay = document.querySelector("#drizzleEditDisplay");

var jarName = document.querySelector("#jarName")
var jarSubheader = document.querySelector("#jarSubtitle");
var rainfallName = document.querySelector("#rainfallName")
var rainfallSubheader = document.querySelector("#rainfallInfo");
var drizzles = document.querySelectorAll(".drizzleCell");
var drizzleEditors = document.querySelectorAll(".drizzleEditCell");

var loginMenu = document.querySelector("#loginMenu");
var loginButton = document.querySelector("#logInButton");
var logInForm = document.querySelector("#logIn");
var createAccountButton = document.querySelector("#signUpButton");
var createAccountForm = document.querySelector("#createAccount");


if(rainfallButton !== null){
rainfallButton.onclick = function(){
    // button view
    rainfallButton.classList.remove("unselectedSidebarButton");
    rainfallButton.classList.add("selectedSidebarButton");
    rainjarButton.classList.add("unselectedSidebarButton");
    rainjarButton.classList.remove("selectedSidebarButton");
    // showing the correct display
    rainfallDisplay.classList.remove("unselectedDisplay");
    rainfallDisplay.classList.add("selectedDisplay");
    rainjarDisplay.classList.add("unselectedDisplay");
    rainjarDisplay.classList.remove("selectedDisplay");
}
}

if(rainjarButton !== null){
rainjarButton.onclick = function(){
    // button view
    rainjarButton.classList.remove("unselectedSidebarButton");
    rainjarButton.classList.add("selectedSidebarButton");
    rainfallButton.classList.add("unselectedSidebarButton");
    rainfallButton.classList.remove("selectedSidebarButton");
    // showing the correct display
    rainjarDisplay.classList.remove("unselectedDisplay");
    rainjarDisplay.classList.add("selectedDisplay");
    rainfallDisplay.classList.add("unselectedDisplay");
    rainfallDisplay.classList.remove("selectedDisplay");
}
}

if(jarName !== null){
    jarName.addEventListener('dblclick', function(){
        innerDisplay.style.display = "none";
        jarEditDisplay.style.display = "flex";
    })
    jarSubheader.addEventListener('dblclick', function(){
        innerDisplay.style.display = "none";
        jarEditDisplay.style.display = "flex";
    })
}

if(rainfallName !== null){
    rainfallName.addEventListener('dblclick', function(){
        innerDisplay.style.display = "none";
        rainfallEditDisplay.style.display = "flex";
    })
    rainfallSubheader.addEventListener('dblclick', function(){
        innerDisplay.style.display = "none";
        rainfallEditDisplay.style.display = "flex";
    })
}

if(drizzles !== null){
    drizzles.forEach((element, index) => {
        element.addEventListener('dblclick', function(){
            element.style.display = "none";
            drizzleEditors[index].style.display = "flex";
        })
    })
}

if(loginButton !== null){
    loginButton.onclick = function(){
        loginMenu.style.display = "none";
        logInForm.style.display = "flex";
    }
    createAccountButton.onclick = function(){
        loginMenu.style.display = "none";
        createAccountForm.style.display = "flex";
    }
}