<!-- USAGE
call the url with the following attributes:
sensor = (int)
source = (string)
name = (string)
eg. graph_canvas.php?sensor=0&source=http://localhost/xv/info.html&name=light(lux)
-->

<?php
$url = "http" . (($_SERVER['SERVER_PORT']==443) ? "s://" : "://") . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//echo "<url>".$url."</url>";
$o = (parse_url($url));
//print_r($o);
$params = $o[query];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>
    Graph Canvas </title>
    <link rel="stylesheet" type="text/css" href="jquery.jqChart.css" />
    <link rel="stylesheet" type="text/css" href="jquery.jqRangeSlider.css" />
    <link rel="stylesheet" type="text/css" href="jquery-ui-1.8.20.css" />
    <script src="jquery-1.7.2.min.js" type="text/javascript"></script>
    <script src="jquery.jqChart.min.js" type="text/javascript"></script>
    <script src="jquery.jqRangeSlider.min.js" type="text/javascript"></script>
    <!--[if IE]><script lang="javascript" type="text/javascript" src="excanvas.js"></script><![endif]-->
    <style>
    	#float { position:absolute; z-index:9999; }
    	
    </style>
    <script lang="javascript" type="text/javascript">
        var data = [];
        var data_history = [];
        var h = 0;;
        <?php if (isset($_POST['data'])) {echo '
        data = window.JSON.parse("'.$_POST[data].'");
        //alert('.$_POST[data].');
       	h = data.length;
        //alert(h);
       
        data_history = data;
        ';}?>
        
        data = []; //reset it
        var yValue = 0;
        var in_data = []; 
        
       

        var i;
        
       
        for (i = 0; i < 40; i++) {
            //populate chart with initial values
            data.push([i, yValue]);
        }

        $(document).ready(function () {

            $('#jqChart').jqChart({
                title: { text: '<?php echo $_GET["name"];?>' },
                legend: { visible: false },
                series: [
                            {
                                type: 'area',
                                data: data
                            }
                        ]
            });

            updateChart();
        });

        function updateChart() {  
        	ajx = 10;          
			//ajax to get our data from the ardu's
			xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function()
			{
			  if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
				ajx=xmlhttp.responseText;
				//parse dat datum
				//alert(ajx);
				in_data = ajx.split(",")
				}
			}
			xmlhttp.open("GET","get_data.php?source=<?php echo $_GET['source'];?>",true);
			xmlhttp.send();
			
			//alert(in_data[2]);
			if (typeof in_data != 'undefined') {
			  yValue = parseInt(in_data[<?php echo $_GET['sensor'];?>]);
			}
            

            // remove the first element
            data.splice(0, 1);
            // add a new element
            data.push([i++, yValue]);
            //alert("h is"+h);
            data_history.push([h++, yValue]);

            $('#jqChart').jqChart('update');
			
            setTimeout("updateChart()", 500);
            
            
            
            $( "#button" ).click( function() {
					
				$('body').append($('<form/>')
				  .attr({'action': 'history.php', 'target':'_blank', 'method': 'post', 'id': 'replacer'})
				  .append($('<input/>')
					.attr({'type': 'hidden', 'name': 'data', 'value': window.JSON.stringify(data_history)})
				  )
				  .append($('<input/>')
					.attr({'type': 'hidden', 'name': 'params', 'value': "?<?php echo $params; ?>" })
				  )
				).find('#replacer').submit();					
			});
					
        	}
    </script>

</head>
<body>
<div id="float">
<button id="button">Access data record</button>
</div>
    <div>
        <div id="jqChart" style="width: 500px; height: 300px;">
        </div>
    </div>
</body>
</html>
