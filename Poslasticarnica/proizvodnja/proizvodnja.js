function generate() {

    var string = '1';
    $.ajax({
        type: "POST",
        url: "generate.php",
        data: string,
        success: function (data) {
            $('#main').append(data);

        },
        error: function (data) {
            console.log("error");


        }
    });
    
}
function check(id) {
    var regex = /^(([1-9][0-9]?\.[0-9]{1,2})|([1-9][0-9]?))$/;
    var value = document.getElementById(id).value;
    if (!regex.test(value)) {
        document.getElementById(id).style = "border: 2px solid red;";
        document.getElementById(id).value = "";
        document.getElementById(id).placeholder = "Vrednost nije ispravna!";
    }
    if (regex.test(value)) {
        document.getElementById(id).style = "border:none;";
        document.getElementById(id).placeholder = "Unesite količinu (max=99kg)";
    }
}
function make(id) {
    var kolicina = document.getElementById('kolicina' + id);
    var regex = /^(([1-9][0-9]?\.[0-9]{1,2})|([1-9][0-9]?))$/;
    var ime = document.getElementById('ime' + id).innerHTML;
    var is_parce = ime.includes("parče");

    if (regex.test(kolicina.value)) {
     
        var check = confirm("Odabrali ste proizvodnju " + kolicina.value + " kilograma " + ime + " , da li želite da nastavite?");
        if (check) {
            var json = {
                "id": id,
                "kolicina": kolicina.value,
                "ime": ime,
                "is_parce" : is_parce
            };
            json = JSON.stringify(json);
            $.ajax({
                type: "POST",
                url: "make.php",
                data: json,
                success: function (data) {
                    alert(data);

                },
                error: function (data) {
                    console.log("error");


                }
            });
        }
        else {
            alert("Otkazali ste proizvodnju i podaci nisu evidentirani");
        }
    }
    else {
    
        kolicina.style = "border: 2px solid red;";
        kolicina.placeholder = "Vrednost nije ispravna!";
    }
}