<?php include("header.php");?>

    
    <script type="text/javascript">
    
    <?php
        $type = (int)$_REQUEST["type"];
        print "var type={$type};";
        
    ?>

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
        <?php
            $types = array(
                "subjective",
                "objective",
                "multichoice",
                "truefalse"
            );
                $f = $types[$type];
                include("questions/{$f}.php"); 
            
        ?>

    </div><!-- /.container -->

<?php include("footer.php");?>
