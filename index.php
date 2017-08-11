<!DOCTYPE html>

    <head><title>Delegator</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <link  href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
 
 
  <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>       
               
  
        <?php
		    $cookie_name = "username";
			require_once("model/db_config.php");
			$query = new DBOperations();
            if ( !isset($_COOKIE[$cookie_name]) )
			{
             
			  echo '<script type="text/javascript">			
					var WinNetwork = new ActiveXObject("WScript.Network");
					document.cookie = "username="+WinNetwork.UserName+"";
					</script>	
				   ';
		      		   
			}
			else{
				
				$sql="select ul_id from tb_userlist where ul_username ='".$_COOKIE['username']."'";
				$query->executeQuery($sql);
				if (!($query->result->num_rows > 0)){
				$sql="insert into tb_userlist (ul_username) values('".$_COOKIE['username']."')";
				$query->executeQuery($sql);
					
				}
				
			}
				
		?>
    <script>
		function getCookie(cname) {
			var name = cname + "=";
			var decodedCookie = decodeURIComponent(document.cookie);
			var ca = decodedCookie.split(';');
			for(var i = 0; i <ca.length; i++) {
					var c = ca[i];
					while (c.charAt(0) == ' ') {
						c = c.substring(1);
					}
					if (c.indexOf(name) == 0) {
						return c.substring(name.length, c.length);
					}
			}
			return "";
		}
  </script>  

  <style>
    a:hover, a:focus { text-decoration: none;}
  </style>
  
</head>
    
<body >
	<div id="header" style=" ">
			<nav class="navbar navbar-default">
		  <div class="container-fluid" style=" background: linear-gradient(to right, #BCE544, #A8EC46); box-shadow: 8px 8px 4px #aaaaaa;" >
			<div class="navbar-header">
			    
			    <a class="navbar-brand" href="#">
				 <span class="glyphicon glyphicon-th-large">  Delegator</span> 
				</a>
				
			</div>
			<ul class="nav navbar-nav navbar-center">
			</ul>
			<ul class="nav navbar-nav navbar-right">
			  <li><a><span class="glyphicon glyphicon-user"> </span> 
			    <script type="text/javascript">
					var x = getCookie("username");
					document.write(x); 
					
					
				</script>
				</a>
			  </li>
			  
			</ul>
		  </div>
		</nav>
	</div>
	<a href="#" >

	 <?php
					require_once("model/db_config.php");
					$query = new DBOperations();
					$cookie_name="username";

					if ( isset($_COOKIE[$cookie_name]) ) 
					{
						echo '						
						<div  name ="assignedToOthers" style="margin: 0 auto; width:90%;">
						<h4 class="text-muted">Tasks assigned To Others</h4>
						<table class="table table-hover table-sm table-bordered nowrap" id="table1">
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
								  ';
								  
						$sql = " SELECT t.t_id,s.ul_username ,t.work_description ,t.status , t.comments 
								from  tb_tasks t inner join tb_userlist f on t.from_id = f.ul_id  
								inner join tb_userlist s on t.to_id = s.ul_id
								where f.ul_username = '".$_COOKIE['username']."'";
						$query->executeQuery($sql);
							
								  
							if ($query->result->num_rows > 0) {
								// output data of each row
								$i=1;
								echo '<tbody>';
								while($row = $query->result->fetch_assoc()) {
									
								echo "<tr><td>".$i."</td>
								<td >" .$row['ul_username']. " </td>
								<td >" .$row['work_description']. "</td>
								<td >" .$row['status']. "</td> 
								<td >" .$row['comments']."  </td>  <td > <span class='glyphicon glyphicon-edit'></span></td>
								<td style='display:none;'>".$row['t_id']."</td> 
								</tr> ";
								
								$i = $i + 1;				
									}
									
								echo "</tbody>";  
							}
							else {
								echo " </table>";
							}		
						
						
						echo '</table> <span id ="addNewTask"><span class="glyphicon glyphicon-plus"></span> Add new task  <span> </div> 
         
							<br> <hr> <br> <div name="assignedByMe" style="margin: 0 auto; width:90%;">
							<h4 class="text-muted">Tasks assigned To Me</h4> 
						    <table class="table table-hover table-sm table-bordered" id="table2">
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
								  ';
						
						
						$sql = " SELECT t.t_id ,s.ul_username ,t.work_description ,t.status , t.comments 
								from  tb_tasks t inner join tb_userlist f on t.to_id = f.ul_id  
								inner join tb_userlist s on t.from_id = s.ul_id
								where f.ul_username = '".$_COOKIE['username']."'";
						$query->executeQuery($sql);
							
								  
							if ($query->result->num_rows > 0) {
								// output data of each row
								echo '<tbody> <tr>';
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
									
							    echo "</tbody>"; 	
							}
							else {
								echo "</table>";
							}
							
						echo'</table></div>';				
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





?>

	
	
	</a>
	<script type="text/javascript">
	  	
		$(document).ready(function() {
		
		//$.ajaxSetup({ cache: false });
		
		//setInterval( function(){ A(); },2000 );	
		
		$('#addNewTask').click(function(e) {  
        $('#DescModal3').modal("show");
		});
		
        $('#table1').DataTable( {
        "paging":   false,
        "ordering": true,
        "info":     false
    } );

	    $('#table2').DataTable( {
        "paging":   false,
        "ordering": true,
        "info":     false
    } );

	    
		
	   $('#table1').on('click', 'tr', function () {
        var name = $('td', this).eq(1).text();
		var work = $('td', this).eq(2).text();
		var status = $('td', this).eq(3).text();
		var comments = $('td', this).eq(4).text();
		var tid = $('td', this).eq(6).text();
		
		
		
		$("select option").filter(function() {
		//may want to use $.trim in here
		return $(this).text().trim() == status.trim(); 
		}).prop('selected', true);
		
		$('#tid1').val(tid);
		$('#InputEmail1').val(name);
		$('#TextWork1').val(work);
		$('#TextComment1').val(comments);
        $('#DescModal1').modal("show");
    });
	
	
		$('#table2').on('click', 'tr', function () {
        var name = $('td', this).eq(1).text();
		var work = $('td', this).eq(2).text();
		var status = $('td', this).eq(3).text();
		var comments = $('td', this).eq(4).text();
		var tid = $('td', this).eq(6).text();
		
		
		
		$("select option").filter(function() {
		//may want to use $.trim in here
		return $(this).text().trim() == status.trim(); 
		}).prop('selected', true);
		
		$('#tid2').val(tid);
		$('#InputEmail2').val(name);
		$('#TextWork2').val(work);
		$('#TextComment2').val(comments);
        $('#DescModal2').modal("show");
		$('#InputEmail2').prop('readonly', true);
		$('#TextWork2').prop('readonly', true);
    });	

		
		} );
         
		function A(){
			$('#tableDisplay').load("table1Load.php?" + new Date().getTime()) ;
		} 

	
     </script>	

	
<div class="modal fade" id="DescModal1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <span class="glyphicon glyphicon-remove"></span></button>
                 <h3 class="modal-title">Edit the task</h3>

            </div>
            <div class="modal-body">
					<form action="#" method="post">
						  <div class="form-group">
						    <input type="text" id='tid1' name="tid1"  style="visibility:hidden;position:absolute;"> 
							
							<label for="exampleInputEmail1">To</label>
							<input type="text" class="form-control" id="InputEmail1" name="to_username" placeholder="Enter Infosys id ">
							
						  </div>
						  <div class="form-group">
							<label for="exampleTextarea">Work</label>
							<textarea class="form-control" name="work_description" id="TextWork1" rows="3"></textarea>
						  </div>		
						 
						 
						  <div class="form-group">
							<label for="exampleSelect1">Status</label>
							<select class="form-control" id="exampleSelect1" name= "status">
							  <option>Yet to Start</option>
							  <option>Work In Progress</option>
							  <option>On Hold</option>
							  <option>Completed</option>
							</select>
						  </div>
						  
						  
						  <div class="form-group">
							<label for="exampleTextarea">Comments</label>
							<textarea class="form-control" id="TextComment1" rows="3" name ="comments"></textarea>
						  </div>
						  
						  
						  <button type="submit" name="update1" class="btn btn-primary">Update</button>
						</form> 
            </div>
            <div class="modal-footer">
                
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



<!-------------------------for second modal pop up below table------------------------------> 


<div class="modal fade" id="DescModal2" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <span class="glyphicon glyphicon-remove"></span></button>
                 <h3 class="modal-title">Edit the task</h3>

            </div>
            <div class="modal-body">
					<form action="#" method="post">
						  <div class="form-group">
						    <input type="text" id='tid2' name="tid2"  style="visibility:hidden;position:absolute;"> 
							
							<label for="exampleInputEmail2">From</label>
							<input type="text" class="form-control" id="InputEmail2" name="to_username" placeholder="Enter Infosys id ">
							
						  </div>
						  <div class="form-group">
							<label for="exampleTextarea">Work</label>
							<textarea class="form-control" name="work_description" id="TextWork2" rows="3" > </textarea>
						  </div>		
						 
						 
						  <div class="form-group">
							<label for="exampleSelect2">Status</label>
							<select class="form-control" id="exampleSelect2" name= "status">
							  <option>Yet to Start</option>
							  <option>Work In Progress</option>
							  <option>On Hold</option>
							  <option>Completed</option>
							</select>
						  </div>
						  
						  
						  <div class="form-group">
							<label for="exampleTextarea">Comments</label>
							<textarea class="form-control" id="TextComment2" rows="3" name ="comments"></textarea>
						  </div>
						  
						  
						  <button type="submit" name="update2" class="btn btn-primary">Update</button>
						</form> 
            </div>
            <div class="modal-footer">
                
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



<!-------------------------for third modal pop up for adding new task ------------------------------> 

<div class="modal fade" id="DescModal3" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <span class="glyphicon glyphicon-remove"></span></button>
                 <h3 class="modal-title">Add New Task</h3>

            </div>
            <div class="modal-body">
					<form action="#" method="post">
						  <div class="form-group">
						    <input type="text" id='tid3' name="tid3"  style="visibility:hidden;position:absolute;"> 
							
							<label for="exampleInputEmail3">To</label>
							<input type="text" class="form-control" id="InputEmail3" name="to_username" placeholder="Enter Infosys id ">
							
						  </div>
						  <div class="form-group">
							<label for="exampleTextarea">Work</label>
							<textarea class="form-control" name="work_description" id="TextWork3" rows="3" > </textarea>
						  </div>		
						 
						 
						  <div class="form-group">
							<label for="exampleSelect3">Status</label>
							<select class="form-control" id="exampleSelect3" name= "status">
							  <option>Yet to Start</option>
							  <option>Work In Progress</option>
							  <option>On Hold</option>
							  <option>Completed</option>
							</select>
						  </div>
						  
						  
						  <div class="form-group">
							<label for="exampleTextarea">Comments</label>
							<textarea class="form-control" id="TextComment3" rows="3" name ="comments"></textarea>
						  </div>
						  
						  
						  <button type="submit" name="addTask" class="btn btn-primary">Add</button>
						</form> 
            </div>
            <div class="modal-footer">
                
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<!------------------------------------------------------------------------------------------------------------->


<?php
      if (isset($_POST['update1'])){
		  
		 $sql = "Update tb_tasks set work_description='".$_POST['work_description']."' , status='".$_POST['status']."' ,  comments='".$_POST['comments']."' where t_id =".$_POST['tid1']."";
		 $query->executeQuery($sql); 
		 $ADMIN_URL = "http://10.76.50.17:8080/delegator";
		 echo("<script>location.href = '".$ADMIN_URL."';</script>");
		 
	  }
	  if (isset($_POST['update2'])){
		 $sql = "Update tb_tasks set status='".$_POST['status']."' ,  comments='".$_POST['comments']."' where t_id =".$_POST['tid2']."";
		 $query->executeQuery($sql); 
		 $ADMIN_URL = "http://10.76.50.17:8080/delegator";
		 
		 echo("<script>location.href = '".$ADMIN_URL."';</script>");
		  
	  }
	  if (isset($_POST['addTask'])) {
		 
		 $sql = "select ul_id from tb_userlist where ul_username='".$_COOKIE['username']."'";
		 $query->executeQuery($sql);
		 if ($query->result->num_rows > 0) {
			
			while($row = $query->result->fetch_assoc())
			{
              $from_id = $row['ul_id'];
			  break;
			}		
	     }
		 
		 $sql = "select ul_id from tb_userlist where ul_username='".$_POST['to_username']."'";
		 $query->executeQuery($sql);
		 if ($query->result->num_rows > 0) {
			
			while($row = $query->result->fetch_assoc())
			{
              $to_id = $row['ul_id'];
              break;
			}		
	     }
		 else
		 {
			 echo'wrong infosys id';
		 }
		 
		 $sql = "INSERT INTO tb_tasks( from_id, to_id, work_description, status, comments) VALUES ( '".$from_id."' , '".$to_id."' , '".$_POST['work_description']."' , '".$_POST['status']."' ,'".$_POST['comments']."' ) ";
		 $query->executeQuery($sql);
		 
		 $ADMIN_URL = "http://10.76.50.17:8080/delegator";
		 
		 echo("<script>location.href = '".$ADMIN_URL."';</script>");
	  }
?>

	 
</body>	
</html>
