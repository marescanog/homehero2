// $(document).ready(()=>{

    
// });

const profile_editAddress = (homeID) =>{
    console.log("You clicked edit address for home "+ homeID);
    // Load Modal for Edit Address
    let obj = {};
    obj['home_id'] = homeID;
    // obj['data'] = data;
    loadModal("editAddr", modalTypes, ()=>{}, getDocumentLevel(), obj);
}

const profile_deleteAddress = (homeID) =>{
    console.log("You clicked delete address for home "+ homeID);
    Swal.fire({
        title: 'Are you sure you want to delete this address?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Yes, Delete',
        denyButtonText: `No, Keep`,
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire('Deleted!', '', 'info');
            // NODEPLOYEDPRODLINK   
            //  Ajax for deletion of address 
        } else if (result.isDenied) {
            //   Swal.fire('Kept', '', 'info');
        }
      })
}

