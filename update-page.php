<html>
<link rel="stylesheet" href="style.php" media="screen">

<body>

    <h2>Insert a Reservation</h2>
    <form method="POST" action="cpsc304-project.php"> <!--refresh page when submitted-->
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
        <input type="submit" value="Insert" name="insertSubmit"></p>
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
    <form method="DELETE" action="cpsc304-project.php"> <!--refresh page when submitted-->
        <p class="formfield">
            Reservation ID: <input type="text" name="deleteQueryRequest"> <br /><br />
        </p>
        <input type="submit"></p>
    </form>
</body>

</html>