
<script src="js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" charset="utf-8">
       //tinymce.init({selector:'textarea'});
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
			        //$('#subjects_li').addClass('active');
				
				$('#example').dataTable({
				    "sAjaxSource": "core/questions.load.php?type=3",
                                    "bProcessing": true,
                                    "aoColumnDefs": [ 
                                        {
                                            "aTargets": [7], 
                                            "sType": "html", 
                                            "fnRender": function(o, val) {
                                                return "<a href=\"javascript:delRecord('questions', "+ o.aData[7]+", 'questions.php?type=3')\"> Delete </a> \
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
			        document.location = "questions.php?type=3";
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
			        $("#edit_modal").modal();
			    });
			    
			}
			
			function editSubjectiveQ(){
			    //alert("gu");
			    $.post("core/question.add.php", $('#edit_subform').serialize(), function(data){
			        //alert(1);
			        document.location = "questions.php?type=3";
			    });
			    $('#myModal').modal('hide');
			}
		</script>





<br />
<a data-toggle="modal" href="#myModal" class="btn btn-success">Add New True/False Question</a>

<?php

function showModal($name = "myModal" , $edit = false){
    $prefix = $edit ? "edit_" : "";
    $formName = $prefix."subform";
    $title = $edit ? "Edit/View True/False Question" : "Add New True/False Question";
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
                <input type="hidden" name="type" value=3>
                
                <div class="form-group">
                    <label for="exampleInputEmail1">Question: </label>
                    <textarea name="body" id=="{$prefix}_body"></textarea>
                </div>
                
                <div class="form-group">
                <div class="row">
                    <div class="col-lg-8">
                        Subject:
                        <select class="form-control" name="subject" id="{$prefix}subject">
                        {$subjectOptions}
                        </select>
                    </div>
                    <div class="col-lg-4">
                        Answer:
                        <select class="form-control" name="answer" id="{$prefix}answer">
                                <option value="1">True</option>
                                <option value="0">False</option>
                        </select>
                    </div>
                </div>
                </div>
                
                <div class="form-group">
                    <label for="exampleInputEmail1">Hint / Explanation: </label>
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

