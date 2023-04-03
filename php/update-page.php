<html>
<link rel="stylesheet" href="style.php" media="screen">

<body>
    </br>
    <h1> Query Page </h1>
    </br>

    <form method="POST" action="cpsc304-project.php">

        <p class="formfield">
        <h2> Back To Main Menu</h2>
        <input type="submit" value="Go Back">
        </p>

    </form>

    <h2>Insert a Reservation</h2>
    <form method="POST" action="update-page.php"> <!--refresh page when submitted-->
        <input type="hidden" id="insertQueryRequest" name="insertQueryRequest">
        <p class="formfield">
            Reservation ID: <input type="text" name="insID"> <br /><br />
        </p>

        <p class="formfield">

            Start Date: <input type="text" name="insStart"> <br /><br />
        </p>
        <p class="formfield">

            End Date: <input type="text" name="insEnd"> <br /><br />
        </p>
        <p class="formfield">

            Room Number: <input type="text" name="insRN"> <br /><br />
        </p>
        <input type="submit"></p>
    </form>

    <hr />

    <h2>Update a Reservation</h2>
    <form method="POST" action="cpsc304-project.php"> <!--refresh page when submitted-->
        <input type="hidden" id="updateQueryRequest" name="updateQueryRequest">
        <p class="formfield">
            Reservation ID: <input type="text" name="updID"> <br /><br />
        </p>
        <p class="formfield">
            New Start Date: <input type="text" name="updStart"> <br /><br />
        </p>
        <p class="formfield">
            New End Date: <input type="text" name="updEnd"> <br /><br />
        </p>
        <p class="formfield">
            New Room Number: <input type="text" name="updRN"> <br /><br />
        </p>
        <input type="submit"></p>
    </form>

    <hr />

    <h2>Delete a Reservation</h2>
    <form method="GET" action="update-page.php"> <!--refresh page when submitted-->
        <p class="formfield">
            Reservation ID: <input type="text" name="delID"> <br /><br />
            Start Date: <input type="text" name="delID"> <br /><br />
            End Date: <input type="text" name="delID"> <br /><br />
            Reservation ID: <input type="text" name="delID"> <br /><br />

        </p>
        <input type="submit" name="deleteQueryRequest"></p>
    </form>

    <?php
    require_once('db-requests.php');

    function handleRequest()
    {

        if (connectToDB()) {

            if (array_key_exists('insertQueryRequest', $_POST)) {
                if (isset($_POST["insID"]) && isset($_POST["insStart"]) && isset($_POST["insEnd"]) && isset($_POST["insRN"])) {
                    insertQueryRequest($_POST["insID"], $_POST["insStart"], $_POST["insEnd"], $_POST["insRN"]);
                } else {
                    echo '<p> Error: Missing an Attribute </p>';
                }
            } else if (array_key_exists('deleteQueryRequest', $_GET)) {
                if (isset($_GET["delID"])) {
                    deleteQueryRequest($_GET["delID"]);
                } else {
                    echo '<p> Error: Missing a Reservation ID </p>';

                }
            }
            disconnectFromDB();
        }
    }

    handleRequest();

    ?>


</body>

</html>