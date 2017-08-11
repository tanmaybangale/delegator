<?php
require_once("model/db_config.php");
$query = new DBOperations();
$cookie_name="username";
if ( isset($_COOKIE[$cookie_name]) ) 
						{
						echo '						
						<div  name ="assignedToOthers" style="margin: 0 auto; width:90%;">
						<h4 class="text-muted">Tasks assigned To Others</h4>'; 
							
						
						$sql = " SELECT t.t_id,s.ul_username ,t.work_description ,t.status , t.comments 
								from  tb_tasks t inner join tb_userlist f on t.from_id = f.ul_id  
								inner join tb_userlist s on t.to_id = s.ul_id
								where f.ul_username = '".$_COOKIE['username']."'";
						$query->executeQuery($sql);
							echo '<table class="table table-hover table-sm table-bordered nowrap" id="table1">
								   <thead class="thead-inverse">
									<tr>
									  <th class ="col-xs-0">#</th>
									  <th class ="col-xs-2">To</th>
									  <th class ="col-xs-4">Work</th>
									  <th class ="col-xs-1">Status</th>
									  <th class ="col-xs-4">Comments</th>
									  <th class ="col-xs-0">  </th>
									  <th class ="col-xs-0" style="display:none;">  </th>
									  
									</tr>
								  </thead>
								  <tbody><tr> ';
								  
							if ($query->result->num_rows > 0) {
								// output data of each row
								$i=1;
								while($row = $query->result->fetch_assoc()) {
									
								echo "<td >".$i."</td>
								<td >" .$row['ul_username']. " </td>
								<td >" .$row['work_description']. "</td>
								<td >" .$row['status']. "</td> 
								<td >" .$row['comments']."  </td>  <td > <span class='glyphicon glyphicon-edit'></span></td>
								<td style='display:none;'>".$row['t_id']."</td> 
								</tr> ";
								
								$i = $i + 1;				
									}
									
								  
							}		
						echo "</tbody></table>"; 
						
						echo ' <span id ="addNewTask"><span class="glyphicon glyphicon-plus"></span> Add new task  <span> </div> ';
	
							
						echo' <br> <hr> <br> <div name="assignedByMe" style="margin: 0 auto; width:90%;">
							<h4 class="text-muted">Tasks assigned To Me</h4>'; 
						
						
						
						$sql = " SELECT t.t_id ,s.ul_username ,t.work_description ,t.status , t.comments 
								from  tb_tasks t inner join tb_userlist f on t.to_id = f.ul_id  
								inner join tb_userlist s on t.from_id = s.ul_id
								where f.ul_username = '".$_COOKIE['username']."'";
						$query->executeQuery($sql);
							echo '<table class="table table-hover table-sm table-bordered" id="table2">
								   <thead class="thead-inverse">
									<tr>
									  <th class ="col-xs-0">#</th>
									  <th class ="col-xs-2">From</th>
									  <th class ="col-xs-4">Work</th>
									  <th class ="col-xs-1">Status</th>
									  <th class ="col-xs-4">Comments</th>
									  <th class ="col-xs-0">  </th>
									  <th class ="col-xs-0" style="display:none;">  </th>
									</tr>
								  </thead>
								  <tbody> ';
								  
							if ($query->result->num_rows > 0) {
								// output data of each row
								$i=1;
								while($row = $query->result->fetch_assoc()) {
									
								echo "<td>".$i."</td> <td>" . 
											 $row['ul_username']. " </td> <td>".
											 $row['work_description']. "</td> <td> " . 
											 $row['status']. "</td> <td>".
											 $row['comments']."  </td> <td> <span class='glyphicon glyphicon-edit'></span>  </td>
											 <td style='display:none;'>".$row['t_id']."</td>	
											 </tr>";
								$i = $i + 1;				
									}
									
								
							}
							echo "</tbody></table>"; 
						 echo'</div>';				
						}
						else
						{
							echo '   <div>
							         <img src="images/yoga_dude_final.gif" alt="Do Yoga">
									 
							         <script> document.write(" Breath In ,  Breath Out .....In.....Out"); 
									 setTimeout(function () { location.reload(); }, 6000);
									 </script> 
									 
								     </div>	 
							     ';
						}

echo'

	


';



?>