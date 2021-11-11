// console.log("appendStyleSheet.js is loaded!");

// function that gets a stylesheet list objct
// with a key pair value where the stylesheet name is the key and the stylesheet DOM is the value
const getDocumentStyleSheets = ()=> {
    const styleSheets_HTMLColelction = document.getElementsByTagName("LINK");
    let styleSheets = {}

    if(styleSheets_HTMLColelction && styleSheets_HTMLColelction.length > 0){
        for (var i = 0; i < styleSheets_HTMLColelction.length; i++) {
            
            let value = styleSheets_HTMLColelction[i];
            let key = styleSheets_HTMLColelction[i].getAttribute("href");

            styleSheets[key] = value;
        }
    }

    return styleSheets;
}

// function that gets the doucment's Curent File level
const getDocumentLevel = () => {
    const metalevel = document.getElementById("meta-level");
    const level = metalevel.getAttribute("level");
    return level;
}

// function that checks if stylesheet is included in current document
const hasStyleSheet = (styleSheetName, documentStyleSheetList) => {

    const level = getDocumentLevel()
    const userStyleSheet = level+styleSheetName;
    const styleSheets = getDocumentStyleSheets();

    let hasStyleSheet = false;

    if(documentStyleSheetList.hasOwnProperty(userStyleSheet)){
        hasStyleSheet = true;
    } 


    return hasStyleSheet;
}


// function that loads the stylesheet into the current document if it is not found
// accepts an array of userStyleSheetNames
const appendStyleSheets= (userStyleSheets) => {
    $( document ).ready(()=> {
        // grab the head DOM element
        const head = document.getElementsByTagName("HEAD")[0];
    
        // get the file level of the current document
        const level = getDocumentLevel();
        const documentStyleSheets = getDocumentStyleSheets();
        const userStyleSheetLocations = userStyleSheets.map(styleSheet=>{
            return level+userStyleSheets;
        }) 
        console.log(userStyleSheetLocations);


        userStyleSheetLocations.forEach(userStyleSheet => {
            if(!hasStyleSheet(userStyleSheet, documentStyleSheets)){
                console.warn("This document does not have the styesheet " + userStyleSheet + " linked and was dynamically appended. Please link this stylesheet to the document for faster css loading.");

                // Dynamically link the user header css
                const newLink = document.createElement("LINK");   

                // Create a <link> element
                newLink.setAttribute("rel", "stylesheet");
                newLink.setAttribute("href", userStyleSheet);

                // Append <link> to <head>
                head.appendChild(newLink);
            }
        });
    });
}


// function that loads the stylesheet into the current document if it is not found
const appendStyleSheet= (userStyleSheet) => {
    $( document ).ready(()=> {
        // grab the head DOM element
        const head = document.getElementsByTagName("HEAD")[0];
    
        // get the file level of the current document
        const level = getDocumentLevel();
        const documentStyleSheets = getDocumentStyleSheets();
        const userStyleSheetLocation = level+userStyleSheet;

    
        if(!hasStyleSheet(userStyleSheet, documentStyleSheets)){
            console.warn("This document does not have the styesheet " + userStyleSheet + " linked and was dynamically appended. Please link this stylesheet to the document for faster css loading.");

            // Dynamically link the user header css
            const newLink = document.createElement("LINK");   
    
            // Create a <link> element
            newLink.setAttribute("rel", "stylesheet");
            newLink.setAttribute("href", userStyleSheetLocation);
    
            // Append <link> to <head>
            head.appendChild(newLink);
        } 

    });
}
