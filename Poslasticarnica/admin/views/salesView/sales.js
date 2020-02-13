var max;
var counter = 0;
var arrayDates = [];
var arrayValues = [];
function graph(datumi,vrednosti,title){
    var ctx = document.getElementById('graph').getContext('2d');
    
    var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
        labels: datumi,
        datasets: [{
            label: title,
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: vrednosti
        }]
    },

    // Configuration options go here
    options: {
        scales:{
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
}
function setDates(){

    $.ajax({
        type: "POST",
        url: "../../controllers/salesControllers/setDateController.php",
        data: "1",
        success: function (data) {
            var index = data.indexOf(',');
            var min  = data.substr(0,index);
            max = data.substr(index+1,data.lenghth);
            
            $('#start').append("<input type='date' id='minDate' min='"+min+"' max='"+max+"' onFocusOut='generateMax()'>");
        },
        error: function (data) {
            console.log("error");


        }
    });
}
function generateMax(){
    var min = document.getElementById('minDate').value;
    if(min == null || min == ""){
        alert('Niste pravilno odabrali datum');
    }
    else{
        if(counter==0){
            $('#end').append("<span>To</span><br/>");
            $('#end').append("<input type='date' id='maxDate' min='"+min+"' max='"+max+"'>");
            counter++;
        }
        
    }
}
function deleteMax(){
    document.getElementById('end').innerHTML="";
    counter=0;
}
function generateGraph(){
    document.getElementById('gore').innerHTML="";
    document.getElementById('gore').innerHTML="<canvas id='graph'></canvas>";
    var dateStart = document.getElementById('minDate').value;
    var dateEnd = null;
    if(document.getElementById('maxDate')==null){
        alert('Niste pravilno odabrali datum, prvo odaberite početni datum, a potom će se pojaviti polje za unos krajnjeg datuma');
    
    }
    else{
    var dateEnd = document.getElementById('maxDate').value;
    }
    var tip = document.getElementById('tip').value;
    if(tip === '-1'){
        alert('Odaberite tip podataka koji želite da budu prikazani');
    }
    if(tip !== '-1' && dateStart!=null && dateEnd!=null){
    var json = {
        'startDate': dateStart,
        'endDate'  : dateEnd,
        'tip'      : tip
    };
    var json = JSON.stringify(json);
    $.ajax({
        type: "POST",
        url: "../../controllers/salesControllers/graphController.php",
        data: json,
        success: function (data) {
            if(data == ""){
                alert('Za unete datume nema zapisa!');
            }
            else{
                if(tip==0){
                    var obj = JSON.parse(data);
                    graph(Object.values(obj.datumi), Object.values(obj.vrednosti), "Zarada");
                    arrayDates = Object.values(obj.datumi);
                    arrayValues = Object.values(obj.vrednosti);

                }   
                if(tip==1){
                    var obj = JSON.parse(data);
                    var title = "Prodaja za period "+dateStart+"-"+dateEnd;
                    graph(Object.values(obj.imena), Object.values(obj.vrednosti), title);
                    arrayDates = Object.values(obj.imena);
                    arrayValues = Object.values(obj.vrednosti);
                }
            }
            
        },
        error: function (data) {
            console.log("error");


        }
    });
    }
    
}

function getXML(){
   
        if(arrayDates.length <=0 || arrayValues <=0 ){
            alert("Odaberite vrednosti i generišite grafikon prvo!");
        }
        else{
          var xmltext = "<report>&#xD;";
         
          for(var i = 0; i<arrayDates.length;i++){
            xmltext += `<stat>
                                <dateOrName>
                                            ${arrayDates[i]}
                                </dateOrName>
                                <value>
                                            ${arrayValues[i]}
                                </value>
                        </stat>&#xD;`;
          }
          xmltext += "</report>";
          var pom = document.createElement('a');
          var filename = "report.xml";
          var bb = new Blob([xmltext], {type: 'text/plain'});
          pom.setAttribute('href', window.URL.createObjectURL(bb));
          pom.setAttribute('download', filename);
          pom.dataset.downloadurl = ['text/plain', pom.download, pom.href].join(':');
          pom.click();
        }
      }

  
