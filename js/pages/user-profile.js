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
        showLoaderOnConfirm: true,
        backdrop: true,
        preConfirm: () => {
            $.ajaxSetup({cache: false})
            return $.get(getDocumentLevel()+'/auth/get-register-session.php', function (data) {
                // console.log(data)
                const parsedSession = JSON.parse(data);
                const token = parsedSession['token'];
                console.log(token);
                // return token;

                // Ajax to delete the address
                return $.ajax({
                    type: 'POST',
                    // url : '', // No live deployed prod route
                     url: 'http://localhost/slim3homeheroapi/public/homeowner/delete-address/'+homeID, // dev
                    contentType: false,
                    processData: false,
                    headers: {
                        "Authorization": `Bearer ${token}`
                    },
                    // data : submitformData,
                    success : function(response) {
                        console.log("your response after account login is:")
                        console.log(response);

                        return true;
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






            }); // closing bracking ajax setup get bearer token
        },// closing swal preconfirm

        allowOutsideClick: () => !Swal.isLoading()
      }).then((result) => {
        if (result.isConfirmed) {
            // result.value
            Swal.fire({
                title: 'Address Deleted!',
                icon: 'info'
            }).then(()=>{
                window.location = getDocumentLevel()+'/pages/homeowner/profile.php?tab=address';
            });

        }
      }) // Closing bracket swal fire then

} // closing bracket delete addr function





    // Swal.fire({
    //     title: 'Are you sure you want to delete this address?',
    //     showDenyButton: true,
    //     showCancelButton: false,
    //     confirmButtonText: 'Yes, Delete',
    //     denyButtonText: `No, Keep`,
    //   }).then((result) => {
    //     if (result.isConfirmed) {
    //       Swal.fire('Deleted!', '', 'info');
    //         // NODEPLOYEDPRODLINK   
    //         // Ajax to get the bearer token
    //         $.ajaxSetup({cache: false})
    //         $.get(getDocumentLevel()+'/auth/get-register-session.php', function (data) {
    //             console.log(data)
    //             const parsedSession = JSON.parse(data);
    //             const token = parsedSession['token'];
    //             console.log(token);

    //         }); // closing bracking ajax setup get bearer token

    //     } else if (result.isDenied) {
    //         //   Swal.fire('Kept', '', 'info');
    //     } // closinf bracket inside swal result else if

    //   }) // closing bracket Swal Fire