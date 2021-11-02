<!-- 
    Theres a conflict for the custom select (applied in the city select) that removes the borders but this issue
    should no longer be seen in the actual page where this will be applied

    Things to be added:
        onSubmit event, JS code to toggle enabled state of the dropdown for specific time
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
        <form id="checkAvailEstDateForm" type="POST" onSubmit="" name="modalForm">
            <h5 class="font-weight-bold text-center" style="color:#707070">Estimated Date</h5>
            <div class="form-group">
                <select name="est-date" class="custom-select">
                    <option value="3d">Within three days</option>
                    <option value="7d">Within one week</option>
                    <option value="14d">Within two weeks</option>
                </select>
                <p class="my-1" style="font-size:0.8em;">
                    or choose a <a href="" data-toggle="modal" onclick="loadModal('check-avail-exact-date')">specific date</a>
                </p>
            </div>
            <div class="form-group">
                <h5 class="font-weight-bold text-center" style="color:#707070">Time Preference</h5>
                <div class="form-check ml-3">
                    <label>
                        <input class="form-check-input" type="checkbox" name="est-time" value="morning">
                        Morning (8am - 12pm)
                    </label>
                </div>
                <div class="form-check ml-3">
                    <label>
                        <input class="form-check-input" type="checkbox" name="est-time" value="afternoon">
                        Afternoon (12pm - 5pm)
                    </label>
                </div>
                <div class="form-check ml-3">
                    <label>
                        <input class="form-check-input" type="checkbox" name="est-time" value="evening">
                        Evening (5pm - 9:30pm)
                    </label>
                </div>

                <p class="text-center mt-2 mb-2" style="font-size:0.8em;">
                    Or choose a specific time
                </p>
                <!-- to be enabled only when none of the three checkboxes are checked and disabled otherwise -->
                <select name="other-time" class="custom-select">
                    <option value="0">I'm flexible</option>
                    <option value="8">8:00-9:00am</option>
                    <option value="9">9:00-10:00am</option>
                    <option value="10">10:00-11:00am</option>
                    <option value="11">11:00am-12:00am</option>
                    <option value="12">12:00-1:00pm</option>
                    <option value="13">1:00-2:00pm</option>
                    <option value="14">2:00-3:00pm</option>
                    <option value="15">3:00-4:00pm</option>
                    <option value="16">4:00-5:00pm</option>
                    <option value="17">5:00-6:00pm</option>
                    <option value="18">6:00-7:00pm</option>
                    <option value="19">7:00-8:00pm</option>
                    <option value="20">8:00-9:30pm</option>
                </select>
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