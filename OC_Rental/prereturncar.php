<!DOCTYPE html>
<html>
<?php 
session_start();
require 'connection.php';
$conn = Connect();
?>
<?php include 'assets.php';?>
<?php include 'header.php';?>



<?php $login_customer = $_SESSION['login_customer']; 

    $sql1 = "SELECT c.car_name, rc.rent_start_date, rc.rent_end_date, rc.fare, rc.id FROM rentedcars rc, cars c
    WHERE rc.customer_username='$login_customer' AND c.car_id=rc.car_id AND rc.return_status='NR' AND rc.rent_end_date <= CURDATE()";
    $result1 = $conn->query($sql1);

    if (mysqli_num_rows($result1) > 0) {
?>
<div class="container" style="padding-top: 6rem">
    <div class="jumbotron">
        <h1 class="text-center">Return your cars here</h1>
        <p class="text-center"> Hope you enjoyed our service </p>
    </div>
</div>

<div class="table-responsive" style="padding-left: 100px; padding-right: 100px;">
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th width="30%">Car</th>
                <th width="20%">Rent Start Date</th>
                <th width="20%">Rent End Date</th>
                <th width="20%">Fare</th>
                <th width="10%">Action</th>
            </tr>
        </thead>
        <?php
        while($row = mysqli_fetch_assoc($result1)) {
?>
        <tr>
            <td><?php echo $row["car_name"]; ?></td>
            <td><?php echo $row["rent_start_date"] ?></td>
            <td><?php echo $row["rent_end_date"]; ?></td>
            <td>Rs.<?php echo ($row["fare"] . "/day");?></td>


            <td><a id="return" href="returncar.php?id=<?php echo $row["id"];?>"> Return </a></td>
        </tr>
        <?php } ?>
    </table>
</div>
<?php } else {
            ?>
<div class="container" style="padding-top: 6rem">
    <div class="jumbotron">
        <h1 class="text-center">No cars to return.</h1>
        <p class="text-center"> Hope you enjoyed our service </p>
    </div>
</div>

<?php
        } ?>

</body>

<div style="padding-top:15rem">
    <?php include 'footer.php';?>

</html>