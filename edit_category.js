
var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];
var update_btn = document.getElementById('update');

function delProduct(obj,id)
{
		var productContainer = document.getElementById('productContainer');
		var pid=id;
		swal({
	    title: "Are you sure?",
	    text: "All details of product will be deleted!!",
	    type: "warning",
	    showCancelButton: true,
	    confirmButtonColor: '#DD6B55',
	    confirmButtonText: 'Yes, I am sure!',
	    cancelButtonText: "No, cancel it!"
	 }).then((result) => {
	 	if (result.value) {
	 		console.log("yes");
			console.log(window.location.hostname.concat('/edit_category.php'));
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
	                		//window.location.href=window.location.hostname.concat('/edit_products.php');
							console.log(window.location.hostname.concat('/edit_products.php'));
							productContainer.removeChild(obj.parentNode);
							
	                }
	            }
        	};
		    
		    xmlhttp.open("GET","del_product.php?q="+pid,true);
		    xmlhttp.send();
		    
	 	} else {
	 		console.log("No");
			console.log(window.location.hostname.concat('/edit_products.php')); 
			
	 	}
	 } 
	 );
	 //productContainer.removeChild(obj.parentNode);
	 return false;

}


function displayError(cls,count,msg)
{
  label=document.getElementsByClassName(cls)[count];
  label.style.display="block";
  label.innerText=msg;
  
}
function removeError(cls,count)
{
  label=document.getElementsByClassName(cls)[count];
  label.style.display="none";
}

function validate()
{
	 var error = false;
	 var product_list=document.getElementsByClassName('product_list');

	 var cname=document.getElementsByClassName('cname')[0];
	 var cid=document.getElementsByClassName('cid')[0];
	 if (cname.value == "")                                  
	    { 
	       // window.alert("Please enter your name.");
	        displayError('error_cname',0,"Please enter Category Name."); 
	        cname.focus(); 
	        error= true; 
	    }
	    else
	    {
	      removeError('error_cname',0);
	    }

	 if (cid.value == "")                                  
	    { 
	       // window.alert("Please enter your name.");
	        displayError('error_cid',0,"Please enter Category ID."); 
	        cid.focus(); 
	        error= true; 
	    }
	    else
	    {
	      removeError('error_cid',0);
	    }
	 
	 console.log(product_list.length);
	 for (var i = 0; i < product_list.length; i++)
	 {
	 	var pname = product_list[i].getElementsByClassName('pname')[0];
	 	
	 	var pid = product_list[i].getElementsByClassName('pid')[0];
	 	var pimage = product_list[i].getElementsByClassName('pimage')[0];

	 	var pdescription = product_list[i].getElementsByClassName('pdescription')[0];
	 	var pprice= product_list[i].getElementsByClassName('pprice')[0];
	 	var pprofit= product_list[i].getElementsByClassName('pprofit')[0];
	 	var punit= product_list[i].getElementsByClassName('punit')[0];

	 	if (pname.value == "")                                  
	    { 
	       // window.alert("Please enter your name.");
	        displayError('error_pname',i,"Please enter Product Name."); 
	        pname.focus(); 
	        error= true; 
	    }
	    else
	    {
	      removeError('error_pname',i);
	    }
	    if (pid.value == "")                                  
	    { 
	       // window.alert("Please enter your name.");
	        displayError('error_pid',i,"Please enter Product ID."); 
	        pid.focus(); 
	        error= true; 
	    }
	    else
	    {
	      removeError('error_pid',i);
	    }
	    
	    //IMAGEEE `````-------------------````````````````
	    
	    var FileUploadPath = pimage.value;
	    console.log("FILE path",FileUploadPath);

        if (FileUploadPath != '') 
        {
            var Extension = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
            if (Extension == "gif" || Extension == "png" || Extension == "bmp" || Extension == "jpeg" || Extension == "jpg") 
            {
                removeError('error_pimage',i); // Valid file type
                FileUploadPath == '';
            }
            else 
            {
                displayError('error_pimage',i,"Image extension is invalid."); // Not valid file type
                pimage.focus();
                error=true; 
            }
        }
        
        if (pdescription.value == "")                                  
	    { 
	       // window.alert("Please enter your name.");
	        displayError('error_pdescription',i,"Please enter Product Description."); 
	        pdescription.focus(); 
	        error= true; 
	    }
	    else
	    {
	      removeError('error_pdescription',i);
	    }
	    if (punit.value == "")                                  
	    { 
	       // window.alert("Please enter your name.");
	        displayError('error_punit',i,"Please enter Unit of Measurement."); 
	        punit.focus(); 
	        error= true; 
	    }
	    else
	    {
	      removeError('error_punit',i);
	    }
	    if (pprice.value == "")                                  
	    { 
	       // window.alert("Please enter your name.");
	        displayError('error_pprice',i,"Please enter Product Price."); 
	        pprice.focus(); 
	        error= true; 
	    }
	    else if(pprice.value<0)
	    {
	    	displayError('error_pprice',i,"Product Price must be greater than 0."); 
	        pprice.focus(); 
	        error= true;

	    }
	    else
	    {
	      removeError('error_pprice',i);
	    }
	    if (pprofit.value == "")                                  
	    { 
	       // window.alert("Please enter your name.");
	        displayError('error_pprofit',i,"Please enter Product Profit."); 
	        pprofit.focus(); 
	        error= true; 
	    }
	    else if(pprofit.value<0)
	    {
	    	displayError('error_pprofit',i,"Product Profit must be greater than 0."); 
	        pprofit.focus(); 
	        error= true;

	    }
	    else
	    {
	      removeError('error_pprofit',i);
	    }
	    
            
	 }
	
	
	 if (!error) {

	 	return true;
	 } 
	 	

	 	return false ;
	 

}

function chkPid(obj,curr_id) {
		var str = obj.value;
		
        console.log(obj.nextSibling.nextSibling);
        if (window.XMLHttpRequest) 
        {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else 
        {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200)
            {
                obj.nextSibling.nextSibling.style.display="block";
                obj.nextSibling.nextSibling.innerHTML = this.responseText;
                

            }
            if (this.responseText=="Please enter ID!" || this.responseText=="ID already used!") 
            {
            	update_btn.setAttribute('disabled','disabled');
            } 
            else 
            {
            	update_btn.removeAttribute('disabled');
            }
        };
        xmlhttp.open("GET","chkEditPid.php?q="+str+"&i="+curr_id,true);
        xmlhttp.send();
    return false;
    
}
function chkCid(obj,curr_id) {
		var str = obj.value;
		
        console.log(obj.nextSibling.nextSibling);
        console.log(curr_id);
        if (window.XMLHttpRequest) 
        {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else 
        {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200)
            {
                obj.nextSibling.nextSibling.style.display="block";
                obj.nextSibling.nextSibling.innerHTML = this.responseText;
                
            }
            if (this.responseText=="Please enter ID!" || this.responseText=="ID already used!") 
            {
            	update_btn.setAttribute('disabled','disabled');
            } 
            else 
            {
            	update_btn.removeAttribute('disabled');
            }
        };
        xmlhttp.open("GET","chkEditCid.php?q="+str+"&i="+curr_id,true);
        xmlhttp.send();
    return false;
    
}