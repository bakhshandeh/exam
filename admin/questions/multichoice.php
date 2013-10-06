
<script src="js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" charset="utf-8">
       tinymce.init({selector:'textarea'});
</script>

<script type="text/javascript" charset="utf-8">
                        var selectedId = 0;
                        
			$(document).ready(function() {
			        //$('#subjects_li').addClass('active');
				
				$('#example').dataTable({
				    "sAjaxSource": "core/questions.load.php?type=2",
                                    "bProcessing": true,
                                    "aoColumnDefs": [ 
                                        {
                                            "aTargets": [7], 
                                            "sType": "html", 
                                            "fnRender": function(o, val) {
                                                return "<a href=\"javascript:delRecord('questions', "+ o.aData[7]+", 'questions.php?type=2')\"> Delete </a> \
                                                | <a href='javascript:editOnClick("+o.aData[7]+");'> Edit/View </a>";
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
			    url = "core/question.add.php";
			    $.post(url, $('#'+id).serialize(), function(data){
			        //alert("hi");
			        document.location = "questions.php?type=2";
			    });
			    $('#myModal').modal('hide');
			}
			
			function editOnClick(id){
			    selectedId = id;
			    
			    //Load Data
			    $.post("core/questions.load.php", {id: selectedId}, function(data){
			        //alert("edit");
			        var json = $.parseJSON(data);
			        $.each(json, function(k,v){
			            $('#edit_'+k).val(v);
			        });
			        tinyMCE.activeEditor.setContent(json.body);
			        //alert("here");
			        $("#edit_answers_div").empty();
			        $.each(json.ans, function(k,v){
			           //$.each(v, function(k,v){
			                addNew("edit_", "value="+v.body, v.is_true == "1" ? "checked" : "");
			            //});
			        });
			        addNew("edit_");
			        $("#edit_modal").modal();
			    });
			    
			}
			
			function editSubjectiveQ(){
			    //alert("gu");
			    $.post("core/question.add.php", $('#edit_subform').serialize(), function(data){
			        //alert(1);
			        document.location = "questions.php?type=2";
			    });
			    $('#myModal').modal('hide');
			}
			
			function addNew(prefix, p1="", p2=""){
			    num = 0;
			    all = 0;
                            $("[id='"+prefix+"answers']").each( function(index, el) {
                                //alert(num);
                                if(el.value == ""){
                                    num = num + 1;
                                }
                                all = all+1;
                            });
			    row = "<div class='row'>"+
                                    "<div class='col-lg-11'>" +
                                        "<input type='text' class='form-control' id='"+prefix+"answers' name='answers[]' onClick=addNew('"+prefix+"') "+p1+">"+
                                    "</div>"+
                                    "<div class='col-lg-1'>"+
                                        "<input type='checkbox' name='trues["+(all)+"]' "+p2+">"+
                                    "</div>"+
                                "</div>";
                            //rows = document.getElementById("edit_subform").getElementsByName("answers[]");
                            
                            if(num <= 2){
                                $("#"+prefix+"answers_div").append(row);
                            }
			}
		</script>





<br />
<a data-toggle="modal" href="#myModal" class="btn btn-success">Add New Multiple Choice Question</a>

<?php

function showModal($name = "myModal" , $edit = false){
    $prefix = $edit ? "edit_" : "";
    $formName = $prefix."subform";
    $title = $edit ? "Edit/View Multiple Choice Question" : "Add New Multiple Choice Question";
    $onclick = $edit ? "editSubjectiveQ();": "submitQForm('{$formName}');";
    
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
                <input type="hidden" name="type" value=2>
                
                <div class="form-group">
                    <textarea name="body" id=="{$prefix}_body"></textarea>
                </div>
                
                <div class="form-group">
                    <label for="exampleInputEmail1">Subject: </label>
                    <select class="form-control" name="subject" id="{$prefix}subject">
                        {$subjectOptions}
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="exampleInputEmail1">Hint: </label>
                    <input type="text" class="form-control" id="{$prefix}hint" placeholder="" name="hint">
                </div>
                
                <div class="form-group">
                <div class="row">
                    <div class="col-lg-4">
                        Mark: <input type="text" class="form-control" placeholder="" id="{$prefix}mark" name="mark">
                    </div>
                    <div class="col-lg-4">
                        Negative Mark: <input type="text" class="form-control" placeholder="" id="{$prefix}neg_mark" name="neg_mark">
                    </div>
                    <div class="col-lg-4">
                        Difficulty Level:
                        <select class="form-control" name="diff_level" id="{$prefix}diff_level">
                                <option value="Normal">Normal</option>
                                <option value="Medium">Medium</option>
                                <option value="Hard">Hard</option>
                        </select>
                    </div>
                </div>
                </div>
                
                <div class="form-group" id="{$prefix}answers_div">
                <div class="row">
                    <div class="col-lg-11">
                        <input type="text" class="form-control" placeholder="" id="{$prefix}answers" name="answers[]" onChange="addNew('{$prefix}')">
                    </div>
                    
                    <div class="col-lg-1">
                        <input type="checkbox" name="trues[0]">
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-11">
                        <input type="text" class="form-control" placeholder="" id="{$prefix}answers" name="answers[]" onChange="addNew('{$prefix}')">
                    </div>
                                       
                    <div class="col-lg-1">
                        <input type="checkbox" name="trues[1]">
                    </div>
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
			<th>Subject</th>
			<th>Type</th>
			<th>Body of Question</th>
			<th>Difficulty Level</th>
			<th>Marks</th>
			<th>&nbsp;&nbsp;&nbsp;&nbsp;Hint&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
			<th>Actions</th>
		</tr>
	</thead>
</table>

