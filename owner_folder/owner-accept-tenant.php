<?php
include ("../connect.php");

if(isset($_GET['accepteid'])){
    $id = (int) $_GET['accepteid'];

    // 1. First fetch the booking data
    $fetch_booking_sql = "SELECT house_id, owner_id, tenant_id FROM booking_request WHERE id = $id";
    $fetch_result = mysqli_query($con, $fetch_booking_sql);

    if($fetch_result && mysqli_num_rows($fetch_result) > 0){
        $row = mysqli_fetch_assoc($fetch_result);
        $house_id = $row['house_id'];
        $owner_id = $row['owner_id'];
        $tenant_id = $row['tenant_id'];
        // $booking_date = $row['booking_date'];

        // 2. Now update booking_request to accept
        $update_booking_sql = "UPDATE booking_request SET status = 'accept' WHERE id = $id";
        $update_result = mysqli_query($con, $update_booking_sql);

        if($update_result){
            echo "Accept Successful<br>";

            // 3. Insert into booking_accepted
            $insert_accept_sql = "INSERT INTO booking_accepted (house_id, owner_id, tenant_id, booking_date)
                                  VALUES ('$house_id', '$owner_id', '$tenant_id', NOW())";
            $insert_result = mysqli_query($con, $insert_accept_sql);

            // 4. Update house availability
            $update_house_sql = "UPDATE house SET availability = 'unavailable' WHERE id = $house_id";
            $update_house_result = mysqli_query($con, $update_house_sql);

            if($insert_result && $update_house_result){
                echo "Booking recorded and house set to unavailable.";
            }else{
                echo "Error inserting booking or updating house status.";
            }
        }else{
            echo "Failed to update booking status.";
        }
    }else{
        echo "Booking details not found.";
    }
}
?>
