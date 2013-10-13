<?php include("header.php");?>


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
                        
			$(document).ready(function() {
			        $('#exams_li').addClass('active');
			       
			        $('#start_date').datetimepicker();
			        $('#end_date').datetimepicker();
			        
			        $('#edit_start_date').datetimepicker();
			        $('#edit_end_date').datetimepicker();
				
				$('#example').dataTable({
				    "sAjaxSource": "core/exams.load.php",
                                    "bProcessing": true,
                                    "aoColumnDefs": [ 
                                        {
                                            "aTargets": [7], 
                                            "sType": "html", 
                                            "fnRender": function(o, val) {
                                                return "<a href=\"javascript:delRecord('exams', "+ o.aData[7]+", 'exams.php')\"> Delete </a> \
                                                | <a href='javascript:editOnClick("+o.aData[7]+");'> Edit/View </a> \
                                                | <a href='exam_details.php?id="+o.aData[7]+"'> Details </a> \
                                                ";
                                            } 
                                        }
                                    ]
                                });
				
				
                                $('#example_length label').css("width", "200px");
                                $('#example_length select').addClass('form-control');


                                $('#example_filter input').addClass('form-control');
                                $('#example_filter input').css("width", "200px");
                                
                                
			});
			
			function submitQForm(id){
			    tinymce.triggerSave();
			    url = "core/exam.add.php";
			    $.post(url, $('#'+id).serialize(), function(data){
			        //alert("hi");
			        //document.location = "exams.php";
			        document.location = "exam_details.php?id="+data;
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
		</script>

<div class="container">



<br />
<a data-toggle="modal" href="#myModal" class="btn btn-success">Add New Subjective Question</a>

<?php

function showModal($name = "myModal" , $edit = false){
    $prefix = $edit ? "edit_" : "";
    $formName = $prefix."subform";
    $title = $edit ? "Edit/View Exam" : "Add New Exam";
    $onclick = $edit ? "editExam();": "submitQForm('{$formName}');";
    
    $subjectOptions = subjectOptions();
    
    $modal = <<<END
    
    <div class="modal fade" id="{$name}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">{$title}</h4>
        </div>
        
        <div class="modal-body">
            
            <form role="form" id="{$prefix}subform">
                <input type="hidden" name="id" id="{$prefix}id">
                
                <div class="form-group">
                <div class="row">
                    <div class="col-lg-6">
                        Name: <input type="text" class="form-control" placeholder="" id="{$prefix}name" name="name">
                    </div>
                    <div class="col-lg-6">
                        Duration: <input type="text" class="form-control" placeholder="HH:mm" id="{$prefix}duration" name="duration">
                    </div>
                </div>
                </div>
                
                
                <div class="form-group">
                <div class="row">
                    <div class="col-lg-6">
                        Start Date: 
                        
                        
                            <div id="{$prefix}start_date" class="input-append date" style="z-index: 3000 !important;">
                                <nobr>
                                <input data-format="yyyy-MM-dd hh:mm" type="text" class="form-control" name="start_date"></input>
                                <span class="add-on" style="display: inline-block;">
                                    <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                                    </i>
                                    <img src="http://localhost/examapp/images/cal.png" style="width: 20px;"> </img>
                                </span>
                                </nobr>
                            </div>

                    </div>
                    
                    <div class="col-lg-6">
                    End Date:
                     <div id="{$prefix}end_date" class="input-append date" style="z-index: 3000 !important;">
                                <nobr>
                                <input data-format="yyyy-MM-dd hh:mm" type="text" class="form-control" name=end_date></input>
                                <span class="add-on" style="display: inline-block;">
                                    <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                                    </i>
                                    <img src="http://localhost/examapp/images/cal.png" style="width: 20px;"> </img>
                                </span>
                                </nobr>
                            </div>

                    </div>
                
                </div>
                </div>
                
                
                <div class="form-group">
                <div class="row">
                    <div class="col-lg-6">
                        Pass Percent %: <input type="text" class="form-control" placeholder="" id="{$prefix}pass_p" name="pass_p">
                    </div>
                    <div class="col-lg-6">
                        Negative Marks: <input type="text" class="form-control" placeholder="" id="{$prefix}neg_mark" name="neg_mark">
                    </div>
                </div>
                </div>
                
                
                
                <div class="form-group">
                    <label for="exampleInputEmail1">Instructions: </label>
                    <textarea name="insts" id=="{$prefix}insts"></textarea>
                    
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="declare_results" id="{$prefix}declare_results">
                            Don't declare results to students.
                        </label>
                    </div>
                    
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="details" id="{$prefix}details">
                            Detailed results with Question | Explanation
                        </label>
                    </div>
                </div>
                
            </form>

        
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="{$onclick}">Save</button>
        </div>
      
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
END;
print $modal;
}

showModal();

showModal("edit_modal", true);
?>


<br/>
<br/>

<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
	<thead>
		<tr>
			<th>#</th>
			<th>Exam Name</th>
			<th>Duration</th>
			<th>Start/End Dates</th>
			<th>Pass Percent %</th>
			<th>Negative Marks</th>
			<th>Instructions</th>
			<th>Actions</th>
		</tr>
	</thead>
</table>



</div>

<?php include("footer.php");?>
