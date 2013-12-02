<?php

$id = $_SESSION["loginInfo"]["id"];
$db =  DBSingleton::getInstance();

$ret = $db->dbSelect("exam_attempts", "is_passed=1", "", 0, -1, array("count(1) as count"));
$passed = (int)$ret[0]["count"];

$ret = $db->dbSelect("exam_attempts", "is_passed=0", "", 0, -1, array("count(1) as count"));
$failed = (int)$ret[0]["count"];

$l = "[[['Passed', $passed], ['Failed', $failed]]]";
?>                                                          

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
    
    l = <?php echo $l;?>;
    plot2 = jQuery.jqplot('chart1_qs', 
            //json.l, 
            l,
    {
      title: 'Performance chart', 
      seriesDefaults: {
        shadow: false, 
        renderer: jQuery.jqplot.PieRenderer, 
        rendererOptions: { 
          startAngle: 180, 
          sliceMargin: 4, 
          showDataLabels: true } 
      }, 
      legend: { show:true, location: 'w' }
    });
    
  //$.post("core/home_qs.php?chart1=1", function(data){
    //var json = $.parseJSON(data);
    //alert(json.l);
    
    /*
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
          startAngle: 180, 
          sliceMargin: 4, 
          showDataLabels: true } 
      }, 
      legend: { show:true, location: 'w' }
    }
  );
});
    });*/
});

</script>


                            <div id="chart1_qs" style="width:600px; height:250px;float: right;"></div>

                            <center>
