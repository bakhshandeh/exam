<?php include("header.php");?>

<script type="text/javascript" charset="utf-8">
                        var selectedId = 0;
                        
			$(document).ready(function() {
			        $('#subjects_li').addClass('active');
				
				$('#example').dataTable({
				    "sAjaxSource": "core/subjects.load.php",
                                    "bProcessing": true,
                                    "aoColumnDefs": [ 
                                        {
                                            "aTargets": [2], 
                                            "sType": "html", 
                                            "fnRender": function(o, val) {
                                                return "<a href=\"javascript:delRecord('subjects', "+ o.aData[2]+", 'subjects.php')\"> Delete </a> \
                                                | <a href='javascript:editOnClick("+o.aData[2]+");'> Edit </a>";
                                            } 
                                        }
                                    ]
                                });
				
				
                                $('#example_length label').css("width", "200px");
                                $('#example_length select').addClass('form-control');


                                $('#example_filter input').addClass('form-control');
                                $('#example_filter input').css("width", "200px");
                                
                                
			});
			
			function submit_form(fid, url){
			    $.post(url, $('#'+fid).serialize(), function(data){
			        data=data.trim();
			        if(data.indexOf("OK!") == -1){
			            alert(data);
			            return;
			        }
			        document.location = "subjects.php";
			    });
			    //$('#myModal').modal('hide');
			}
			
			function editOnClick(id){
			    selectedId = id;
			    //Load Data
			    
			    $.post("core/subjects.load.php", {id: selectedId}, function(data){
			        //alert("edit");
			        var json = $.parseJSON(data);
			        $.each(json, function(k,v){
			            $('#edit_'+k).val(v);
			        });
			        $("#edit_modal").modal();
			    });
			    //$("#edit_modal").modal();
			}
			
			function editSubject(){
			    title = $("#edit_title").val();
			    //alert(title);
			    $.post("core/subject.edit.php", {id: selectedId, title:title}, function(data){
			        document.location = "subjects.php";
			    });
			    $('#myModal').modal('hide');
			}
		</script>




    <div class="container">



<br />

<a data-toggle="modal" href="#myModal" class="btn btn-success">Add New Subject</a>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Add New Subject</h4>
        </div>
        <div class="modal-body">
            
            <form role="form" id="add_subject_form">
                <div class="form-group">
                    <label for="exampleInputEmail1">Subject title: </label>
                    <input type="text" class="form-control" id="title" placeholder="Title" name="title">
                </div>
            </form>

        
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="submit_form('add_subject_form', 'core/subject.add.php');">Save</button>
        </div>
      
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->







<div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Edit Subject</h4>
        </div>
        <div class="modal-body">
            
            <form role="form" id="add_subject_form">
                <div class="form-group">
                    <label for="exampleInputEmail1">Subject title: </label>
                    <input type="text" class="form-control" id="edit_title" placeholder="Title" name="title">
                </div>
            </form>

        
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="editSubject();">Save</button>
        </div>
      
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->









<br/>
<br/>

<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
	<thead>
		<tr>
			<th>Row #</th>
			<th>Subject Title</th>
			<th>Action</th>
		</tr>
	</thead>
</table>










    </div><!-- /.container -->

<?php include("footer.php");?>
