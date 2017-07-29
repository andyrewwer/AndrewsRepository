var Alert = new CustomAlert();

var alertIsShowing = false;
var username;
var password;

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}
function makeNavBarActive() {
    if (window.location.href.includes('index.php')) {
      document.getElementById('Home').className = "active";  
    }else if (window.location.href.includes('sales.php')) {
      document.getElementById('Inquiries').className = "active";  
    }else if (window.location.href.includes('aboutUs.php')) {
      document.getElementById('Who is Deus?').className = "active";  
    }else if (window.location.href.includes('testimonials.php')) {
      document.getElementById('Testimonials').className = "active";  
    }else if (window.location.href.includes('directiveConfirmation.php')) {
      document.getElementById('Chair Approval').className = "active";  
    }else if (window.location.href.includes('FAQ.php')) {
      document.getElementById('FAQ').className = "active";  
    }else if (window.location.href.includes('feedback.php')) {
      document.getElementById('Feedback').className = "active";  
    }else if (window.location.href.includes('demo.php')) {
      document.getElementById('Demo').className = "active";  
    }else if (window.location.href.includes('.php') === false) {
      document.getElementById('Home').className = "active";  
    }

}
function hideMe(){
    var y = document.getElementById('ShowOrHideMe');
    y.className = 'visuallyhidden';
    console.log("testung");

}
function showMe(){
    var y = document.getElementById('ShowOrHideMe');
    y.className ='visuallyshown form-control';
    console.log("testung?");

}
function setCookie(name, value) {
    var date = new Date();
    date.setTime(date.getTime() + (30 * 24 * 60 * 60 * 1000));
    var expires = date.toUTCString();
    document.cookie = name + '=' + value + ';' +
                   'expires=' + expires + ';' +
                   'path=/;';
    console.log("test");

    console.log(name + '=' + value + ';' +
                   'expires=' + expires + ';' +
                   'path=/;');
}
function clearAlert(){
    document.getElementById('messageMe').style.display = "none";
    document.getElementById('dialogbox').style.display = "none";
    document.getElementById('dialogoverlay').style.display = "none";
}
function telegramAlert(){
        // document.getElementById('messageMe').innerHTML = title + ": " + dialog;
    this.render = function(title, dialog){
        console.log (title);
        console.log (dialog);
        document.getElementById("messageMe").style.padding = "10px";
        document.getElementById('messageMe').innerHTML = title + ": " + dialog;
        
        // var winW = window.innerWidth;
        // var winH = window.innerHeight;
        // var dialogoverlay = document.getElementById('dialogoverlay');
        // var dialogbox = document.getElementById('dialogbox');
        // dialogoverlay.style.display = "initial";
        // dialogoverlay.style.height = winH+"px";
        // dialogbox.style.left = (winW/2) - (550 * .5)+"px";
        // dialogbox.style.top = "100px";
        // dialogbox.style.display = "initial";
        // document.getElementById('dialogboxhead').innerHTML = title;
        // document.getElementById('dialogboxbody').innerHTML = dialog;
        // document.getElementById('dialogboxfoot').innerHTML = '<button style="border-radius: 30%; background-color: #FFF" onclick="Alert.ok()">OK</button> ';
    }
    this.ok = function(){
        document.getElementById('dialogbox').style.display = "none";
        document.getElementById('dialogoverlay').style.display = "none";
    }
}
function makeTelegramGreen(){
    document.getElementById("messageMe").style.color = "green";
}
function clearAlert(){
    document.getElementById('dialogbox').style.display = "none";
    document.getElementById('dialogoverlay').style.display = "none";
}

function CustomAlert(){
    this.render = function(dialog){
        var winW = window.innerWidth;
        var winH = window.innerHeight;
        var dialogoverlay = document.getElementById('dialogoverlay');
        var dialogbox = document.getElementById('dialogbox');
        dialogoverlay.style.display = "block";
        dialogoverlay.style.height = winH+"px";
        dialogbox.style.left = (winW/2) - (550 * .5)+"px";
        dialogbox.style.top = "100px";
        dialogbox.style.display = "block";
        document.getElementById('dialogboxhead').innerHTML = "Incorrect Username/Password combination";
        document.getElementById('dialogboxbody').innerHTML = dialog;
        document.getElementById('dialogboxfoot').innerHTML = '<button style="border-radius: 30%; background-color: #FFF" onclick="Alert.ok()">OK</button> ';
    }
    this.ok = function(){
        document.getElementById('dialogbox').style.display = "none";
        document.getElementById('dialogoverlay').style.display = "none";
    }
}
function CustomConfirm(){
    this.render = function(dialog, id){
        var winW = window.innerWidth;
        var winH = window.innerHeight;
        var dialogoverlay = document.getElementById('dialogoverlay');
        var dialogbox = document.getElementById('dialogbox');
        dialogoverlay.style.display = "block";
        dialogoverlay.style.height = winH+"px";
        dialogbox.style.left = (winW/2) - (550 * .5)+"px";
        dialogbox.style.top = "100px";
        dialogbox.style.display = "block";
        
        document.getElementById('dialogboxhead').innerHTML = "Log out?";
        document.getElementById('dialogboxbody').innerHTML = dialog;
        document.getElementById('dialogboxfoot').innerHTML = '<button onclick="Confirm.yes()">Yes</button> <button onclick="Confirm.no()">No</button>';
    }
    this.no = function(){
        document.getElementById('dialogbox').style.display = "none";
        document.getElementById('dialogoverlay').style.display = "none";
        return "NO";    
    }
    this.yes = function(){
        document.getElementById('dialogbox').style.display = "none";
        document.getElementById('dialogoverlay').style.display = "none";
            setCookie('loggedIn', 'NO');
            // setCookie('user', '');
            // document.cookie = "=";
            // setCookie('name', '');
            // document.cookie = "name=MUNCrisis; expires=Thu, 01 Jan 1970 00:00:01 GMT;";
            // document.cookie = "user=; expires=Thu, 01 Jan 1970 00:00:01 GMT;";
            window.location = "index.php";
        return "YES";
    }
}


var Confirm = new CustomConfirm();

function makeActive(a){
    var elements = document.getElementsByClassName('list-group-item');
    for (var elementNo =0; elementNo<elements.length; elementNo++) {
        elements[elementNo].setAttribute('class', 'list-group-item');
        if (elementNo == a) {
            elements[elementNo].className += ' active';
        };
    }
}
function changeValue()
{
    var theButton = document.getElementById("delegateButton");
    if (theButton.value === 'on') {
        theButton.value = 'off';
        theButton.className = "btn btn-info";
        document.getElementById("responseValue").value = "off";
        theButton.innerHTML = 'Allow Delegate Response: Off';                    
    }else {
        theButton.value = 'on';
        document.getElementById("responseValue").value = "on";
        theButton.className = "btn btn-danger";
        theButton.innerHTML = 'Allow Delegate Response: On';
    }
}

function changeValue2()
{

    if (document.form.button.value === 'on') {
        document.form.button.value = 'off';
        document.getElementById("button").className = "btn btn-info";
        document.getElementById("responseValue2").value = "off";
        document.form.button.innerHTML = 'Allow Delegate Response: Off';                    
    }else {
        ConfirmAcceptance.render("Are you sure you want to allow the user to respond to this directive?", "backroomAcceptance");
    }
}