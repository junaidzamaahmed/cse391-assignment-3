  <header>
    <nav class="bg-primary flex justify-between align-center" style="color: white; padding: 30px;">
      <span style="font-size:x-large;">Car Workshop</span>
      <span id="navlinks">
        <a href="index.php">Home</a>
        <a href="contact.php">Contact</a>
        <?php
        if (isset($_SESSION['isAdmin'])) {
          echo '<a href="dashboard.php">Dashboard</a>';
        } ?>
      </span>
      <div>
        <a href="book-appointment.php"> <button class="button-secondary">BOOK AN APPOINTMENT</button>
        </a>
        <?php
        if (isset($_SESSION['email'])) {
        ?><a href="logout.php"> <button class="button-secondary">Logout</button></a>
        <?php   } else {
        ?> <a href="login.php"> <button class="button-secondary">Login/Signup</button></a><?php
                                                                                        }
                                                                                          ?>
      </div>
    </nav>
  </header>