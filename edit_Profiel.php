<?php require_once 'header.php'; ?>
  <?php
    session_start();
    include_once 'connection.php';
    
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM users WHERE id = $user_id";
    $result = $conn->query($query);
    $user = $result -> fetch(PDO::FETCH_ASSOC);
    ?>
    <form action = "Profiel.php" method="POST">
      <label>Name:</label>
      <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required><br>
      <label>Email:</label>
      <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br>

      <button type="submit">update Profile</button>

   
   <body>
     <main>
        <section>
            <video class="skycolor" autoplay loop muted src="video/skycolor.mp4"></video>
            <article class="profielpagina">


             
            </article>
      </section>    
    </main>
</body>
<?php require_once 'footer.php'; ?>