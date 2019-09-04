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
  	//document.write(placehlder);
  	if (e1.value.length ==0) {
	e2.style.visibility="hidden";
	}
	else{
		e1.style.borderColor="blue";
	}
  */
}

var cities =
{   
    "0":["Select State first."],
    A: ["Select City", "Mumbai", "Pune","Thane", "Panvel","Aurangabad"],
    B: ["Select City", "Uttara kannada","Bengaluru","Mysore","Bijapur"],
    C: ["Select City", "Jaipur","Udaipur","Jodhpur","Ajmer"],
    D: ["Select City", "Allahabad", "Varanasi","Lucknow","Kanpur"],
    E: ["Select City", "Ahmedabad","Gandhinagar","Surat","Rajkot"],
    F: ["Select City", "Bhopal","Ujjain","Khajuraho","Indore"]

};

var values =
{
    "0":[""],
    A: ["", "Mumbai", "Pune","Thane", "Panvel","Aurangabad"],
    B: ["", "Uttara kannada","Bengaluru","Mysore","Bijapur"],
    C: ["", "Jaipur","Udaipur","Jodhpur","Ajmer"],
    D: ["", "Allahabad", "Varanasi","Lucknow","Kanpur"],
    E: ["", "Ahmedabad","Gandhinagar","Surat","Rajkot"],
    F: ["", "Bhopal","Ujjain","Khajuraho","Indore"]
};


function fill_select(option,target_menu){
    for (var i = 0 ; i < cities[option].length; i++) {
        var op = document.createElement('option');
        op.text=cities[option][i];
        op.value=values[option][i];
        target_menu.add(op);
    }
}
function empty_select(target_menu){
    for (var i = target_menu.length - 1; i >= 0; i--) {
        target_menu.remove(i);
    }
}

function StateCity()
{
    var state = document.getElementById("state_box");
    var city = document.getElementById("city_box");

    var selected = state.value;


    empty_select(city);
    if (selected=="0") {
        var op = document.createElement('option');
               
        fill_select('0',city);
        
    } 
    else 
    {
        if (selected=="Maharashtra") 
        {
            fill_select('A',city);  
        }
        else if(selected=="Karnataka")
        {
            fill_select('B',city);
        }
        else if(selected=="Rajasthan")
        {
            fill_select('C',city);
        }
        else if(selected=="Uttar Pradesh")
        {
            fill_select('D',city);
        }
        else if(selected=="Gujarat")
        {
            fill_select('E',city);
        }
        else 
        {
            fill_select('F',city);
        }
        
    }
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
    var owner = document.forms["RegForm"]["owner_name"];               
    var org = document.forms["RegForm"]["org_name"];               
    var email = document.forms["RegForm"]["email"];    
    var phone = document.forms["RegForm"]["phone"];  
    
    var password = document.forms["RegForm"]["password"];  
    var confirm_password =  document.forms["RegForm"]["confirm_password"];  
    var address = document.forms["RegForm"]["address"];  
    var pin_code =  document.forms["RegForm"]["pin_code"];  
    var city =  document.forms["RegForm"]["city"];  
    var state =  document.forms["RegForm"]["state"];  
    
    var error = false;
    if (owner.value == "")                                  
    { 
       // window.alert("Please enter your name.");
        displayError('owner_error',"Please enter Owner Name."); 
        owner.focus(); 
        error= true; 
    }
    else
    {
      removeError('owner_error');
    } 

    if (org.value == "")                                  
    { 
        //window.alert("Please enter your name."); 
        displayError('org_error',"Please enter Org Name.");
        org.focus(); 
        error= true;  
    } 
    else
    {
      removeError('org_error');
    }
    if (address.value == "")                               
    { 
        //window.alert("Please enter your address."); 
        displayError('address_error',"Please enter Address.");
        address.focus(); 
        error= true; 
    } 
    else
    {
      removeError('address_error');
    }
    if (pin_code.value == "")                               
    { 
        //window.alert("Please enter your address."); 
        displayError('pin_code_error',"Please enter Pin.");
        pin_code.focus(); 
        error= true; 
    } 
    else
    {
      removeError('pin_code_error');
    }
       
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
   
    if (phone.value == "")                           
    { 
        //window.alert("Please enter your telephone number."); 
        displayError('phone_error',"Please enter your Phone number.");
        phone.focus(); 
        error= true; 
    } 
    else if (phone.value.length!=10)                           
    { 
        //window.alert("Please enter your telephone number."); 
        displayError('phone_error',"Please enter a valid Phone number.");
        phone.focus(); 
        error= true; 
    }
    else
    {
      removeError('phone_error');
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
    
    if (confirm_password.value == "")                        
    { 
        //window.alert("Please enter your password");
        displayError('confirm_password_error',"Please enter your password."); 
        confirm_password.focus(); 
        error= true; 
    }
    else
    {
      removeError('confirm_password_error');
    }
    
   
    if (password.value!=confirm_password.value) 
    {
      displayError('passwords_error',"Passwords don't match."); 
      confirm_password.focus(); 
      error= true; 
    }
    else
    {
      removeError('passwords_error');
    }
   
    if (state.selectedIndex < 1)                  
    { 
        //alert("Please enter your course."); 
        displayError('state_error',"Please select State."); 
        state.focus(); 
        error= true; 
    } 
    else
    {
      removeError('state_error');
    }
    if (city.selectedIndex < 1)                  
    { 
        //alert("Please enter your course."); 
        displayError('city_error',"Please select City."); 
        city.focus(); 
        error= true; 
    }
    else
    {
      removeError('city_error');
    } 

   
    if (error) 
    {
      return false;
    }
    return true; 
}



function chkMail(obj) {
        str=obj.value;
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
                document.getElementById("email_error").style.display="block";
                document.getElementById("email_error").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","chkMail.php?q="+str,true);
        xmlhttp.send();
    
}