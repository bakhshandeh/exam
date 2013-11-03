
<?php 

include("header.php");
//$gid = (int)$_SESSION["loginInfo"]["stdgroup"];
$std_id = $_SESSION["loginInfo"]["id"];
$db = DBSingleton::getInstance();
$exams = $db->dbSelect("exams",  "end_date >= now() and id in (select eid from exam_stdgroups where gid in(select g_id from std_stdgs where std_id = {$std_id}))");
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
                        Name: <span style="font-weight:bold;">{$ex["name"]}</span> <br />
                        Start Date: <span style="font-weight:bold;">{$ex["start_date"] }</span> <br />
                        End Date: <span style="font-weight:bold;">{$ex["end_date"]}</span> <br />
                        Duration: <span style="font-weight:bold;">{$ex["duration"]}</span> <br />
                        Pass Percent %: <span style="font-weight:bold;">{$ex["pass_p"]}</span><br />
                        Negative Marks: <span style="font-weight:bold;">{$ex["neg_mark"]}</span>
                        <br />
                        <a class="btn btn-primary" type="button" href="tryexam.php?eid={$ex['id']}">Attempt Now</a>
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
