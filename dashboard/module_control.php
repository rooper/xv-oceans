<!-- USAGE
call the url with the following attributes using GET:
actuate = int sensor_number
range_low = int low
range_high = int high
source = string hostname
name = string actuator name
eg. module_control.php?actuate=0&range_low=0&range_high=180&source=http://169.254.63.189/&name=servo
	for a servo ranged 0-180 on http://169.254.63.189/
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>
    Module Control </title>
    <link rel="stylesheet" href="jquery-ui-1.8.20.css" />
    <script src="jquery-1.8.3.js"></script>
    <script src="jquery-ui.js"></script>
     <script>
	   
	   $(document).ready(function(){
	   xmlhttp=new XMLHttpRequest();
	   
	   $(function() {
			$( "#slider" ).slider({
				range: "min",
				min: <?php echo $_GET['range_low'];?>,
				max: <?php echo $_GET['range_high'];?>,
				value: 60,
				slide: function( event, ui ) {
					$( "#amount" ).val( ui.value );
				
				}	
			} 
				
		);		
				
			
			
			$( "#amount" ).val(($( "#slider" ).slider( "value" ) ));
			
			});	
	
	});
	
    </script>
</head>
<body>
<h2><?php echo $_GET['name'];?></h2>
<div id="slider"></div>
<label for="amount">Value: </label>
<input type="text" id="amount" style="border: 0; color: #f6931f; font-weight: bold;" />
<br>
<button id="button">Fire</button>

<script>
$( "#button" ).click( function() {
				
					//make AJAX request to host?actuate=0,90% when slider is changed
					//value of slider is $( "#slider" ).slider( "value" )
					//alert("button fired");
					var num = $( "#slider" ).slider( "value" );
					num = num*1.6;
					//<?php echo $_GET['range_low'];?>
					
					//<?php echo $_GET['range_high'];?>
					
					var req = "<?php echo $_GET['source'];?>?actuate=<?php echo $_GET['actuate'];?>,"+num+"%";
					
					//alert(req);
					xmlhttp.open("GET",req,true);
					xmlhttp.send();
					});
</script>
</body>
</html>
