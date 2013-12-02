<?php 

include("header.php");

$db = DBSingleton::getInstance();
$att_id = (int)$_REQUEST["att_id"];

$ret = $db->dbSelect("attempt_qs join questions on(qid=questions.id)", "attempt_id={$att_id} and questions.diff_level='Normal'");
$easy = count($ret);

$ret = $db->dbSelect("attempt_qs join questions on(qid=questions.id)", "attempt_id={$att_id} and questions.diff_level='Medium'");
$med = count($ret);

$ret = $db->dbSelect("attempt_qs join questions on(qid=questions.id)", "attempt_id={$att_id} and questions.diff_level='Hard'");
$hard = count($ret);
//var_dump($student);exit(0);

$l = "[[['Easy Questions', {$easy}], ['Medium Question', {$med}], ['Hard Questions', {$hard}]]]";
?>


<script type="text/javascript" charset="utf-8">    
    
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
                            
                            
                            
                            
                            <script>
$(document).ready(function() {

//  $.post("core/std_exam_chart.php", function(data){
//    var json = $.parseJSON(data);
    //alert(json.l);
    
    l = <?php echo $l;?>;
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
   // });
});

</script>


                            <div id="chart1_qs" style="width:600px; height:250px;float: right;"></div>

                            <center>

                            
                            
                            
                            
                            
                            
                            
                    </div>
                    </div>
                    
          </div>
        </div>
    
    

<?php include("footer.php");?>
