<?php

include 'Mobile_Detect.php';

date_default_timezone_set('Asia/Hong_Kong');
session_start();

ini_set('memory_limit', '1024M');
//ini_set('session.gc_maxlifetime', 7200);
                                
$now = date("Y-m-d H:i:s");
$ip = $_SERVER['REMOTE_ADDR'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //$_POST['staffid'] = strtoupper($_POST['staffid']);
    $id = $_POST['staffid'];
    $password = hash('sha256',$_POST['password']);  
    $type = "";
    //$secret_key = "6LfLmg0eAAAAALy6FOWLkshRE5axTtd8n5xYXNR-";
    $secret_key = "6LdKyw4eAAAAACLTFC7p3Y2Qz-M-q56fnjryPkXX";
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=".$secret_key."&response=".$_POST["recaptcha"]."&remoteip=".$_SERVER["REMOTE_ADDR"];
    $row = json_decode(file_get_contents($url), true);
    if ($row["success"] == "true") {
        $grecaptcha = "true";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    //$_POST['staffid'] = strtoupper($_POST['staffid']);
    $id = $_GET['staffid'];
    $password = $_GET['password'];  
    $type = $_GET["type"];
    $grecaptcha = "true";
}

$serverName = "10.1.1.47, 1433";
$connectionInfo = array( "Database"=>"hr_lg", "UID"=>"hr_lg", "PWD"=>"hr_lg392", "CharacterSet"  => 'UTF-8');
$newconn = sqlsrv_connect( $serverName, $connectionInfo);

$conn = mysqli_connect("10.1.1.202","system","system","pn");
mysqli_query($conn, 'SET NAMES utf8');
//$ip = $_SERVER['REMOTE_ADDR'];

if ($id == "" or $password == "") {
    echo "space";
} else {
    if( $newconn ) {
        //$select = "select * from login where staff_id = '".$id."'";
        $select = "select * from login where staff_id = (?)";
        $param = array($id);
        $query = sqlsrv_query($newconn, $select, $param);
        if ($query !== NULL) {  
            $rows = sqlsrv_has_rows( $query );  
            if ($rows === true) {
                while( $row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC) ) {   
                    if ($row["password"] == $password && $row["staff_id"] == $id && $grecaptcha == "true") {
                        $select2 = "Select nickname,surname,first_name,chi_name,grading,position,convert(varchar(10),join_date,23) as 'join_date',convert(varchar(10),join_date,23) as 'probation_end_date',convert(varchar(10),last_employment_date,23) as 'last_employment_date',team,gender,supervisor,working_days,att_bonus,holi_bonus,meal_allow,kpi from staff_list where staff_id = '".$id."' and valid_status = 'Y'"; 
                        $query2 = sqlsrv_query($newconn, $select2);
                        //$update = "update login set times = times + 1, last_time = '".$now."' where staff_id = '".$id."'";
                        //$query3 = sqlsrv_query($newconn, $update);
                        $row2 = sqlsrv_fetch_array($query2, SQLSRV_FETCH_ASSOC);
                            
                        $_SESSION["chi_name"] = $row2["chi_name"];
                        $_SESSION["eng_name"] = $row2["nickname"] . " " . $row2["surname"];
                        $_SESSION["nickname"] = $row2["nickname"];
                        $_SESSION["grading"] = $row2["grading"];
                        $_SESSION["position"] = $row2["position"];
                        $_SESSION["join_date"] = $row2["join_date"];
                        $_SESSION["probation"] = $row2["probation_end_date"];
                        $_SESSION["team"] = $row2["team"];
                        $_SESSION["gender"] = $row2["gender"];
                        $_SESSION["supervisor"] = $row2["supervisor"];
                        $_SESSION["att_bonus"] = $row2["att_bonus"];
                        $_SESSION["holi_bonus"] = $row2["holi_bonus"];
                        $_SESSION["meal_allow"] = $row2["meal_allow"];
                        $_SESSION["pnlevelname"] = "使用者";
                        $_SESSION["department"] = "LG";
                        $_SESSION["kpi"] = $row2["kpi"];
                        $_SESSION["last_employment_date"] = $row2["last_employment_date"];
                        $_SESSION["first_name"] = $row2["first_name"];
                        $_SESSION["surname"] = $row2["surname"];

                        if ($row2["working_days"] == 'ALT6') {
                            $_SESSION["working_days"] = '一週5.5天工作';
                        } elseif ($row2["working_days"] == '6') {
                            $_SESSION["working_days"] = '一週6天工作';
                        } elseif ($row2["working_days"] == '5') {
                            $_SESSION["working_days"] = '一週5.5天工作';
                        } else {
                            $_SESSION["working_days"] = 'Part-time';
                        }

                        $_SESSION['success'] = '1';  
                        
                        $detect = new Mobile_Detect();

                        if ($detect->isMobile()){
                            $device = 'mobile';
                        } else {
                            $device = 'desktop';
                        }

                        $insert_record = sqlsrv_query($newconn, "insert into login_record values ('".$id."','".$ip."','".$now."','".$device."')");

                        $update = "update login set times = times + 1, last_time = '".$now."' where staff_id = '".$id."'";
                        $query3 = sqlsrv_query($newconn, $update);

                        $_SESSION["level"] = $row["level"];

                        $pnac = mysqli_query($conn, "select * from account where staff_id = '".$id."'") or die("Failed to query database ".mysqli_connect_error());
                        $row3 = mysqli_fetch_array($pnac);

                        $pnlevel = $row3['level'];
                        $pnname = $row3['name'];
                        $pnlocation = $row3['location'];
                        $pntimes = $row3['times']+1;
                        $pnlasttime = $row3['lasttime'];
                        $pnjob = $row3['job'];
                        $pnnow = date('Y-m-d H:i:s');
                        $pnaddress = $row3['address'];
                        $pnphone = $row3['phone'];

                        if ($pnlevel == "1") {
                            $pnlevelname = "管理員";
                        } else if ($pnlevel == "2") {
                            $pnlevelname = "主管";
                        } else if ($pnlevel == "3") {
                            $pnlevelname = "使用者";
                        } else if ($pnlevel == "5") {
                            $pnlevelname = "店鋪";
                        } else if ($pnlevel == "4") {
                            $pnlevelname = "Office";
                        } else {
                            $pnlevelname = "使用者(特別功能)";
                        }

                        /*$_SESSION['pnstaffid'] = $id;
                        $_SESSION['pnlevel'] = $pnlevel;
                        $_SESSION['pnlevelname'] = $pnlevelname;
                        $_SESSION['pnname'] = $pnname;
                        $_SESSION['pnlocation'] = $pnlocation;
                        $_SESSION['pnlasttime'] = $pnlasttime;
                        $_SESSION['pntimes'] = $pntimes;
                        $_SESSION['pnjob'] = $pnjob;
                        $_SESSION['pnphone'] = $pnphone;
                        $_SESSION['pnaddress'] = $pnaddress;
                        $_SESSION['success'] = 1;
                        $pnrecord = mysqli_query($conn, "update account set lasttime = '".$pnnow."' , times = '".$pntimes."', ip = '".$ip."' where staff_id = '".$id."'");


                        /*$_SESSION["hrname"] = '萬浩賢';
                        $_SESSION['hrstaffid'] = '21332';
                        $_SESSION["hrlevel"] = '1';
                        $_SESSION["hrteam"] = 'System Team'*/

                        $_SESSION["mainid"] = $id;

                        if ($type == "approve") {
                            header('Location: http://lg.sasa.com/hrms/leave_approve');
                        } elseif ($type == "attendance") { 
                            header('Location: http://lg.sasa.com/hrms/attendance_approve');
                        } else {
                            echo "success";
                        }
                    } else {
                        echo "fail";
                    }
                }
            } else {
                $result = mysqli_query($conn, "select * from account where staff_id = '".$id."'") or die("Failed to query database ".mysqli_connect_error());
                $other_row = mysqli_fetch_array($result);

                if ($other_row["password"] == $_POST['password']) {
                    $level = $other_row['level'];
                    $times = $other_row['times'] + 1;
                    $_SESSION["chi_name"]  = $other_row['name'];
                    $_SESSION["mainid"] = $other_row["staff_id"];
                    //$pnlocation = $row['location'];
                    //$pnlasttime = $row['lasttime'];
                    //$pnjob = $row['job'];
                    $now = date('Y-m-d H:i:s');
                    $_SESSION['pnaddress'] = $other_row['address'];
                    //$pnphone = $row['phone'];
        
                    if ($level == "1") {
                        $pnlevelname = "管理員";
                    } else if ($level == "2") {
                        $pnlevelname = "主管";
                    } else if ($level == "3") {
                        $pnlevelname = "使用者";
                    } else if ($level == "5") {
                        $pnlevelname = "店鋪";
                    } else if ($level == "4") {
                        $pnlevelname = "Office";
                    } else {
                        $pnlevelname = "使用者(特別功能)";
                    }
        
                    $_SESSION["pnlevelname"] = $pnlevelname;
                    $_SESSION["level"] = $level;
                    $_SESSION["department"] = $other_row["location"];
                    $_SESSION["grading"] = '';
                    $_SESSION["position"] = '';
                    $_SESSION["join_date"] = '';
        
                    $update_time = mysqli_query($conn, "update account set lasttime = '".$now."' , times = '".$times."', ip = '".$ip."' where staff_id = '".$id."'");
        
                    echo "success";
                } else {
                    echo "fail";
                }
            } 
        }  
    }   
}
//} else {
//echo "
//<script>
//alert('該帳號已在其他地方登錄,請注意!');
//window.location.href='login';
//</script>";
//exit();
//}


?>