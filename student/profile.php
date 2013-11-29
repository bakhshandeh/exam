
<?php 

include("header.php");
$ST = $_SESSION["loginInfo"];

$std_id = $ST["id"];

$db = DBSingleton::getInstance();
$gs = $db->dbSelect("std_stdgs join stdgroups on(g_id=stdgroups.id)", "std_id=".(int)$std_id);

$groups = array();
foreach($gs as $g){
    $groups[] = $g["title"];
}
$group = implode(",", $groups);

$img = $ST["profile_img"] ? $ST["profile_img"] : "def.jpg";

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
	        if (data.indexOf("Profile updated successfully!")!= -1){
	            //document.location="profile.php";
	            //return;
	        }
		alert(data);
	});
	//$('#myModal').modal('hide');
    }
    
    function edit_enable(){
        //alert("hi");
        $('#edit_phone').prop('disabled', false);
        $('#edit_alt_phone').prop('disabled', false);
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
            <div class="col-md-3">
                <img src="../uploads/<?php echo $img;?>" style="width:170ox;height: 150px;"></img>
                <br> <br><br>
                
                <form id="edit_form2" role="form" class="" method="post" enctype="multipart/form-data" action="core/profile_img.php">
                    <input type="file" name="file" size="10">
                    <br>
                    <button type="submit" class="btn btn-primary" type="button">Update picture</button>
                </form>
                
                
            </div>
            <div class="col-md-6">
              
              
              <form id="edit_form" role="form" class="well">
              
                <input type="hidden" id="edit_id" name="id" value="8">
                
                <div class="form-group">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-4">Full Name: </div>
                        <div class="col-lg-8"><b><?php echo $ST["name"];?></b></div>
                    </div>
                    
                </div>
                </div>
                
                <div class="form-group">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-4">Email:</div> 
                        <div class="col-lg-8"><b><?php echo $ST["email"];?></b></div>
                    </div>
                    
                </div>
                </div>
                
                <div class="form-group">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-4" >Candidate Groups: </div>
                        <div class="col-lg-8"><b><?php echo $group; ?> </b></div>
                    </div>
                    
                </div>
                </div>
                
                <div class="form-group">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-4" >Enrollment Number: </div>
                        <div class="col-lg-8"><b><?php echo $ST["enrol_number"];?></b></div>
                    </div>
                    
                </div>
                </div>
                
                <div class="form-group">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-4"> Phone Number:</div> 
                        <div class="col-lg-8"> <input type="text" name="phone" placeholder="Phone" id="edit_phone" class="form-control" disabled></div>
                    </div>
                    
                </div>
                </div>
                
                <div class="form-group">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-4"> Alternate Number:</div> 
                        <div class="col-lg-8"> <input type="text" name="alt_phone" placeholder="Phone" id="edit_alt_phone" class="form-control" disabled></div>
                    </div>
                    
                </div>
                </div>
                
                
                
                <!--div class="form-group">
                <div class="row">
                    <div class="col-lg-6">
                        Password: <input type="text" name="pass" placeholder="Password" id="edit_pass" class="form-control" disabled>
                    </div>
                    
                </div>
                </div -->
                
                
                
                <!--div class="form-group">
                <div class="row">
                    <div class="col-lg-12">
                        Address: <input type="text" name="address" placeholder="Address" id="edit_address" class="form-control" disabled>
                    </div>
                    
                </div>
                </div -->
                
                <div class="form-group">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-4" >Address: </div>
                        <div class="col-lg-8"><b><?php echo $ST["address"];?></b></div>
                    </div>
                    
                </div>
                </div>
                
                <div class="form-group">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-4" >Date of Admission: </div>
                        <div class="col-lg-8"><b><?php echo $ST["date"];?></b></div>
                    </div>
                    
                </div>
                </div>
                
                <button onclick="editProfile();" class="btn btn-primary" type="button">Update Profile Details</button>
                <a onclick="edit_enable();">Enable editing information</a>
            </form>
              
              
              
              
              
              
              
              
              
              
              
              
              
              
            </div>
          </div>
        </div>
      </div>
      
    </div>


<?php include("footer.php");?>
