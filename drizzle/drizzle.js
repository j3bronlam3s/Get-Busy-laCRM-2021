let rainfallButton = document.querySelector("#rainfallButton");
let rainjarButton = document.querySelector("#rainjarButton");
let rainfallDisplay = document.querySelector("#rainfallDisplay");
let rainjarDisplay = document.querySelector("#rainjarDisplay");

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
