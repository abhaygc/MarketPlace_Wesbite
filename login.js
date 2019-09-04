var placehlder;
function hide(input_id,lbl){
  /*
		var e1=document.getElementById(input_id);
		var e2=document.getElementById(lbl);		
	e2.style.visibility="visible";
	if (e1.value != ""){
    return;
  }

    var sz = 0;
    e2.style.fontSize=sz;
    var id = setInterval(frame, 10);
    function frame() {
        if (sz == 20) {
            clearInterval(id);
        } else {
            sz+=5;
            e2.style.fontSize = sz + 'px';
        }
    }
*/
}
function show(input_id,lbl){
  /*
  	var e1=window.document.getElementById(input_id);
  	var e2=document.getElementById(lbl);
  	document.write(placehlder);
  	if (e1.value.length ==0) {
	e2.style.visibility="hidden";
	}
	else{
		e1.style.borderColor="blue";
	}
*/
}
function displayError(id,msg)
{
  console.log(id);
  console.log(msg);

  label=document.getElementById(id);
  label.style.display="block";
  label.innerText=msg;
  
}
function removeError(id)
{
  label=document.getElementById(id);
  label.style.display="none";
}

function FormValidate()                                    
{ 
  console.log("FormValidate");
                  
    var email = document.forms["LogForm"]["email"];    
      
    
    var password = document.forms["LogForm"]["password"];  
     
    
    var error = false;
    
    
       
    if (email.value == "")                                   
    { 
        //window.alert("Please enter a valid e-mail address."); 
        displayError('email_error',"Please enter a valid e-mail address.");
        email.focus(); 
        error= true;  
    } 
   
    else if (email.value.indexOf("@", 0) < 0)                 
    { 
        //window.alert("Please enter a valid e-mail address."); 
        displayError('email_error',"Please enter a valid e-mail address.");
        email.focus(); 
        error= true;  
    } 
   
    else if (email.value.indexOf(".", 0) < 0)                 
    { 
        //window.alert("Please enter a valid e-mail address."); 
        displayError('email_error',"Please enter a valid e-mail address.");
        email.focus(); 
        error= true; 
    } 
    else
    {
      removeError('email_error');
    }
   
    
    
   
    if (password.value == "")                        
    { 
        //window.alert("Please enter your password");
        displayError('password_error',"Please enter your password."); 
        password.focus(); 
        error= true;  
    }
    else
    {
      removeError('password_error');
    }
        
   
    if (error) 
    {
      return false;
    }
    return true; 
}
