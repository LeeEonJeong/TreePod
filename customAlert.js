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