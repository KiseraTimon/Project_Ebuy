<?php
session_start();
if (!isset($_SESSION['userType']) && $_SESSION['userType'] != 'admin') {
echo '<script>
        alert("You are not authorized to view this page.");
        // window.location.href = "/index.php";
        </script>';
exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add an event | Car Depot</title>
    <link
        href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"
        rel="stylesheet"
    />
    <link rel="stylesheet" href="/pageclasses/assets/css/sell.css" />
    <link rel="stylesheet" href="/styles.css" />
    <link rel="stylesheet" href="/defaults.css" />
</head>
<body>
<div class="major">
    <h1>Add an event</h1>
    <p>Events are  good opportunities to connect petrolheads</p>

    <div class="form">
        <form action="eventsupload.php" method="POST" enctype="multipart/form-data">
            <h2>Event Details</h2>

            <!--Event name-->
            <div class="form-group">
                <label for="evtname">Event Name</label>
                <input type="text" name="evtname" id="name" required maxlength="50">
            </div>

            <!--Event type-->
            <div class="form-group">
                <label for="evttype">Event Type</label>
                <select name="evttype"required>
                    <option>General</option>
                    <option>Sales Event</option>
                    <option>Car Auction</option>
                    <option>Car Show</option>
                    <option>Car Launch</option>
                    <option>Car Sale</option>
                    <option>Meetup</option>
                    <option>Service Clinic</option>
                    <option>Test Drive</option>
                    <option>Track Day</option>
                    <option>Other</option>
                </select>
            </div>

            <!--Event description-->
            <div class="form-group">
                <label for="evtdesc">Event Description</label>
                <textarea name="evtdesc"required maxlength="200" placeholder="Tell us more about the event"></textarea>
            </div>

            <!--Event date-->
            <div class="form-group">
                <label for="evtdate">Event Date (dd/mm/yyyy)</label>
                <input type="text" name="evtdate" required maxlength="30">
            </div>

            <!--Event time-->
            <div class="form-group">
                <label for="evttime">Event Hours (format: 24hr-system. Do not write the 'hrs' part as it is done for you)</label>
                <input type="text" name="evttime" required maxlength="30" placeholder="Start time">
            </div>

            <!--Event location-->
            <div class="form-group">
                <label for="evtlocation">Event Location</label>
                <input type="text" name="evtlocation" required maxlength="100">
            </div>

            <!--Event hosts-->
            <div class="form-group">
                <label for="evthost">Event Host</label>
                <input type="text" name="evthost" required maxlength="30">
            </div>

            <!--Event registration-->
            <div class="form-group">
                <label for="evtreg">Event Registration</label>
                <select name="evtreg" required>
                    <option>None</option>
                    <option>Open</option>
                    <option>Closed</option>
                </select>
            </div>

            <!--Event link-->
            <div class="form-group">
                <label for="evtlink">Registration Link</label>
                <input type="text" name="evtlink" required maxlength="200">
            </div>

            <!--Event cost-->
            <div class="form-group">
                <label for="evtcost">Event Cost</label>
                <select name="evtcost">
                    <option>Free</option>
                    <option>Charged</option>
                </select>
            </div>

            <!--Event notes-->
            <div class="form-group">
                <label for="evtnotes">Additional notes (e.g. dress code, age restrictions, mentions etc)</label>
                <textarea name="evtnotes" required maxlength="300">
                </textarea>
            </div>

            <!--Contact-->
            <div class="form-group">
                <label for="evtcont">Leave a contact</label>
                <input type="number" name="evtcont" required maxlength="10">
            </div>
    
            <!--Contact method-->
            <div class="form-group">
                <label for="evtcontmethod">Preferred Contact Method</label><br>
                <select name="evtcontmethod">
                    <option>Any</option>
                    <option>Email</option>
                    <option>Phone</option>
                    <option>SMS</option>
                    <option>WhatsApp</option>
                </select>
            </div>

            <!--Event tags-->
            <div class="form-group">
                <label for="evttags">Tags</label>
                <select name="evttags">
                    <option>None</option>
                    <option>Family-friendly</option>
                    <option>Food and drinks</option>
                    <option>Freebies</option>
                    <option>Music</option>
                    <option>Networking</option>
                    <option>Prizes</option>
                    <option>Special guests</option>
                    <option>Test drives</option>
                </select>
            </div>
            
            <!--Event image-->
            <div class="form-group">
                <label for="evtimage[]">Event Image</label>
                <input type="file" name="evtimages[]" required multiple>
            </div>

            <!--Submit-->
            <div class="form-group">
                <input type="submit" value="Submit">
            </div>
        </form>
    </div>
</div>

<?php
$footer->footercont();
?>