<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Work at a nation</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/grids-responsive-min.css">
        <link rel="stylesheet" type="text/css" href="style.css">
        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>


    </head>
    <body>

        
        <div class="pure-menu pure-menu-horizontal">
            <ul class="pure-menu-list">
                <li class="pure-menu-item"><a href="#" class="pure-menu-link">MY PROFILE</a></li>
            </ul>
            
        </div>
        <div id="searchbar" class="pure-u-1 pure-u-md-3-5">
            <form class="pure-form pure-form-stacked">
                <div class="pure-g">
                    <div class="pure-u-1 pure-u-md-1-4">
                        <select id="first-name" class="pure-u-23-24">
                            <option value="all">See All Nations</option>
                            <option value="stockholm">Stockholms nation</option>
                            <option value="uplands">Uplands nation</option>
                            <option value="gästrike-hälsinge">Gästrike-Hälsinge nation</option>
                            <option value="östgöta">Östgöta nation</option>
                            <option value="västgöta">Västgöta nation</option>
                            <option value="södermanlands-nerikes">Södermanlands-Nerikes nation</option>
                            <option value="västmanlands-dala">Västmanlands-Dala nation</option>
                            <option value="smålands">Smålands nation</option>
                            <option value="göteborgse">Göteborgs nation</option>
                            <option value="kalmar">Kalmar nation</option>
                            <option value="norrlands">Norrlands nation</option>
                            <option value="gotlands">Gotlands nation</option>
                        </select>
                    </div>

                    <div class="pure-u-1 pure-u-md-1-4">
                        <select id="first-name" class="pure-u-23-24">
                            <option value="all">See All Position</option>
                            <option value="stockholm">Bartender</option>
                        </select>
                    </div>

                    <div class="pure-u-1 pure-u-md-1-5">
                        <input id="date_from" class="pure-u-23-24" type="date">
                        
                    </div>

                    <div class="pure-u-1 pure-u-md-1-5">
                        <input id="date_to" class="pure-u-23-24" type="date">
                    </div>
                    <div class="pure-u-1 pure-u-md-1-12">
                        <button type="submit" id="searchbarButton">FILTER</button>
                    </div>

                </div>
            </form>
        </div>
        <div id="dayContainer">
            <div class="day">
                
                <h1>Tisdag, 17/5</h1>
                <?php

                    $conn = new mysqli("localhost", "root", "admin", "nationsjobb");
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT * from shift";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        
                        while($row = $result->fetch_assoc()) {
                            //HEADER
                            $nation = $row["nation_name"];
                            $category = $row["category"];
                            $time_from_raw = $row["time_from"];
                            $time_to_raw = $row["time_to"];
                            $empnum = $row["empnum"];
                            
                            $time_from_formated = strtotime($time_from_raw);
                            $time_from = date("H:i", $time_from_formated);

                            $time_to_formated = strtotime($time_to_raw);
                            $time_to = date("H:i", $time_to_formated);

                            
                            //MORE INFO
                            $description = $row["description"];
                            
                            $result = mysqli_query($conn, "SELECT nation_info FROM nations WHERE nation_name = '$nation'");
                            if (!$result) {
                                echo 'Could not run query: ' . mysql_error();
                                exit;
                            }
                            $row = mysqli_fetch_row($result);

                            $nation_info = $row[0];
                            
                            
                            
                            
                            ?>
                
                            
                            <div class="job">
                                <div class="jobHeader">
                                    <div class="pure-g">
                                        <div class="pure-u-1-4">
                                            <h3 class="job_location"><?php echo $nation ?></h3>
                                        </div>
                                        <div class="pure-u-1-4">
                                            <h3 class="job_position"><?php echo $category ?> <span class="jobNumber">(<?php echo $empnum ?> platser)</span></h3>
                                        </div>
                                        <div class="pure-u-1-4">
                                            <h3 class="job_time"><?php echo $time_from ." - ". $time_to?></h3>
                                        </div>
                                        <div class="pure-u-1-5">
                                            <div class="plusAndMinus">
                                                <div class="plus"></div>
                                                <div class="minus"></div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="jobDetails">
                                    <div class="pure-g">
                                        <div class="pure-u-1 pure-u-md-1-2">
                                            <p class="nationDescription"><?php echo $nation ?>:<br><?php echo $nation_info ?></p>
                                        </div>
                                        <div class="pure-u-1 pure-u-md-1-2">
                                            <p class="jobDescription"><?php echo $category ?>:<br><?php echo $description ?></p>
                                        </div>
                                    </div>
                                    
                                    <input type="button" class="applyButton" id="popUpButton" value="APPLY" onclick="showPopUp('<?php echo $category?>', 
                                                                                                                     '<?php echo $nation?>', '<?php echo $time_from?>', '<?php echo $time_to?>')">
                                </div>
                            </div>

                            <?php

                        }
                    } else {
                        echo "There are no jobs available.";
                    }

                ?>
                
                
            </div>
        </div>
        
        <div id="popUp">
            <h2>Do you wish to apply for:</h2>
            <p id="popUp_category"></p>
            <form name ="applyForm" methos="POST">
                <input type="submit" class="applyButton" value="APPLY">
            </form>
        </div>

     

        <script>
            
            
        function showPopUp(category, nation, time_from, time_to){
            $("#popUp").show();

            var message = category + " at " + nation + " between " + time_from + " and " + time_to;
            
            document.getElementById("popUp_category").innerHTML = message;
        }
            
        $( document ).ready(function() {
            $(".jobDetails").hide(); 
        
            var now = new Date();
            
            var day = ("0" + now.getDate()).slice(-2);
            var month = ("0" + (now.getMonth() + 1)).slice(-2);
            var today = now.getFullYear()+"-"+(month)+"-"+(day);
            
           $('#date_from').val(today);
            
            
            var twoWeeksFromNow = new Date();
            var _day = ("0" + twoWeeksFromNow.getDate()).slice(-2);
            var _month = ("0" + (twoWeeksFromNow.getMonth() + 2)).slice(-2);
            var _today = twoWeeksFromNow.getFullYear()+"-"+(_month)+"-"+(_day);


            $('#date_to').val(_today);
            
            $("#popUp").hide();
        });
            
            
        $( ".jobHeader" ).click(function() {
            
            if($(this).next().is(":hidden")){
                $(this).find(".plus").css({
                     '-webkit-transform' : 'rotate(90deg)',
                      '-moz-transform'    : 'rotate(90deg)',
                      '-ms-transform'     : 'rotate(90deg)',
                      '-o-transform'      : 'rotate(90deg)',
                      'transform'         : 'rotate(90deg)'
                });

            }else{
                $(this).find(".plus").css({
                     '-webkit-transform' : 'rotate(0deg)',
                      '-moz-transform'    : 'rotate(0deg)',
                      '-ms-transform'     : 'rotate(0deg)',
                      '-o-transform'      : 'rotate(0deg)',
                      'transform'         : 'rotate(0deg)'
                }); 
            }
            $(this).next().animate({
                height: "toggle"
                }, 300, function() {
            });
            


        });

        </script>
    </body>
</html>
