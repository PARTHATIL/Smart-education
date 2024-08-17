<form id="login-form" action="login.php" method="POST">
    <?php
    session_start();
    
    // Mock database records for demonstration (replace with actual database query)
    $users = [
        [
            'email' => 'test@example.com',
            'password' => password_hash('password', PASSWORD_DEFAULT), // Hashed password
            'name' => 'Test User'
        ]
    ];
    
    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = htmlspecialchars(trim($_POST['s_email']));
        $password = htmlspecialchars(trim($_POST['s_password']));
    
        $errors = [];
    
        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Please enter a valid email address.';
        }
    
        // Validate password length
        if (strlen($password) < 6) {
            $errors['password'] = 'Password must be at least 6 characters long.';
        }
    
        if (empty($errors)) {
            // Check credentials
            $userFound = false;
            foreach ($users as $user) {
                if ($user['email'] == $email && password_verify($password, $user['password'])) {
                    $_SESSION['user'] = $user['name'];
                    $userFound = true;
                    break;
                }
            }
    
            if ($userFound) {
                // Successful login, redirect to homepage
                header('Location: homepage.html');
                exit();
            } else {
                $errors['login'] = 'Invalid email or password.';
            }
        }
    
        if (!empty($errors)) {
            // Display errors or redirect back with error messages
            foreach ($errors as $error) {
                echo "<p class='text-danger'>$error</p>";
            }
        }
    }
    ?>
    <form id="login-form" action="login.php" method="POST">
        <div class="form-group">
            <input type="email" class="form-control" id="email" name="s_email" placeholder=" " required>
            <label for="email">Email</label>
            <?php if (!empty($errors['email'])): ?>
                <small class="form-text text-danger"><?php echo $errors['email']; ?></small>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" id="password" name="s_password" placeholder=" " required minlength="6">
            <label for="password">Password</label>
            <?php if (!empty($errors['password'])): ?>
                <small class="form-text text-danger"><?php echo $errors['password']; ?></small>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-login btn-block">Login</button>
        <div class="options">
            <a href="forgot_password.html">Forgot password?</a>
            <span>|</span>
            <a href="register.html">Register</a>
        </div>
        <?php if (!empty($errors['login'])): ?>
            <div class="alert alert-danger mt-2"><?php echo $errors['login']; ?></div>
        <?php endif; ?>
    </form>
    if ($userFound) {
        $_SESSION['user'] = $user['name'];
        header('Location: homepage.html');
        exit();
    }
    
    