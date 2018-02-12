
		window.onload = function DisableButton(){
			document.getElementById("undo").disabled = true;
		}

		const ALLPRILOG = 6;
		var undo = [];
		undo[0] = "empty";
		undo[1] = "empty";
		undo[2] = "empty";
		undo[3] = "empty";
		undo[4] = "empty";
		undo[5] = "empty";
		undo[6] = "empty";
		var undocount = 0;
		var exists = 0;

		var price = 150;

		var prices = {
			1:30,
			2:50,
			3:50,
			4:40,
			5:20,
			6:20
		};

        var flag = true;

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
		    ev.preventDefault();
		    var data = ev.dataTransfer.getData("text");
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

		function SendOrder()
		{
			var prilog = document.getElementById('added');
			var firstname = document.getElementById('firstname');
	        var lastname = document.getElementById('lastname');
	        var adress = document.getElementById('adress');
	        var phone = document.getElementById('phone');
	        var email = document.getElementById('email');
	        var quantity = document.getElementById('quantity');

	        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

        	var flag = true;

        	if(prilog.innerHTML == "Added:")
        	{
	            alert("There is nothing in your pizza!");
	            flag = false;
        	}

        	if(firstname.value.trim().length < 1)
        	{
	            firstname.style.border = "solid red 2px";
	            flag = false;
        	}
        	else if(firstname.value.trim().length < 3)
        	{
	            firstname.style.border = "solid red 2px";
	            flag = false;
        	}
        	else
        	{
            	firstname.style.border="solid #a9a9a9 1px";
        	}

        	if(lastname.value.trim().length < 1)
        	{
	            lastname.style.border = "solid red 2px";
	            flag = false;
        	}
        	else if(lastname.value.trim().length < 3)
        	{
	            lastname.style.border = "solid red 2px";
	            flag = false;
        	}
        	else
        	{
            	lastname.style.border="solid #a9a9a9 1px";
        	}

        	if(adress.value.trim().length < 1)
        	{
	            adress.style.border = "solid red 2px";
	            flag = false;
        	}
        	else if(adress.value.trim().length < 8)
        	{
	            adress.style.border = "solid red 2px";
	            flag = false;
        	}
        	else
        	{
            	adress.style.border="solid #a9a9a9 1px";
        	}

        	if(phone.value.trim().length < 6)
        	{
       			phone.style.border="solid red 2px";
            	flag = false;
        	}
        	else
        	{
       			phone.style.border="solid #a9a9a9 1px";
        	}

        	if(re.test(email.value.trim()))
        	{
		        email.value.trim().length < 1
	            email.style.border="solid #a9a9a9 1px";
        	}
        	else if(email.value.trim().length < 1)
        	{
	            email.style.border="solid red 2px";
	            flag = false;
        	}
        	else
        	{
	            email.style.border="solid red 2px";
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
                xmlhttp.send("prilog="+prilog.innerHTML+"&firstname="+firstname.value+"&lastname="+lastname.value+"&adress="+adress.value+"&phone="+phone.value+"&email="+email.value+"&quantity="+quantity.value+"&price="+price*quantity.value);

		}
	}