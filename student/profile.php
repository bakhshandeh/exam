
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
            <div class="col-md-8">
              
              
              
              
              
              
              <form id="edit_form" role="form" class="well">
                <input type="hidden" id="edit_id" name="id" value="8">
                
                <div class="form-group">
                <div class="row">
                    <div class="col-lg-8">
                        Email: <input type="text" name="email" placeholder="Email" id="edit_email" class="form-control">
                    </div>
                    
                    <div class="col-lg-4">
                        Student Group: 
                        <select id="edit_stdgroup" name="stdgroup" class="form-control">
                            <option value="1">Test</option><option value="2">Test 3</option><option value="3">test1</option>
                        </select>
                    </div>
                </div>
                </div>
                
                <div class="form-group">
                <div class="row">
                    <div class="col-lg-4">
                        Name: <input type="text" name="name" id="edit_name" placeholder="Name" class="form-control">
                    </div>
                    <div class="col-lg-4">
                        Password: <input type="text" name="pass" id="edit_pass" placeholder="Password" class="form-control">
                    </div>
                    <div class="col-lg-4">
                        Mobile: <input type="text" name="mobile" id="edit_mobile" placeholder="Mobile" class="form-control">
                    </div>
                </div>
                </div>
                
                
                <div class="form-group">
                <div class="row">
                    <div class="col-lg-4">
                        Country: <input type="text" name="country" id="edit_country" placeholder="Country" class="form-control">
                    </div>
                    <div class="col-lg-4">
                        Area: <input type="text" name="area" id="edit_area" placeholder="Area" class="form-control">
                    </div>
                    <div class="col-lg-4">
                        City: <input type="text" name="city" id="edit_city" placeholder="City" class="form-control">
                    </div>
                </div>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Address: </label>
                    <input type="text" name="address" placeholder="address" id="edit_address" class="form-control">
                </div>
                
                
                <div class="form-group">
                <div class="row">
                    <div class="col-lg-4">
                        Phone: <input type="text" name="phone" id="edit_phone" placeholder="Phone" class="form-control">
                    </div>
                    <div class="col-lg-4">
                        Alternate Phone: <input type="text" name="alt_phone" id="edit_alt_phone" placeholder="Alternate Phone" class="form-control">
                    </div>
                    <div class="col-lg-4">
                        Guardian Phone: <input type="text" name="parent_phone" id="edit_parent_phone" placeholder="Guardian Phone" class="form-control">
                    </div>
                </div>
                </div>
                
                <div class="form-group">
                <div class="row">
                    <div class="col-lg-4">
                        Roll Number: <input type="text" name="roll_number" id="edit_roll_number" placeholder="Roll Number" class="form-control">
                    </div>
                    <div class="col-lg-4">
                        Enrolment Number : <input type="text" name="enrol_number" id="edit_enrol_number" placeholder="" class="form-control">
                    </div>
                    <div class="col-lg-4">
                        Status:
                        <select id="edit_status" name="status" class="form-control">
                                <option value="0">Active</option>
                                <option value="1">Pending</option>
                                <option value="2">Suspended</option>
                        </select>
                    </div>
                </div>
                </div>
                
                
                <div class="form-group">
                    <label for="exampleInputEmail1">Comments: </label>
                    <input type="text" name="comments" placeholder="Comments" id="edit_comments" class="form-control">
                </div>
                
                <button onclick="editSubject();" class="btn btn-primary" type="button">Update Profile Details</button>
            </form>
              
              
              
              
              
              
              
              
              
              
              
              
              
              
            </div>
          </div>
        </div>
      </div>
      
    </div>


<?php include("footer.php");?>
