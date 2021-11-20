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

// Page 1
const loadOrientation = () => {
    const level = getDocumentLevel();
    data={}
    data["level"] = level;
    $("#body").load(level+"/components/sections/register-orientation.php", data, ()=>{
        const next = document.getElementById("next");
        next.addEventListener("click", ()=>{
            window.location.href = level+"/pages/worker/register.php"+"?page=1";
        })
    });
}

// Page 2
const loadPersonalInfo = () => {
    const level = getDocumentLevel();
    $("#body").load(level+"/components/sections/register-personal-info.php", ()=>{
        const next = document.getElementById("next");
        const back = document.getElementById("back");
        next.addEventListener("click", ()=>{
            window.location.href = level+"/pages/worker/register.php"+"?page=2";
        })
        back.addEventListener("click", ()=>{
            window.location.href = level+"/pages/worker/register.php";
        })
    });

}

// Page 3
const loadSchedule = () => {
    const level = getDocumentLevel();
    // Grab the DOM element for page type
    let edit = document.getElementById("edit").value == 1;
    const outerPageData = {};
    outerPageData["edit"] = edit;

    $("#body").load(level+"/components/sections/register-schedule.php",outerPageData, ()=>{
        const next = document.getElementById("next");
        const back = document.getElementById("back");
        next.addEventListener("click", ()=>{
            window.location.href = level+"/pages/worker/register.php"+"?page=3";
        })
        back.addEventListener("click", ()=>{
            window.location.href = level+"/pages/worker/register.php"+"?page=1";
        })

        const rawPretendData = {
            "id": "1",
            "is_monday_off": "0",
            "monday_start_time": "09:00:00", 
            "monday_end_time": "17:00:00",
            "is_tuesday_off": "0",
            "tuesday_start_time": "09:00:00", 
            "tuesday_end_time": "17:00:00",
            "is_wednesday_off": "0",
            "wednesday_start_time": "09:00:00", 
            "wednesday_end_time": "17:00:00",
            "is_thursday_off": "0",
            "thursday_start_time": "09:00:00", 
            "thursday_end_time": "17:00:00",
            "is_friday_off": "0",
            "friday_start_time": "09:00:00", 
            "friday_end_time": "17:00:00",
            "is_saturday_off": "1",
            "saturday_start_time": "09:00:00", 
            "saturday_end_time": "17:00:00",
            "is_sunday_off": "1",
            "sunday_start_time": "09:00:00", 
            "sunday_end_time": "17:00:00"
        }

        // Convert Raw Data to an array
        const arrayData = Object.values(rawPretendData);
        const scheduleData = {};
        const week = [];

        // Fomat the array to an array of objects
        for(x=1; x<arrayData.length;x+=3){
            const day = {};
            day["isDayOff"] = arrayData[x];
            day["start"] = convertFrom24To12Format(arrayData[x+1]);
            day["end"] = convertFrom24To12Format(arrayData[x+2]);
            day["sRaw"] = arrayData[x+1];
            day["eRaw"] = arrayData[x+2];
            week.push(day);
        }

        // move Sunday to front
        rotateRight(week);
       
        // Add the new array as data to be passed into
        scheduleData["week"] = week;
      
        if(edit){
            $("#schedule-preference").load(level+"/components/sections/register-specific-hours.php",scheduleData,()=>{
                const clickySun = document.getElementById("clicky-Sun");
                const clickyMon = document.getElementById("clicky-Mon");
                const clickyTue = document.getElementById("clicky-Tue");
                const clickyWed = document.getElementById("clicky-Wed");
                const clickyThur = document.getElementById("clicky-Thur");
                const clickyFri = document.getElementById("clicky-Fri");
                const clickySat = document.getElementById("clicky-Sat");

                const clickyWeek = [
                    clickySun, clickyMon, clickyTue, clickyWed, clickyThur, clickyFri, clickySat
                ];

                clickyWeek.forEach(day=>{
                    day.addEventListener("click", ()=>{
                        // console.log(day);
                        if(day.innerText == "Edit"){
                            day.innerText = "Done"
                        } else if (day.innerText == "Done"){
                            day.innerText = "Edit"
                        }
                    });
                });
                // const clicky = document.getElementById("clicky");
                // clicky.addEventListener("click", ()=>{

                // })
            });
        } else {
            $("#schedule-preference").load(level+"/components/sections/register-general-schedule.php",scheduleData,()=>{
                const clicky = document.getElementById("clicky");
                clicky.addEventListener("click", ()=>{
                    window.location.href = level+"/pages/worker/register.php"+"?page=2&edit=true";
                })
            });
        }
    });
}

// Page 3
const loadServiceArea = () => {
    const level = getDocumentLevel();
    $("#body").load(level+"/components/sections/register-service-area.php", ()=>{
        const next = document.getElementById("next");
        const back = document.getElementById("back");
        next.addEventListener("click", ()=>{
            window.location.href = level+"/pages/worker/register.php"+"?page=4";
        })
        back.addEventListener("click", ()=>{
            window.location.href = level+"/pages/worker/register.php"+"?page=2";
        })
    });
}

// Page 4
const loadReview = () => {
    const level = getDocumentLevel();
    $("#body").load(level+"/components/sections/register-review.php", ()=>{
        const next = document.getElementById("next");
        next.addEventListener("click", ()=>{
            window.location.href = level+"/pages/worker/completed-registration.php";
        })
        back.addEventListener("click", ()=>{
            window.location.href = level+"/pages/worker/register.php"+"?page=3";
        })
    });
}