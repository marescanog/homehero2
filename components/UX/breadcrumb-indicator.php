<?php
    $hasTitle = isset($hasTitle) ? $hasTitle : true;
    $isHeader = isset($isHeader) ? $isHeader : false;
    // $bci_current_page=4;    
    $bci_total_pages = isset($bci_total_pages) ? $bci_total_pages : 3;
    $bci_current_page = isset($bci_current_page) ? $bci_current_page : 1;
    $bci_titles = isset($bci_titles) && is_array($bci_titles) ? $bci_titles : ["Choose date & time","Describe your project","Review & Submit"];
?>
<div class="breadcrumb-container mt-2 ">
    <ul class="bc-title-container <?php
        echo $hasTitle==false ? ' d-none' : "";
    ?>">
        <?php 
            for($x = 0; $x < count($bci_titles); $x++){
        ?>
            <li class="bc-title">
                <?php
                    echo $bci_titles[$x];
                ?>
            </li>
        <?php
            }
        ?>
    </ul>
    <div>
        <div class="line-container d-flex <?php 
            echo $isHeader == true ? " bc-lg-w-60 adjust-20": " bc-w-60";
        ?>">
            <?php 
                for($x = 1; $x < $bci_total_pages; $x++){
            ?>
                <div class="w-100 line-segment
                    <?php
                        echo $isHeader ? " adjust-l-20" : "";

                        if($x+1 <= $bci_current_page){
                            echo " colored";
                        }
                    ?>
                "></div>
            <?php
                }
            ?>
        </div>
        <div class="box-container d-flex justify-content-between <?php 
            echo $isHeader == true ? " bc-lg-w-60 adjust-20": " bc-w-60";
        ?>">
            <?php 
                for($x = 1; $x <= $bci_total_pages; $x++){
            ?>
                <div class="bc-circle 
                    <?php 
                        echo $isHeader ? " adjust-c-20" : "";
                        if($x <= $bci_current_page){
                            echo " colored";
                        }
                    ?>
                ">
                    <div class="circle-check
                        <?php 
                            if($x+1 <= $bci_current_page){
                                echo " circ-content-show";
                            }
                        ?>
                    ">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="circle-text  
                        <?php
                            if($x+1 >= $bci_current_page){
                                echo " circ-content-show";
                            }
                        ?>
                    ">
                        <?php
                            echo $x;
                        ?>
                    </div>
                </div>
            <?php
                }
            ?>
        </div>
    </div>
</div>