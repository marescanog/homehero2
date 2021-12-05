
<!-- Bootstrap JS & Popper -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
<!-- Other Packages -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Custom JS -->
<script src="<?php echo $level;?>/js/main.js"></script>

<!-- =============================================== -->
<!--                    MODAL                        -->
<!-- =============================================== -->
<div class="modal fade" id="modal"  role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-backdrop="static">
    <div id="modal-contents" class="modal-dialog modal-dialog-centered" role="document">
        <?php

        ?>
    </div>
</div>
<script>
    // This script clears the modal contents on hide by loading an empty php page.
    $('#modal').on('hidden.bs.modal', function () {
        $("#modal-contents").load(modalTypes["clear"]);
    });
</script>