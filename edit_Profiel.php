<?php require_once 'header.php'; ?>
  
  <?php
  
    include_once 'connection.php';
    
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt-> execute([$user_id]);
    $user = $stmt-> fetch(PDO::FETCH_ASSOC);
    ?>
    <form action = "Profiel.php" method="POST">
      <label>Name:</label>
      <input type="text" name="name" value="<?php echo htmlspecialchars($user['username']); ?>" required><br>
      <label>Email:</label>
      <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br>
      <label>Password:</label>
      <input type="password" name=password value="" placeholder="Enter new password for change"><br>

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