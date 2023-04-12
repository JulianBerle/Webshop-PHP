function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
  
function getCookie(cname) {
    let name = cname + "=";
    let ca = document.cookie.split(';');
    for(let i = 0; i < ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
}
  
function checkCookie() {
    let user = getCookie("username");
    if (user != "") {
      alert("Welcome again " + user);
    } else {
      user = prompt("Please enter your name:", "");
      if (user != "" && user != null) {
        setCookie("username", user, 365);
      }
    }
} 

function login() {


    if(getCookie("Login-admin")) {
        const response = confirm("Hi I see this is an admin login, do you want to go to your user panel or to the admin panel. Click 'OK' to go to the admin panel. Click on 'Cancel' to go to the user panel.");


        if (response) {
            window.location.href = "./panel/";
        } else {
            window.location.href = "./myaccount/";
        }
    } else if(getCookie("Login")){
        window.location.href = "./myaccount/";
    }

    if (document.getElementById("login_form").style.display == "block") {
        console.log("kaas");
        document.querySelector(".form.login").style.animation = "popout .3s";
        setTimeout(() => {  document.querySelector(".form.login").style.display = "none"; }, 290);
    } else {
        document.getElementById("login_form").style.display = "block";
        document.getElementById("login_form").style.animation = "popup .3s";
    }

};

function closeLogin(number) {
    if (number == 1) {
        document.querySelector(".form.login").style.animation = "popout .3s";
        setTimeout(() => {  document.querySelector(".form.login").style.display = "none"; }, 290);
    }
    if (number == 2) {
        document.querySelector(".form.add_item").style.animation = "popout .3s";
        setTimeout(() => {  document.querySelector(".form.add_item").style.display = "none"; }, 290);
    } else if (number == 3) {
        document.querySelector(".form.add_user").style.animation = "popout .3s";
        setTimeout(() => {  document.querySelector(".form.add_user").style.display = "none"; }, 290);
    }
    else if (number == 4) {
        document.getElementById("register_form").style.animation = "popout .3s";
        setTimeout(() => {      document.getElementById("register_form").style.display = "none"; }, 290);
    }

};

function itemAdd() {
    document.getElementById("add_form").style.display = "block";
    document.getElementById("add_form").style.animation = "popup .3s";
    document.getElementById("add_user").style.display = "none";
    document.querySelector(".items").style.display = "none";
    document.querySelector(".users").style.display = "none";
};

function userAdd() {
    document.getElementById("add_user").style.display = "block";
    document.getElementById("add_user").style.animation = "popup .3s";
    document.getElementById("add_form").style.display = "none";
    document.querySelector(".items").style.display = "none";
    document.querySelector(".users").style.display = "none";
};

function itemDelete() {
    document.querySelector(".items").style.display = "block";
    document.querySelector(".items").style.animation = "popup .3s";
    document.getElementById("add_form").style.display = "none";
    document.getElementById("add_user").style.display = "none";
    document.querySelector(".users").style.display = "none";
}

function closeDelete() {
    document.querySelector(".items").style.animation = "popout .3s";
    setTimeout(() => {  document.querySelector(".items").style.display = "none"; }, 290);
}

function closeUserAdd() {
    document.querySelector(".users").style.animation = "popout .3s";
    setTimeout(() => {  document.querySelector(".users").style.display = "none"; }, 290);
}

function openUserAdd() {
    document.querySelector(".users").style.display = "block";
    document.querySelector(".users").style.animation = "popup .3s";
    document.getElementById("add_form").style.display = "none";
    document.getElementById("add_user").style.display = "none";
    document.querySelector(".items").style.display = "none";
}

function logout() {
    setCookie("Login-admin", "Uitgelogd", -1);
    window.location.href = "../";
}

function home() {
    window.location.href = "../";
}


function confirmAction(username) {
    const response = confirm("Hi I see this is an admin login, do you want to go to your user panel or to the admin panel. Click 'OK' to go to the admin panel. Click on 'Cancel' to go to the user panel.");


    if (response) {
        setCookie("Login-admin", username, );
        window.location.href = "./panel/";
    } else {
        setCookie("Login", username, );
        window.location.href = "./myaccount/";
    }
}

function openRegister() {
    console.log("jo");
    document.getElementById("login_form").style.display = "none";
    document.getElementById("register_form").style.display = "block";
}
