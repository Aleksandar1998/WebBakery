function login() {
    var username = document.getElementById('username').value;
    var pass = document.getElementById('pw').value;
    if ((pass.length == 0 || pass.length < 4) || (username.length == 0)) {
        alert("Unete informacije nisu u ispravnom formatu");
    }
    else {
        var jsonobj = { "pass": pass,
                        "username" : username}
        var json = JSON.stringify(jsonobj);
        $.ajax({
            type: "POST",
            url: "login.php",
            data: json,
            success: function (data) {
                if (data == -1){
                    window.location.replace("../admin/admin.php");
                }
                if (data == 0) {
                    window.location.replace("../magacin/magacin.php");
                }
                if (data == 1) {
                    window.location.replace("../proizvodnja/proizvodnja.php");
                }
                if (data == 2) {
                    window.location.replace("../prodaja/prodaja.php");
                }

            },
            error: function (data) {
                var data = JSON.stringify(data['statusText']);
                data = data.replace('\"', "");
                data = data.replace('\"', "");
                alert(data);

                
            }
        });
    }
}
function logout(){

    $.ajax({
        type: "POST",
        url: "../logout.php",
        data: "1",
        success: function (data) {
 
        },
        error: function (data) {
            console.log("error");


        }
    });
}
