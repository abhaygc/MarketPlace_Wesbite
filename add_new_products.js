var mega_clone = document.getElementsByClassName('product_form_demo')[0].getElementsByTagName('div')[0].cloneNode(true);

var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];

function addProduct(obj) {
	var new_product = document.createElement('div');

	var add_more = document.getElementById('add_more_btn');
	var add_category = document.getElementById('add_category');

	new_product.className="product_list container-fluid w-100 mx-auto";

	product_form=document.getElementsByClassName('product_form')[0];

	product_form.appendChild(new_product);
    product_form.lastChild.innerHTML=mega_clone.innerHTML;

    obj.style.display="none";
    add_more.style.display="inline-block";
    add_category.style.display="inline-block";

    return false;
}

function addMoreProduct(obj) {
	var new_product = document.createElement('div');
	var add_more = document.getElementById('add_more_btn');
	var add_category = document.getElementById('add_category');
	new_product.className="product_list";
	var product_form=document.getElementsByClassName('product_form')[0];

	product_form.appendChild(new_product);
    product_form.lastChild.innerHTML=mega_clone.innerHTML;

    add_category.setAttribute("disabled","disabled");
	                		
	add_more.setAttribute("disabled","disabled");

    return false;
}

function removeProduct(obj)
{
	var product_form=document.getElementsByClassName('product_form')[0];
	var product = obj.parentNode;
	var simple_add = document.getElementById('simple_add_btn');
	var add_more = document.getElementById('add_more_btn');
	var add_category = document.getElementById('add_category');
	if(product_form.childElementCount == "1")
	{
		simple_add.style.display="inline";
		console.log(document.getElementsByClassName('error_cid')[0].innerText);
		if(document.getElementsByClassName('error_cid')[0].innerText=="ID available!")
		{
			simple_add.removeAttribute("disabled");
		}
		else
		{
			simple_add.setAttribute("disabled","disabled");
		}
	    
	                		
		add_more.style.display="none";
    	add_category.style.display="none";
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
	 
	 
	 for (var i = 1; i < product_list.length; i++)
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
	    /*
	    if (pimage.value == "")                                  
	    { 
	       // window.alert("Please enter your name.");
	        displayError('error_pimage',i,"Please enter Product Image."); 
	        pimage.focus(); 
	        error= true; 
	    }
	    else
	    {
	      removeError('error_pimage',i);
	    }
		*/

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
		var simple_add = document.getElementById('simple_add_btn');
		var add_category = document.getElementById('add_category');
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
                			add_category.removeAttribute("disabled");
                			simple_add.removeAttribute("disabled");
                			add_more.removeAttribute("disabled");
                	} 
                else 
	                {
	                		add_category.setAttribute("disabled","disabled");
	                		simple_add.setAttribute("disabled","disabled");
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
		var add_category = document.getElementById('add_category');
		var simple_add = document.getElementById('simple_add_btn');
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
                			
                			simple_add.removeAttribute("disabled");
                			
                	} 
                else 
	                {
	                		add_category.setAttribute("disabled","disabled");
	                		simple_add.setAttribute("disabled","disabled");
	                		add_more.setAttribute("disabled","disabled");
	                }

            }
        };
        xmlhttp.open("GET","chkCid.php?q="+str,true);
        xmlhttp.send();
    return false;
    
}