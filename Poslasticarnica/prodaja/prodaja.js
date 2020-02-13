function generateLeft() {
    var string = '1';

    $.ajax({
        type: "POST",
        url: "generateLeft.php",
        data: string,
        success: function (data) {

            $('#kat').append(data);

        },
        error: function (data) {
            console.log("error");
            alert('eror');

        }
    });
    
}
function generateCenter(tip) {
    var string = tip;

    $.ajax({
        type: "POST",
        url: "generateCenter.php",
        data: string,
        success: function (data) {
            document.getElementById('center').innerHTML = "";
            $('#center').append(data);

        },
        error: function (data) {
            console.log("error");
           

        }
    });
}
function addToCart(id) {
    var kolicina = document.getElementById('kolicina' + id).value;
    var cena = document.getElementById('cena' + id).innerHTML;
    cena = cena.replace('din.',"");
    var maks = document.getElementById('kolicina' + id).max;
    var flag = false;
    if (Number(kolicina) <= Number(maks)) {
        var ime = document.getElementById('ime' + id).innerHTML;
        var is_parce = ime.includes('parče');
        var is_kg = ime.includes('Kg');
        if (is_parce) {
            var regex = /^([1-9][0-9]{0,2})$/;

            if (regex.test(kolicina)) {

                var json = {
                    "id": id,
                    "kolicina": kolicina,
                    "cena": cena
                };
                json = JSON.stringify(json);
                flag = true;
            }
        }
        if (is_kg) {
            var regex = /^(([1-9][0-9]?\.[0-9]{1,2})|([1-9][0-9]?))$/;
            if (regex.test(kolicina)) {

                var json = {
                    "id": id,
                    "kolicina": kolicina,
                    "cena":cena
                };
                json = JSON.stringify(json);
                flag = true;
            }
        }
        if (!regex.test(kolicina)) {
            alert('Uneta vrednost nije dobra');
            document.getElementById('kolicina' + id).value = "";
            flag = false;
            
        }

        if (flag) {
            $.ajax({
                type: "POST",
                url: "generateRight.php",
                data: json,
                success: function (data) {
                    document.getElementById('field').innerHTML = "";
                    document.getElementById('field').innerHTML = "<div id='tabela'><span>Ime</span><span>Količina</span><span>Cena</span><buttontype='button' id='btn' style='visibility:hidden;'>Obriši</button></div >";
                    $('#field').append(data);
                    document.getElementById('ukupno').innerHTML = "";
                    document.getElementById('ukupno').innerHTML = "Ukupno";
                    document.getElementById('racunaj').innerHTML = "";
                    document.getElementById('racunaj').innerHTML = "<button type='button' id='prodaj' onClick='generateDole()'>Saberi</div>";


                },
                error: function (data) {
                    console.log("error");


                }
            });
        }

    }
    else {
        alert("Maksimalna kolicina na stanju je " + maks);
        document.getElementById('kolicina' + id).value = "";
    }
}
function obrisi(ime) {
    var ukupno = document.getElementById('cena').innerHTML;
    ukupno = ukupno.replace('din', "");
    $('#' + ime).remove();
    $.ajax({
        type: "POST",
        url: "obrisi.php",
        data: ime,
        success: function (data) {
            document.getElementById('cena').innerHTML = "";
            document.getElementById('racunaj').innerHTML = "";
            document.getElementById('racunaj').innerHTML = "<button type='button' id='prodaj' onClick='generateDole()'>Saberi</div>";
            if (data == 0) {
                document.getElementById('racunaj').innerHTML = "";
                document.getElementById('cena').innerHTML = "";
                document.getElementById('ukupno').innerHTML = "";
            }
        },
        error: function (data) {
            console.log("error");


        }
    });
   
}
function generateDole() {
    var string = "dole";
    $.ajax({
        type: "POST",
        url: "generateDole.php",
        data: string,
        success: function (data) {
            document.getElementById('cena').innerHTML = "";
            document.getElementById('cena').innerHTML = data + "din";
            document.getElementById('racunaj').innerHTML = "";
            document.getElementById('racunaj').innerHTML = "<button type='button' id='prodaj' onClick='prodaj()'>Potvrdite Transakciju</div>";


        },
        error: function (data) {
            console.log("error");


        }
    });
}
function cleanKorpa(){

    $.ajax({
        type: "POST",
        url: "cleanKorpa.php",
        data: 'clean',
        success: function (data) {
           
            

        },
        error: function (data) {
            console.log("error");
            

        }

    });
}
function prodaj() {
    var check = confirm("Da li potvrđujete transakciju?")
    if (check) {
        var string = 'ok';
        $.ajax({
            type: "POST",
            url: "prodaj.php",
            data: string,
            success: function (data) {
                if (data == "ok") {

                }


            },
            error: function (data) {
                console.log("error");


            }

        });
        alert("Podaci su evidentirani");
        location.reload();
    }
    else {
        alert("Podaci nisu evidentirani");
    }
}
