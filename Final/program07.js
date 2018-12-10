function runSelect()
{
	var serverRequest;
	
	if(window.XMLHttpRequest)
	{
		 serverRequest = new XMLHttpRequest();
	
		//What to do when it talks back
		serverRequest.onreadystatechange = function()
		{
			if(serverRequest.readyState == 4 && serverRequest.status == 200)
			{
			   document.getElementById("test").innerHTML = serverRequest.responseText + "<br />";
			}
		}
		
		//Start talking is_session_cookie_set()
		serverRequest.open("POST", "functions07.php?", true);
		serverRequest.send();
	}
}

function choice(product_id)
{

	var serverRequest;
	
	if(window.XMLHttpRequest)
	{
		 serverRequest = new XMLHttpRequest();
	
		//What to do when it talks back
		serverRequest.onreadystatechange = function()
		{
			if(serverRequest.readyState == 4 && serverRequest.status == 200)
			{
			   document.getElementById("test").innerHTML = serverRequest.responseText + "<br />";
			}
		}
		
		//Start talking is_session_cookie_set()
		//	document.getElementById("test").innerHTML ="<br /> the id gotten is " + product_id;
		
		
		
		serverRequest.open("GET", "functions07.php?product_id="+product_id, true);
		serverRequest.send();
	}
}

