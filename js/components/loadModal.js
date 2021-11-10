const loadModal = (modalType, modalTypes) => {
    // const modalTypes = {
    //     "name" : "location",
    // }
    console.log("loadModal Function executed");
    if(modalTypes.hasOwnProperty(modalType)){
        $("#modal-contents").load(modalTypes[modalType]);
    } else {
        $("#modal-contents").load(modalTypes["error"]);
    }
}

