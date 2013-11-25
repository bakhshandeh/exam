
<?php 

include("header.php");
$ST = $_SESSION["loginInfo"];

$db = DBSingleton::getInstance();
$rets = $db->dbSelect("exam_attempts join exams on(exams.id=eid)", "std_id={$ST['id']}");
$scores = array();
$names = array();
foreach($rets as $ret){
    $scores[] = $ret["score"];
    $names[] = quote($ret["name"]);
}

$scoreStr = "[".implode(",", $scores)."]";
$nameStr = "[".implode(",", $names)."]";
?>

    
    
    
    
    <script type="text/javascript">

        $(document).ready(function(){
        $.jqplot.config.enablePlugins = true;
        var s1 = <?php echo $scoreStr;?>;
        var ticks = <?php echo $nameStr;?>;
         
        plot1 = $.jqplot('chart1', [s1], {
            // Only animate if we're not using excanvas (not in IE 7 or IE 8)..
            animate: !$.jqplot.use_excanvas,
            seriesDefaults:{
                renderer:$.jqplot.BarRenderer,
                pointLabels: { show: true }
            },
            axes: {
                xaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer,
                    ticks: ticks
                }
            },
            highlighter: { show: false }
        });
     
        $('#chart1').bind('jqplotDataClick',
            function (ev, seriesIndex, pointIndex, data) {
                $('#info1').html('series: '+seriesIndex+', point: '+pointIndex+', data: '+data);
            }
        );
        });
    </script>
    


<!-- Page content -->
      <div id="page-content-wrapper">
        <div class="content-header">
          <h1>
            <a id="menu-toggle" href="#" class="btn btn-default"><i class="icon-reorder"></i></a>
            Performance Chart
          </h1>
        </div>
        
        <div id="chart1" style="margin-top:20px; margin-left:20px; width:700px; height:300px;"></div>      
    </div>


<?php include("footer.php");?>
