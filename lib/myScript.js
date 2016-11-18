
      var state;
      var interval;
      $(document).ready(function(){
          function setIntervalTable(){
            
            console.log("Clear Interval Graph !");
            clearInterval(interval);
            console.log("setInterval Table");
            interval = setInterval(fetch_data,120000);
          }
         function fetch_data(){ 
           state = "table"; 
           $.ajax({  
                url:"show.php",  
                method:"POST",   
                success:function(data){
                     $('#table').html("");  
                     $('#table').html(data);
                     console.log("Draw Table!");
                }  
           });
           setIntervalTable();  
        }
        fetch_data();
        console.log(state);
        
        $( "#ButtonTable" ).click(function() {
            $('#chart').html("");
            fetch_data();
        });
       
      });
       google.charts.load('current', {'packages':['corechart']});
        function setIntervalGraph(){
          console.log("Clear Interval Table!");
          clearInterval(interval);
          console.log("setInterval Graph!");
          interval = setInterval(showGraph,120000);
        }
        function showGraph() {
          document.getElementById('table').innerHTML = "";
          state = "Graph";
          $.ajax({
            url: "Temp_Humid.php",
            type: 'post',
            dataType: "JSON",
          }).done(function(data) {
            var DataTable = new google.visualization.arrayToDataTable(data);
            var options = {
              title: 'Temperature & Humidity',
              width: window.innerWidth*0.9,
              height: window.innerHeight*0.65,
              hAxis: {title: 'Timestamp',  titleTextStyle: {color: '#333'}},
              colors: ['#FF0000','#0000FF'],
              backgroundColor: '#FDFDFD'
            };
            var chart = new google.visualization.AreaChart(document.getElementById('chart'));
            chart.draw(DataTable, options);
            setIntervalGraph();
            console.log("Draw Graph!");
            
       });   
          console.log(state);
      }
 