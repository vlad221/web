var nbr_click = 0;
var startpoint;
let array;
let goap;
var idd;

function loadArray(arr, obj){
    array = arr;
    goap = obj;
}

function reply_click(clicked_id)
{
    nbr_click = nbr_click+1;
    startpoint = clicked_id;

    // window.alert(getOffset(clicked_id).left);

    if(nbr_click > 2){
        // Reset tout
        nbr_click = 0;

        document.getElementById("information").innerHTML = "";
        var parent = document.getElementById("information");
        var el = document.createElement('div');
        el.setAttribute("id", "preview");
        parent.appendChild(el);

        var c = document.getElementById("Canvas");
        var ctx = c.getContext("2d");
        ctx.clearRect(0, 0, 900, 900);

        reply_click(clicked_id);
    }
    else {
        // ajoute clic 0 puis 1
        document.getElementById("preview").innerHTML = ""

        var parent = document.getElementById("information");
        var p = document.createElement("p");
        var text = document.createTextNode(clicked_id);

        p.appendChild(text);
        parent.appendChild(p);
    }
}

function myCallBack(xmlhttp, id) {
   
        var answer = xmlhttp;
        
        // fonctionne doit convertir en classname to ID  è_é
        var idEl = document.getElementsByClassName("button boxes"+answer)[0].id;

        var c = document.getElementById("Canvas");
        var ctx = c.getContext("2d");
        ctx.beginPath();

        if(answer != id){

            ctx.moveTo(getOffset(startpoint).left+30, getOffset(startpoint).top+30);
            ctx.lineTo(getOffset(idEl).left+30, getOffset(idEl).top+30);
            ctx.lineTo(getOffset(id).left+30,getOffset(id).top+30);
            
        }
        else{
        // check point
            ctx.moveTo(getOffset(startpoint).left+30, getOffset(startpoint).top+30);
            ctx.lineTo(getOffset(id).left+30, getOffset(id).top+30);
        }

        ctx.lineWidth = 10;
        ctx.stroke();
   
    
}

function getDestination(id){
    if(nbr_click == 1){
        sendInformation(id);
    }
}


function sendInformation(id){

    idd = id;
    var p = document.createElement('p');

    var xmlhttp = new XMLHttpRequest();
    //encodeURI pour pb url
    xmlhttp.open("GET", "request.php?n="+id+"&pathfinding="+encodeURIComponent(JSON.stringify(goap))+"&q="+encodeURIComponent(JSON.stringify(array)), false);
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == XMLHttpRequest.DONE && xmlhttp.status == 200) {

                var txt = document.createTextNode(this.responseText);
                p.appendChild(txt);
                document.getElementById("preview").appendChild(txt);

            }
    
        }
    xmlhttp.send();

    

    if (xmlhttp.status === 200) {// That's HTTP for 'ok'
        
        //document.write(xmlhttp.responseText);
        console.log(xmlhttp);

        myCallBack(xmlhttp.responseText, idd);
    }
}

function refreshDraw(name){
    document.getElementById("preview").innerHTML = "";
    bool = false;
    if(name != startpoint){
        if(nbr_click == 1){
            var c = document.getElementById("Canvas");
            var ctx = c.getContext("2d");
            ctx.clearRect(0, 0, 900, 900);
        }
    }
}

function getOffset(el) {
    var rec = document.getElementById(el).getBoundingClientRect();
  return {top: rec.top + window.scrollY, left: rec.left + window.scrollX};
  }