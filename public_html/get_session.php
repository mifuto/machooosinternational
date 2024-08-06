<?php

/*
define('HOST', "localhost");
define('DB_USER','u775466301_machooscrm');
define('DB_PASS','Raj.sarath522@123');
define('DB_NAME','u775466301_machooscrm');
*/
    function get_session() {
        $retArray = [];

        if (isset($_COOKIE['mchs_session'])) {
            $ses = $_COOKIE['mchs_session'];

            $DBC = mysqli_connect("localhost", "u775466301_machooscrm", "Raj.sarath522@123",'u775466301_machooscrm');

            // echo $ses;

            if (mysqli_connect_error()) {
                $retArray = [];
            } else {
                $sql = "SELECT `data` FROM tblsessions WHERE id = '".$ses."'";
                $result = $DBC->query($sql);

                $count = mysqli_num_rows($result);

                $tmpData = [];

                if($count > 0) {		
                    while ($row = mysqli_fetch_assoc($result)) {
                        array_push($tmpData,$row);
                    }

                    $data = explode(';', $tmpData[0]['data']);

                    foreach ($data as $key => $value) {
                        if($value != "") {
                            $pd = explode('|', $value);
                            $dd = explode(':', $pd[1]);

                            $retArray[$pd[0]] = $dd[0] == 's' ? trim($dd[2], '"'):$dd[1];
                        }
                    }

                    if(isset($retArray['client_user_id'])) {
                        $sql = "SELECT * FROM tblcontacts WHERE id = ".$retArray['contact_user_id'] . " LIMIT 1";
                        $contact = $DBC->query($sql);

                        $countC = mysqli_num_rows($contact);

                        if($countC > 0) {		
                            if ($us = mysqli_fetch_assoc($contact)) {
                                $retArray["firstname"] = $us["firstname"];
                                $retArray["lastname"] = $us["lastname"];
                                $retArray["email"] = $us["email"];
                                $retArray["phonenumber"] = $us["phonenumber"];
                                $retArray["main_user_id"] = $us["main_user_id"];
                            }
                        }

                        $retArray['userID'] = $retArray['client_user_id'];
                    }
                }
            }
        }

        return $retArray;
    }

    function get_user_record_with_id($id) {
        $retArray = [];
        $retArray['contact_user_id'] = $id;

        $DBC = mysqli_connect("localhost", "u775466301_machooscrm", "Raj.sarath522@123",'u775466301_machooscrm');

        // echo $ses;

        if (mysqli_connect_error()) {
            $retArray = [];
        } else {
            
            $sql = "SELECT * FROM tblcontacts WHERE id = ".$retArray['contact_user_id'] . " LIMIT 1";
            $contact = $DBC->query($sql);

            $countC = mysqli_num_rows($contact);

            if($countC > 0) {		
                if ($us = mysqli_fetch_assoc($contact)) {
                    $retArray["firstname"] = $us["firstname"];
                    $retArray["lastname"] = $us["lastname"];
                    $retArray["email"] = $us["email"];
                    $retArray["phonenumber"] = $us["phonenumber"];
                    $retArray['userID'] = $us['userid'];
                    $retArray['client_user_id'] = $us['userid'];
                    $retArray['main_user_id'] = $us['main_user_id'];
                }
            }
        }

        return $retArray;
    }
?>