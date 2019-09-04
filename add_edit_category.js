var mega_clone = document.getElementsByClassName('product_list')[0].cloneNode(true);

var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];


function addMoreProduct(obj) {
	var new_product = document.createElement('div');
	
	new_product.className="product_list container-fluid mx-auto";
	new_product.style="border-bottom-style: solid;border-bottom-color: black;";
	var product_form=document.getElementsByClassName('product_form')[0];

	product_form.appendChild(new_product);
    product_form.lastChild.innerHTML=mega_clone.innerHTML;

    
    return false;
}

function removeProduct(obj)
{
	var product_form=document.getElementsByClassName('product_form')[0];
	var product = obj.parentNode;	
	
	if(product_form.childElementCount == "1")
	{
		addMoreProduct(obj);
	    
	}	
	product_form.removeChild(product);

	

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

        if (FileUploadPath == '') {
            // There is no file selected 
            displayError('error_pimage',i,"Please select Product Image.");
            pimage.focus();
            error = true;
        }
        else {
            var Extension = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
            if (Extension == "gif" || Extension == "png" || Extension == "bmp" || Extension == "jpeg" || Extension == "jpg") {
                removeError('error_pimage',i); // Valid file type
                FileUploadPath == '';
            }
            else {
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

function chkPid(obj) {
		var str = obj.value;
		
		var update_category = document.getElementById('update_category');
		var add_more = document.getElementById('add_more_btn');
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
                if (this.responseText=="ID available!") 
                	{
                			update_category.removeAttribute("disabled");
                			
                			add_more.removeAttribute("disabled");
                	} 
                else 
	                {
	                		update_category.setAttribute("disabled","disabled");
	                		
	                		add_more.setAttribute("disabled","disabled");
	                }

            }
        };
        xmlhttp.open("GET","chkPid.php?q="+str,true);
        xmlhttp.send();
    return false;
    
}
function chkCid(obj) {
		var str = obj.value;
		var update_category = document.getElementById('update_category');
		
		var add_more = document.getElementById('add_more_btn');
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
                if (this.responseText=="ID available!") 
                	{
                			
                			
                			
                	} 
                else 
	                {
	                		update_category.setAttribute("disabled","disabled");
	                		
	                		add_more.setAttribute("disabled","disabled");
	                }

            }
        };
        xmlhttp.open("GET","chkCid.php?q="+str,true);
        xmlhttp.send();
    return false;
    
}