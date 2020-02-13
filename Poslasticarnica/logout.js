function logout(ime){
    $.ajax({
        type: "POST",
        url: "../logout.php",
        data: ime,
        success: function (data) {
           // console.log(data);

        window.location.replace("../login/login.html");
            
        },
        error: function (data) {
            console.log("error");


        }
    });
}
