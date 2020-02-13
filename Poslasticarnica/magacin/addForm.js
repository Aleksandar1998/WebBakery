var counter = 0;
var maxform = 0;
var array = [];
array.push(0);
var tableCounter = 0;
function addForm() {
    if (maxform == 4) {
        alert("Maksimalan broj paralelnih prijemnica je dostignut.");
        

    }
    else {
        if (maxform < 4) {
            maxform++;
        }
        counter++;
        array.push(counter);
        var json = JSON.stringify(counter);

        $.ajax({
            type: "POST",
            url: "addForm.php",
            data: json,
            success: function (data) {
                $("#main").append(data);

            },
            error: function (data) {
                console.log("error");


            }
        });
    }
}          
function  removeForm(remove){
    var div = document.getElementById(remove);
    var number = remove.toString();
    char = number.replace("button", "");
    div.parentElement.remove();
    for (var i = 0; i <= array.length; i++) {
        if (char == array[i]) {
            array.splice(i,1);
        }
    }
    maxform--;
    
    
}
function checkAmount(check) {
    var field = document.getElementById(check);
    
   

    var regex = /^(([0]\.[0][1-9])|([0]\.[1-9]{1,2})|([1-9]{1}[0-9]{0,4}(\.[0-9]{0,2})?))$/;
    if (regex.test(field.value) == false) {
        field.style = "border: 2px solid red;";
        field.value = "";
        field.placeholder = "Nedozvoljena vrednost!";
    }
    if (regex.test(field.value)) {
        field.style = "border:none";
    }
   
}
function sendForm() {
    var valueArray = [];
    var regex = /^(([0]\.[0][1-9])|([0]\.[1-9]{1,2})|([1-9]{1}[0-9]{0,4}(\.[0-9]{0,2})?))$/;
    var arrayFinal = [];
    var errorFlag = 0;
    for (var i = 0; i < array.length; i++) {
        var ime = document.getElementById('ime' + array[i]).value;
        var tipProizvoda = document.getElementById('dd' + array[i]);
        tipProizvoda = tipProizvoda.options[tipProizvoda.selectedIndex].value;
        var kolicina = document.getElementById('kolicina' + array[i]).value;
        var arr = [];
        arr.push(ime);
        arr.push(tipProizvoda);
        arr.push(kolicina);
        valueArray.push(arr);
    }
    for (var i = 0; i < valueArray.length; i++) {
        if (valueArray[i][0] == "") {
            alert("Polje Ime proizvoda u formularu broj: " + (i + 1) + " nije ispravno popunjeno");
            errorFlag = -1;
        }
        if (valueArray[i][1] == "Odaberi tip proizvoda") {
            alert("Niste ispravno odabrali tip proizvoda u formularu broj: " + (i + 1));
            errorFlag = -1;
        }
        if (valueArray[i][2] == "" || valueArray[i][2] <= 0) {
            alert("Niste ispravno popunili Količinu u formularu broj: " + (i + 1));
            errorFlag = -1;
        }
        if (valueArray[i][0] != "" && valueArray[i][1] != "Odaberi tip proizvoda" && (valueArray[i][2] !="" && valueArray[i][2] > 0)) {
            arrayFinal.push(valueArray[i][0]);
            arrayFinal.push(valueArray[i][1]);
            arrayFinal.push(valueArray[i][2]);
            errorFlag = 1;
        }
    }
    if (errorFlag == 1) {
        var json = JSON.stringify(arrayFinal);
        $.ajax({
            type: "POST",
            url: "send.php",
            data: json,
            success: function (data) {
                document.getElementById('title').innerHTML = "";
                document.getElementById('field').innerHTML = "";
                $("#field").append(data);
                $("#field").append('<button type="button" onClick = "send()">Dodaj u magacin</button>');
                document.getElementById('field').style = "border-bottom: 2px solid grey;";
            },
            error: function (data) {
                console.log("error");


            }
        });
        
    }
    tableCounter = array.length;
}
function obrisi(btn) {
    var div = document.getElementById(btn);
    var string = div.parentElement.id;
    string = string.replace("tabela", "");
    $.ajax({
        type: "POST",
        url: "delete.php",
        data: string,
        success: function (data) {
            

        },
        error: function (data) {
            console.log("error");


        }
    });
    div.parentElement.remove();
    if (tableCounter == 1) {
        document.getElementById("field").innerHTML = "";
        document.getElementById("field").style = "border:none;";
        $.ajax({
            type: "POST",
            url: "generateMagacin.php",
            data: '1',
            success: function (data) {
                document.getElementById('title').innerHTML="<h1>Spisak sirovina za magacin</h1>"
                document.getElementById('field').innerHTML = "";

                $("#field").append(data);

                document.getElementById('field').style = "border-bottom: 2px solid grey;";
            },
            error: function (data) {
                console.log("error");


            }
        });

    }
    tableCounter--;


    
}
function send() {
    var check = confirm("Da li garantujete ispravnost podataka i njihov unos u sistem?");
    if (check==true) {
        var string = "final";
        $.ajax({
            type: "POST",
            url: "send.php",
            data: string,
            success: function (data) {
                console.log(data);

            },
            error: function (data) {
                console.log("error");


            }
        });

        alert("Podaci su uneti u sistem.");
        location.reload();
    }
    else {
        alert("Podaci nisu uneseni u sistem.");
    }
}
function generateMagacin() {

    $.ajax({
        type: "POST",
        url: "generateMagacin.php",
        data: '1',
        success: function (data) {
            document.getElementById('field').innerHTML = "";
          
            $("#field").append(data);
            
            document.getElementById('field').style = "border-bottom: 2px solid grey;";
        },
        error: function (data) {
            console.log("error");


        }
    });
}
function checkName(check) {
    var field = document.getElementById(check);
    
   

var regex = /^([A-ž]+[\-, ]?(([A-ž]+)?|(\d{1,5}[\-, ]?([A-ž]*)))*)+$/; //zamisljen Format koji mora da prođe je Brašno Proizvođač T-500 , a da se izbegne {-*/.,!@#$%^*} treba proveriti jos
    if (regex.test(field.value) == false) {
        field.style = "border: 2px solid red;";
        field.value = "";
        field.placeholder = "Nedozvoljena vrednost!";
    }
    if (regex.test(field.value)) {
        field.style = "border:none";
    }
   
}