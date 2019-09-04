function addtocart(obj,pid)
{
	if (window.XMLHttpRequest) 
    {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();

    } 
	else 
    {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200)
        {	
        	console.log(this.responseText);
        	document.getElementById('cart_count').innerText=this.responseText;
        	obj.innerText="Added to cart";
        	obj.setAttribute("disabled","disabled");
            
        }
    }

    xmlhttp.open("GET","addtocart.php?id="+pid,true);
    xmlhttp.send();
}