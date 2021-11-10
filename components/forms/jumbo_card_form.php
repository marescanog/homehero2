<form <?php echo isset($jumb_id) ? "id='form-".$jumb_id."'" : ""?> class="jum-form rounded d-flex  flex-column flex-lg-row"

>
    <div class="jumb-form-input-container">
        <input type="text" class="form-control-plaintext flex-1 card-input" placeholder="<?php echo isset($jumb_placeholder) ? $jumb_placeholder : "What do you need help with?"?>">
    </div>
    <div class="cust-select-container">
        <div class="d-flex align-items-center">
            <div class="vert-line"></div>
            <svg class="city-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#F2AE00"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zM7 9c0-2.76 2.24-5 5-5s5 2.24 5 5c0 2.88-2.88 7.19-5 9.88C9.92 16.21 7 11.85 7 9z"/><circle cx="12" cy="9" r="2.5"/></svg>
        </div>
        <select class="custom-select">
            <option value="" disabled selected>City</option>
            <option value="1">Bantayan</option>
            <option value="2">Carcar</option>
            <option value="3">Metro Cebu</option>
            <option value="4">Daanbantayan</option>
            <option value="5">Danao</option>
            <option value="6">Lapu-lapu</option>
            <option value="7">Liloan</option>
            <option value="8">Mandaue</option>
            <option value="9">Minglanilla</option>
            <option value="10">Naga</option>
            <option value="11">Talisay</option>
            <option value="12">Toledo</option>
        </select>
    </div>
    <button <?php echo isset($jumb_id) ? "id='button-".$jumb_id."'" : ""?> 
        class="btn btn-warning text-white m-0 h-100 jmb-form-btn border-0"
        type="button" data-toggle="modal" data-target="#modal"
        >
    <?php echo isset($jumb_button_text) ? $jumb_button_text : "SEARCH"?>
    </button>
</form>