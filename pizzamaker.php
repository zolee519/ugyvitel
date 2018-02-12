<?php
	$sql = "SELECT * FROM prilog ORDER BY prilog_id asc";
	$pizzamaker = mysqli_query($connection, $sql);
	$prilozi = mysqli_num_rows($pizzamaker);
	echo'
		<script type="text/javascript">
		window.onload = function DisableButton(){
			document.getElementById("undo").disabled = true;
		}
		 const ALLPRILOG ='.$prilozi.'; ';
		echo 'var undo = []; ';
		for($i=1;$i<=$prilozi;$i++)
		{
			echo 'undo['.$i.'] = "empty"; ';
		}
		echo 'var undocount = 0; 
		var exists = 0;
		var loading = false;

		var price = 150;

		var prices = {';
		while ($row = mysqli_fetch_array($pizzamaker))
		{
			if($row['prilog_id'] == $prilozi)
			{
				echo $row['prilog_id'].':'.$row['prilog_price'].'}; ';
			}
			else
			{
				echo $row['prilog_id'].':'.$row['prilog_price'].',';
			}
		};

        echo 'var flag = true;

		function allowDrop(ev) 
		{
		    ev.preventDefault();
		}

		function drag(ev) 
		{
		    ev.dataTransfer.setData("text", ev.target.id);
		}

		function drop(ev) 
		{
			if( typeof(ev) == "object")
			{
				ev.preventDefault();
			    var data = ev.dataTransfer.getData("text");
			}
			else
			{
				var data = ev;
			}
		    if(1 < data < ALLPRILOG)
		    {
		    	for(var i = 0; i<=ALLPRILOG; i++)
		    	{
		    		if(data == undo[i])
		    		{
		    			exists = 1;
		    			break;
		    		}
		    	}

		    	if(exists == 0)
		    	{
		    		document.getElementById(data + "1").style.visibility = "visible";
		    		document.getElementById(data).style.opacity = "1";
		    		document.getElementById("undo").disabled = false;

		    		price = price + prices[data];
		    		var newvalue = document.getElementById("quantity").value;
					document.getElementById("showprice").innerHTML = newvalue * price + " Din";

					if(undocount <= ALLPRILOG)
			    	{
					    undo[undocount] = data;
					    undocount++;
			    	}
		    	}
		    	else
		    	{
		    		alert("You already added that one!");
		    		exists = 0;
		    	}
		    }
		    updateAddedText();		    
		}

		function undoFunction()
		{
			if(undocount != 0 && undo[undocount-1] != "empty")
			{
				document.getElementById(undo[undocount-1] + "1").style.visibility = "hidden";
		    	document.getElementById(undo[undocount-1]).style.opacity = "0.5";
		    	price = price - prices[undo[undocount-1]];
		    	var newvalue = document.getElementById("quantity").value;
				document.getElementById("showprice").innerHTML =newvalue * price + " Din";
		    	undo[undocount-1] = "empty";
		    	undocount--;

		    	if(undocount == 0)
		    	{
		    		document.getElementById("undo").disabled = true;
		    	}
			}
			updateAddedText();
		}

		function updateAddedText()
		{
			var addedprilog = " ";
			for(var i = 0; i<=ALLPRILOG; i++)
			{
				if(undo[i] != "empty")
				{
					addedprilog = addedprilog + " " + undo[i];
				}
			}
			if(undocount == 0)
			{
				document.getElementById("added").innerHTML = "Added: (nothing yet)";
			}
			else
			{
				document.getElementById("added").innerHTML = "Added:" + addedprilog;
			}
		}

		function changeQuantity()
		{
			var newvalue = document.getElementById("quantity").value;
			document.getElementById("showprice").innerHTML = newvalue * price + " Din";
		}

		function SaveOrder()
		{
			var prilog = document.getElementById("added");
			var name = document.getElementById("savename").value;
        	var flag = true;

        	if(prilog.innerHTML == "Added:")
        	{
	            alert("There is nothing in your pizza!");
	            flag = false;
        	}

        	if(name == "" || name < 3 || undocount < 3)
        	{
	            alert("You must give it a name longer than 3 character and it must be least 3 things on your pizza!");
	            flag = false;
        	}

			if(flag)
        	{
            	var xmlhttp;
            	if(window.XMLHttpRequest)
            	{
                	xmlhttp = new XMLHttpRequest();
            	}
            	else
            	{
                	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            	}

            	xmlhttp.onreadystatechange = function()
            	{
                	if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
                	{
                    	var text = xmlhttp.responseText;
                    	alert(text);
                	}
            	}
            	xmlhttp.open("POST","save_order.php",true);
            	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                xmlhttp.send("name="+name+"&prilog="+prilog.innerHTML);

			}
		}

		function SendOrder()
		{
			var prilog = document.getElementById("added");
	        var quantity = document.getElementById("quantity");
        	var flag = true;

        	if(prilog.innerHTML == "Added:")
        	{
	            alert("There is nothing in your pizza!");
	            flag = false;
        	}

        	if(document.getElementById("added").innerHTML == "Added: (nothing yet)" || undocount < 3)
			{
				alert("Sorry, but your pizza is empty or there is less than 3 things on it.");
				flag = false; 
			}

			if(flag)
        	{
            	var xmlhttp;
            	if(window.XMLHttpRequest)
            	{
                	xmlhttp = new XMLHttpRequest();
            	}
            	else
            	{
                	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            	}

            	xmlhttp.onreadystatechange = function()
            	{
                	if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
                	{
                    	var text = xmlhttp.responseText;
                    	alert(text);
                	}
            	}
            	xmlhttp.open("POST","insert_order.php",true);
            	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                xmlhttp.send("prilog="+prilog.innerHTML+"&quantity="+quantity.value+"&price="+price*quantity.value);

			}
		}

		function LoadPizza()
		{
			var loading = true;
			var selected = document.getElementById("pizzaload").value;

			var xmlhttp;
			if(window.XMLHttpRequest)
			{
				xmlhttp = new XMLHttpRequest();
			}
			else
			{
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}

			xmlhttp.onreadystatechange = function()
			{
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
				{
					var text = xmlhttp.responseText;
					LoadPizzaFunc(text);
				}
			}
			xmlhttp.open("POST","pizzaload.php",true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("selected="+selected);

		}

		function LoadPizzaFunc(x)
		{
			x = x.slice( 1 );
			var y = x.split(" ");
			var y_length = y.length;
			
			while(undocount != 0)
			{
				undoFunction();
			}

			for(var i = 0; i<y_length; i++)
			{
				drop(y[i]);
			}
			loading = false;
		}
	</script>';

?>