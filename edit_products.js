function del_category(cid)
{

	/*swal({
	    title: "Are you sure?",
	    text: "All products under the category will be deleted!!",
	    type: "warning",
	    showCancelButton: true,
	    confirmButtonColor: '#DD6B55',
	    confirmButtonText: 'Yes, I am sure!',
	    cancelButtonText: "No, cancel it!"
	 },
	 function(isConfirm){
	 	console.log(isConfirm);
	   if (isConfirm)
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
		    
		    xmlhttp.open("GET","del_category.php?q="+cid,true);
		    xmlhttp.send();
		    location.reload(true);

	   } 
	    
	   else 
	    
	   {
	      
	         
	   }
	 });*/
    swal({
	    title: "Are you sure?",
	    text: "All products under the category will be deleted!!",
	    type: "warning",
	    showCancelButton: true,
	    confirmButtonColor: '#DD6B55',
	    confirmButtonText: 'Yes, I am sure!',
	    cancelButtonText: "No, cancel it!"
	 }).then((result) => {
	 	if (result.value) {
	 		console.log("yes");
			console.log(window.location); 
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
		    xmlhttp.onreadystatechange = function() {
	            if (this.readyState == 4 && this.status == 200)
	            {	
	            	//console.log(this.responseText);
	                if (this.responseText.length > 0)
	                {
	                		//window.location.href='http://localhost/RT/web/edit_products.php';
							window.location.href=window.location;
							console.log(window.location);
	                }
	            }
        	};
		    
		    xmlhttp.open("GET","del_category.php?q="+cid,true);
		    xmlhttp.send();
		    
	 	} else {
	 		console.log("No");
			console.log(window.location); 
	 	}
	 } 
	 );
}