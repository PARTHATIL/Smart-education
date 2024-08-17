<form id="register-form" action="register.php" method="POST">
   <?php
   // Check if the form is submitted
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
       // Collect and sanitize form data
       $name = htmlspecialchars(trim($_POST['t_name']));
       $teacherId = htmlspecialchars(trim($_POST['t_Id']));
       $email = htmlspecialchars(trim($_POST['t_email']));
       $password = htmlspecialchars(trim($_POST['t_password']));
       $department = htmlspecialchars(trim($_POST['t_department']));
   
       // Validate the form data
       $errors = [];
   
       if (empty($name)) {
           $errors['name'] = 'Name is required.';
       }
   
       if (empty($teacherId)) {
           $errors['teacherId'] = 'Teacher ID is required.';
       }
   
       if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
           $errors['email'] = 'Invalid email format.';
       }
   
       if (strlen($password) < 6) {
           $errors['password'] = 'Password must be at least 6 characters long.';
       }
   
       if (empty($department)) {
           $errors['department'] = 'Department is required.';
       }
   
       // If no errors, process the registration
       if (empty($errors)) {
           // Hash the password
           $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
   
           // Here you would typically insert the data into the database
           // For example, using PDO:
           /*
           $pdo = new PDO('mysql:host=localhost;dbname=your_database', 'username', 'password');
           $stmt = $pdo->prepare('INSERT INTO teachers (name, teacher_id, email, password, department) VALUES (?, ?, ?, ?, ?)');
           $stmt->execute([$name, $teacherId, $email, $hashedPassword, $department]);
           */
   
           // After successful registration, redirect to the login page
           header('Location: index.html');
           exit();
       } else {
           // If there are errors, you can either display them or redirect back to the form
           // Here we're just redirecting back with error messages as an example
           foreach ($errors as $key => $error) {
               echo "<p>$error</p>";
           }
       }
   }
   ?>
   <?php if (!empty($errors)): ?>
   <div class="errors">
      <?php foreach ($errors as $error): ?>
         <p class="text-danger"><?php echo $error; ?></p>
      <?php endforeach; ?>
   </div>
<?php endif; ?>
