<?php
$s = $_POST["search"];
$n = $_POST["name"];
$c = $_POST["Scode"];
//print("Search=$n");

$dbhost = 'localhost';
$dbuser = 'libery';
$dbpass = 'atoiyu2542';
$dbname = 'libery';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if(! $conn ){
	die('Could not connect: ' . mysqli_error());
}

$sql = "SELECT S.StudentName,S.StudentCode,BI.BookName , BR.ReturnDate
FROM book_infos BI , borrow BR ,student S
WHERE BR.BookID=BI.BookNo
AND S.StudentCode = BR.StudentCode
AND BI.BookName = '$s'";


$result = mysqli_query($conn,$sql);
?>

<form method="post" action="library.php">
    	<input type="submit" value="Home" style="width:100px;height:50px"  /><br />
</form>
<?php
if(mysqli_num_rows($result)==0){
	print("\nชื่อหนังสือที่ยืม:$s<br />");
	print("ยังไม่ถูกยืม");
	exit();
}

while($row=mysqli_fetch_assoc($result))
{

print("ชื่อผู้ยืม:");
print($row["StudentName"]);
print("<br />");
print("รหัสนิสิต:");
print($row["StudentCode"]);
print("<br />");
print("หนังสือที่ยืม:&nbsp;");
print($row["BookName"]);

if($row["ReturnDate"] != 0){
	print("<br />");
	print(" ยืมแล้ว ");

}
else if($row["ReturnDate"] == 0){
	print("<br />");
	print("  ยังไม่ส่งคืน");
}

}

?>




