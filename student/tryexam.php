<?php 


include("header.php");
$std_id = (int)$_SESSION["loginInfo"]["id"];
$eid = (int)$_REQUEST["eid"];
$db = DBSingleton::getInstance();

update_exams();

$re=(int)get_current_attempt($eid, $std_id);
if($re == -1){
    print <<<END
    <script>
        alert("ERROR: Your maximum attempt count for this Exam is over");
        window.location = "home.php";
    </script>
END;
}

$res=$db->dbSelect("exam_attempts", "eid={$eid} and std_id={$std_id} and attempt_num={$re}");
$att_id=$res[0]["id"];
$end_date = $res[0]["end_date"];
$exam=$db->dbSelect("exams", "id={$eid}");

if(count($res)==0 && $re > 0){

    $duration=explode(":",$exam[0]["duration"]);
    //$date = new DateTime();
    //$date->modify("+{$duration[0]} hours");
    //$date->modify("+{$duration[1]} minutes");
    $secs = $duration[0]*3600+$duration[1]*60;
    $date = date("Y-m-d H:i:s", time() + $secs);
    $end_date = $date;
    $db->dbInsert("exam_attempts", array(
            "eid" => $eid,
            "std_id" => $std_id,
            "start_date"=>"now()",
            "end_date"=>quote($date),
            "attempt_num" => (int) $re
    ));
    
    $res=$db->dbSelect("exam_attempts", "eid={$eid} and std_id={$std_id} and attempt_num={$re}");
    $att_id=$res[0]["id"];
}

$gid = (int)$_SESSION["loginInfo"]["stdgroup"];

$sub_id = "";
if(isset($_REQUEST["sub_id"])){
    $sub_id = (int)$_REQUEST["sub_id"];
}

$cond = "questions.id in (select qid from exam_qs where eid={$eid})";
$subjects = $db->dbSelect("questions left join subjects on(subject=subjects.id)", $cond, "subjects.id", 0, -1, array("distinct subjects.id as id, subjects.title as title") );
if($sub_id == ""){
    $sub_id = (int)$subjects[0]["id"];
}
$subject_title = "";
foreach($subjects as $sbj){
    if($sbj["id"] == $sub_id){
        $subject_title = $sbj["title"];
    }
}

$cond = "questions.id in (select qid from exam_qs where eid={$eid}) and subjects.id={$sub_id}";
$rets = $db->dbSelect("questions left join subjects on(subject=subjects.id)", $cond, "", 0, -1, array("questions.id as id", "questions.*", "subjects.title") );

foreach($rets as &$q){
    $ans = $db->dbSelect("qanswers", "qid=".($q["id"]) );
    $q["answers"] = $ans;
}

$ans = $db->dbSelect("attempt_qs join exam_attempts on(exam_attempts.id = attempt_id)", "eid={$eid} and std_id={$std_id} and attempt_id={$att_id}");
$std_ans = array();
foreach($ans as $an){
    $std_ans[$an["qid"]] = $an;
}

foreach($rets as &$q){
    $q["is_answered"] = isset($std_ans[$q["id"]]);
    $q["std_answer"] = $std_ans[$q["id"]];
}

$QS = $rets;

$ret = $db->dbSelect("exams", "id={$eid}");
$EXAM = $ret[0];

$ret=$db->dbSelect("exam_attempts", "eid={$eid} and std_id={$std_id} and attempt_num={$re}");
$start_date=$ret[0]["start_date"];

//$EXAM['start_date']

?>

    
    <script type="text/javascript">
    
    $(document).ready(function() {
	QS = 0;
	current = 0;
	
	startDate = "<?php echo $end_date ?>";
	startDate = startDate.replace(/:| /g,"-");
	var YMDhms = startDate.split("-");
        var sqlDate = new Date();
        
        duration = "<?php echo $EXAM['duration']?>";
        //dus = duration.split(':');
        dus = [0,0,0,0];
        sqlDate.setFullYear(parseInt(YMDhms[0]), parseInt(YMDhms[1])-1,
                                                 parseInt(YMDhms[2]));
        sqlDate.setHours(parseInt(YMDhms[3])+parseInt(dus[0]), parseInt(YMDhms[4])+parseInt(dus[1]), 
                                              parseInt(YMDhms[5])+parseInt(dus[2]), 0/*msValue*/);
        //alert(sqlDate);
        $('#defaultCountdown').countdown({until: sqlDate, format: 'HMS', timezone: +330});
	
	window.load = function load(id){
	    exam = <?php echo $eid;?>;
	    sub_id = <?php echo $sub_id;?>;
	    att_id=<?php echo $att_id; ?>;
	    $.post('core/questions.load.php', {exam: exam, sub_id: sub_id, att_id: att_id}, function(data){
		var json = $.parseJSON(data);
		QS = json;
		select(0);
		current = 0;
	    });
	};
	
	window.select = function select(indx){
	    if(indx>=QS.length){
	        alert("No more questions in this subject. Please go to another subject or submit the exam!");
	        return;
	    }
	    if(QS[indx].type == 0){
	        s = QS[indx].std_answer.answer;
	        if(s==-1){
	            s="";
	        }
	        html = "<textarea cols=50 rows=3 name='answer'>"+s+"</textarea>";
	    }
	    if(QS[indx].type == 1){
	        html = "";
	        for(i=0; i < QS[indx].answers.length; i++){
	            s = "";
	            if(QS[indx].std_answer.answer == i+1){
	                s = "checked";
	            }
	            html = html + "<input type='radio' name='answer' "+s+" value="+(i+1)+"> "+QS[indx]['answers'][i].body+"<br>";
	        }
	    }
	    
	    if(QS[indx].type == 2){
	        html = "";
	        for(i=0; i < QS[indx].answers.length; i++){
	            html = html + "<input type='checkbox' value="+(i+1)+" name='answer["+i+"]'> "+QS[indx]['answers'][i].body+"<br>";
	        }
	    }
	    
	    if(QS[indx].type == 3){
	        true_s = "";
	        false_s = "";
	        if(QS[indx].std_answer.answer == 0){
	            false_s = "checked";
	        }
	        if(QS[indx].std_answer.answer == 1){
	            true_s = "checked";
	        }
	        html = "<input type='radio' name='answer' value=1 "+true_s+"> True <br>" + "<input type='radio' name='answer' value=0 "+false_s+"> False";
	    }
	    
	    $('#q_form_id').html(html);
	    $('#q_body_id').html("<b>Question #"+(indx+1)+"</b><br>"+QS[indx].body);
	};
	
	load();
	
	window.goto = function goto(i){
	    current = i;
	    select(i);
	}
	
        window.next_q = function next_q(){
            goto(current+1);
        }
        
        window.save = function save(){
            currentRec = QS[current];
            qid = currentRec.id;
            eid = <?php echo $eid;?>;                   
            att_id=<?php echo $att_id; ?>;
            ser = $("#q_form_id").serialize()+ "&eid="+eid+"&qid="+qid+"&att_id="+att_id;
            
            $.post('core/answer.add.php', ser, function(data){
            
                if(data.indexOf('OK')!=-1){
                    $("#td_id_"+current).addClass("badge-info");
	            next_q();
	            return;
	        }
	        alert(data);
            });

        }
        
        window.save_next = function save_next(){
            save();
            //$("#td_id_"+current).addClass("badge-info");
            //next_q();
        }
        
        window.mark = function mark(){
            $("#td_id_"+current).addClass("badge-success");
        }
        
        window.reset = function reset(){
            currentRec = QS[current];
            qid = currentRec.id;
            eid = <?php echo $eid;?>;
            att_id=<?php echo $att_id; ?>;
            ser = $("#q_form_id").serialize()+ "&eid="+eid+"&qid="+qid+"&att_id="+att_id+"&reset=1";
            $.post('core/answer.add.php', ser, function(data){
                if(data.indexOf('OK')!=-1){
                    $("#td_id_"+current).removeClass("badge-success");
                    $("#td_id_"+current).removeClass("badge-info");
	            return;
	        }
	        alert(data);
            });
        }
        
        window.submit_exam = function submit_exam(){
            eid = <?php echo $eid;?>;
            att_id=<?php echo $att_id; ?>;
            $.post('core/exam.submit.php', {eid: eid, att_id: att_id}, function(data){
                if(data.indexOf('OK')!=-1){
                    alert("Exam submitted successfully!");
                    window.location = "home.php";
	            return;
	        }
	        alert(data);
            });
        }
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
                    
                    
                    
                        <ul class="nav nav-pills">
                            <?php
                                foreach($subjects as $sbj){
                                    $id = $sbj["id"];
                                    $title = $sbj["title"];
                                    $class = $id == $sub_id ? "active" : "";
                                    print "
                                     <li class='{$class}' >
                                        <a  href='tryexam.php?eid={$eid}&sub_id={$id}'>{$title} </a>
                                    </li>";
                                }
                            ?>
                        </ul> 
    
                        <br>
                    
                    
                    
                        <p class="" id="q_body_id">
                            This is exam text
                        </p>
                        <form id="q_form_id">
                            <textarea rows="3" cols=50></textarea><br/> <br />
                        </form>
                        <br>
                            <button class="btn btn" onclick="next_q();"> Skip </button>
                            <button class="btn btn-primary" onclick="save_next()"> Save & Next </button>
                            <button class="btn btn-success" onclick="mark()"> Mark for Review </button>
                            <button class="btn btn-danger" onclick="reset()"> Reset</button>
                            
                            
                        
                        
                        <!--ul class="pager">
                                <li class="previous">
                                    <a href="#">&larr; Previous</a>
                                </li>
                                <li class="next">
                                        <a href="#">Next &rarr;</a>
                                </li>
                        </ul -->
                    </div>
                    
                    <div class="col-md-5">
                    
                    <div class="row">
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-10 well">
                        <div id="defaultCountdown"></div>
                    </div>
                    </div>
                    
                    <div class="row">
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-10 well">
                    You are viewing <b> <?php echo $subject_title; ?> </b> section. <br>
                    Question Palette: <br><br>
                <table>
                <?php
                    $N = 5;
                    $tr_count = (int)(count($QS)/$N);
                    if((count($QS)/$N) % $N == 0){
                        $tr_count += 1;
                    }
                    
                    for($i=0; $i < $tr_count; $i++){
                            print '<tr style="border: 3px solid white;">';
                            foreach(array(1,2,3,4,5) as $j){
                                $num = $i*$N + $j;
                                if($num > count($QS)){
                                    break;
                                }
                                $goto = $num - 1;
                                $state = "";
                                if($QS[$goto]["is_answered"]){
                                    $state = " badge-info";
                                }
                                print <<<END
                                <td class="badge{$state}" style="width:40px;height:30px;line-height:20px;" onclick="goto({$goto})" id="td_id_{$goto}"> 
                                     {$num}
                                </td>
END;
                            }
                            print "</tr>";
                    }
                ?>
                </table>
                        
                        <br><br>
                        <b>Legend: </b><br><br>
                        <table>
                            <tr>
                                <td class="badge" style="width:40px;height:30px;line-height:20px;"> 
                                    
                                </td>
                                <td style="padding-left: 20px;">
                                    No Answer
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="badge badge-success" style="width:40px;height:30px;line-height:20px;"> 
                                    
                                </td>
                                <td style="padding-left: 20px;">
                                    Marked for review
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="badge badge-info" style="width:40px;height:30px;line-height:20px;"> 
                                    
                                </td>
                                <td style="padding-left: 20px;">
                                    Answered
                                </td>
                            </tr>
                        </table> <br>
                        
                        <div width=100% align="center">
                        <button onclick="submit_exam()" class="btn btn-primary"> Submit the Exam </button>
                        </div>
                        
                    </div>
                    </div>
                </div>
                    
                    
                    
            </div>
          
          </div>
        </div>
      </div>
      
    </div>


<?php include("footer.php");?>
