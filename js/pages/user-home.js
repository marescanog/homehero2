$(document).ready(()=>{

    const addAddress = document.getElementById("add-address");
    const modal = document.getElementById("modal");
    const getStarted = document.getElementById("button-home");
    const myform = document.getElementById("form-home");

    addAddress.addEventListener("click", ()=>{

        const selectAddress = ()=>{
            // LOAD SELECT ADDRESS MODAL
            loadModal("home-select-address",modalTypes, ()=>{
                const addButton = document.getElementById("add_address");  
                const chooseButton = document.getElementById("choose"); 
                const selectButton = document.getElementById("select"); 

                if(selectButton != null && selectButton != undefined){
                    selectButton.addEventListener("click",()=>{
                        const AddressText = document.getElementById("add-address-text");
                        const HomeFeild = document.getElementById("home_address_field");
                        const selectFeild = document.getElementById("change_address");
                        const address_name_label2 = document.getElementById("address_name_label");
                        
                        HomeFeild.value = selectFeild.value;
                        let streetname = selectFeild.options[selectFeild.selectedIndex].text.split(",");;
                        AddressText.innerText = streetname[0];
                        address_name_label2.value =  streetname[0];
                        $("#modal").modal('hide');
                    });
                }

                if(addButton != null && addButton != undefined){
                    addButton.addEventListener("click",()=>{
                        loadModal("tempAddr",modalTypes, ()=>{
                            // const changeButton = document.getElementById("change");        
                            // changeButton.addEventListener("click",()=>{
                            //     console.log("cleck")
                            // });
                        }, getDocumentLevel(), obj);
                    });
                }

                if(chooseButton != null && chooseButton != undefined){
                    chooseButton.addEventListener("click",()=>{
                        const home_id_hidden = document.getElementById("home_number_hidden").value;
                        const home_address_hidden = document.getElementById("home_address_hidden").value;
                        const address_name_label2 = document.getElementById("address_name_label");

                        const AddressText = document.getElementById("add-address-text");
                        const HomeFeild = document.getElementById("home_address_field");
                         
          
                        //AddressText.innerText = home_address_hidden;
                        HomeFeild.value = home_id_hidden;
                        AddressText.innerText = home_address_hidden;
                        address_name_label2.value = home_address_hidden;
                        // HomeFeild.value = 10;
                        $("#modal").modal('hide');
                    });
                }
            }, getDocumentLevel(), obj);
        }


        // GET current home Id from selection
        let home_id = document.getElementById("home_address_field").value;
        // create an empty object
        let obj = {};
        obj['level'] = getDocumentLevel();
        obj['home_id'] = home_id;

        // If the user has selected an address, display address. Otherwise display form
        if(home_id == null || home_id == ""){
            selectAddress();
        } else {
            // Your address
            loadModal("home-your-address",modalTypes, ()=>{
                const changeButton = document.getElementById("change");        
                changeButton.addEventListener("click",()=>{
                    selectAddress();
                });
            }, getDocumentLevel(), obj);
        }

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