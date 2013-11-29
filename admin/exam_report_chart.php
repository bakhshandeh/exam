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
    //alert(json.l);
    
    l = [[['Absents', 1], ["Passed", 1], ["Failed", 1]]];
        $(document).ready(function(){
        plot2 = jQuery.jqplot('chart1_qs', 
            //json.l, 
            l,
    {
      title: ' ', 
      seriesDefaults: {
        shadow: false, 
        renderer: jQuery.jqplot.PieRenderer, 
        rendererOptions: { 
          //startAngle: 180, 
          //sliceMargin: 4, 
          showDataLabels: true ,
          dataLabels: 'value',
          dataLabelFormatString:'%d'
          } 
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
