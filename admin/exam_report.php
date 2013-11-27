<?php 

include("header.php");

$db = DBSingleton::getInstance();
$id = (int)$_REQUEST["id"];
$exam = $db->dbSelect("exams", "id=".(int)$_REQUEST["id"]);
$exam = $exam[0];
//var_dump($student);exit(0);

?>


<script type="text/javascript" charset="utf-8">    
    
    $(document).ready(function() {
    
                                $('#up_exams_table').dataTable({
                                
                                    "bPaginate": false,  
                                    "bInfo": false,  
                                    "bFilter": false,
                                    "bAutoWidth": false,
				    "sAjaxSource": "core/exam_stds.php?id=<?php echo $id;?>",
                                    "bProcessing": true,
                                });
			});
</script>
    
    
    
    <div id="page-content-wrapper">
        <div class="content-header">
          <h1>
            <!--a class="btn btn-default" href="#" id="menu-toggle"><i class="icon-reorder"></i></a-->
          </h1>
        </div>
        <!-- Keep all page content within the page-content inset div! -->
        <div class="page-content inset">
          

                    <div class="row">
                        <div class="col-md-8">
                            <h4>Exam Name: <?php echo $exam['name'];?> <br />
                            <br><br>
                            Students:
                            </h4>
                        <?php include("exam_report_chart.php");?>
                          <center>
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="up_exams_table" style="width:800px" >
	                        <thead>
		                    <tr>
			            <th>Student Name</th>
			            <th>Marks Obtained</th>
			            <th>Total Qs. Attempted</th>
			            <th>Duration</th>
			            <th>Percentage</th>
		                    </tr>
	                        </thead>
                            </table>
                            </center>
                    </div>
                    </div>
                    
          </div>
        </div>
    
    

<?php include("footer.php");?>
