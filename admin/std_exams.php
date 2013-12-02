<?php 

include("header.php");

$db = DBSingleton::getInstance();
$id = (int)$_REQUEST["id"];
$student = $db->dbSelect("students", "id=".(int)$_REQUEST["id"]);
$student = $student[0];
//var_dump($student);exit(0);

?>


<script type="text/javascript" charset="utf-8">    
    
    $(document).ready(function() {
    
                                $('#up_exams_table').dataTable({
                                
                                    "bPaginate": false,  
                                    "bInfo": false,  
                                    "bFilter": false,
                                    "bAutoWidth": false,
				    "sAjaxSource": "core/std_exams.php?id=<?php echo $id;?>",
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
                            <h4>Student Details: <?php echo $student["name"]."/".$student["enrol_number"];?> <br />
                            <br><br>
                            Exams:
                            </h4>
                          <center>
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="up_exams_table" style="width:800px" >
	                        <thead>
		                    <tr>
			            <th>Date</th>
			            <th>Exam Name</th>
			            <th>Marks Obtained</th>
			            <th>Total Qs. Attempted</th>
			            <th>Duration</th>
			            <th>Details</th>
		                    </tr>
	                        </thead>
                            </table>
                            </center>
                    </div>
                    </div>
                    
          </div>
        </div>
    
    

<?php include("footer.php");?>
