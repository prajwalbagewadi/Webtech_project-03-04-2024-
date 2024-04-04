<?php


// m = month y=year
$firstDayOfMonth=date("1-m-y");
//echo "$firstDayOfMonth";
/*
"t": This is a format specifier used within the date() function. 
When "t" is used as a format specifier, it returns the number of days in the given month.
*/
$totalDayOfMonth=date("t",strtotime($firstDayOfMonth));
//echo "$totalDayOfMonth";
$totalNoOfStudent;
$studentName;
$studentId;
$currentDate;
$tempDate;
//db connection
include_once "config.php";

$sql_qr1="select count(stud_id) from Class_Sybca";
$sql_qr2="select stud_id,stud_name from Class_Sybca";
$sql_qr3="select stud_id,day(day_date),val from attendence";
$query1=mysqli_query($db,"$sql_qr1")or die("query error");
$query2=mysqli_query($db,"$sql_qr2")or die("query error");
$query3=mysqli_query($db,"$sql_qr3") or die("fetch attendence error");
// while($row=mysqli_fetch_row($query1)){
//     foreach($row as $val){
//         global $totalNoOfStudent;
//         echo "val=$val";
//         $totalNoOfStudent=$row;
//     } 
// }
while($val1=mysqli_fetch_row($query1)){
    foreach($val1 as $num){
        global $totalNoOfStudent;
        //echo "num=$num";
        $totalNoOfStudent=$num;
    }
}

//marker
$alpha;
$col;
function char_ins($c){
    return $c;
}
function marker($j){
    global $query3;
    while($row=mysqli_fetch_row($query3)){
        foreach($row as $val){
            //echo "Day-$row[1]"."<br>";
            $currentDate=(int)$row[1];
            $val=$row[2];
            //echo "cureentDate-$currentDate";
            if($currentDate==$j){
                switch($val){
                    case 'Present':
                        $alpha=char_ins('P');
                        $col=char_ins('green');
                        break;
                    case 'Absent';
                        $alpha=char_ins('A');
                        $col=char_ins('red');
                        break;
                    case 'Holiday';
                        $alpha=char_ins('H');
                        $col=char_ins('orange');
                        break;
                    case 'Permitted_leave';
                        $alpha=char_ins('L');
                        $col=char_ins('blue');
                        break;
                }
            }
        }
    }
}

echo "<h1>Student Attendence Management System:<h1>";
// F= current month
echo "<h3>Attendence for the month:<u><font color=\"red\">".date("F",strtotime($firstDayOfMonth))."</font> <font color=\"red\">".date("Y",time())."</font></u><h3>";

echo "<table border=\"1\" cellspacing=\"0\">";
    
        for($i=1;$i<=$totalNoOfStudent+2;$i++){
            
            if($i==1){
                // date loop will only execute once at $i==1 print dates
                echo "<tr>";
                echo "<td rowspan=\"2\">Id</td>";
                echo "<td rowspan=\"2\">Names</td>";
                for($j=1;$j<=$totalDayOfMonth;$j++){
                    echo "<td>$j</td>";
                }
                echo "</tr>";  
            }
            else if($i==2){
                // day loop will only execute once at $i==2 print days
                echo "<tr>";
                for($j=0;$j<$totalDayOfMonth;$j++){
                    // global $tempDate;
                    // D=day  +$j days =days to the date represented by $firstDayOfMonth
                    //$tempDate=date("D",strtotime("+$j days",strtotime("$firstDayOfMonth")));
                    echo "<td>".date("D",strtotime("+$j days",strtotime("$firstDayOfMonth")))."</td>";
                    
                }
                echo "</tr>";  
            }
            else{
                // name loop will  execute remaining times at i>2 print names
                echo "<tr>";
                if($val2=mysqli_fetch_row($query2)){
                    // foreach($val2 as $name){
                        // global $studentName,$studentId;
                        // //echo "$name";
                        // $studentName=$val2[0];
                        // $studentId=$val2[1];
                        echo "<td>$val2[0]</td>";
                        echo "<td>$val2[1]</td>";
                   // }
                } 
                for($j=1;$j<=$totalDayOfMonth;$j++){
                   
                //    global $tempDate;
                    // D=day  +$j days =days to the date represented by $firstDayOfMonth
                    //if($j)
                    if($currentDate==$j){
                        while($row=mysqli_fetch_row($query3)){
                            foreach($row as $val){
                                //echo "Day-$row[1]"."<br>";
                                $currentDate=(int)$row[1];
                                $val=$row[2];
                                //echo "cureentDate-$currentDate";
                                if($currentDate==$j){
                                    switch($val){
                                        case 'Present':
                                            $alpha=char_ins('P');
                                            $col=char_ins('green');
                                            break;
                                        case 'Absent';
                                            $alpha=char_ins('A');
                                            $col=char_ins('red');
                                            break;
                                        case 'Holiday';
                                            $alpha=char_ins('H');
                                            $col=char_ins('orange');
                                            break;
                                        case 'Permitted_leave';
                                            $alpha=char_ins('L');
                                            $col=char_ins('blue');
                                            break;
                                    }
                                }
                            }
                        }
                        echo "<td>";
                        echo "<font color=\"$col\">$alpha</font>";   
                        echo "</td>";
                    }
                    else{
                        echo "<td>";
                        echo "</td>";
                    }
                   
                }
                echo "</tr>";  
            }

        }
    
echo "</table>";


// $sql_qr3="insert into attendence (stud_id,date,attend) values("$studentId",)";

?>