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
function updateBackroomReserve(newNumber){
    document.getElementById('backroomReserve').innerHTML = newNumber;     
}
function showLogInForm() {
    document.getElementById('logInForm').style.display = "block";
    document.getElementById('Home').className = "";
    document.getElementById('Help').className = "";
    document.getElementById('logInFormButton').className = "active";
}
function makeNavBarActive() {
    if (window.location.href.includes('index.php')) {
      document.getElementById('Home').className = "active";  
    }else if (window.location.href.includes('profile.php')) {
      document.getElementById('Your Profile').className = "active";  
    }else if (window.location.href.includes('telegram.php')) {
      document.getElementById('Directives').className = "active";  
    }else if (window.location.href.includes('delegateDirectives.php')) {
      document.getElementById('Sent Directives').className = "active";  
    }else if (window.location.href.includes('directiveConfirmation.php')) {
      document.getElementById('Chair Approval').className = "active";  
    }else if (window.location.href.includes('userSettings.php')) {
      document.getElementById('Settings').className = "active";  
    }else if (window.location.href.includes('backroomResponse.php')) {
      document.getElementById('Backroom Overview').className = "active";  
    }else if (window.location.href.includes('backroomReserve.php')) {
      document.getElementById('Reserved Directive').className = "active";  
    }else if (window.location.href.includes('backroomSheet.php')) {
      document.getElementById('Delegate Summary').className = "active";  
    }else if (window.location.href.includes('createUser.php')) {
      document.getElementById('Delegate Changes').className = "active";  
    }else if (window.location.href.includes('sent.php')) {
      document.getElementById('[Sent Messages]').className = "active";  
    }else if (window.location.href.includes('sentMessages.php')) {
      document.getElementById('[Sent Messages]').className = "active";  
    }else if (window.location.href.includes('settings.php')) {
      document.getElementById('Admin Panel').className = "active";  
    }else if (window.location.href.includes('feedback.php')) {
      document.getElementById('Feedback').className = "active";  
    }else if (window.location.href.includes('help.php')) {
      document.getElementById('Help').className = "active";  
    }else if (window.location.href.includes('worldmap.php')) {
      document.getElementById('World Map').className = "active";  
    }else if (window.location.href.includes('demo.php')) {
      document.getElementById('Demo (Sign up)').className = "active";  
    }else if (window.location.href.includes('.php') === false) {
      document.getElementById('Home').className = "active";  
    }

}
function hideThem(){
    var y = document.getElementsByClassName('visuallyshown');
    var length = y.length;
    for (var i = 0; i < length; i++)
    {
        y[0].className = "visuallyhidden";
    }

}
function showThem(){
    var y = document.getElementsByClassName('visuallyhidden');
    var length = y.length;
    for (var i = 0; i < length; i++)
    {
        y[0].className = "visuallyshown";
    }

}
function makeTelegramGreen(){
    document.getElementById("messageMe").style.color = "green";
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
function reduceProfileNumber(){
    var currentNumber = Number(document.getElementById('ProfileNumber').innerHTML);
    // console.log(currentNumber);
    currentNumber = currentNumber - 1;
document.getElementById('ProfileNumber').innerHTML = currentNumber;    
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

function clearAlert(){
    document.getElementById('dialogbox').style.display = "none";
    document.getElementById('dialogoverlay').style.display = "none";
}
function clickTableRow(row) {
    var cabinetOrEmail = window.location.href;
    // if (cabinetOrEmail.length > 42 && cabinetOrEmail.charAt(42) !== 'd') {
    //     while (cabinetOrEmail.charAt(0) !== "a"){
    //         cabinetOrEmail = cabinetOrEmail.substr(1);
    //     }
    //     cabinetOrEmail = cabinetOrEmail.substr(1);
    //     while (cabinetOrEmail.charAt(0) !== "a"){
    //         cabinetOrEmail = cabinetOrEmail.substr(1);
    //     }        
    //     console.log(cabinetOrEmail, "1");
    //     if (cabinetOrEmail.charAt(1) === "b") {
    //         cabinetOrEmail = "c" + cabinetOrEmail;
    //         console.log(cabinetOrEmail, "2a");
    //     }if (cabinetOrEmail.charAt(1) === "i") {
    //         cabinetOrEmail = "em" + cabinetOrEmail;
    //         console.log(cabinetOrEmail, "2b");
    //     }
    //     console.log(row, "Row");
    //     var location = "backroomResponse.php?directive="+row;
    //     console.log(location, ": location");
    //     if (cabinetOrEmail.indexOf("cabinet") !== -1 || cabinetOrEmail.indexOf("email") !== -1) {
    //         location = location+"&"+cabinetOrEmail;
    //       console.log(location, "3a");
    //     }
    //     console.log(location, "3b");
    // } else
     if (cabinetOrEmail.includes("sortBy")) {
        while (cabinetOrEmail.includes("sortBy")) {
            cabinetOrEmail = cabinetOrEmail.substr(1);
        }
        console.log("working");
        cabinetOrEmail = 's' + cabinetOrEmail;
        var location = "backroomResponse.php?" + cabinetOrEmail + "&directive=" +row;
    }else 
    {
        var location = "backroomResponse.php?directive="+row;        
    }
    window.location = location;
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

function backroomAcceptanceConfirm(){
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
        
        document.getElementById('dialogboxhead').innerHTML = "Allow delegates to respond directly? ";
        document.getElementById('dialogboxbody').innerHTML = dialog;
        document.getElementById('dialogboxfoot').innerHTML = '<button onclick="ConfirmAcceptance.yes()">Yes</button> <button onclick="ConfirmAcceptance.no()">No</button>';
    }
    this.no = function(){
        document.getElementById('dialogbox').style.display = "none";
        document.getElementById('dialogoverlay').style.display = "none";
        return "NO";    
    }
    this.yes = function(){
        var theButton = document.getElementById("delegateButton");
        document.getElementById('dialogbox').style.display = "none";
        document.getElementById('dialogoverlay').style.display = "none";
        theButton.value = 'on';
        document.getElementById("responseValue").value = "on";
        theButton.className = "btn btn-danger";
        theButton.innerHTML = 'Allow Delegate Response: On';
        return "YES";
    }
}


var Confirm = new CustomConfirm();
var ConfirmAcceptance = new backroomAcceptanceConfirm();
function sendBackHome() {
    var currentLocation = window.location.href;
    console.log(currentLocation);
    if (currentLocation === "http://muncrisis.com/") {
        window.location = "index.php";
    }else if (currentLocation.indexOf("login.php") !== -1) {
    }else if (currentLocation.indexOf("help.php") !== -1) {
    }else if (currentLocation.indexOf("index.php") === -1) {
        window.location = "index.php?message=logOn";
    }
} 

function logOnCheck(){
    if(getCookie("loggedIn").indexOf("YES") !== -1) {
        if (getCookie("isBackroom").indexOf("t") !== -1||getCookie("isBackroom").indexOf("a") !== -1){
    //  if (getCookie("isBackroom") === "t") {
            if (window.location.toString().indexOf("profile.php") !== -1 /*or telegram maybe */) {
                window.location = "backroomResponse.php";
            }
        }
//          x.style.display = 'none';
        
        
        if (document.getElementById("form-container") != null) {
            window.location = "profile.php";
        } 
    }else {
        var deleteBackroomReserve = document.getElementById("backroomReserveButton");
        if (deleteBackroomReserve!=null) {
            deleteBackroomReserve.parentNode.removeChild(deleteBackroomReserve);
        }
        sendBackHome();
        var z = document.getElementById("badgeNumber");
        if (z != null) {
            z.innerHTML = "";
        }
        var a = document.getElementById("jumbotron");
        if (a != null) {
            a.className += " col-sm-offset-3 col-xs-offset-3";
        }


    }
}

function logOut()  {
    Confirm.render("Are you sure you want to log out?", "logOut");

}
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