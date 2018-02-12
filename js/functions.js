function DeliverOrder(in_progress,order_id,worker_id)
{
	if(in_progress == 0)
	{
		alert("Can't deliver which is not in progress.")
	}

	if(in_progress == 1)
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
		xmlhttp.open("POST","deliver_order.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("order_id="+order_id+"&worker_id="+worker_id);
	}

}

function PutInProgress(in_progress,order_id,worker_id)
{
	if(in_progress == 0)
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
		xmlhttp.open("POST","inprogress_order.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("order_id="+order_id+"&worker_id="+worker_id);
	}

}