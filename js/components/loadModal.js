const loadModal = (modalType, modalTypes) => {
    // const modalTypes = {
    //     "signup" : "./components/modals/homeowner-register.php",
    //     "error" : "./components/modals/error.php" ,
    //     "check-avail-est-date" : "./components/modals/check-avail-est-date.php" ,
    //     "check-avail-exact-date" : "./components/modals/check-avail-exact-date.php" 
    // }
    console.log("loadModal Function executed");
    if(modalTypes.hasOwnProperty(modalType)){
        $("#modal-contents").load(modalTypes[modalType]);
    } else {
        $("#modal-contents").load(modalTypes["error"]);
    }
}

