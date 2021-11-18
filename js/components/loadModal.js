// console.log("laodModal.js is loaded!");
const modalTypes = {
    "signup" : getDocumentLevel()+"/components/modals/homeowner-register.php",
    "worker-signup" : getDocumentLevel()+"/components/modals/worker-register.php",
    "error" : getDocumentLevel()+"/components/modals/error.php" ,
    "check-avail-est-date" : getDocumentLevel()+"/components/modals/check-avail-est-date.php" ,
    "check-avail-exact-date" : getDocumentLevel()+"components/modals/check-avail-exact-date.php",
    "user-login":  getDocumentLevel()+"/components/modals/homeowner-login.php",
    "worker-login":  getDocumentLevel()+"/components/modals/worker-login.php",
    "tempAddr" : getDocumentLevel()+"/components/modals/temporary/temp-enter-address.php", 
    "tempRegister": getDocumentLevel()+"/components/modals/temporary/test-modal-register.php",
    "tempLogin": getDocumentLevel()+"/components/modals/temporary/temp-login.php"
}

// This function loads the
const loadModal = (modalType, modalTypes, modalFunction = () => {}, level=".") => {
    // const modalTypes = {
    //     "name" : "location",
    // }
    if(modalTypes.hasOwnProperty(modalType)){
        // create an empty object
        let obj = {};
        obj['level'] = level;
        $("#modal-contents").load(modalTypes[modalType], obj, ()=>{
            modalFunction();
        });
    } else {
        $("#modal-contents").load(modalTypes["error"]);
    }
}



