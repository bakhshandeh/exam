<?php include("header.php"); ?>

<script type="text/javascript" charset="utf-8">    
    $(document).ready(function() {
    
                                $('#rec_exams_table').dataTable({
                                
                                    "bPaginate": false,  
                                    "bInfo": false,  
                                    "bFilter": false,
                                    "bAutoWidth": false,
				    "sAjaxSource": "core/exam_history.php",
                                    "bProcessing": true,
                                });
                                
    
			});
</script>

    
    <div id="page-content-wrapper">
        <div class="content-header">
          <h1>
            <a class="btn btn-default" href="#" id="menu-toggle"><i class="icon-reorder"></i></a>
          </h1>
        </div>
        <!-- Keep all page content within the page-content inset div! -->
        <div class="page-content inset">
                    
                    <div class="row">
                        <div class="col-md-8">
                          <center>
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="rec_exams_table" style="width:800px" >
	                        <thead>
		                    <tr>
			            <th>Exam Name</th>
			            <th>Exam Date</th>
			            <th>State</th>
			            <th>Your Marks</th>
			            <th>Duration</th>
			            <th>Percentage</th>
			            <th>Rank</th>
			            <th>Actions</th>
			
		                    </tr>
	                        </thead>
                            </table>
                            </center>
                    </div>
                    </div>
          </div>
        </div>
    
<?php include("footer.php");?>
