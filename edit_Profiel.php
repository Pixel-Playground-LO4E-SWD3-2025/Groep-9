<?php require_once 'header.php'; ?>
  
  <?php
  
    include_once 'connection.php';
    
    $user_id = $_SESSION['user_id'];
    if (isset($_POST['change'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
    
    if (!empty($password)){
       $hashed_password = password_hash($password, PASSWORD_DEFAULT);
       $update_query = "UPDATE users SET username = ?, email = ?, password = ? WHERE id= ?";
       $stmt = $conn->prepare($update_query);
       $stmt->execute([$name, $email, $hashed_password, $user_id]);
    }else {
       $update_query = "UPDATE users SET username = ?, email = ? WHERE id=?";
       $stmt = $conn-> prepare($update_query);
       $stmt->execute([$name, $email, $user_id]);
    }
    $_SESSION['username'] = $name;
    header('Location: Profiel.php');
    echo '<article class="success">Profile updated successfully!</article>';
  }

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
               <form action="" method="POST">
               <label class="Label-menu">Name:</label>
               <input class="Input-menu" type="text" name="name" value="<?php echo htmlspecialchars($user['username']); ?>" required><br>
               <label class="Label-menu">Email:</label>
               <input class="Input-menu"type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br>
               <label class="Label-menu">Password:</label>
               <input class="Input-menu" type="password" name=password value="" placeholder="Enter new password for change"><br>
             <button class="Submit-menu" type="submit" name="change">Update Profile</button>
            </article>
      </section>    
    </main>
</body>
<?php require_once 'footer.php'; ?>