<?php
require_once("lib/nusoap.php");
$client = new nusoap_client("http://localhost/IoT/IoTWebserver.php?wsdl");
$result = $client->call("showtable",array("keyword" => "ALL"));
$index = 0;
echo  '<div align="center">
              <table>
                    <tr>
                        <th width="15%"> Temperature</th>
                        <th width="15%"> Humidity </th>
                        <th width="25%"> Timestamp </th>
                        <th width="5%"> Add / Remove </th>
                    </tr>
                    <tr>'."\n";
    foreach ($result as $key => $value) {
      switch ($index) {
        case 0:
          echo '<td class="from_temp" contenteditable="true" >'.$value.'</td>'."\n";
          $index = $index+1;
          break;
        case 1:
          echo '<td class="from_humid" contenteditable="true" >'.$value .'</td>'."\n";
          $index = $index+1;
          break;
        case 2:
          echo '<td class="from_timestamp">'.$value.' </td>'."\n";
          $index = $index+1;
          break;
      }
      if(($key+1) %3 ==0 ){
          $index = 0;
          echo '<td><button type="button" name="delete_btn" class="btn btn-xs btn-danger btn_delete">x</button></td>';
          echo "</tr>\n";
          if($key+1 < sizeof($result)){
            echo "<tr>\n";
          }else{
            /*echo '<tr>
                    <td id="from_temp" contenteditable></td>
                    <td id="from_humid" contenteditable></td>    
                    <td id="from_timestamp" contenteditable></td> 
                    <td><button type="button" name="btn_add" id="btn_add" class="btn btn-xs btn-success">+</button></td> 
                  </tr>
                  ';*/
          }
          
      }
    }
echo "</table></div>";
?>