<?php

// require_once('cpsc304-project.php');


$success = True; //keep track of errors so it redirects the page only if there are no errors
$db_conn = NULL; // edit the login credentials in connectToDB()
$show_debug_alert_messages = False; // set to True if you want alerts to show you which methods are being triggered (see how it is used in debugAlertMessage())

function debugAlertMessage($message)
{
    global $show_debug_alert_messages;

    if ($show_debug_alert_messages) {
        echo "<script type='text/javascript'>alert('" . $message . "');</script>";
    }
}

// function resetReservationsRequest() {
// global $db_conn;
// $result = executePlainSQL("create table reservations
// (start_date varchar(20) not null,
// end_date varchar(40) not null,
// reservation_id int not null,
// primary key (reservation_id))");

// echo $result;

// OCICommit($db_conn);
// }



function selectAttributeQueryRequest($id, $start, $end)
{
    // global $db_conn;
    // $tuple = array();
    
    // $query = "select from reservation where";

    // $count = 0;
    // foreach($tuple as $val) {
    //     if ($count == 1 || $count == 2) {
    //         $query = $query . "AND" . $val;
    //     } else {
    //         $query = $query . $val;
    //     }

    //     $count++;
    // }

    // $result = 

    // // printResult($result);
    // executeBoundSQL("select from " . $val . " (:bind1, :bind2, :bind3)", $reservationstuples);
}


function projectTableRequest()
{
    $val = $_GET['projectQueryRequest'];

    // $tuple;

    if ($val == "Reservations") {
        $val = "reservations";

        // $tuple = array(
        //     ":bind1" => $start,
        //     ":bind2" => $end,
        //     ":bind3" => $id
        // );
        
    } else if ($val == "Reserves") {
        $val = "reserves";
    } else if ($val == "Room") {
        $val == "roomContains";
    }


    // executeBoundSQL("select from " . $val . " (:bind1, :bind2, :bind3)", $reservationstuples);
}

function insertQueryRequest($id, $start, $end, $rn)
{

    echo "running";
    global $db_conn;

    $reservationstuple = array(
        ":bind1" => $start,
        ":bind2" => $end,
        ":bind3" => $id
    );

    $reservationstuples = array(
        $reservationstuple
    );

    $reservestuple = array(
        ":bind1" => $id,
        ":bind2" => $rn
    );

    $reservestuples = array(
        $reservestuple
    );

    executeBoundSQL("insert into reservations values (:bind1, :bind2, :bind3)", $reservationstuples);
    executeBoundSQL("insert into reserves values (:bind1, :bind2)", $reservestuples);
    // updateRoomStatusToOccupied($rn);
    OCICommit($db_conn);
}

function updateRoomStatusToOccupied($rn)
{
    global $db_conn;
    $occupied = "occupied";
    executePlainSQL("UPDATE demoTable SET name='" . $occupied . "' WHERE name='" . $rn . "'");
    OCICommit($db_conn);
}

function deleteQueryRequest($id)
{
    global $db_conn;

    //Getting the values from user and insert data into the table
    $tuple = array(
        ":bind1" => $id
    );

    $tupleArray = array(
        $tuple
    );
    executeBoundSQL("delete FROM reservations WHERE ", $tupleArray);
    OCICommit($db_conn);
}

function aggregationGroupByRequest() 
{
    global $db_conn;
    
    $result = executePlainSQL("SELECT RC.room_type, COUNT(*) FROM roomContains RC WHERE RC.status = 'vacant' GROUP BY RC.room_type");

    $columns = array(
        "Room Type",
        "Count"
    );


    printResult($result, $columns, "Room");
    OCICommit($db_conn);
}

function aggregationHavingRequest() 
{
    global $db_conn;

    $result = executePlainSQL("SELECT RC.floor, MIN(RC.price) FROM roomContains RC WHERE RC.status = 'vacant' GROUP BY RC.floor HAVING COUNT(*) > 0");


    $columns = array(
        "Floor",
        "Min Price"
    );

    printResult($result, $columns, "Room");
    OCICommit($db_conn);
}

function aggregationNestedRequest() 
{
    global $db_conn;

    $result = executePlainSQL("SELECT RC.room_number FROM roomContains RC WHERE RC.status = 'vacant' AND RC.price >= all (SELECT MAX(RC2.price) FROM roomContains RC2 WHERE RC2.status = 'vacant' GROUP BY RC2.floor)");

    $columns = array(
        "Number",

    );

    printResult($result, $columns, "Room");

    OCICommit($db_conn);
}

function divisionRequest() 
{
    global $db_conn;

    $result = executePlainSQL("SELECT R.reservation_id FROM reservations R WHERE NOT EXISTS ((SELECT RC.room_number FROM roomContains RC WHERE RC.floor = 3) minus (SELECT Res.room_number FROM reserves Res WHERE R.reservation_id = Res.reservation_id))");

    printResult($result);
    OCICommit($db_conn);
}


function viewReservationsRequest()
{
    global $db_conn;

    $result = executePlainSQL("SELECT * FROM reservations");

    $columns = array (
        "Reservation ID",
        "Start Date",
        "End Date"  
    );

    printResult($result, $columns, "Reservations");

    // echo $result;
    OCICommit($db_conn);
}


function executePlainSQL($cmdstr)
{ //takes a plain (no bound variables) SQL command and executes it
    //echo "<br>running ".$cmdstr."<br>";
    global $db_conn, $success;

    $statement = OCIParse($db_conn, $cmdstr);
    //There are a set of comments at the end of the file that describe some of the OCI specific functions and how they work

    if (!$statement) {
        echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
        $e = OCI_Error($db_conn); // For OCIParse errors pass the connection handle
        echo htmlentities($e['message']);
        $success = False;
    }

    $r = OCIExecute($statement, OCI_DEFAULT);
    if (!$r) {
        echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
        $e = oci_error($statement); // For OCIExecute errors pass the statementhandle
        echo htmlentities($e['message']);
        $success = False;
    }

    return $statement;
}





function executeBoundSQL($cmdstr, $list)
{
    global $db_conn, $success;
    $statement = OCIParse($db_conn, $cmdstr);

    // echo "TEST";

    if (!$statement) {
        echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
        $e = OCI_Error($db_conn);
        echo htmlentities($e['message']);
        $success = False;
    }

    foreach ($list as $tuple) {
        foreach ($tuple as $bind => $val) {
            //echo $val;
            //echo "<br>".$bind."<br>";
            OCIBindByName($statement, $bind, $val);
            unset($val); //make sure you do not remove this. Otherwise $val will remain in an array object wrapper which will not be recognized by Oracle as a proper datatype
        }

        $r = OCIExecute($statement, OCI_DEFAULT);
        if (!$r) {
            echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
            $e = OCI_Error($statement); // For OCIExecute errors, pass the statementhandle
            echo htmlentities($e['message']);
            echo "<br>";
            $success = False;
        }
    }
}



function printResult($result, $columns, $name)
{ //prints results from a select statement
    echo "<h3>Retrieved data from table " . $name . ":<h3>";
    echo "<table>";

    echo "<tr>";
    foreach ($columns as $column) {
        echo "<th>" . $column . "</th>";
    }
    echo "</tr>";

    while ($row = OCI_fetch_array($result, OCI_BOTH)) {
        echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td></tr>"; //or just use "echo $row[0]"
    }

    echo "</table>";
}

function connectToDB()
{
    // echo "test";

    global $db_conn;

    // Your username is ora_(CWL_ID) and the password is a(student number). For example,
    // ora_platypus is the username and a12345678 is the password.
    $db_conn = OCILogon("ora_henryk02", "a32523722", "dbhost.students.cs.ubc.ca:1522/stu");

    if ($db_conn) {
        debugAlertMessage("Database is Connected");
        return true;
    } else {
        debugAlertMessage("Cannot connect to Database");
        $e = OCI_Error(); // For OCILogon errors pass no handle
        echo htmlentities($e['message']);
        return false;
    }
}

function disconnectFromDB()
{
    global $db_conn;

    debugAlertMessage("Disconnect from Database");
    OCILogoff($db_conn);
}
