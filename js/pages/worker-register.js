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
                // Grab DOM for Reset 9-5 and Day off setting
                const reset9to5DOM = document.getElementById("reset9to5Link");
                const setDayOffDOM = document.getElementById("setDayOffLink");
               
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
                    "Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"
                ];

                    // Accepts a string Mon - Sun, newStartTime value and newEndTime value
                    // Sets the label & inputs to new time
                    const setNewTime = (dayTxt, newStartTime, newEndTime) => {
                        // Get feilds to change to new values
                        const checkedStart = document.getElementById("start-time-input-"+dayTxt);
                        const label = document.getElementById("label-"+dayTxt);
                        const checkedEnd = document.getElementById("end-time-input-"+dayTxt);
                        const dayOffInput = document.getElementById("dayoff-input-"+dayTxt);

                        // Change Label to new time
                        label.innerText = convertFrom24To12Format(newStartTime) + " - " +
                        convertFrom24To12Format(newEndTime);

                        // Change start time input value to new time
                        checkedStart.setAttribute("value", newStartTime);

                        // Change end time input value to new time
                        checkedEnd.setAttribute("value", newEndTime);

                        // change day off to false
                        dayOffInput.setAttribute("value", "0");
                    }


                    // Accepts a string Mon - Sun
                    // Sets the label & day off inputs to day off
                    // Does not change the previous time values
                    const setDayOff = (dayTxt) => {
                        // Get feilds to change to new values
                        const label = document.getElementById("label-"+dayTxt);
                        const dayOffInput = document.getElementById("dayoff-input-"+dayTxt);

                        // Change Label to Day off
                        label.innerText = "Day off";

                        // change day off to true
                        dayOffInput.setAttribute("value", "1");
                    }

                    // Resets all checked panels back to zero
                    const resetToUncheckAll = () => {
                        daysBase.forEach(dayTxt=>{
                            const checkBox = document.getElementById("chk-"+dayTxt);
                            checkBox.checked = false;
                        })
                    }


                 // Add logic for the reset 9-5 clickable item
                 reset9to5DOM.addEventListener("click", ()=>{
                    const myForm = document.getElementById("schedule-form");
                    const formData = getFormDataAsObj(myForm);
                    // Reset All input feilds that have the checked attr
                    daysBase.forEach(dayTxt=>{
                        if(formData.hasOwnProperty("chk-"+dayTxt)){
                            // Reset 
                            setNewTime(dayTxt,"09:00:00","17:00:00");
                        }
                    });
                    resetToUncheckAll();
                });


                // Add logic for the set Days off clickable item
                setDayOffDOM.addEventListener("click", ()=>{
                    const myForm = document.getElementById("schedule-form");
                    const formData = getFormDataAsObj(myForm);
                    // Set Days off for input feilds that have the checked attr
                    daysBase.forEach(dayTxt=>{
                        if(formData.hasOwnProperty("chk-"+dayTxt)){
                            // Apply day off 
                            setDayOff(dayTxt);
                            // Close panel
                        }
                    });
                    resetToUncheckAll();
                });

                // Set up the Show/Hide for the edit panel of each row in schedule
                clickyWeek.forEach(day=>{
                    // Grab Values & HTML Entitites
                    let dayType = day.getAttribute("data-day");
                    const thisLabel = document.getElementById(labelWeek[dayType]);
                    const thisStartInput = document.getElementById(startInputIds[dayType]);
                    const thisToLabel = document.getElementById(toLabelIDs[dayType]);
                    const thisEndInput = document.getElementById(endInputIds[dayType]);
                    const thisApplyClick = document.getElementById(applyClickIds[dayType]);
                    
                    // Private functions
                    // Show Panel
                    const showEditSchedPanel = () => {
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
                    }
                    // Hide Panel
                    const hideEditSchedPanel = () => {
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


                    // Get Panel's Current Start Value
                    const newStartTimeFeild = document.getElementById("start-time-input-"+daysBase[dayType]);
                    const newEndTimeFeild = document.getElementById("end-time-input-"+daysBase[dayType]);


                    // Add the logic for "Apply Multiple" clickable item
                    thisApplyClick.addEventListener("click", ()=>{
                        // Grab the HTML DOM elements & values
                        let newStartTime = newStartTimeFeild.value;
                        let newEndTime = newEndTimeFeild.value;
                        const myForm = document.getElementById("schedule-form");
                        const formData = getFormDataAsObj(myForm);
                        let countChanged = 0;
                        daysBase.forEach(dayTxt=>{
                            if(formData.hasOwnProperty("chk-"+dayTxt)){
                                // Set new time
                                setNewTime(dayTxt,newStartTime,newEndTime);
                                countChanged++;
                            }
                        });
                        if(countChanged == 0){
                            alert("No days were selected! Please check on a day.");
                        } else {
                            // Close the Panel
                            hideEditSchedPanel();
                            resetToUncheckAll();
                        }
                    });


                    // Add the logic for "Edit" clickable item
                    day.addEventListener("click", ()=>{
                        if(day.innerText == "Edit"){
                            showEditSchedPanel();
                        } else if (day.innerText == "Apply"){
                            // Apply for only this selected panel
                            let thisdayTxt = daysBase[dayType];
                            let newStartTime = newStartTimeFeild.value;
                            let newEndTime = newEndTimeFeild.value;
                            // Get feilds to change to new values
                            const label = document.getElementById("label-"+thisdayTxt);
                            const dayOffInput = document.getElementById("dayoff-input-"+thisdayTxt);

                            // Change Label to new time
                            label.innerText = convertFrom24To12Format(newStartTime) + " - " +
                            convertFrom24To12Format(newEndTime);

                            // change day off to false
                            dayOffInput.setAttribute("value", "0");
                            hideEditSchedPanel();
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