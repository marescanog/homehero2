$(document).ready(()=>{
    const goToDashBoardButton = document.getElementById("next");
    goToDashBoardButton.addEventListener("click", ()=>{
        window.location.href = getDocumentLevel()+"/pages/worker/home.php";
    })
});