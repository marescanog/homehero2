// console.log("laodModal.js is loaded!");
const docLevelModal = getDocumentLevel();

const modalTypes = {
    "signup" : docLevelModal+"/components/modals/homeowner-register.php",
    "worker-signup" : docLevelModal+"/components/modals/worker-register.php",
    "error" : docLevelModal+"/components/modals/error.php" ,
    "check-avail-est-date" : docLevelModal+"/components/modals/check-avail-est-date.php" ,
    "check-avail-exact-date" : docLevelModal+"components/modals/check-avail-exact-date.php",
    "user-login":  docLevelModal+"/components/modals/homeowner-login.php",
    "worker-login":  docLevelModal+"/components/modals/worker-login.php",
    "tempAddr" : docLevelModal+"/components/modals/temporary/temp-enter-address.php", 
    "tempRegister": docLevelModal+"/components/modals/temporary/test-modal-register.php",
    "tempLogin": docLevelModal+"/components/modals/temporary/temp-login.php",
    "SMS-verification":  docLevelModal+"/components/modals/sms-verification.php"
}

// This function loads the
const loadModal = (modalType, modalTypes, modalFunction = () => {}, level=".", data = {}) => {
    // const modalTypes = {
    //     "name" : "location",
    // }
    if(modalTypes.hasOwnProperty(modalType)){
        // create an empty object
        let obj = {};
        obj['level'] = level;
        obj['data'] = data;
        $("#modal-contents").load(modalTypes[modalType], obj, ()=>{
            modalFunction();
        });
    } else {
        $("#modal-contents").load(modalTypes["error"]);
    }
}



