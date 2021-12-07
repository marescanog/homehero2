$(document).ready(()=>{

    load_create_project_form();

    const fp = flatpickr("#timePicker", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        minTime: "6:00",
        maxTime: "22:30",
    });




    // var form = document.getElementById("form-home");
    // var button = document.getElementById("button-home");

    // // console.log(form);
    // // console.log(button);

    // form.setAttribute("onSubmit", "submitForm(event)");

    // button.addEventListener("click", ()=>{
    //     console.log("button has been clicked");  
    //     // const modalTypes = {
    //     // "login" : "../../components/modals/temp-enter-address.php",
    //     // "error" : "../../components/modals/error.php" 
    //     // }
    //     // loadModal("login", modalTypes);
    // });
})

// Original Form
// const pages = [
//     getDocumentLevel()+"/", 
//     getDocumentLevel()+"/components/forms/UCPFC-1.php",
//     getDocumentLevel()+"/components/forms/UCPFC-2.php",
//     getDocumentLevel()+"/components/forms/UCPFC-3.php"
// ]

// Current Form / Modified because No time to debug
const pages = [
    getDocumentLevel()+"/", 
    getDocumentLevel()+"/components/forms/UCPFC-1-alt.php",
    getDocumentLevel()+"/components/forms/UCPFC-2.php",
    getDocumentLevel()+"/components/forms/UCPFC-3.php"
]

const load_create_project_form = (
    current_page = 1, 
    page1_Data = null, 
    page2_Data = null, 
    page3_Data = null,
) => {

    $("#user-create-project-form").load(getDocumentLevel()+"/components/forms/user-create-project-form.php",
    {
        current_page: current_page,
        level: getDocumentLevel(),
    }, 
    ()=>{
        $("#form-content-display").load(pages[current_page],
        {
            current_page: current_page,
            page_1: page1_Data,
            page_2: page2_Data,
            page_3: page3_Data, 
            level: getDocumentLevel(),
        },
        ()=>{
            // Page 1 code
            // Only Load Page 1 A if page1Data is null (new page)
            // Or if is_exact_schedule is false
            // if(current_page == 1 
            //     &&  (page1_Data == null 
            //         ||  page1_Data?.is_exact_schedule == false)){

            //     // Grab the DOM elements
            //     const is_exact_schedule = document.getElementById("is_exact_schedule");

            //     // Date Selection buttons
            //     const button_date_3days = document.getElementById("schedule-within-3-days-btn");
            //     const button_date_week = document.getElementById("schedule-within-week-btn");
            //     const button_date_month = document.getElementById("schedule-within-month-btn");
            //     const button_specific = document.getElementById("schedule-specific-date-btn");
            //     // Group into Array
            //     const buttons = [button_date_3days, button_date_week, button_date_month, button_specific];

            //     // Grab necessary hidden temporary input
            //     const is_exact_sched_field = document.getElementById("is_exact_schedule");
            //     const preferred_date_time_field = document.getElementById("preferred_date_time");
            //     const days_offset = document.getElementById("days_offset");


            //     // Private helper function to remove highlight class
            //     const removeSelected = () => {
            //         buttons.forEach(button=>{
            //             if(button.classList.contains("text-white")){
            //                 button.classList.remove("text-white");
            //             }
            //             if(button.classList.contains("btn-warning")){
            //                 button.classList.remove("btn-warning");
            //             }
            //             if(!button.classList.contains("btn-outline-secondary")){
            //                 button.classList.add("btn-outline-secondary");
            //             }
            //         });
            //     }

            //     // Private helper function to add highlight class
            //     const addHighlight = (button)=>{
            //         button.classList.remove("btn-outline-secondary");
            //         button.classList.add("btn-warning");
            //         button.classList.add("text-white");
            //     }

            //     button_date_3days.addEventListener("click", ()=>{
            //         removeSelected();
            //         addHighlight(button_date_3days);
            //         console.log("3 days");
            //         days_offset.value = 3;
            //     });

            //     button_date_week.addEventListener("click", ()=>{
            //         removeSelected();
            //         addHighlight(button_date_week);
            //         console.log("1 week");
            //         days_offset.value = 7;
            //     });

            //     button_date_month.addEventListener("click", ()=>{
            //         removeSelected();
            //         addHighlight(button_date_month);
            //         console.log("1 Month");
            //     });

            //     button_specific.addEventListener("click", ()=>{
            //         removeSelected();
            //         is_exact_schedule.value = true;
            //         console.log("Specific Date");
            //         console.log(is_exact_schedule.value);
            //         let page1Data = {
            //             is_exact_schedule: true
            //         }
            //         load_create_project_form(1, page1Data);
            //     });
            // }

            // Previous Code // before when there was an alternative adddition
            // Only Load Page 1 B if there is page1Data
            // Or if is_exact_schedule is true
            // if(current_page == 1 
            //     &&  (page1_Data !== null 
            //         ||  page1_Data?.is_exact_schedule == true)){


            
            // PAGE LOADING CODE
            // SETTING UP PAGE 1 UI & LABELS & HOOKS
            if(current_page == 1){
                // Grab the DOM elements
                const is_exact_schedule = document.getElementById("is_exact_schedule");
                // Navigation Buttons
                // const link_back_general = document.getElementById("link_back_general");

                const inlineCalendar = flatpickr("#inline-calendar", {
                    inline: true,
                    minDate: "today"
                });

                const timePicker = flatpickr("#time-picker", {
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i",
                })
                // console.log(link_back_general)
                // ==============


                const dateTimeLabel = document.getElementById("date-time-label");
                const flatPickrTimePickr = document.getElementById("time-picker");
                flatPickrTimePickr.addEventListener('change', (event) => {
                    const dayselected_DOM = $( ".flatpickr-day.selected" ).length !== 0 ? $( ".flatpickr-day.selected" )[0] : null;
                    const dayselected = dayselected_DOM == null ?  null : dayselected_DOM.getAttribute("aria-label");
                    dateTimeLabel.innerText = dayselected == null ? "Please select a date and time" : dayselected;
                });

                // ===============

                // No more general date
                // if(link_back_general){
                //     // Go back to General Date
                //     link_back_general.addEventListener("click", ()=>{
                
                //         const is_exact_schedule = document.getElementById("is_exact_schedule");

                //         is_exact_schedule.value = false;

                //         let page1Data = {
                //             //is_exact_schedule: false
                //         }
                //         load_create_project_form(1, page1Data);
                //     });
                // }

            }


            
            // PAGE LOADING CODE
            // SETTING UP PAGE 2 UI & LABELS & HOOKS
            if(current_page==2){
                // The current project default name
                const project_side_label = document.getElementById("project-labelly").innerText;
                
                // Get the DOM for the project name input to add the default name as placeholder.
                const proj_name_input_feild = document.getElementById("project_name_field");
                proj_name_input_feild.setAttribute("placeholder", project_side_label);
            }






            // PAGE LOADING CODE
            // SETTING UP PAGE 3 UI & LABELS & HOOKS
            if(current_page == 3){
                console.log("You are on the last page!");

                // GRAB THE DOM THAT ARE THE LABELS
                const projectTitleLabel = document.getElementById("projectTitleLabel");
                const dateLabel = document.getElementById("dateLabel");
                const jobSizeLabel = document.getElementById("jobSizeLabel");
                const descLabel = document.getElementById("descLabel");
                const rateOfferLabel = document.getElementById("rateOfferLabel");
                const addressLabel = document.getElementById("addressLabel");

                // GRAB THE DOM THAT ARE THE VALUES
                const project_name = document.getElementById("project_name");
                const preferred_date_time = document.getElementById("preferred_date_time");
                const address_name_label = document.getElementById("address_name_label");
                const job_size_id = document.getElementById("job_size_id");
                const job_description = document.getElementById("job_description");
                const rate_offer = document.getElementById("rate_offer");
                const rate_type_id = document.getElementById("rate_type_id");
                // The current project default name as given by the side label
                const project_side_label = document.getElementById("project-labelly").innerText;

                const rateTypeArr = ["hr","day","week","project-based"];
                const jobSizeArr = ["Small - Est 1hr", "Medium - Est 4-8 hrs.", "Large - Est 8+hrs"];

                // FILL THE DOM WITH THE INFO
                projectTitleLabel.innerText = project_name.value == "" ? project_side_label : project_name.value;
                dateLabel.innerText = preferred_date_time.value;
                jobSizeLabel.innerText = jobSizeArr[job_size_id.value - 1];
                descLabel.innerText = job_description.value.trim() == "" ? "No description provided" : job_description.value;
                rateOfferLabel.innerText = "P "+rate_offer.value+" "+rateTypeArr[rate_type_id.value-1];
                addressLabel.innerText = address_name_label.value;

                if(job_description.value.trim() == ""){
                    descLabel.classList.add("font-italic");
                    descLabel.innerText = "No description provided"
                } else {
                    descLabel.innerText = job_description.value.trim();
                }

            }











            // =======================================================================
            // EVERTTHING BELOW IS BUTTON CODE
            // ON CLICK EVENTS & ETC.
            // =======================================================================

            // Grab the DOM elements
            // Next Buttons
            const button_page1 = document.getElementById("btn-page-1");
            const button_page2 = document.getElementById("btn-page-2");
            const button_page3 = document.getElementById("btn-page-3");
            // Back Buttons
            const button_back_page2 = document.getElementById("btn-back-page-2");
            // const button_back_page3 = document.getElementById("btn-back-page-3");

            // Next, Back & Submit Button Logic
            // Forward to Page 2
            if(button_page1 != null){
                button_page1.addEventListener("click", ()=>{
                    // const text1 = document.getElementById("text1");
                    // let page1Data = {};
                    // page1Data['text1'] = text1.value;

                    // const text2 = document.getElementById("text2");
                    // let page2Data = {};
                    // page2Data['text2'] = text2.value;

                    // const text3 = document.getElementById("text3");
                    // let page3Data = {};
                    // page3Data['text3'] = text3.value;

                    // load_create_project_form(2, page1Data, page2Data, page3Data);

                    //Note: will add logic later, but for now, will jsut proceed to next page.


            

                    // if(current_page == 1 
                    //     &&  (page1_Data !== null 
                    //         ||  page1_Data?.is_exact_schedule == true)){
                    //  console.log("Specific Date");
                    
                            // const inlineCalender = document.getElementById("inline-calendar");
                            // console.log(inlineCalender)

                            let dayselected_DOM = $( ".flatpickr-day.selected" ).length !== 0 ? $( ".flatpickr-day.selected" )[0] : null;
                            const time_picker_DOM = document.getElementById("time-picker");

                            if(dayselected_DOM != undefined && time_picker_DOM.value != ""){
                                const dayselected = dayselected_DOM.getAttribute("aria-label");
                                const timeSelected = time_picker_DOM.value+":00";
                                const myArray = dayselected.split(" ");
                                console.log(dayselected)
                                console.log(timeSelected)
                                const months = ["January", "February", "March", "April", "May", "June", "July",
                                                "August", "September", "October", "November", "December"];
                                //2021-12-02 00:00:00
                                //December 14, 2021
                                //14:29
                                function pad(num, size) {
                                    var s = "000000000" + num;
                                    return s.substr(s.length-size);
                                }
                                const mon = months.findIndex(elem => {
                                    return myArray[0] == elem;
                                }) + 1;
                                //console.log(mon)
                                let day = myArray[1].replace(",", "");
                                //day = pad(day,2);
                                const timestamp = myArray[2]+"-"+mon+"-"+day+" "+timeSelected;
                                console.log(timestamp);

                                const preferred_date_time = document.getElementById("preferred_date_time");
                                preferred_date_time.value = timestamp;

                                //console.log(preferred_date_time );
                                load_create_project_form(2, );
                            } else {

                                if(dayselected_DOM == undefined && time_picker_DOM.value == ""){
                                    Swal.fire({
                                        title: 'Please select a date and time.',
                                        text: 'Click on the calendar to select a date, Click on the gray input box below box below the calendar to set a time.'
                                    });
                                } else if (dayselected_DOM == undefined){
                                    Swal.fire({
                                        title: 'Please select a date.',
                                        text: 'Click on the calendar day to select a date.'
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Please select the time.',
                                        text: 'Click on the Select Time input box below the calendar to set a time.'
                                    });
                                }
                                
                            }


                    // } else {
                    //     console.log("general datee");
                    // }

                    // load_create_project_form(2);

                })
            }

            // Backward to Page 1
            // if(button_back_page2 != null){
            //     button_back_page2.addEventListener("click", ()=>{
            //         // const text1 = document.getElementById("text1");
            //         // let page1Data = {};
            //         // page1Data['text1'] = text1.value;

            //         // const text2 = document.getElementById("text2");
            //         // let page2Data = {};
            //         // page2Data['text2'] = text2.value;

            //         // const text3 = document.getElementById("text3");
            //         // let page3Data = {};
            //         // page3Data['text3'] = text3.value;

            //         // load_create_project_form(1, page1Data, page2Data, page3Data);

            //         //Note: will add logic later, but for now, will jsut proceed to next page.
            //         load_create_project_form(1);
            //     });
            // }

            // Forward to Page 3
            if(button_page2 != null){
                button_page2.addEventListener("click", ()=>{
                    // const text1 = document.getElementById("text1");
                    // let page1Data = {};
                    // page1Data['text1'] = text1.value;

                    // const text2 = document.getElementById("text2");
                    // let page2Data = {};
                    // page2Data['text2'] = text2.value;

                    // const text3 = document.getElementById("text3");
                    // let page3Data = {};
                    // page3Data['text3'] = text3.value;

                    // load_create_project_form(3, page1Data, page2Data, page3Data);

                    //Note: will add logic later, but for now, will jsut proceed to next page.
                    //load_create_project_form(3);

                    // =============================================

                    // Get the feild value DOMS
                    const project_name_field = document.getElementById("project_name_field");
                    const project_description_field = document.getElementById("project_description_field");
                    const ritema = document.getElementById("ritema");
                    const ritemb = document.getElementById("ritemb");
                    const ritemc = document.getElementById("ritemc");
                    const rateValue = document.getElementById("rateValue");
                    const rateTypeSelect = document.getElementById("rate-type-select");

                    // AddressText2.innerText = saved_add_select.options[saved_add_select.selectedIndex].text;
                    // Get the Values
                    // let rate_type = rateTypeSelect.options[rateTypeSelect.selectedIndex].text;
                    let rate_type = rateTypeSelect.value;
                    let rate_value = rateValue.value;
                    let proj_name = project_name_field .value;
                    let proj_desc = project_description_field .value;
                    let job_size = "";
                    job_size = ritema.checked ? 1 : job_size;
                    job_size = ritemb.checked ? 2 : job_size;
                    job_size = ritemc.checked ? 3 : job_size;

                    // get the feilds that will hold the values
                    const project_name = document.getElementById("project_name");
                    const job_description = document.getElementById("job_description");
                    const job_size_id = document.getElementById("job_size_id");
                    const rate_offer= document.getElementById("rate_offer");
                    const rate_type_id = document.getElementById("rate_type_id");

                    // Assign the values
                    console.log("proj_name: "+proj_name)
                    console.log("proj_desc: "+proj_desc)
                    console.log("job_size: "+job_size)
                    console.log("rate_type: "+rate_type)
                    console.log("rate_value: "+rate_value)
                    project_name.value = proj_name;
                    job_description.value = proj_desc;
                    job_size_id.value = job_size;
                    rate_offer.value =  rate_value;
                    rate_type_id.value = rate_type;

                    // Validation handling
                    if (rate_value.trim() == ""){
                        Swal.fire({
                            title: 'Please enter your rate offer.',
                            text: 'Enter your estimated offer you are willing to pay for the project'
                        });
                    } else {
                        load_create_project_form(3);
                    }
                    
                })
            }

            // Backward to Page 2
            // if(button_back_page3 != null){
            //     button_back_page3.addEventListener("click", ()=>{
            //         // const text1 = document.getElementById("text1");
            //         // let page1Data = {};
            //         // page1Data['text1'] = text1.value;

            //         // const text2 = document.getElementById("text2");
            //         // let page2Data = {};
            //         // page2Data['text2'] = text2.value;

            //         // const text3 = document.getElementById("text3");
            //         // let page3Data = {};
            //         // page3Data['text3'] = text3.value;

            //         // load_create_project_form(2, page1Data, page2Data, page3Data);

            //         //Note: will add logic later, but for now, will jsut proceed to next page.
            //         // load_create_project_form(2);
            //     });
            // }



            // =================================================================================
            // =================================================================================
            // 
            //  Submit the form
            // 
            // =================================================================================
            // =================================================================================
            if(button_page3 != null){
                button_page3.addEventListener("click", ()=>{
                    // Disable the button and show a loading spinner
                    button_page3.setAttribute("disabled", "true");
                    button_page3.innerHTML = "Loading"
                    Swal.fire({
                        title: "",
                        imageUrl: getDocumentLevel()+"/images/svg/Spinner-1s-200px.svg",
                        imageWidth: 200,
                        imageHeight: 200,
                        imageAlt: 'Custom image',
                        showCancelButton: false,
                        showConfirmButton: false,
                        background: 'transparent',
                        allowOutsideClick: false
                    });

                    // const myForm = document.getElementById("form-submission-create-project");
                    
                    console.log("Submitted!");  

                    // Grab the necessary DOM elements for the information
                    const homeID_DOM = document.getElementById("home_id");
                    const jobSize_DOM = document.getElementById("job_size_id");
                    const projType_DOM = document.getElementById("required_expertise_id");
                    const jobDesc_DOM = document.getElementById("job_description");
                    const rateOffer_DOM = document.getElementById("rate_offer");
                    const rateType_DOM = document.getElementById("rate_type_id");
                    const projName_DOM = document.getElementById("project_name");
                    const is_exact_sched = 1;
                    const timestamp = document.getElementById("preferred_date_time");
                    // The current project default name as given by the side label
                    const project_side_label = document.getElementById("project-labelly").innerText;

                    // Extract the values & save into an object
                    const projData = [];

                    projData["home_id"] = homeID_DOM.value;
                    projData["job_size_id"] = jobSize_DOM.value;
                    projData["required_expertise_id"] = projType_DOM.value;
                    projData["job_description"] = jobDesc_DOM.value;
                    projData["rate_offer"] = rateOffer_DOM.value;
                    projData["rate_type_id"] = rateType_DOM.value;
                    projData["is_exact_schedule"] = 1;
                    projData["preferred_date_time"] = timestamp.value;
                    projData["project_name"] = projName_DOM.value == "" ? document.getElementById("project-labelly").innerText : projName_DOM.value;

                    // GET SESSION VARIABLE
                    // Then call ajax to save



                    $.ajaxSetup({cache: false})
                    $.get(getDocumentLevel()+'/auth/get-register-session.php', function (data) {
                        console.log(data)
                        const parsedSession = JSON.parse(data);
                        const token = parsedSession['token'];
                        console.log(token);
                        console.log(projData);
    
                                    
                        // Create new form 
                        const samoka = new FormData();
    
                        // Append 
                        samoka.append('home_id', projData["home_id"]);
                        samoka.append('job_size_id', projData["job_size_id"]);
                        samoka.append('required_expertise_id', projData["required_expertise_id"]);
                        samoka.append('job_description', projData["job_description"]);
                        samoka.append('rate_offer', projData["rate_offer"]);
                        samoka.append('rate_type_id', projData["rate_type_id"]);
                        samoka.append('is_exact_schedule', projData["is_exact_schedule"]);
                        samoka.append('preferred_date_time', projData["preferred_date_time"]);
                        samoka.append('project_name', projData["project_name"]);


 // CHANGELINKDEVPROD
                        $.ajax({
                            type : 'POST',
                            url : "http://localhost/slim3homeheroapi/public/add-project", // dev
                            // url : "https://slim3api.herokuapp.com/add-project", // prod
                            data : samoka,
                                contentType: false,
                                processData: false,
                                headers: {
                                    "Authorization": `Bearer ${token}`
                                },
                            success : function(response) {
                                console.log(response);
                                // console.log(response.response);
                                // console.log(response.response.data);
                                // console.log(response.response.data.home_id);
                                $("#modal").modal('hide');
                                window.location = getDocumentLevel()+'/pages/homeowner/projects.php';

                            },
                            error: function (response) {
                                console.log(response);
                                Swal.fire({
                                    title: 'An error occurred',
                                    text: 'Please try again',
                                    icon: 'error'
                                });
                            }
                        });



                    });













                    // // Convert Form Data to Object
                    // let formData = new FormData(myForm);
                    // let data = {};
                    // formData.forEach((value, key) => data[key] = value);

                    // $.ajax({
                    //     type: 'POST',
                    //     url : 'http://localhost/slim3homeheroapi/public/job-post/create',
                    //     data : data,
                    //     success : function(response) {
                    //         console.log(response);
                    //     },
                    //     error : function(response) {
                    //         console.log(response);
                    //     },
                    // });

                })
            }
        })

        // Grab the DOM elements
        // var myForm = document.getElementById("form-submission-create-project");
        // var formContentDisplay = document.getElementById("form-content-display");

        // // Buttons
        // var button_page1 = document.getElementById("btn-page-1");
        // var button_page2 = document.getElementById("btn-page-2");
        // var button_page3 = document.getElementById("btn-page-3");
        // var button_back_page2 = document.getElementById("btn-back-page-2");
        // var button_back_page3 = document.getElementById("btn-back-page-3");

        // // Input Feilds
        // var text1 = document.getElementById("text1");
        // var text2 = document.getElementById("text2");
        // var text3 = document.getElementById("text3");

        // // Forward to Page 2
        // button_page1.addEventListener("click", ()=>{
        //     let page1Data = {};
        //     page1Data['text1'] = text1.value;

        //     let page2Data = {};
        //     page1Data['text2'] = text2.value;

        //     let page3Data = {};
        //     page1Data['text2'] = text3.value;
            
        //     if(text3.value != ""){
        //         console.log("I go forward with page 1, 2 and 3 data");
        //         return;
        //     }

        //     if(text2.value != ""){
        //         console.log("I go forward with page 1 and 2 data");
        //         load_create_project_form( 2, page1Data, {adasdsads:  text2.value});
        //         return;
        //     }

        //     console.log("I go forward with page 1 data only");
        //     load_create_project_form(2, page1Data);
        // });

        //  // Back to Page 1
        //  button_back_page2.addEventListener("click", ()=>{

        //     let page1Data = {};
        //     page1Data['text1'] = text1.value;

        //     let page2Data = {};
        //     page1Data['text2'] = text2.value;

        //     let page3Data = {};
        //     page1Data['text2'] = text3.value;

        //     if(text3.value != ""){
        //         console.log("I go back with page 1, 2 and 3 data");
        //         return;
        //     }

        //     if(text2.value != ""){
        //         console.log("I go back with page 1 and 2 data");
        //         load_create_project_form( 1, page1Data, page2Data);
        //         return;
        //     }

        //     console.log("I go back with page 1 data only");
        //     load_create_project_form( 1, page1Data);
        
        //     // let page1Data = {};
        //     // page1Data['text1'] = text1.value;
            
        //     // load_create_project_form(2, page1Data);
        // });

        // button_page2.addEventListener("click", ()=>{
        //     let page1Data = {};
        //     page1Data['text1'] = text1.value;

        //     let page2Data = {};
        //     page2Data['text2'] = text2.value;
        //     load_create_project_form(3, page1Data, page2Data);
        // });

        // button_page3.addEventListener("click", ()=>{
        //     console.log("Submitted!");  

        //     // Convert Form Data to Object
        //     let formData = new FormData(myForm);
        //     let data = {};
        //     formData.forEach((value, key) => data[key] = value);

        //     $.ajax({
        //         type: 'POST',
        //         url : 'http://localhost/slim3homeheroapi/public/job-post/create',
        //         data : data,
        //         success : function(response) {
        //             console.log(response);
        //         },
        //         error : function(response) {
        //             console.log(response);
        //         },
        //     });
        // });
    });
}

// const submitForm = (e)=>{
//     e.preventDefault();


    
// }