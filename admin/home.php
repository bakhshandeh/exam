<?php include("header.php");?>


<script type="text/javascript" charset="utf-8">    
    
    $(document).ready(function() {
    
                                $('#up_exams_table').dataTable({
                                
                                    "bPaginate": false,  
                                    "bInfo": false,  
                                    "bFilter": false,
                                    "bAutoWidth": false,
				    "sAjaxSource": "core/up_exams.php",
                                    "bProcessing": true,
                                });
                                
                                $('#rec_exams_table').dataTable({
                                
                                    "bPaginate": false,  
                                    "bInfo": false,  
                                    "bFilter": false,
                                    "bAutoWidth": false,
				    "sAjaxSource": "core/up_exams.php",
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
                            <h4>Upcoming exams</h4>
                          <center>
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="up_exams_table" style="width:800px" >
	                        <thead>
		                    <tr>
			            <th>Date</th>
			            <th>Exam Name</th>
			            <th>Group</th>
			            <th>Marks</th>
			            <th>Duration</th>
			
		                    </tr>
	                        </thead>
                            </table>
                            </center>
                    </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-8">
                            <h4>User Details</h4>
                        
                        <?php include("home_users.php");?>
                    </div>
                    </div>
          </div>
        </div>
    
    

<?php include("footer.php");?>
