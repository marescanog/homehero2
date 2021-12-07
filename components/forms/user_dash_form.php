<!-- <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script> -->
<!-- <script
  src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"
  integrity="sha256-hlKLmzaRlE8SCJC1Kw8zoUbU8BxA+8kR3gseuKfMjxA="
  crossorigin="anonymous"></script> -->

<script src="../../js/jquery-ui.min.js"></script>

<script>
$(document).ready(function() {
    // This sections loads a fefault list into the search items
    // if the list was successfully retreived from DB, it will load that list

    const cProjectsDefault =
    [
        {label: "General Plumbing Project", value: "General Plumbing Project", metaData_cat: "1", metaData_subcat: "1"},
        {label: "General Carpentry Project", value: "General Carpentry Project", metaData_cat: "2", metaData_subcat: "2"},
        {label: "General Electrical Project", value: "General Electrical Project", metaData_cat: "3", metaData_subcat: "3"},
        {label: "General Gardening Project", value: "General Gardening Project", metaData_cat: "4", metaData_subcat: "4"},
        {label: "General Home Improvement Project", value: "General Home Improvement Project", metaData_cat: "5", metaData_subcat: "5"},
        {label: "General Cleaning Project", value: "General Cleaning Project", metaData_cat: "6", metaData_subcat: "6"},
    ]
    const cProjects = [];
    // On Page Load, The default falback list is 6 items.
    $.ajax({
        type : 'GET',
        // url : "http://localhost/slim3homeheroapi/public/search-proj", // DEV
        url : "https://slim3api.herokuapp.com/search-proj", // PROD
        success : function(response) {
            console.log(response.response.data)
            const retreivedProjFromDB = response.response.data;
            for(let x = 0; x < retreivedProjFromDB.length; x++){
                let obj = {label: retreivedProjFromDB[x]["type"], value:retreivedProjFromDB[x]["type"],
                    metaData_cat: retreivedProjFromDB[x]["expertise"], metaData_subcat: retreivedProjFromDB[x]["id"]};
                cProjects.push(obj);
            }
            if(cProjects.length == 0){
                cProjects = cProjectsDefault;
            }
            $('#autoSuggest').autocomplete({
                appendTo: "#show-list",
                source: cProjects,
                change: function (event, ui) {
                if(!ui.item){
                    $(event.target).val("");
                }
                    let idFeild = document.getElementById("project_id_field");
                    let idCategory = document.getElementById("project_category_field");
                    let obj = cProjects.find(o => o.value === ui.item.value);
                    // console.log("your UI item is");
                    // console.log(ui.item.value);
                    // console.log("your UI object is");
                    // console.log(obj);
                    idFeild.value = obj.metaData_subcat;
                    idCategory.value = obj.metaData_cat;

                }, 
                focus: function (event, ui) {
                    return false;
                }
            })
        },
        error: function (response) {
            console.log(response);
            $('#autoSuggest').autocomplete({
                appendTo: "#show-list",
                source: cProjectsDefault,
                change: function (event, ui) {
                if(!ui.item){
                    $(event.target).val("");
                }
                    let idFeild = document.getElementById("project_id_field");
                    console.log("your UI item is");
                    console.log(ui.item);
                    idFeild.value = "";
                }, 
                focus: function (event, ui) {
                    return false;
                }
            })
        }
    });
    // console.log(cProjects);
    // TO DO, ADD CODE TO REST FORM ON PAGE LOAD
    $('#form-home')[0].reset();
});
</script>  

<form <?php echo isset($jumb_id) ? "id='form-".$jumb_id."'" : ""?> class="jum-form rounded d-flex flex-column flex-lg-row"
action="<?php echo $level;?>/pages/homeowner/create-project.php"
method="post"
>
    <div class="jumb-form-input-container">
        <!-- <input id="search-in" type="text" class="form-control-plaintext flex-1 card-input" placeholder="<?php //echo isset($jumb_placeholder) ? $jumb_placeholder : "What do you need help with?"?>"
        autocomplete="off" required
        > -->
        <div class="ui-widget">
            <input id="autoSuggest" type="text" class="form-control-plaintext flex-1 card-input" placeholder="What do you need help with?" name="project_type" value=""/>
        </div>
        <input id="project_id_field" type="hidden" name="project_id" value="">
        <input id="project_category_field" type="hidden" name="project_category" value="">
        <input id="address_name_label" type="hidden" name="address_name_label" value="">
    </div>
    <div id="add-address" class="cust-select-container hvr-pop">
        <div class="d-flex align-items-center ">
            <div class="vert-line"></div>
            <svg class="city-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#F2AE00"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zM7 9c0-2.76 2.24-5 5-5s5 2.24 5 5c0 2.88-2.88 7.19-5 9.88C9.92 16.21 7 11.85 7 9z"/><circle cx="12" cy="9" r="2.5"/></svg>
        </div>
        <p id="add-address-text" class="p-0 m-0 ">
            Add an address
        </p>
        <input id="home_address_field" type="hidden" name="home_id" value="">
    </div>
    <button <?php echo isset($jumb_id) ? "id='button-".$jumb_id."'" : ""?> 
        class="btn btn-warning text-white m-0 h-100 jmb-form-btn border-0"
        type="button"
        >
    <?php echo isset($jumb_button_text) ? $jumb_button_text : "SEARCH"?>
    </button>
</form>
<div class="col-md-6" style="position:relative;margin-left:5px">
    <div class="list-group ui-front" id="show-list">

    </div>
</div>
<p id="form-err-msg" class="text-danger d-none"  style="font-size: 0.85rem">* Please select a project from the list. Please add an address for the project.</p>
