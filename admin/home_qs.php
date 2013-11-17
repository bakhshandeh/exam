<script>
$(document).ready(function() {
    $('#qs_table').dataTable({
                                
                                    "bPaginate": false,  
                                    "bInfo": false,  
                                    "bFilter": false,
                                    "bAutoWidth": false,
				    "sAjaxSource": "core/home_qs.php",
                                    "bProcessing": true,
                                });
  $.post("core/home_qs.php?chart1=1", function(data){
    var json = $.parseJSON(data);
    alert(json.l);
        $(document).ready(function(){
        plot2 = jQuery.jqplot('chart1_qs', 
            json.l, 
    {
      title: ' ', 
      seriesDefaults: {
        shadow: false, 
        renderer: jQuery.jqplot.PieRenderer, 
        rendererOptions: { 
          startAngle: 180, 
          sliceMargin: 4, 
          showDataLabels: true } 
      }, 
      legend: { show:true, location: 'w' }
    }
  );
});
    });
});

</script>


                            <div id="chart1_qs" style="width:600px; height:250px;float: right;"></div>

                            <center>
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="qs_table" style="width:800px" >
	                        <thead>
		                    <tr>
			            <th>Bank Name</th>
			            <th>Total Questions</th>
			            <th>Total Easy</th>
			            <th>Total Normal</th>
			            <th>Total Difficult</th>
		                    </tr>
	                        </thead>
                            </table>
                            </center>