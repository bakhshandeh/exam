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
                                
    
			});
</script>
    


<!-- Page content -->
      <div id="page-content-wrapper">
        <div class="content-header">
          <h1>
            <a id="menu-toggle" href="#" class="btn btn-default"><i class="icon-reorder"></i></a>
          </h1>
        </div>
        
        
        <!-- Keep all page content within the page-content inset div! -->
        <div class="page-content inset">
          <div class="row" style="font-weight:bold; color:#C646C6">
            Today's Exams
          </div>
        </div>
        
      </div>
      
    </div>


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



<?php include("footer.php");?>
