
<!-- action="<?php echo $_SERVER['PHP_SELF'] ; ?> -->
<form method="POST">
    <input type="text" name="stud_id" placeholder="Enter Student ID"/>
    <input type="text" name="stud_name" placeholder="Enter Student Name"/>
    <input type="submit" value="Add_Student" name="submit"/>
</form>

<?php
// data from form to variable
$studentName=$_POST['stud_name'];
$studentId=$_POST['stud_id'];
// include database connection
include_once "config.php";
// query execution

// create table query 
//$sql_qr="create table Class_Sybca (stud_id int primary key,stud_name varchar(50))";
// $sql_qr="create table attendence (stud_id int primary key references Class_Sybca(stud_id),date date,attend varchar(1) check(attend in('p','a')))";
// $query4=mysqli_query($db,"$sql_qr") or die("error in sql stmt");
// insert student query 
$sql_qr2="insert into Class_Sybca (stud_id,stud_name) values ($studentId,'$studentName')";
//
$sql_qr3="select stud_id,stud_name from Class_Sybca";

//$query=mysqli_query($db,"$sql_qr") or die("error in sql stmt");
$query2=mysqli_query($db,"$sql_qr2") or die("error in sql stmt");
$query3=mysqli_query($db,"$sql_qr3") or die("error in sql stmt");

// $date=date("d-m-y");
// echo "date=$date"."<br>";

while($row=mysqli_fetch_row($query3)){
    foreach($row as $var){
        echo "record:$var"."<br>";
    }
}
?>