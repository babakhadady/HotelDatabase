<!--Test Oracle file for UBC CPSC304 2018 Winter Term 1
  Created by Jiemin Zhang
  Modified by Simona Radu
  Modified by Jessica Wong (2018-06-22)
  This file shows the very basics of how to execute PHP commands
  on Oracle.
  Specifically, it will drop a table, create a table, insert values
  update values, and then query for values

  IF YOU HAVE A TABLE CALLED "demoTable" IT WILL BE DESTROYED

  The script assumes you already have a server set up
  All OCI commands are commands to the Oracle libraries
  To get the file to work, you must place it somewhere where your
  Apache server can run it, and you must rename it to have a ".php"
  extension.  You must also change the username and password on the
  OCILogon below to be your ORACLE username and password 

    Testing commits 
-->


<html>
<link rel="stylesheet" href="style.php" media="screen">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">


<head>
    <title>Hotel Management Application</title>
</head>

<body>
    <h1> Hotel Management Application</h1>

    <hr />

    <!-- <h2>Reset Application</h2>
    <form method="GET" action="cpsc304-project.php">
        <input type="submit" value="Reset" name="resetTablesRequest">
    </form> -->


    <h2> Update DataBase Page </h2>
    <form method="POST" action="update-page.php">
        <input type="submit" value="Query">
    </form>

    <h2> Query Page </h2>
    <form method="POST" action="query-page.php">
        <input type="submit" value="Query">
    </form>


    <h2>View All Reservations </h2>
    <form method="GET"> <!--refresh page when submitted-->
        <input type="submit" name="viewReservations"></p>
    </form>

    <!-- unnecessary ? -->
    <!-- <h2>Select Reservations by End Date</h2>
    <form method="GET" action="cpsc304-project.php"> 
        <input type="hidden" id="selectQueryRequest" name="selectQueryRequest">
        <p class="formfield">
            End Date: <input type="text" name="selend"> <br /><br />
        </p>
        <input type="submit" id="selectQueryRequest" name="selectQueryRequest">
    </form> -->

    <h2>Select Certain Tuples From Reservation</h2>
    <form method="GET"  action="cpsc304-project.php"> <!--refresh page when submitted-->
    <input type="hidden" name="selectAttributeQueryRequest" />
            Select a Column:
            <select name="projectTable">
                <?php
                $tables = array("Start date", "End date", "Reservation ID");
                foreach ($tables as $table) {
                    echo '<option value="' . $table . '"' . (($_GET['projectTable'] == $table) ? 'selected = selected' : '') . '>' . $table . '</option>';
                }
                ?>
            </select>
            <p class="formfield">
            Value: <input type="text" name="whereBody"> <br /><br />
            </p>
            <input type="submit">
    </form>

    <h2>Select a Table and Attributes to View</h2>
    <form method="GET">
        <p class="formfield">
            Select a Table:
            <select name="projectTable">
                <?php
                $tables = array("Reservations", "Reserves", "Room");
                foreach ($tables as $table) {
                    echo '<option value="' . $table . '"' . (($_GET['projectTable'] == $table) ? 'selected = selected' : '') . '>' . $table . '</option>';
                }
                ?>
            </select>
            <input type="submit">
        </p>
    </form>
    <form method="GET">
        <p class="formfield">

            <?php
            if (isset($_GET['projectTable'])) {

                $aDoor = $_GET['projectTable'];
                echo '<input type="hidden" id="projectQueryRequest" name="projectQueryRequest" value="' . $aDoor . '">';
                echo '<strong> Select Attributes </strong>';
                echo '<br />';
                if ($aDoor == "Reservations") {
                    echo ' <p class="attribute"> Reservation ID <input type="checkbox" name="attrReservationsID" value="Yes" /> </p>';
                    echo ' <p class="attribute"> Start Date <input type="checkbox" name="attrStartDate" value="Yes" /> </p>';
                    echo ' <p class="attribute"> End Date <input type="checkbox" name="attrDndDate" value="Yes" /> </p>';
                } else if ($aDoor == "Reserves") {
                    echo ' <p class="attribute"> Reservation ID <input type="checkbox" name="attrReservationsID" value="Yes" /> </p>';
                    echo ' <p class="attribute"> Room Number <input type="checkbox" name="attrRoomNumber" value="Yes" /> </p>';
                } else {
                    echo ' <p class="attribute"> Number <input type="checkbox" name="attrRoomNumber" value="Yes" /> </p>';
                    echo ' <p class="attribute"> Type <input type="checkbox" name="attrRoomType" value="Yes" /> </p>';
                    echo ' <p class="attribute"> Floor <input type="checkbox" name="attrRoomFloor" value="Yes" /> </p>';
                    echo ' <p class="attribute"> Status <input type="checkbox" name="attrRoomStatus" value="Yes" /> </p>';
                    echo ' <p class="attribute"> Price <input type="checkbox" name="attrRoomPrice" value="Yes" /> </p>';
                }
                echo '<br />';
                echo ' <input type="submit" > ';
            }
            ?>


        </p> <br />
    </form>

    <?php

    require_once('db-requests.php');

    function handleRequest()
    {
        if (connectToDB()) {
            if (array_key_exists('selectAttributeQueryRequest', $_GET)) {
                selectAttributeQueryRequest($_GET["selectID"], $_GET["selectStart"], $_GET["selectEnd"]);
            } else if (array_key_exists('viewReservations', $_GET)) {
                viewReservationsRequest();
            } else if (isset($_GET['resetTablesRequest'])) {
                // resetReservationsRequest();
             } else if (isset($_GET['projectQueryRequest'])) {
                projectTableRequest();
             }
            disconnectFromDB();
        }
    }

    handleRequest();


    ?>
</body>

</html>