<?php
	session_start();
    if(isset($_SESSION["login"]))
    {
        header("Location:index.php");
        exit;
    }
	require 'fungsi.php';
	if( isset($_POST["daftar"]))
	{
		if(registrasi($_POST) > 0)
		{
			echo "<script>
					alert('akun admin berhasil dibuat');
					document.location.href = 'login.php';  
				</script>";
		}else
		{
			mysqli_error($db);
		}
	}
	if(isset($_POST["login"]))
    {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $result = mysqli_query($db, "SELECT * FROM user WHERE email = '$email'");

        if(mysqli_num_rows($result) === 1 )
        {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row["password"]))
            {
                $_SESSION["login"] = true;

                header("Location: index.php");
                exit;
            }
        }

        $error = true;
    } 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="login.css">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>
<body>
<div class="container" id="container">
	<div class="form-container sign-up-container">
		<form action="login.php" method="post">
			<h1>Create Account</h1><br>
			<span>or use your email for registration</span><br>
			<input type="text" placeholder="Name" name="nama" id="nama" required />
			<input type="email" placeholder="Email" name="email" id="email" required />
			<input type="password" placeholder="Password" name="password" id="password" required />
			<input type="password" placeholder="Konfirmasi Password" name="password2" id="password2" required />
			<input type="number" placeholder="No.Telp" name="telp" id="telp" required /><br>
			<button type="submit" name="daftar">Sign Up</button>
		</form>
	</div>
	<div class="form-container sign-in-container">
		<?php if(isset($error)) : ?>
        <p style="color: red; font-style: italic; text-align: center;">username / password error</p>
    <?php endif; ?>
		<form action="" method="post">
			<h1>Sign in</h1><br>
			<span>or use your account</span><br>
			<input type="email" placeholder="Email" name="email" required />
			<input type="password" placeholder="Password" name="password" required /><br>
			<button name="login" type="submit">Sign In</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Welcome Back!</h1>
				<p>To keep connected with us please login with your personal info</p>
				<button class="ghost" id="signIn">Sign In</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Hello, Friend!</h1>
				<p>Enter your personal details and start journey with us</p>
				<button class="ghost" id="signUp">Sign Up</button>
			</div>
		</div>
	</div>
</div>
</body>

<script  >
	const signUpButton = document.getElementById('signUp');
	const signInButton = document.getElementById('signIn');
	const container = document.getElementById('container');

	signUpButton.addEventListener('click', () => {
		container.classList.add("right-panel-active");
	});

	signInButton.addEventListener('click', () => {
		container.classList.remove("right-panel-active");
	});
</script>

</html>