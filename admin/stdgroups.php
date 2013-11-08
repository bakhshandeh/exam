<?php include("header.php");?>

<script type="text/javascript" charset="utf-8">
                        var selectedId = 0;
                        
			$(document).ready(function() {
			        //$('#subjects_li').addClass('active');
				
				$('#example').dataTable({
				    "sAjaxSource": "core/stdgroups.load.php",
                                    "bProcessing": true,
                                    "aoColumnDefs": [ 
                                        {
                                            "aTargets": [2], 
                                            "sType": "html", 
                                            "fnRender": function(o, val) {
                                                return "<a href=\"javascript:delRecord('stdgroups', "+ o.aData[2]+", 'stdgroups.php')\"> Delete </a> \
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
			        if(data == "" || data.indexOf("OK!") != -1){
			            document.location = "stdgroups.php";
			        }else{
			            alert(data);
			        }
			    });
			    //$('#myModal').modal('hide');
			}
			
			function editOnClick(id){
			    selectedId = id;
			    $("#edit_modal").modal();
			}
			
			function editSubject(){
			    title = $("#edit_title").val();
			    //alert(title);
			    $.post("core/stdgroup.edit.php", {id: selectedId, title:title}, function(data){
			        document.location = "stdgroups.php";
			    });
			    $('#myModal').modal('hide');
			}
		</script>




    <div class="container">



<br />
<a data-toggle="modal" href="#myModal" class="btn btn-success">Add New Student Group</a>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Add New Student Group</h4>
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
          <button type="button" class="btn btn-primary" onclick="submit_form('add_subject_form', 'core/stdgroup.add.php');">Save</button>
        </div>
      
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->







<div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Edit Student Group</h4>
        </div>
        <div class="modal-body">
            
            <form role="form" id="add_subject_form">
                <div class="form-group">
                    <label for="exampleInputEmail1">Name: </label>
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
			<th>Strudent Group Name</th>
			<th>Action</th>
		</tr>
	</thead>
</table>










    </div><!-- /.container -->

<?php include("footer.php");?>
