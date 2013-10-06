<?php include("header.php");?>

    
    <script type="text/javascript">

    jQuery(document).ready(function(){
        $('#exams_li').addClass('active');
        <?php
            $tab = $_REQUEST["tab"];
            if($tab){
                print <<<END
                    $("#q_tabs a[href='#{$tab}']").tab('show');
END;
            }
        ?>
    });
    
    </script>
    

    <div class="container">
    
    <br/>
    <div class="tabbable" id="q_tabs"> <!-- Only required for left/right tabs -->
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab1" data-toggle="tab">Subjective Questions</a></li>
            <li><a href="#tab2" data-toggle="tab">Objective Questions</a></li>
            <li><a href="#tab3" data-toggle="tab">Multiple Choice Questions</a></li>
            <li><a href="#tab4" data-toggle="tab">True/False Questions</a></li>
        </ul>
    
            <div class="tab-content">
                <div class="tab-pane active" id="tab1">
                    <?php include("questions/subjective.php"); ?>
                </div>
            
                <div class="tab-pane" id="tab2">
                    <p>Howdy, I'm in Section 2.</p>
                </div>
            </div>
        </div>

    </div><!-- /.container -->

<?php include("footer.php");?>
