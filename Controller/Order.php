<?php

session_start();    

if(isset($_REQUEST['json'])){
        $json = json_decode($_REQUEST['json'], true);
    
   //  var_dump($json["hamburgers"][0]['name']);

}

/*
{
    "hamburgers":[
       {
          "name":"Classic",
          "price":6.99,
          "ingredients":[
             {
                "name": "bun",
                "amount": 2
             },
          ]
       },
       {
          "name":"Classic",
          "price":6.99,
          "ingredients":[
             {
                "name": "bun",
                "amount": 2
             },
          ]
       },
    ]
}
*/