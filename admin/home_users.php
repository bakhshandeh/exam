<script>
$(document).ready(function() {
    $('#users_table').dataTable({
                                
                                    "bPaginate": false,  
                                    "bInfo": false,  
                                    "bFilter": false,
                                    "bAutoWidth": false,
				    "sAjaxSource": "core/subject_users.php",
                                    "bProcessing": true,
                                });
  $.post("core/subject_users.php?chart=1", function(data){
    var json = $.parseJSON(data);
    
    //var s1 = [200, 600, 700, 1000];
    //var s2 = [460, 210, 690, 820];
    //var s3 = [260, 440, 320, 200];
    l = json.l;
    
    var ticks = json.names;//['May', 'June', 'July', 'August'];
     
    var plot1 = $.jqplot('chart1', l, {
        seriesDefaults:{
            renderer:$.jqplot.BarRenderer,
            rendererOptions: {fillToZero: true}
        },
        series:[
            {label:'Active'},
            {label:'Pending'},
            {label:'Suspended'}
        ],
        legend: {
            show: true,
            placement: 'outsideGrid'
        },
        axes: {
            xaxis: {
                renderer: $.jqplot.CategoryAxisRenderer,
                ticks: ticks
            },
            yaxis: {
                pad: 1.05,
                tickOptions: {formatString: '%d'}
            }
        }
    });
  });
});

</script>


                            <div id="chart1" style="width:600px; height:250px;float: right;"></div>

                            <center>
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="users_table" style="width:800px" >
	                        <thead>
		                    <tr>
			            <th>Group Name</th>
			            <th>Total Students</th>
			            <th>Total Active</th>
			            <th>Total Suspend</th>
		                    </tr>
	                        </thead>
                            </table>
                            </center>