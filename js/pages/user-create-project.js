$(document).ready(()=>{

    load_create_project_form();



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

const load_create_project_form = (
    current_page = 1, 
    page1_Data = null, 
    page2_Data = null, 
    page3_Data = null
) => {
    let obj = {};
    obj['level'] = getDocumentLevel();
    obj["current_page"] = current_page;
    if(page1_Data != null){
        obj["page_1"] = page1_Data;
    }
    if(page2_Data != null){
        obj["page_2"] = page2_Data;
    }
    if(page3_Data != null){
        obj["page_3"] = page3_Data;
    }

    $("#user-create-project-form").load(getDocumentLevel()+"/components/forms/user-create-project-form.php",obj, ()=>{
        // Grab the DOM elements
        var myForm = document.getElementById("form-submission-create-project");
        // Buttons
        var button_page1 = document.getElementById("btn-page-1");
        var button_page2 = document.getElementById("btn-page-2");
        var button_page3 = document.getElementById("btn-page-3");
        var button_back_page2 = document.getElementById("btn-back-page-2");
        var button_back_page3 = document.getElementById("btn-back-page-3");

        console.log(button_back_page2);
        console.log(button_back_page3);
        // Input Feilds
        var text1 = document.getElementById("text1");
        var text2 = document.getElementById("text2");
        var text3 = document.getElementById("text3");

        // Add event listeners for the buttons
        button_page1.addEventListener("click", ()=>{
            let page1Data = {};
            page1Data['text1'] = text1.value;
            
            load_create_project_form(2, page1Data);
        });

        button_page2.addEventListener("click", ()=>{
            let page1Data = {};
            page1Data['text1'] = text1.value;

            let page2Data = {};
            page2Data['text2'] = text2.value;
            load_create_project_form(3, page1Data, page2Data);
        });

        button_page3.addEventListener("click", ()=>{
            console.log("Submitted!");  

            // Convert Form Data to Object
            let formData = new FormData(myForm);
            let data = {};
            formData.forEach((value, key) => data[key] = value);

            $.ajax({
                type: 'POST',
                url : 'http://localhost/slim3homeheroapi/public/job-post/create',
                data : data,
                success : function(response) {
                    console.log(response);
                },
                error : function(response) {
                    console.log(response);
                },
            });
        });
    });
}

// const submitForm = (e)=>{
//     e.preventDefault();


    
// }