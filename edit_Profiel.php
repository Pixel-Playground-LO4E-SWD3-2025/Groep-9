<?php require_once 'header.php'; ?>
  
  <?php
  
    include_once 'connection.php';
    
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt-> execute([$user_id]);
    $user = $stmt-> fetch(PDO::FETCH_ASSOC);
    ?>
   <body>
     <main>
        <section>
            <video class="skycolor" autoplay loop muted src="video/skycolor.mp4"></video>
            <article class="profielpagina">
               <form action = "Profiel.php" method="POST">
               <label class="Label-menu">Name:</label>
               <input class="Input-menu" type="text" name="name" value="<?php echo htmlspecialchars($user['username']); ?>" required><br>
               <label class="Label-menu">Email:</label>
               <input class="Input-menu"type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br>
               <label class="Label-menu">Password:</label>
               <input class="Input-menu" type="password" name=password value="" placeholder="Enter new password for change"><br>
             <button class="Submit-menu" type="submit">update Profile</button>
            </article>
      </section>    
    </main>
</body>
<?php require_once 'footer.php'; ?>