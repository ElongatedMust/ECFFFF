
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reservation</title>
  <link rel="stylesheet" href="../styling/resa.css">
</head>
<body>
  <?php
    require 'header.php'
  ?>
    <div class="resa"> 
      <form method="post" action="process_reservation.php">
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>
        <br>
        <label for="time">Time:</label>
        <input type="time" id="time" name="time" required>
        <br>
        <label for="comments">Comments:</label>
        
        <textarea id="comments" name="comments"></textarea>
        <br>
        <button type="submit" name="submit">Submit</button>
      </form>
    </div>
   
</body>
</html>