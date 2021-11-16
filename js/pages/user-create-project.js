$(document).ready(()=>{

    load_create_project_form(2);

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

const pages = [
    getDocumentLevel()+"/", 
    getDocumentLevel()+"/components/forms/UCPFC-1.php",
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
            if(current_page == 1 
                &&  (page1_Data == null 
                    ||  page1_Data?.is_exact_schedule == false)){
                // Grab the DOM elements
                const is_exact_schedule = document.getElementById("is_exact_schedule");

                // Date Selection buttons
                const button_date_3days = document.getElementById("schedule-within-3-days-btn");
                const button_date_week = document.getElementById("schedule-within-week-btn");
                const button_date_month = document.getElementById("schedule-within-month-btn");
                const button_specific = document.getElementById("schedule-specific-date-btn");
                // Group into Array
                const buttons = [button_date_3days, button_date_week, button_date_month, button_specific];

                // Private helper function to remove highlight class
                const removeSelected = () => {
                    buttons.forEach(button=>{
                        if(button.classList.contains("text-white")){
                            button.classList.remove("text-white");
                        }
                        if(button.classList.contains("btn-warning")){
                            button.classList.remove("btn-warning");
                        }
                        if(!button.classList.contains("btn-outline-secondary")){
                            button.classList.add("btn-outline-secondary");
                        }
                    });
                }

                // Private helper function to add highlight class
                const addHighlight = (button)=>{
                    button.classList.remove("btn-outline-secondary");
                    button.classList.add("btn-warning");
                    button.classList.add("text-white");
                }

                button_date_3days.addEventListener("click", ()=>{
                    removeSelected();
                    addHighlight(button_date_3days);
                    console.log("3 days");
                });

                button_date_week.addEventListener("click", ()=>{
                    removeSelected();
                    addHighlight(button_date_week);
                    console.log("1 week");
                });

                button_date_month.addEventListener("click", ()=>{
                    removeSelected();
                    addHighlight(button_date_month);
                    console.log("1 Month");
                });

                button_specific.addEventListener("click", ()=>{
                    removeSelected();
                    is_exact_schedule.value = true;
                    console.log("Specific Date");
                    console.log(is_exact_schedule.value);
                    let page1Data = {
                        is_exact_schedule: true
                    }
                    load_create_project_form(1, page1Data);
                });
            }

            // Only Load Page 1 B if there is page1Data
            // Or if is_exact_schedule is true
            if(current_page == 1 
                &&  (page1_Data !== null 
                    ||  page1_Data?.is_exact_schedule == true)){
                // Grab the DOM elements
                const is_exact_schedule = document.getElementById("is_exact_schedule");
                // Navigation Buttons
                const link_back_general = document.getElementById("link_back_general");

                const inlineCalendar = flatpickr("#inline-calendar", {
                    inline: true,
                    minDate: "today"
                });

                const timePicker = flatpickr("#time-picker", {
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i",
                })

                // Go back to General Date
                link_back_general.addEventListener("click", ()=>{
                    is_exact_schedule.value = false;

                    let page1Data = {
                        is_exact_schedule: false
                    }
                    load_create_project_form(1, page1Data);
                });
            }

            // Grab the DOM elements
            // Next Buttons
            const button_page1 = document.getElementById("btn-page-1");
            const button_page2 = document.getElementById("btn-page-2");
            const button_page3 = document.getElementById("btn-page-3");
            // Back Buttons
            const button_back_page2 = document.getElementById("btn-back-page-2");
            const button_back_page3 = document.getElementById("btn-back-page-3");

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
                    load_create_project_form(2);
                })
            }

            // Backward to Page 1
            if(button_back_page2 != null){
                button_back_page2.addEventListener("click", ()=>{
                    // const text1 = document.getElementById("text1");
                    // let page1Data = {};
                    // page1Data['text1'] = text1.value;

                    // const text2 = document.getElementById("text2");
                    // let page2Data = {};
                    // page2Data['text2'] = text2.value;

                    // const text3 = document.getElementById("text3");
                    // let page3Data = {};
                    // page3Data['text3'] = text3.value;

                    // load_create_project_form(1, page1Data, page2Data, page3Data);

                    //Note: will add logic later, but for now, will jsut proceed to next page.
                    load_create_project_form(1);
                });
            }

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
                    load_create_project_form(3);
                })
            }

            // Backward to Page 2
            if(button_back_page3 != null){
                button_back_page3.addEventListener("click", ()=>{
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
                    load_create_project_form(2);
                });
            }

            // // Submit the form
            // if(button_page3 != null){
            //     button_page3.addEventListener("click", ()=>{
            //         const myForm = document.getElementById("form-submission-create-project");
                    
            //         console.log("Submitted!");  

            //         // Convert Form Data to Object
            //         let formData = new FormData(myForm);
            //         let data = {};
            //         formData.forEach((value, key) => data[key] = value);

            //         $.ajax({
            //             type: 'POST',
            //             url : 'http://localhost/slim3homeheroapi/public/job-post/create',
            //             data : data,
            //             success : function(response) {
            //                 console.log(response);
            //             },
            //             error : function(response) {
            //                 console.log(response);
            //             },
            //         });

            //     })
            // }
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