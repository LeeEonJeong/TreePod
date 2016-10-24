function CustomAlert(){
    var result;
    this.render = function(head,dialog,foot){
        result = false;
        var winW = window.innerWidth;
        var winH = window.innerHeight;
        var dialogoverlay = document.getElementById('dialogoverlay');
        var dialogbox = document.getElementById('dialogbox');
        dialogoverlay.style.display = "block";
        dialogoverlay.style.height = winH+"px";
        dialogbox.style.left = (winW/2) - (550 * .5)+"px";
        dialogbox.style.top = "100px";
        dialogbox.style.display = "block";
        document.getElementById('dialogboxhead').innerHTML = head;
        document.getElementById('dialogboxbody').innerHTML = dialog;
        if(foot=='default'){
            document.getElementById('dialogboxfoot').innerHTML = '<button class="button2" onclick="Alert.ok()">OK</button>';
        } else {
            document.getElementById('dialogboxfoot').innerHTML = foot;
        }

    }
    this.ok = function(){
        document.getElementById('dialogbox').style.display = "none";
        document.getElementById('dialogoverlay').style.display = "none";
    }
}
var Alert = new CustomAlert();

function deletePost(id){
    var db_id = id.replace("post_", "");
    // Run Ajax request here to delete post from database
    document.body.removeChild(document.getElementById(id));
}

function CustomConfirm(){
    var anyFunction;
    var parameters;
    this.render = function(head,dialog,func,par,no){
        anyFunction = func;
        parameters = par;
        var winW = window.innerWidth;
        var winH = window.innerHeight;
        var dialogoverlay = document.getElementById('dialogoverlay');
        var dialogbox = document.getElementById('dialogbox');
        dialogoverlay.style.display = "block";
        dialogoverlay.style.height = winH+"px";
        dialogbox.style.left = (winW/2) - (550 * .5)+"px";
        dialogbox.style.top = "100px";
        dialogbox.style.display = "block";
        
        document.getElementById('dialogboxhead').innerHTML = head;
        document.getElementById('dialogboxbody').innerHTML = dialog;
        if(no == "use") {
            document.getElementById('dialogboxfoot').innerHTML = '<button class=\'button2\' onclick="Confirm.yes();">Yes</button> <button  class=\'button2\' onclick="Confirm.no()">No</button>';
        } else {
            document.getElementById('dialogboxfoot').innerHTML = '<button class=\'button2\' onclick="Confirm.yes();">Yes</button>'
        }
    }
    this.no = function(){
        document.getElementById('dialogbox').style.display = "none";
        document.getElementById('dialogoverlay').style.display = "none";
        anyFunction=''; parameters='';
    }
    this.yes = function(){
    //    alert(parameters);
        anyFunction(parameters); //익명의 함수.
        anyFunction=''; parameters='';
        document.getElementById('dialogbox').style.display = "none";
        document.getElementById('dialogoverlay').style.display = "none";
    }
}
var Confirm = new CustomConfirm();


function CustomPrompt(){
    var parameters;
    this.render = function(head,dialog,type,func,para){
        parameters = para;
        var winW = window.innerWidth;
        var winH = window.innerHeight;
        var dialogoverlay = document.getElementById('dialogoverlay');
        var dialogbox = document.getElementById('dialogbox');
        dialogoverlay.style.display = "block";
        dialogoverlay.style.height = winH+"px";
        dialogbox.style.left = (winW/2) - (550 * .5)+"px";
        dialogbox.style.top = "100px";
        dialogbox.style.display = "block";
        document.getElementById('dialogboxhead').innerHTML = head;
        document.getElementById('dialogboxbody').innerHTML = dialog;
        document.getElementById('dialogboxbody').innerHTML += '<input type="'+type+'" class="transparent" id="prompt_value1">';
        document.getElementById('dialogboxfoot').innerHTML = '<button class="button2" onclick="Prompt.ok(\''+func+'\')">OK</button> <button class="button2" onclick="Prompt.cancel()">Cancel</button>';
    }
    this.cancel = function(){
        document.getElementById('dialogbox').style.display = "none";
        document.getElementById('dialogoverlay').style.display = "none";
        parameters='';
    }
    this.ok = function(func){
        var prompt_value1 = document.getElementById('prompt_value1').value;

        if( window[func](parameters,prompt_value1) == true) {
            document.getElementById('dialogbox').style.display = "none";
            document.getElementById('dialogoverlay').style.display = "none";
        }
        parameters='';
    }
}
var Prompt = new CustomPrompt();