<?php
#load data test

require_once("model/db_config.php");
$query = new DBOperations(); 

$sql = "select * from tb_userlist;";
$query->executeQuery($sql);

if ($query->result->num_rows > 0) {
// output data of each row
echo'<table> ';
while($row = $query->result->fetch_assoc()) {

echo "<tr><td>".$row['ul_id']."</td></tr>";

}

echo'</table>';
}



?>
