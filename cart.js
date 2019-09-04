
totalPrice();

function totalPrice()
{
 var totalP = document.getElementById("totalPrice");
 var totalAmount = document.getElementsByClassName("totalAmount");
 var tot = 0;
 for (var i = totalAmount.length - 1; i >= 0; i--) 
 {
     tot = tot + Number(totalAmount[i].innerText);

 }
 totalP.innerText=tot;
 console.log(tot);
}





function increment(id,tot,price)
{
    var inv = document.getElementById(id);
    var totl= document.getElementById(tot);
    var val = inv.value;
    val++;
    inv.value=val;
    totl.innerText=val*price;
    totalPrice();
}
function decrement(id,tot,price)
{
    var inv = document.getElementById(id);
    var totl= document.getElementById(tot);
    var val = inv.value;
    val--;
    if (val<=0) 
    {
        val=1;
    } 
    inv.value=val;
    totl.innerText=val*price;
    totalPrice();
}
function removeProduct(id)
{   
    var product = document.getElementById(id);
    var form = document.getElementById('form');
    if(form.childElementCount == "1")
    {
        var no_product = document.getElementById("no_products");
        var goto_products = document.getElementById("goto_products");
        form.parentNode.removeChild(form);
        no_product.style.display="block";
        goto_products.style.display="block";

    }
    console.log(form.childElementCount);
    console.log(id);
    
    form.removeChild(product);
    totalPrice();
    return true;

}




function validQuantity(id)
{
    var inp = document.getElementById(id);
    if(inp.value < 1)
    {
        inp.value=1;
    }
    totalPrice();
}


function thankYou()
{

    return false;

}