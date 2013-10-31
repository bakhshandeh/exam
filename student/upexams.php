
<?php 

include("header.php");
$gid = (int)$_SESSION["loginInfo"]["stdgroup"];
$db = DBSingleton::getInstance();
$exams = $db->dbSelect("exams",  "end_date >= now() and id in (select eid from exam_stdgroups where gid={$gid})");
?>

    
    <script type="text/javascript">

    jQuery(document).ready(function(){
        $('#home_li').addClass('active');
    });
    
    </script>
    


<!-- Page content -->
      <div id="page-content-wrapper">
        <div class="content-header">
          <h1>
            <a id="menu-toggle" href="#" class="btn btn-default"><i class="icon-reorder"></i></a>
            Upcoming Exams
          </h1>
        </div>
        <!-- Keep all page content within the page-content inset div! -->
        <div class="page-content inset">
          
          
          <?php
            foreach($exams as $ex){
                print <<<END
                <div class="row">
                    <div class="col-md-6">
                    <p class="well">
                        {$ex["name"]} | {$ex["start_date"]} - {$ex["end_date"]}<br />
                        <a class="btn btn-primary" type="button" href="tryexam.php?eid={$ex['id']}">Try this exam ...</a>
                    </p>
                    </div>
                    
                </div>
                    
END;
            }
          ?>
          
          </div>
        </div>
      </div>
      
    </div>


<?php include("footer.php");?>