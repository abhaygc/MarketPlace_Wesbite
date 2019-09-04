function show(id) {
    var ele= document.getElementById(id);
    ele.style.display="inline-block";
}
/*
document.addEventListener('click',function (event){
    var ele= document.getElementById('menu');
    var clck = ele.contains(event.target);

    if (!clck) {
        ele.style.display="none";
    }

})
*/
// this function can fire onclick handler for any DOM-Element
function fireClickEvent(element) {
    var evt = new window.MouseEvent('click', {
        view: window,
        bubbles: true,
        cancelable: true
    });

    element.dispatchEvent(evt);
}

// this function will setup a virtual anchor element
// and fire click handler to open new URL in the same room
// it works better than location.href=something or location.reload()
function openNewURLInTheSameWindow(targetURL) {
    var a = document.createElement('a');
    a.href = targetURL;
    fireClickEvent(a);
}
function show_op(id,lb){
    var ops = document.getElementsByClassName('option-contents');
    var op = document.getElementById(id);
    if (op.style.display=='block') {
        var url="#"+id;
        
        openNewURLInTheSameWindow(url);
        /*
        window.open(url);
        */
    } 
    else {
        for (var i = 0; i < ops.length; i++) {
            ops[i].style.display='none';
        }

        op.style.display='block';
    }
    var labels = document.getElementsByClassName('option-links');
    var label = document.getElementById(lb);
    for (var i = 0; i < labels.length; i++) {
        labels[i].style.backgroundColor="transparent";
    }
    label.style.backgroundColor="#cccccc";
}

var productsByCategory =
{   
    "0":["Select sub-product"],
    A: ["Select sub-product", "CNC 1", "CNC 2", "CNC 3", "CNC 4"],
    B: ["Select sub-product", "LASER 1", "LASER 2", "LASER 3", "LASER 4"],
    C: ["Select sub-product", "RUBBER 1", "RUBBER 2", "RUBBER 3", "RUBBER 4", "RUBBER 5"],
    D: ["Select sub-product", "Fixture 1", "Fixture 2", "Fixture 3"]
};

var valuesByCategory =
{
    "0":[""],
    A: ["", "A1", "A2", "A3", "A4"],
    B: ["", "B1", "B2", "B3", "B4"],
    C: ["", "C1", "C2", "C3", "C4", "C5"],
    D: ["", "D1", "D2", "D3"]
};

var mega_clone = document.getElementsByClassName('product')[0].cloneNode(true);

function fill_select(option,target_menu){
    for (var i = 0 ; i < productsByCategory[option].length; i++) {
        var op = document.createElement('option');
        op.text=productsByCategory[option][i];
        op.value=valuesByCategory[option][i];
        target_menu.add(op);
    }
}
function empty_select(target_menu){
    for (var i = target_menu.length - 1; i >= 0; i--) {
        target_menu.remove(i);
    }
}
function setdisabled(obj){
    obj.setAttribute("disabled","disabled");
}
function setenabled(obj){
    obj.removeAttribute("disabled");
}
function blue_color(obj){
    obj.style.boxShadow="";
    obj.style.boxShadow="0.1em 0.2em 0.6em blue";
}
function green_color(obj){
    obj.style.boxShadow="";
    obj.style.boxShadow="0.1em 0.2em 0.6em #00ff3b";    
}
function red_color(obj){
    obj.style.boxShadow="";
    obj.style.boxShadow="0.1em 0.2em 0.6em red";
}
function remove_shadow(obj){
    obj.style.boxShadow="";
}
function add_class(obj,class_value){
    
    for (var i = 0; i < obj.classList.length; i++) 
    {
        if (obj.classList[i]==class_value)
        {
            break;
        }
    }
    obj.classList.add(class_value);
}
function remove_class(obj,class_value){
    obj.classList.remove(class_value);
}

function dropdown(obj){
    var selected = obj.value;
    var target = obj.nextElementSibling;
    
    var quantity_input = target.nextElementSibling;
    var remove_button = quantity_input.nextElementSibling;
    
    var add_button = remove_button.nextElementSibling.nextElementSibling;
    var order = document.getElementById("order_now");
    var form =  order.firstElementChild;

    var red_check = false;
    
    if (form.childElementCount != "1") {
        if (target.length != 0 && obj.parentNode.nextElementSibling!=null) {
            red_check=true;
            red_color(obj);
            red_color(target);
        }
    }
    empty_select(target);

    if (selected=="0") {
        var op = document.createElement('option');
        /*
        op.text=productsByCategory[option][0];
        op.value=valuesByCategory[option][0];
        target_menu.add(op);
        */
        console.log(target.classList);
        fill_select('0',target);
        setdisabled(target);
        add_class(target,"disabled_button");
        setdisabled(add_button);
        add_class(add_button,"disabled_button");
        setdisabled(quantity_input);
        add_class(quantity_input,"disabled_button");
        setdisabled(remove_button);
        add_class(remove_button,"disabled_button");
    } 
    else 
    {
        if (selected=="1") {
            fill_select('A',target);  
        }
        else if(selected=="2"){
            fill_select('B',target);
        }
        else if(selected=="3"){
            fill_select('C',target);
        }
        else {
            fill_select('D',target);
        }
        setenabled(target);
        remove_class(target,"disabled");
        if (!red_check) {
            green_color(obj);
            blue_color(target);
            
        }
    }
    red_check=false;
}

function dropdown2(obj){
    var order = document.getElementById("order_now");
    var form =  order.firstElementChild;
    var quantity_input = obj.nextElementSibling;
    var remove_button = quantity_input.nextElementSibling;
    
    var red_check = false;
    if (form.childElementCount == "1" || obj.parentNode.nextElementSibling===null)   {
        var add_button = remove_button.nextElementSibling.nextElementSibling;
        
        var reset_button = add_button.nextElementSibling;
        var submit_button = reset_button.nextElementSibling.nextElementSibling;
        
        setenabled(add_button);
        remove_class(add_button,"disabled_button");
    
        setenabled(reset_button);
        remove_class(reset_button,"disabled_button");

        setenabled(submit_button);
        remove_class(submit_button,"disabled_button");
        
        red_check = true;
    }
    setenabled(quantity_input);
    remove_class(quantity_input,"disabled");

    setenabled(remove_button);
    remove_class(remove_button,"disabled_button");
    
    
    green_color(obj);
    if (!red_check) {
        
        green_color(obj.previousElementSibling);
    }

}

function new_products(obj){
    var order = document.getElementById("order_now");
    var form =  order.firstElementChild;
    var last_product = form.lastElementChild;
    var clone = last_product.cloneNode(true);
    
    var reset_button = obj.nextElementSibling;
    var submit_button = reset_button.nextElementSibling.nextElementSibling;

    setdisabled(clone.getElementsByClassName("second_select")[0]);
    add_class(clone.getElementsByClassName("second_select")[0],"disabled");

    setdisabled(clone.getElementsByClassName("quantity_btn")[0]);
    add_class(clone.getElementsByClassName("quantity_btn")[0],"disabled");

    setenabled(clone.getElementsByClassName("remove_btn")[0]);
    remove_class(clone.getElementsByClassName("remove_btn")[0],"disabled_button");

    setdisabled(clone.getElementsByClassName("add_btn")[0]);
    add_class(clone.getElementsByClassName("add_btn")[0],"disabled_button");
    
    setenabled(clone.getElementsByClassName('submit_btn')[0]);
    remove_class(clone.getElementsByClassName('submit_btn')[0],"disabled_button");


    remove_shadow(clone.getElementsByClassName("first_select")[0]);
    remove_shadow(clone.getElementsByClassName("second_select")[0]);
    blue_color(clone.getElementsByClassName("first_select")[0]);
    obj.parentNode.removeChild(reset_button);
    obj.parentNode.removeChild(submit_button);

    obj.parentNode.removeChild(obj);
    
    form.appendChild(clone);

    

}
function reset (){
    /*
    var product = document.getElementsByClassName('product')[0];
    var first_select = product.firstElementChild;
    var second_select = first_select.nextElementSibling;
    var quantity_input = second_select.nextElementSibling;
    var remove_product = quantity_input.nextElementSibling;
    var add_button = remove_product.nextElementSibling;
    empty_select(first_select);
    empty_select(second_select);
    setdisabled(second_select);
    setdisabled(quantity_input);
    setdisabled(remove_button);
    setdisabled(add_button);
    */
    var order = document.getElementById("order_now");
    var form =  order.firstElementChild;

    var new_product = document.createElement('div');
    new_product.className = "product";

    form.innerHTML="";
    form.appendChild(new_product);
    
     
    form.firstElementChild.innerHTML = mega_clone.innerHTML;

    
}
function remove_product(obj){
    var order = document.getElementById("order_now");
    var form =  order.firstElementChild;
    var product = obj.parentNode;
    console.log(form.childElementCount);
    if (form.childElementCount == "1") {
        
        reset();
    }
    else if (obj.parentNode.nextElementSibling===null) {
        product.removeChild(product.getElementsByClassName('first_select')[0]);
        product.removeChild(product.getElementsByClassName('second_select')[0]);
        product.removeChild(product.getElementsByClassName('quantity_btn')[0]);
        product.removeChild(product.getElementsByClassName('remove_btn')[0]);
    } 
    else {
            form.removeChild(obj.parentNode);
    }
    
}