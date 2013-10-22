
<?php 

include("header.php");
$gid = (int)$_SESSION["loginInfo"]["stdgroup"];
$db = DBSingleton::getInstance();

$eid = (int)$_REQUEST["eid"];

?>

    
    <script type="text/javascript">

    jQuery(document).ready(function(){
        $('#home_li').addClass('active');
    });
    
    </script>
    


    <!-- Page content -->
      <div id="page-content-wrapper">
        <div class="content-header">
          <h1>
            <a id="menu-toggle" href="#" class="btn btn-default"><i class="icon-reorder"></i></a>
          </h1>
        </div>
        <!-- Keep all page content within the page-content inset div! -->
        <div class="page-content inset">
            
            <div class="row">
                    
                    <div class="col-md-6 well" >
                        <p class="">
                            This is exam text
                        </p>
                        <form>
                            <textarea rows="3" cols=50></textarea><br/> <br />
                            <button class="btn btn-primary"> Submit</button>
                        </form>
                        
                        <ul class="pager">
                                <li class="previous">
                                    <a href="#">&larr; Previous</a>
                                </li>
                                <li class="next">
                                        <a href="#">Next &rarr;</a>
                                </li>
                        </ul>
                    </div>
                    
                    
                    
                    
                    <div class="col-md-6">
                        <table>
                            <tr style="border: 3px solid white;">
                                <td class="badge" style="width:40px;height:30px;line-height:20px;"> 
                                     1
                                </td>
                                <td  class="badge" style="width:40px;height:30px;line-height:20px;"> 
                                     2
                                </td>
                                <td class="badge" style="width:40px;height:30px;line-height:20px;"> 
                                     3
                                </td>
                                <td class="badge" style="width:40px;height:30px;line-height:20px;"> 
                                     4
                                </td>
                            </tr>
                            
                            <tr style="border: 3px solid white;">
                                <td class="badge" style="width:40px;height:30px;line-height:20px;"> 
                                     5
                                </td>
                                <td class="badge" style="width:40px;height:30px;line-height:20px;"> 
                                     6
                                </td>
                                <td class="badge" style="width:40px;height:30px;line-height:20px;"> 
                                     7
                                </td>
                                <td class="badge" style="width:40px;height:30px;line-height:20px;"> 
                                     8
                                </td>
                            </tr>
                            
                            <tr style="border: 3px solid white;">
                                <td class="badge badge-important" style="width:40px;height:30px;line-height:20px;"> 
                                     1
                                </td>
                                <td  class="badge badge-important" style="width:40px;height:30px;line-height:20px;"> 
                                     2
                                </td>
                                <td class="badge badge-important" style="width:40px;height:30px;line-height:20px;"> 
                                     3
                                </td>
                                <td class="badge badge-important" style="width:40px;height:30px;line-height:20px;"> 
                                     4
                                </td>
                            </tr>
                            
                            <tr style="border: 3px solid white;">
                                <td class="badge" style="width:40px;height:30px;line-height:20px;"> 
                                     5
                                </td>
                                <td class="badge" style="width:40px;height:30px;line-height:20px;"> 
                                     6
                                </td>
                                <td class="badge" style="width:40px;height:30px;line-height:20px;"> 
                                     7
                                </td>
                                <td class="badge" style="width:40px;height:30px;line-height:20px;"> 
                                     8
                                </td>
                            </tr>
                        </table>
                    </div>
                    
                    
                    
                    
            </div>
          
          </div>
        </div>
      </div>
      
    </div>


<?php include("footer.php");?>
