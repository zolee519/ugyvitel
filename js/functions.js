function DeliverOrder()
{
	var order_id = document.getElementById("order_id").value;
	var worker_id = document.getElementById("worker_id").value;

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