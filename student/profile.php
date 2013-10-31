
<?php 

include("header.php");
$ST = $_SESSION["loginInfo"];

?>

    
    
    
    
    <script type="text/javascript">

    jQuery(document).ready(function(){
        $('#home_li').addClass('active');
    });
    
    $(document).ready(function() {
	function load(id){
	    selectedId = <?php echo (int)$ST["id"];?>;
	    $.post("../admin/core/students.load.php", {id: selectedId}, function(data){
			        var json = $.parseJSON(data);
			        $.each(json, function(k,v){
			            //alert(k+v);
			            $('#edit_'+k).val(v);
			        });
			    });
	}
	load();
    });
    
    function editProfile(){
	$.post("core/profile.edit.php", $('#edit_form').serialize(), function(data){
		alert(data);
	});
	//$('#myModal').modal('hide');
    }
    </script>
    


<!-- Page content -->
      <div id="page-content-wrapper">
        <div class="content-header">
          <h1>
            <a id="menu-toggle" href="#" class="btn btn-default"><i class="icon-reorder"></i></a>
            Profile Management
          </h1>
        </div>
        <!-- Keep all page content within the page-content inset div! -->
        <div class="page-content inset">
          <div class="row">
            <div class="col-md-6">
              
              
              
              
              
              
              <form id="edit_form" role="form" class="well">
              
                <input type="hidden" id="edit_id" name="id" value="8">
                
                <div class="form-group">
                <div class="row">
                    <div class="col-lg-6">
                        Phone: <input type="text" name="phone" placeholder="Phone" id="edit_phone" class="form-control">
                    </div>
                    
                </div>
                </div>
                
                
                
                <div class="form-group">
                <div class="row">
                    <div class="col-lg-6">
                        Password: <input type="text" name="pass" placeholder="Password" id="edit_pass" class="form-control">
                    </div>
                    
                </div>
                </div>
                
                <div class="form-group">
                <div class="row">
                    <div class="col-lg-6">
                        Enrollment Number: <input type="text" name="enrol_number" id="edit_enrol_number" class="form-control">
                    </div>
                    
                </div>
                </div>
                
                <div class="form-group">
                <div class="row">
                    <div class="col-lg-12">
                        Address: <input type="text" name="address" placeholder="Address" id="edit_address" class="form-control">
                    </div>
                    
                </div>
                </div>
                
                <button onclick="editProfile();" class="btn btn-primary" type="button">Update Profile Details</button>
            </form>
              
              
              
              
              
              
              
              
              
              
              
              
              
              
            </div>
          </div>
        </div>
      </div>
      
    </div>


<?php include("footer.php");?>
