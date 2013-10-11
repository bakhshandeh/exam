
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
			        //$('#subjects_li').addClass('active');
				
				$('#example').dataTable({
				    "sAjaxSource": "core/questions.load.php?type=1",
                                    "bProcessing": true,
                                    "aoColumnDefs": [ 
                                        {
                                            "aTargets": [7], 
                                            "sType": "html", 
                                            "fnRender": function(o, val) {
                                                return "<a href=\"javascript:delRecord('questions', "+ o.aData[7]+", 'questions.php?type=1')\"> Delete </a> \
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
			        ////alert(data);
			        document.location = "questions.php?type=1";
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
			        tinyMCE.get("edit_body").setContent(json.body);
			        //alert("here");
			        //$("#edit_answers_div").empty();
			        true_answer = 0;
			        $.each(json.ans, function(k,v){
			            //alert(k+1);
			           //$.each(v, function(k,v){
			                //addNew("edit_", "value="+v.body, v.is_true == "1" ? "checked" : "");
			            //});
			            if(v.is_true == "1"){
			                $("#edit_correct"+(k+1)).prop("checked", true);
			            }
			            indx = "edit_answer"+(k+1);
			            tinyMCE.get(indx).setContent(v.body);
			            //$("#edit_answer"+(k+1)).val(v.body);
			        });
			        //$("#edit_correct"+true_answer).prop("checked", true);
			        //addNew("edit_");
			        $("#edit_modal").modal();
			    });
			    
			}
			
			function editSubjectiveQ(){
			    //alert("gu");
			    tinymce.triggerSave();
			    $.post("core/question.add.php", $('#edit_subform').serialize(), function(data){
			        //alert(data);
			        document.location = "questions.php?type=1";
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
<a data-toggle="modal" href="#myModal" class="btn btn-success">Add New Objective Question</a>

<?php

function answerTab($i, $prefix){

    return <<<END
        <div class="tab-pane" id="{$prefix}op{$i}">
                <div class="form-group">
                    <label for="exampleInputEmail1">Answer #{$i}: </label>
                    <textarea name="answer{$i}" id="{$prefix}answer{$i}"></textarea>
                    <div class="radio">
                        <label>
                            <input type="radio" name="true_answer" id="{$prefix}correct{$i}" value="{$i}">
                            
                            Correct answer
                        </label>
                    </div>
                </div>
        </div>
END;
}

function showModal($name = "myModal" , $edit = false){
    $prefix = $edit ? "edit_" : "";
    $formName = $prefix."subform";
    $title = $edit ? "Edit/View Objective Question" : "Add New Objective Question";
    $onclick = $edit ? "editSubjectiveQ();": "submitQForm('{$formName}');";
    
    $subjectOptions = subjectOptions();
    $answers = "";
    foreach(array(1,2,3,4) as $ind){
        $answers = $answers.answerTab($ind, $prefix);
    }
    
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
            
            <ul class="nav nav-tabs">
                <li><a href="#{$prefix}question" data-toggle="tab">Question</a></li>
                <li><a href="#{$prefix}op1" data-toggle="tab">Answer 1</a></li>
                <li><a href="#{$prefix}op2" data-toggle="tab">Answer 2</a></li>
                <li><a href="#{$prefix}op3" data-toggle="tab">Answer 3</a></li>
                <li><a href="#{$prefix}op4" data-toggle="tab">Answer 4</a></li>
            </ul>

            
        <div class="tab-content">
            <div class="tab-pane active" id="{$prefix}question">
                <input type="hidden" name="id" id="{$prefix}id">
                <input type="hidden" name="type" value=1>
                
                <div class="form-group">
                    <label for="exampleInputEmail1">Question: </label>
                    <textarea name="body" id="{$prefix}body"></textarea>
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
                
                <!--div class="form-group" id="{$prefix}answers_div">
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
                
                </div-->
            </div>
            
            
            
            {$answers}
            
            
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

