var modal = document.getElementById('myModel');
var btn1 = document.getElementById('btnBay');
var span = document.getElementsByClassName('close')[0];
var prod = document.getElementById('products');


var bay = function (a) {
    prod.innerHTML = a;
    
    modal.style.display = "block";
};

btn1.onclick = function () {

    alert("Multumesc pentru cumparare, incurand va telefonam pentru detalii adaugatoare");
    modal.style.display = "none";
};

span.onclick = function () {
    modal.style.display = "none";
};

