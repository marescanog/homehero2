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
                // Grab Edit Element for each
                const clickySun = document.getElementById("clicky-Sun");
                const clickyMon = document.getElementById("clicky-Mon");
                const clickyTue = document.getElementById("clicky-Tue");
                const clickyWed = document.getElementById("clicky-Wed");
                const clickyThu = document.getElementById("clicky-Thu");
                const clickyFri = document.getElementById("clicky-Fri");
                const clickySat = document.getElementById("clicky-Sat");

                const clickyWeek = [
                    clickySun, clickyMon, clickyTue, clickyWed, clickyThu, clickyFri, clickySat
                ];

                const labelWeek = [
                    "label-Sun", "label-Mon", "label-Tue", "label-Wed", "label-Thu", "label-Fri", "label-Sat"
                ];

                const startInputIds = [
                    "start-time-input-Sun", "start-time-input-Mon", "start-time-input-Tue", "start-time-input-Wed", "start-time-input-Thu", "start-time-input-Fri", "start-time-input-Sat"
                ];

                const toLabelIDs = [
                    "to-Sun", "to-Mon", "to-Tue", "to-Wed", "to-Thu", "to-Fri", "to-Sat"
                ];

                const endInputIds = [
                    "end-time-input-Sun", "end-time-input-Mon", "end-time-input-Tue", "end-time-input-Wed", "end-time-input-Thu", "end-time-input-Fri", "end-time-input-Sat"
                ];

                const applyClickIds = [
                    "appy-click-Sun", "appy-click-Mon", "appy-click-Tue", "appy-click-Wed", "appy-click-Thu", "appy-click-Fri", "appy-click-Sat"
                ];

                const daysBase = [
                    "Sun", "Mon", "Tue", "Wed", "Thu", "Fri"
                ];

                // Set up the Show/Hide for the edit panel of each row in schedule
                clickyWeek.forEach(day=>{
                    // Grab Values & HTML Entitites
                    let dayType = day.getAttribute("data-day");
                    const thisLabel = document.getElementById(labelWeek[dayType]);
                    const thisStartInput = document.getElementById(startInputIds[dayType]);
                    const thisToLabel = document.getElementById(toLabelIDs[dayType]);
                    const thisEndInput = document.getElementById(endInputIds[dayType]);
                    const thisApplyClick = document.getElementById(applyClickIds[dayType]);
                    

                    // Add the logic for "Apply" clickable item
                    thisApplyClick.addEventListener("click", ()=>{
                        console.log("hehe "+dayType);
                        const myForm = document.getElementById("schedule-form");
                        const formData = getFormDataAsObj(myForm);
                        // console.log(myForm);
                        console.log(formData);
                        daysBase.forEach(day=>{
                            console.log("chk-"+day);
                        });
                    });

                    // Add the logic for "Edit" clickable item
                    day.addEventListener("click", ()=>{
                        if(day.innerText == "Edit"){
                            // Show the Edit panel
                            day.innerText = "Apply"                            
                            thisLabel.classList.add("d-none");
                            thisStartInput.setAttribute("type", "time");
                            thisToLabel.classList.remove("d-none");
                            thisEndInput.setAttribute("type", "time");
                            thisApplyClick.classList.remove("d-none");
                            // Hide all Edit labels except for current
                            clickyWeek.forEach(editLabel=>{
                                if(day != editLabel){
                                    editLabel.classList.add("d-none");
                                }
                            });
                        } else if (day.innerText == "Apply"){
                            // Hide Edit panel
                            day.innerText = "Edit"                          
                            thisLabel.classList.remove("d-none");
                            thisStartInput.setAttribute("type", "hidden");
                            thisToLabel.classList.add("d-none");
                            thisEndInput.setAttribute("type", "hidden");
                            thisApplyClick.classList.add("d-none");
                            // Show all Edit labels
                            clickyWeek.forEach(editLabel=>{
                                if(day != editLabel){
                                    editLabel.classList.remove("d-none");
                                }
                            });
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