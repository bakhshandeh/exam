<?php include("header.php");?>

<script type="text/javascript" charset="utf-8">
                        var selectedId = 0;
                        
			$(document).ready(function() {
			         $('.multiselect').multiselect({
buttonClass: 'btn',
buttonWidth: 'auto',
buttonContainer: '<div class="btn-group" />',
maxHeight: false,
buttonText: function(options) {
if (options.length == 0) {
return 'None selected <b class="caret"></b>';
}
else if (options.length > 3) {
return options.length + ' selected <b class="caret"></b>';
}
else {
var selected = '';
options.each(function() {
selected += $(this).text() + ', ';
});
return selected.substr(0, selected.length -2) + ' <b class="caret"></b>';
}
}
});
			        //$('#subjects_li').addClass('active');
				$('#example').dataTable({
				    "sAjaxSource": "core/students.load.php",
                                    "bProcessing": true,
                                    "aoColumnDefs": [ 
                                        {
                                            "aTargets": [10], 
                                            "sType": "html", 
                                            "fnRender": function(o, val) {
                                                //alert(o);
                                                return "<a href=\"javascript:delRecord('students', "+ o.aData[10]+", 'students.php')\"> Delete </a> \
                                                | <a href='javascript:editOnClick("+o.aData[10]+");'> Edit/View </a>";
                                            } 
                                        }
                                    ]
                                });
                                $('#example_length label').css("width", "200px");
                                $('#example_length select').addClass('form-control');

                                $('#example_filter input').css("width", "200px");
			});
			
			function submit_form(fid, url){
			    $.post(url, $('#form').serialize(), function(data){
			        data=data.trim();
			        //alert(data);
			        if(data.indexOf("OK!") != -1 || data == ""){
			            document.location = "students.php";
			            return;
			        }
			        alert(data);
			    });
			    //$('#myModal').modal('hide');
			}
			
			function editOnClick(id){
			    selectedId = id;
			    
			    //Load Data
			    $.post("core/students.load.php", {id: selectedId}, function(data){
			        //alert(data);
			        var json = $.parseJSON(data);
			        $.each(json, function(k,v){
			            val = $('#edit_'+k).val(v);
			            
			        });
			        
			        el = $('#edit_stdgroup');
			        $('option', el).each(function(idx, element){
			            val = $(element).val();
			            select = -1;
			            for(i=0; i < json.gs.length; i++){
			                if(json.gs[i].g_id == val){
			                    select = val;
			                }
			            }
			            if(select != -1){
			                $(el).multiselect("select", select);
			            }else{
			                $(el).multiselect("deselect", val);
			            }
			        });
			        $(el).multiselect('refresh');
			        $("#edit_modal").modal();
			    });
			    
			}
			
			function editSubject(){
			    $.post("core/student.edit.php", $('#edit_form').serialize(), function(data){
			        if(data.indexOf("OK!") != -1 || data == ""){
			            document.location = "students.php";
			            return;
			        }
			        alert(data);
			    });
			    $('#myModal').modal('hide');
			}
		</script>




    <div class="container">



<br />
<a data-toggle="modal" href="#myModal" class="btn btn-success">Add New Student</a>

<?php

function showModal($name = "myModal" , $edit = false){
    $prefix = $edit ? "edit_" : "";
    $title = $edit ? "Edit/View Student" : "Add New Student";
    $onclick = $edit ? "editSubject();": "submit_form('add_subject_form', 'core/student.add.php');";
    $stdgroupOptions = stdgroupOptions();
    $modal = <<<END
    
    <div class="modal fade" id="{$name}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">{$title}</h4>
        </div>
        <div class="modal-body">
            
            <form role="form" id="{$prefix}form">
                <input type="hidden" name="id" id="{$prefix}id">
                
                <div class="form-group">
                <div class="row">
                    <div class="col-lg-8">
                        Email: <input type="text" class="form-control" id="{$prefix}email" placeholder="Email" name="email">
                    </div>
                    
                    <div class="col-lg-4">
                        Student Group: 
                        <select name="stdgroup[]" id="{$prefix}stdgroup" class="multiselect" multiple="multiple">
                            {$stdgroupOptions}
                        </select>
                    </div>
                </div>
                </div>
                
                <div class="form-group">
                <div class="row">
                    <div class="col-lg-4">
                        Name: <input type="text" class="form-control" placeholder="Name" id="{$prefix}name" name="name">
                    </div>
                    <div class="col-lg-4">
                        Password: <input type="text" class="form-control" placeholder="Password" id="{$prefix}pass" name="pass">
                    </div>
                    <div class="col-lg-4">
                        <!-- Mobile: <input type="text" class="form-control" placeholder="Mobile" id="{$prefix}mobile" name="mobile"--> 
                    </div>
                </div>
                </div>
                
                
                <!--div class="form-group">
                <div class="row">
                    <div class="col-lg-4">
                        Country: <input type="text" class="form-control" placeholder="Country" id="{$prefix}country" name="country">
                    </div>
                    <div class="col-lg-4">
                        Area: <input type="text" class="form-control" placeholder="Area" id="{$prefix}area" name="area">
                    </div>
                    <div class="col-lg-4">
                        City: <input type="text" class="form-control" placeholder="City" id="{$prefix}city" name="city">
                    </div>
                </div>
                </div -->

                <div class="form-group">
                    <label for="exampleInputEmail1">Address: </label>
                    <input type="text" class="form-control" id="{$prefix}address" placeholder="address" name="address">
                </div>
                
                
                <div class="form-group">
                <div class="row">
                    <div class="col-lg-4">
                        Phone: <input type="text" class="form-control" placeholder="Phone" id="{$prefix}phone" name="phone">
                    </div>
                    <div class="col-lg-4">
                        Alternate Phone: <input type="text" class="form-control" placeholder="Alternate Phone" id="{$prefix}alt_phone" name="alt_phone">
                    </div>
                    <div class="col-lg-4">
                        Guardian Phone: <input type="text" class="form-control" placeholder="Guardian Phone" id="{$prefix}parent_phone" name="parent_phone">
                    </div>
                </div>
                </div>
                
                <div class="form-group">
                <div class="row">
                    <div class="col-lg-4">
                        Enrolment Number : <input type="text" class="form-control" placeholder="" id="{$prefix}enrol_number" name="enrol_number">
                    </div>
                    <div class="col-lg-4">
                        Status:
                        <select class="form-control" name="status" id="{$prefix}status">
                                <option value="0">Active</option>
                                <option value=1>Pending</option>
                                <option value=2>Suspended</option>
                        </select>
                    </div>
                </div>
                </div>
                
                
                <div class="form-group">
                    <label for="exampleInputEmail1">Comments: </label>
                    <input type="text" class="form-control" id="{$prefix}comments" placeholder="Comments" name="comments">
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
			<th>Email</th>
			<th>Name</th>
			<th>Enrolment Number</th>
			<th>Phone</th>
			<th>Address</th>
			<th>Guardian Phone</th>
			<th>Date of Admission</th>
			<th>Status</th>
			<th>Comments</th>
			<th>Actions</th>
		</tr>
	</thead>
</table>










    </div><!-- /.container -->

<?php include("footer.php");?>
