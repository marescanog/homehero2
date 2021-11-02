<!-- 
    Theres a conflict for the custom select (applied in the city select) that removes the borders but this issue
    should no longer be seen in the actual page where this will be applied

    Things to be added:
        onSubmit event, JS code to reflect date and time chosen
-->

<div class="modal-content">
    <div class="modal-header">

        <div class="mx-auto text-center">
            <h4 class="mt-2 font-weight-bold" style="color:#707070">Check availability</h4>
            <p class="m-0">When would you like to start your project?</p>
        </div>
        <button type="button" class="close position-absolute" data-dismiss="modal" aria-label="Close" style="margin: -1rem 0; right:0">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body col-sm-7 mx-auto">
        <form id="checkAvailExactDateForm" type="POST" onSubmit="" name="modalForm">
            <div class="my-md-5">
                <h5 class="font-weight-bold text-center" style="color:#707070">Exact Date</h5>
                <p class="text-center">
                    Scheduled for:
                    <span id="selectedDate">Nov 3</span>,
                    <span id="selectedTime">8:00 AM</span>
                </p>
                <div class="form-group">
                    <input type="date" class="form-control mb-2" id="date" name="date">

                    <input type="time" class="form-control mb-2" id="time" name="time" min="08:00" max="21:00" step="1800" value="08:00"> <!-- step 30 minutes -->
                    <p class="mt-1" style="font-size:0.8em;">
                        or choose an <a href="" data-toggle="modal" onclick="loadModal('check-avail-est-date')">estimated date</a>
                    </p>
                </div>
            </div>


            <p class="mt-1 text-center" style="font-size:0.8em;">
                *Choose an estimated or exact date to see if this HomeHero is available to work for you.
            </p>
            <button type="submit" class="btn btn-warning text-white font-weight-bold w-100 mb-3">
                <span id="RU-submit-btn-txt">SELECT AND CONTINUE</span>
                <div id="RU-submit-btn-load" class="d-none">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <span class="sr-only">Loading...</span>
                </div>
            </button>

        </form>
    </div>
</div>

<!-- Script to set default date to tomorrow -->
<script>
    var tomorrow = new Date(new Date().getTime() + 24 * 60 * 60 * 1000);
    var tomday = tomorrow.getDate();
    var tommonth = tomorrow.getMonth() + 1;
    var tomyear = tomorrow.getFullYear();
    if (tomday < 10) tomday = '0' + tomday;
    if (tommonth < 10) tommonth = '0' + tommonth;
    tomorrow = tomyear + '-' + tommonth + '-' + tomday;
    document.getElementById('date').setAttribute('value', tomorrow);
</script>