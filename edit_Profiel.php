<?php require_once 'header.php'; ?>
  
  <?php
  
    include_once 'connection.php';
     $user_id = $_SESSION['user_id'];

    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt-> execute([$user_id]);
    $user = $stmt-> fetch(PDO::FETCH_ASSOC);
    

    if (isset($_POST['change'])){
       $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $profile_photo = null;



    if(isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] == 0){
      $upload_dir = 'uploads/profile_photos/';

      if (!is_dir($upload_dir)){
        mkdir($upload_dir, 0755, true);

      }
      $allowed_types =['image/jpeg', 'image/jpg' , 'image/png', 'image/gif'];
      $file_type = $_FILES['profile_photo']['type'];

      if (in_array($file_type, $allowed_types)){
        $file_extension = pathinfo($_FILES['profile_photo']['name'], PATHINFO_EXTENSION);
        $new_file_name = 'Profile_' . $user_id . '.' . $file_extension;
        $upload_path = $upload_dir . $new_file_name;
        if (move_uploaded_file($_FILES['profile_photo']['tmp_name'], $upload_path )){
           $profile_photo = $upload_path;

       }       
    }
 }
       
 
    if (!empty($password)){
       $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        if($profile_photo){
            $update_query = "UPDATE users SET username = ?, email = ?, password = ?, profile_photo = ?  WHERE id= ?";
            $stmt = $conn->prepare($update_query);
            $stmt->execute([$name, $email, $hashed_password, $profile_photo, $user_id]);   
    }else {
       $update_query = "UPDATE users SET username = ?, email = ?, password = ? WHERE id=?";
       $stmt = $conn->prepare($update_query);
       $stmt->execute([$name, $email, $hashed_password, $user_id]);
    }
  
    }else {
    if($profile_photo){
      $update_query = "UPDATE users SET username = ?, email = ?, profile_photo = ? WHERE id =?";
      $stmt = $conn ->prepare($update_query);
      $stmt->execute([$name, $email, $profile_photo, $user_id]);
    }else{
      $update_query = "UPDATE users SET username = ?, email = ? WHERE id = ?";
      $stmt = $conn->prepare($update_query);
      $stmt->execute([$name, $email,  $user_id]);
  }
}
      $_SESSION['username'] = $name;
      header('Location: Profiel.php');
      echo '<article class="success">Profile updated successfully!</article>';
      exit();
}

  
  

    ?>
   <body>
     <main>
        <section>
            <video class="skycolor" autoplay loop muted src="video/skycolor.mp4"></video>
            <article class="profielpagina">
               <form action="" method="POST" enctype="multipart/form-data">
               <label class="Label-menu">Profile Photo:</label>
               <input class="Input-menu" type="file" name="profile_photo" accept="image/*"><br>
               <label class="Label-menu">Name:</label>
               <input class="Input-menu" type="text" name="name" value="<?php echo htmlspecialchars($user['username']); ?>" required><br>
               <label class="Label-menu">Email:</label>
               <input class="Input-menu"type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br>
               <label class="Label-menu">Password:</label>
               <input class="Input-menu" type="password" name= "password" value="" placeholder="Enter new password for change"><br>
             <button class="Submit-menu" type="submit" name="change">Update Profile</button>
            </article>
      </section>    
    </main>
</body>
<?php require_once 'footer.php'; ?>