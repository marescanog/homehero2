$(document).ready(()=>{

    const addAddress = document.getElementById("add-address");
    const modal = document.getElementById("modal");
    const getStarted = document.getElementById("button-home");
    const myform = document.getElementById("form-home");

    addAddress.addEventListener("click", ()=>{
        console.log("click");
        loadModal("tempAddr",modalTypes, ()=>{}, getDocumentLevel());
        $("#modal").modal("show");
    });

    getStarted.addEventListener("click", ()=>{
        // console.log(addAddress)
        // console.log(modal)
        // console.log(getStarted)
        // console.log(myform)

        // Grab the feilds to validate and the UI to display error messages
        const proj_id_field = document.getElementById("project_id_field");
        const proj_cat_field = document.getElementById("project_category_field");
        const home_add_field = document.getElementById("home_address_field");
        const myform = document.getElementById("form-home");
        const errorMessageDisplay = document.getElementById("form-err-msg");

        let errorMessage = "";
        let isError = false;
        // classes are error and d-none

        if (proj_id_field.value == "" && home_add_field.value == ""){
            errorMessage = "* Please select a project from the list. Please add an address for the project.";
            isError = true;
        }

        else if (proj_id_field.value == "" ){
            errorMessage = "* Please select a project from the list.";
            isError = true;
        }

        else if (home_add_field.value == ""){
            errorMessage = "* Please add an address for the project.";
            isError = true;
        }

        else {
            isError = false;
        }

        if(isError){
            if(! $("#form-home").hasClass("error")){
                $("#form-home").addClass("error");
            } 
            if($("#form-err-msg").hasClass("d-none")){
                $("#form-err-msg").removeClass("d-none");
            } 
        } else {
            if( $("#form-home").hasClass("error")){
                $("#form-home").removeClass("error");
            } 
            if(! $("#form-err-msg").hasClass("d-none")){
                $("#form-err-msg").addClass("d-none");
            } 
            console.log("Submitting form///")
            myform.submit();
            //window.location.href = getDocumentLevel()+"/pages/homeowner/create-project.php";
        }



    });

    
})

// const submitForm = (e)=>{
//     e.preventDefault();


    
// }