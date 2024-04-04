<?php

include_once "config.php";

$sql_qr1=("Select * from Class_Sybca");
$sql_qr2=("delete from attendence");
//SELECT * FROM `Class_Sybca`
$query1=mysqli_query($db,"$sql_qr1") or die("cannot execute Query");
if($query1){
    echo "executed successful for query"."<br>";
}

//date
$currentDate=date("y-m-d");
echo "<h1>Attendence Sheet</h1><br>";
echo "<h3>DATE :<font color=\"red\"> $currentDate </font></h3><br>";
echo "<form method=\"POST\">";
echo "<table border=\"1\" cellspacing=\"0\">";
echo "<tr>";
    echo "<th>Stud_id</th>";
    echo "<th>Stud_name</th>";
    echo "<th>Present</th>";
    echo "<th>Absent</th>";
    echo "<th>Holiday</th>";
    echo "<th>Permitted_leave</th>";
echo "</tr>";
while($row=mysqli_fetch_row($query1)){
    echo "<tr>";
    echo "<td>$row[0]</td>";
    echo "<td>$row[1]</td>";
    echo "<td><input type=\"radio\" name=\"$row[0],$row[1]\" value=\"Present\"></td>";
    echo "<td><input type=\"radio\" name=\"$row[0],$row[1]\" value=\"Absent\"></td>";
    echo "<td><input type=\"radio\" name=\"$row[0],$row[1]\" value=\"Holiday\"></td>";
    echo "<td><input type=\"radio\" name=\"$row[0],$row[1]\" value=\"Permitted_leave\"></td>";
    echo "</tr>";
}
echo "</table>"."<br>";
echo "<input type=\"submit\" name=\"submit\"/>";
echo "<input type=\"submit\" name=\"reset\" value=\"reset\"/>";
echo "</form>";

?>
<?php
    if(isset($_POST['submit'])){
        $varAssoc=$_POST;
    
        foreach($varAssoc as $key=>$val){
            echo "Val=$val ";
            $name=explode(",",$key);
            print_r($name);
            $sql_qr="insert into attendence(stud_id,day_date,val) values($name[0],'$currentDate','$val')";
            $query=mysqli_query($db,"$sql_qr");
            if($query){
                echo "execution success for query<br>";
            }
        }
    }
    
 
    if(isset($_POST['reset'])){
        // echo "reset pressed <br>";
        // $sql_qr4=("delete from attendence");
        // $query2=mysqli_query($db,"$sql_qr4");
        // if($query2){
        //     echo "cleared table";
        // }
        // $varAssoc=$_POST;
        // foreach($varAssoc as $key=>$val){
        //     echo "Val=$val ";
        //     $name=explode(",",$key);
        //     print_r($name);
            $sql_qr="DELETE from attendence";
            $query=mysqli_query($db,"$sql_qr");
            if($query){
                echo "cleared table<br>";
                echo "execution success for query<br>";
                //GRANT DELETE ON your_database.* TO 'root'@'localhost';
            }
    }
?>
