
function openPopUp(){
    let popup = document.getElementById("popUp");
    popup.classList.remove("popUp-close");
    popup.classList.add("popUp-open");
}
function closePopUp(){
    let popup = document.getElementById("popUp");
    popup.classList.remove("popUp-open")
    popup.classList.add("popUp-close");
}

