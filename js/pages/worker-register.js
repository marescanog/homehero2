// $(document).ready(()=>{
//     // Next Page Data
//     pageData = {}
//     pageData['level'] =getDocumentLevel();
//     pageData['header_title'] = "Personal Infomation";
//     pageData['page'] = 1;
//     loadRegisterBody("/components/sections/register-orientation.php", pageData, ()=>{
//         let = obj ={}
//         let = obj['level'] = getDocumentLevel();
//         let = obj['header_title'] = "Orientation";
//         let = obj['page'] = 0;
    
//         $("#header").load(getDocumentLevel()+"/components/headers/worker-register.php",obj);
//         const button = document.getElementById("next");
//         button.addEventListener("click", ()=>{
//             console.log("I Click")//register-personal-info.php
//             loadRegisterBody("/components/sections/register-personal-info.php");
//             let pageObj ={}
//             pageObj['level'] =  pageData['level'];
//             pageObj['header_title'] = pageData['header_title'];
//             pageObj['page'] = pageData['page'];
//             $("#header").load(getDocumentLevel()+"/components/headers/worker-register.php",pageObj);

//         })
//     })
// })

// const loadRegisterBody = (page, data, func)=> {
//     $("#body").load(getDocumentLevel()+page,data, ()=>{

//     });
// };
