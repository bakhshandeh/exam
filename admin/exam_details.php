<?php 
    include("header.php");

    $id = (int)$_REQUEST["id"];
    $exam = loadExam($id);
?>


<script src="js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" charset="utf-8">

    tinymce.init({
    selector: "textarea",
    theme: "modern",
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor moxiemanager"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    toolbar2: "print preview media | forecolor backcolor emoticons",
    image_advtab: true,
    templates: [
        {title: 'Test template 1', content: 'Test 1'},
        {title: 'Test template 2', content: 'Test 2'}
    ]
    });
</script>

<script type="text/javascript" charset="utf-8">
                        var selectedId = 0;
                        
                        function RefreshTable(table, urlData){
                              $.getJSON(urlData, null, function( json ){
                                    oSettings = table.fnSettings();
                                    table.fnClearTable(this);
                                    for (var i=0; i<json.aaData.length; i++){
                                        table.oApi._fnAddData(oSettings, json.aaData[i]);
                                    }
                                    oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
                                    table.fnDraw();
                                    
                                    $(".delfromexam").bind("click", function(event){
                                                        var q = $(this).attr('q');
                                                        var exam = $(this).attr('exam');
                                                        var target_row = $(this).closest("tr").get(0);
                                                        var del = 1;
                                                        $.post("core/add_exam_question.php", {q: q, exam: exam, del: del}, function(data){
                                                            var aPos = examTable.fnGetPosition(target_row); 
                                                            examTable.fnDeleteRow(aPos);
                                                        });
                                    });
                            });
                        }
                        
                        
			$(document).ready(function() {
			
			        
			        $('#exams_li').addClass('active');
			       
			        $('#start_date').datetimepicker();
			        $('#end_date').datetimepicker();
			        
			        $('#edit_start_date').datetimepicker();
			        $('#edit_end_date').datetimepicker();
			        
			        examTable = $('#example').dataTable({
				    "sAjaxSource": "core/questions.load.php?exam=<?php echo $id;?>",
                                    "bProcessing": true,
                                    "aoColumnDefs": [ 
                                        {
                                            "aTargets": [7], 
                                            "sType": "html", 
                                            "fnRender": function(o, val) {
                                                return "<a class='delfromexam' q="+o.aData[7]+" exam="+<?php echo $id;?>+"> Delete </a>";
                                            } 
                                        }
                                    ],
                                    "fnInitComplete": function(oSettings, json) {
                                                $(".delfromexam").bind("click", function(event){
                                                        var q = $(this).attr('q');
                                                        var exam = $(this).attr('exam');
                                                        var target_row = $(this).closest("tr").get(0);
                                                        var del = 1;
                                                        $.post("core/add_exam_question.php", {q: q, exam: exam, del: del}, function(data){
                                                            var aPos = examTable.fnGetPosition(target_row); 
                                                            examTable.fnDeleteRow(aPos);
                                                            //RefreshTable(examTable, "core/questions.load.php?exam=<?php echo $id;?>");
                                                        });
                                                });
                                    }
                                });
                                
                                allTable = $('#all_qs_table').dataTable({
				    "sAjaxSource": "core/questions.load.php?exam=<?php echo $id;?>&no_exam=1",
                                    "bProcessing": true,
                                    "aoColumnDefs": [ 
                                        {
                                            "aTargets": [7], 
                                            "sType": "html", 
                                            "fnRender": function(o, val) {
                                                //return "<a href=\"javascript:addToExam(this,"+ o.aData[7]+", <?php echo $id;?>)\"> Add to Exam </a>";
                                                return "<a class='addqtoexam' q="+o.aData[7]+" exam="+<?php echo $id;?>+"> Add to Exam </a>";
                                            }
                                        }
                                    ],
                                    "fnInitComplete": function(oSettings, json) {
                                                //alert("hi");
                                                $('#my_tab a:first').tab('show');
                                                
                                                $(".addqtoexam").bind("click", function(event){
                                                        var q = $(this).attr('q');
                                                        var exam = $(this).attr('exam');
                                                        var target_row = $(this).closest("tr").get(0);
                                                        $.post("core/add_exam_question.php", {q: q, exam: exam}, function(data){
                                                            var aPos = allTable.fnGetPosition(target_row); 
                                                            allTable.fnDeleteRow(aPos);
                                                            RefreshTable(examTable, "core/questions.load.php?exam=<?php echo $id;?>");
                                                        });
                                                });
                                    }
                                });

                                $('#example_length label').css("width", "200px");
                                $('#example_length select').addClass('form-control');


                                $('#example_filter input').addClass('form-control');
                                $('#example_filter input').css("width", "200px");
                                
                                $('#all_qs_table_length label').css("width", "200px");
                                $('#all_qs_table_length select').addClass('form-control');


                                $('#all_qs_table_filter input').addClass('form-control');
                                $('#all_qs_table_filter input').css("width", "200px");
			});
			
			function submitQForm(id){
			    tinymce.triggerSave();
			    url = "core/exam.add.php";
			    $.post(url, $('#'+id).serialize(), function(data){
			        //alert("hi");
			        document.location = "exams.php";
			    });
			    $('#myModal').modal('hide');
			}
			
			function editOnClick(id){
			    selectedId = id;
			    
			    //Load Data
			    $.post("core/exams.load.php", {id: selectedId}, function(data){
			        //alert("edit");
			        var json = $.parseJSON(data);
			        $.each(json, function(k,v){
			            $('#edit_'+k).val(v);
			        });
			        tinyMCE.activeEditor.setContent(json.insts);
			        if(json.declare_results == 1){
			            $("#edit_declare_results").prop("checked", true);
			        }
			        if(json.details == 1){
			            $("#edit_details").prop("checked", true);
			        }
			        $("#edit_modal").modal();
			    });
			    
			}
			
			function editExam(){
			    $.post("core/exam.add.php", $('#edit_subform').serialize(), function(data){
			        document.location = "exams.php";
			    });
			    $('#myModal').modal('hide');
			}
			
			function addStdGroup(){
			    id = $('#stdgroup_id').val();
			    del = 0;
			    eid = <?php echo $id;?>;
			    $.post("core/exam_details.php", {del:del, id: id, eid: eid}, function(data){
			        document.location = "exam_details.php?id=<?php echo $id;?>";
			    });
			}
			
			function delStdGroup(){
			    ids = $('#groups_multi').val();
			    del = 1;
			    
			    $.post("core/exam_details.php", {del:del, id: ids}, function(data){
			        document.location = "exam_details.php?id=<?php echo $id;?>";
			    });
			}
			
			
		</script>

<div class="container">

<br/>
<br/>

<h4>Exams -> Exam Details -> <?php echo $exam['name']."(".$exam['start_date'].")";?> </h4>
<hr>

<h5>Student Groups</h5>


<form id="add_subject_form" role="form" style="width:400px">
                <div class="form-group">
                    <select multiple="multiple" class="form-control" name="stdgroup" id="groups_multi">
                        <?php echo examStdgroupOptions($id);?>
                    </select>
                </div>
          <button data-dismiss="modal" class="btn btn-danger" type="button" onclick="delStdGroup();">
            Deleted selected groups
          </button>
          <a data-toggle="modal" href="#stdg_modal" class="btn btn-primary">Add New</a>
          
    <div class="modal fade" id="stdg_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        
        <div class="modal-body">
                <div class="form-group">
                    <select class="form-control" name="stdgroup" id="stdgroup_id">
                            <?php echo stdgroupOptions();?>
                    </select>
                </div>
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="addStdGroup();">Add</button>
        </div>
      
      </div><!-- /.modal-content' -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
</form>

<hr>




<ul class="nav nav-tabs" id="my_tab">
                <li><a href="#exam_qs" data-toggle="tab">Exam Questions</a></li>
                <li><a href="#all_qs" data-toggle="tab">Add new Questions</a></li>
</ul>


<div class="tab-content">
        
    <div class="tab-pane active" id="exam_qs">
        <h3> List of current exam Questions</h3>
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
	<thead>
		<tr>
			<th>#</th>
			<th>Subject</th>
			<th>TYpe</th>
			<th>Body of Question</th>
			<th>Difficulty Level</th>
			<th>Marks</th>
			<th>Hint/Explanation</th>
			<th>Actions</th>
		</tr>
	</thead>
        </table>
    </div>
    
    <div class="tab-pane active" id="all_qs">
        <h3> Add new Questions to exam </h3>
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="all_qs_table">
	<thead>
		<tr>
		        <th>#</th>
			<th>Subject</th>
			<th>TYpe</th>
			<th>Body of Question</th>
			<th>Difficulty Level</th>
			<th>Marks</th>
			<th>Hint/Explanation</th>
			<th>Actions</th>
		</tr>
	</thead>
        </table>
    </div>

</div>



</div>

<?php include("footer.php");?>
