<?php
		$db = mysqli_connect("localhost", "root", "", "regis");
		function query ($query)
		{
			global $db;
			$result = mysqli_query($db, $query);
			$rows = [];
			while ($row = mysqli_fetch_assoc($result))
			{
				$rows[] = $row;
			}
			return $rows;
		} 

		function tambah ($data)
		{
			global $db;
			$nama = htmlspecialchars($data["nama"]);
			$noresi = htmlspecialchars($data["noresi"]);
			$tujuanpengiriman = htmlspecialchars($data["tujuanpengiriman"]);
			$lokasi = htmlspecialchars($data["lokasi"]);
			$notelp = htmlspecialchars($data["notelp"]);

			$query = "INSERT INTO resi VALUES ('', '$nama', '$noresi', '$tujuanpengiriman', '$lokasi', '$notelp')";
			mysqli_query($db, $query);

			return mysqli_affected_rows($db);
		}

		function hapus($id)
		{
			global $db;
			mysqli_query($db, "DELETE FROM resi WHERE id = $id");
			return mysqli_affected_rows($db);
		}

		function ubah($data)
		{
			global $db;
			$id = $data["id"];
			$nama = htmlspecialchars($data["nama"]);
			$noresi = htmlspecialchars($data["noresi"]);
			$tujuanpengiriman = htmlspecialchars($data["tujuanpengiriman"]);
			$lokasi = htmlspecialchars($data["lokasi"]);
			$notelp = htmlspecialchars($data["notelp"]);

			$query = "UPDATE resi SET nama = '$nama',
						noresi = '$noresi',
						tujuanpengiriman = '$tujuanpengiriman',
						lokasi = '$lokasi',
						notelp = '$notelp'
						WHERE id = $id
						";
			mysqli_query($db, $query);

			return mysqli_affected_rows($db);
		}

		function cari($keyword)
		{
			$query = "SELECT * FROM resi WHERE 

			
			noresi = '$keyword' 
			
			";		
			return query($query);
		}
		function cari1($keyword)
		{
			$query = "SELECT * FROM resi WHERE 

			
			nama LIKE '%$keyword%' OR
			noresi LIKE '%$keyword%' OR
			tujuanpengiriman LIKE '%$keyword%' OR
			lokasi LIKE '%$keyword%' OR
			notelp LIKE '%keyword%'			
			";		
			return query($query);
		}

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



