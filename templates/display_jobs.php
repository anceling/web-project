<?php
    function displayJobs(){
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
    }
?>