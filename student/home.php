<?php include("header.php"); ?>

<script type="text/javascript" charset="utf-8">    
    /*
    jQuery(document).ready(function(){
        $('#home_li').addClass('active');
    });
    */
    
    $(document).ready(function() {
    
                                $('#example').dataTable({
                                
                                    "bPaginate": false,  
                                    "bInfo": false,  
                                    "bFilter": false,
                                    "bAutoWidth": false,
                                    
                                
                                
				    "sAjaxSource": "core/home.php",
                                    "bProcessing": true,
                                    
                                    "aoColumnDefs": [ 
                                        {
                                            "aTargets": [0],
                                            
                                            "sType": "html", 
                                            "fnRender": function(o, val) {
                                                //return "<a href=\"javascript:delRecord('home', "+ o.aData[0]+", 'home.php')\"> Attempt Now</a> " ;
                                                return "<a href=tryexam.php?eid="+o.aData[0]+"> Attempt Now</a> " ;
                                            } 
                                        }
                                        
                                    ]
                                
                                });
                                
                                
                                $('#up_exams_table').dataTable({
                                
                                    "bPaginate": false,  
                                    "bInfo": false,  
                                    "bFilter": false,
                                    "bAutoWidth": false,
				    "sAjaxSource": "core/home.php?up=1",
                                    "bProcessing": true,
                                });
                                
                                $('#rec_exams_table').dataTable({
                                
                                    "bPaginate": false,  
                                    "bInfo": false,  
                                    "bFilter": false,
                                    "bAutoWidth": false,
				    "sAjaxSource": "core/home.php?pass=1",
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
                            <?php include("home_per_chart.php"); ?>
                        </div>
                    </div>
          
                    <div class="row">
                        <div class="col-md-8">
                            <h4>Today's Exams </h4>
                          <center>
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" style="width:800px" >
	                        <thead>
		                    <tr>
			            <th>Status</th>
			            <th>Exam Name</th>
			            <th>Duration</th>
			            <th>Marks</th>
			
		                    </tr>
	                        </thead>
                            </table>
                            </center>
                    </div>
                    </div>                
                    
                    <div class="row">
                        <div class="col-md-8">
                            <h4>Upcoming exams</h4>
                          <center>
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="up_exams_table" style="width:800px" >
	                        <thead>
		                    <tr>
			            <th>Status</th>
			            <th>Exam Name</th>
			            <th>Duration</th>
			            <th>Marks</th>
			
		                    </tr>
	                        </thead>
                            </table>
                            </center>
                    </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-8">
                            <h4>Your recent passed exams</h4>
                          <center>
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="rec_exams_table" style="width:800px" >
	                        <thead>
		                    <tr>
			            <th>Exam Name</th>
			            <th>Exam Date</th>
			            <th>Your Marks</th>
			            <th>Duration</th>
			            <th>Percentage</th>
			            <th>Rank</th>
			            <th>Results</th>
			
		                    </tr>
	                        </thead>
                            </table>
                            </center>
                    </div>
                    </div>
          </div>
        </div>

<?php include("footer.php");?>
