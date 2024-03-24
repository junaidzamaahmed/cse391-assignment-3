  <header>
    <nav class="bg-primary flex justify-between align-center" style="color: white; padding: 30px;">
      <span style="font-size:x-large;"><a style="color:white;text-decoration:none;" href="<?php echo $prefix ?>index.php">Car Workshop</a></span>
      <span id="navlinks">
        <a href="<?php echo $prefix ?>index.php">Home</a>
        <a href="<?php echo $prefix ?>contact.php">Contact</a>
        <?php
        if (isset($_SESSION['isAdmin'])) {
          if ($prefix == "../") { ?>
            <a href="./appointments.php">Dashboard</a>
          <?php
          } else { ?>
            <a href="<?php echo $prefix ?>dashboard/appointments.php">Dashboard</a><?php
                                                                                }
                                                                              } ?>
      </span>
      <div>
        <a href="<?php echo $prefix ?>book-appointment.php"> <button class="button-secondary">BOOK AN APPOINTMENT</button>
        </a>
        <?php
        if (isset($_SESSION['email'])) {
        ?><a href="<?php echo $prefix ?>logout.php"> <button class="button-secondary">Logout</button></a>
        <?php   } else {
        ?> <a href="<?php echo $prefix ?>login.php"> <button class="button-secondary">Login/Signup</button></a><?php
                                                                                                              }
                                                                                                                ?>
      </div>
    </nav>
  </header>