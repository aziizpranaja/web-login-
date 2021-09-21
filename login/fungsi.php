<?php
		$db = mysqli_connect("localhost", "root", "", "regis");
		function registrasi($data)
		{
			global $db;
			$nama = strtolower(stripcslashes($data["nama"]));
            $email = htmlspecialchars($data["email"]);
            $password = mysqli_real_escape_string($db, $data["password"]);
            $password2 = mysqli_real_escape_string($db, $data["password2"]);
            $telp = htmlspecialchars($data["telp"]);

            $result = mysqli_query($db, "SELECT email FROM user WHERE email = '$email'");


			if(mysqli_fetch_assoc($result))
			{
				echo "<script>
					alert('username sudah terdaftar');
					</script>";
					return false;
			}

			if($password !== $password2)
			{
				echo "<script>
					alert('Konfirmasi password tidak sesuai');
					</script>";
					return false;
			}

			$password = password_hash($password, PASSWORD_DEFAULT);
			$query = "INSERT INTO user VALUES ('', '$nama', '$email', '$password', '$telp')";

			mysqli_query($db, $query) or die(mysqli_error($db));

			return mysqli_affected_rows($db);
		}

?>



