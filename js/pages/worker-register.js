$(document).ready(()=>{
    // Grab the DOM element
    let page = parseInt(document.getElementById("page").value);

    // Validate the value to be in range of pages
    if(page < 0 || page > 4){
        page = 0;
    }

    if(!Number.isInteger(page)){
        page = 0;
    }

    if(page == null || page == undefined || page == ""){
        page = 0;
    }

    // Declare Array for loading contents
    const loadRegisterBody = [
        loadOrientation,
        loadPersonalInfo,
        loadSchedule,
        loadServiceArea,
        loadReview,
    ]

    // Load Content based on Page Number
    loadRegisterBody[page]();
})

const loadOrientation = () => {
    const level = getDocumentLevel();
    $("#body").load(level+"/components/sections/register-orientation.php", ()=>{
        const next = document.getElementById("next");
        next.addEventListener("click", ()=>{
            window.location.href = getDocumentLevel()+"/pages/worker/register.php"+"?page=1";
        })
    });
}

const loadPersonalInfo = () => {
    const level = getDocumentLevel();
    $("#body").load(level+"/components/sections/register-personal-info.php", ()=>{
        const next = document.getElementById("next");
        next.addEventListener("click", ()=>{
            window.location.href = getDocumentLevel()+"/pages/worker/register.php"+"?page=2";
        })
    });
}

const loadSchedule = () => {
    const level = getDocumentLevel();
    $("#body").load(level+"/components/sections/register-schedule.php", ()=>{
        const next = document.getElementById("next");
        next.addEventListener("click", ()=>{
            window.location.href = getDocumentLevel()+"/pages/worker/register.php"+"?page=3";
        })
    });
}

const loadServiceArea = () => {
    const level = getDocumentLevel();
    $("#body").load(level+"/components/sections/register-service-area.php", ()=>{
        const next = document.getElementById("next");
        next.addEventListener("click", ()=>{
            window.location.href = getDocumentLevel()+"/pages/worker/register.php"+"?page=4";
        })
    });
}

const loadReview = () => {
    const level = getDocumentLevel();
    $("#body").load(level+"/components/sections/register-review.php", ()=>{
        const next = document.getElementById("next");
        next.addEventListener("click", ()=>{
            window.location.href = getDocumentLevel()+"/pages/worker/completed-registration.php";
        })
    });
}