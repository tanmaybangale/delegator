<!DOCTYPE html>
		<head>
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" >
		<title>Testing</title>
		  
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		   <link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

		   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



		  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>       

		</head>



<body>

<div id = "displayData">


</div>


<script type="text/javascript">


    $(document).ready(function() {
	$.ajaxSetup({ cache: false });
		
	setInterval( function(){ $('#displayData').load("loadData.php?" + new Date().getTime());  },1000 );
	
	
	
		
});

</script>

</body>



</html>
