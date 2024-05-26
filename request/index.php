<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Jowari</title>
		<style type="text/css">
			*{
				padding: 0;
				margin: 0;
				font-family: arial;
			}
			input{
				color: #452B4E; 
				width: 300px; 
				border: 0; 
				border-radius: 4px;
				padding: 18px;
				margin-bottom: 8px;
				font-size: 14px;
			}
			button{
				margin-top: 32px;
				padding: 20px;
				background-color: #584060;
				border: 0;
				border-radius: 24px;
				color: white;
				box-shadow: 0 0 5px #3F2748;
				font-size: 16px;
				width: 150px;
			}
		</style>
	</head>
	<body style="height: 100vh; width: 100vw; background-color: #452B4E; color: white; display: flex; justify-content: center; align-items: center;">
		<?php 

			include_once("../api.v1/conn.php");

			if(isset($_GET['code'])){
				$code = mysqli_real_escape_string($conn, $_GET['code']);

				$sql = "SELECT * FROM chama WHERE identifier = '$code'";
				$result = mysqli_query($conn, $sql);

				if($row = mysqli_fetch_assoc($result)){
					$name = $row['name'];
					$chamaid = $row['id'];

					if(isset($_POST['usn'])){
						$phone = mysqli_real_escape_string($conn, $_POST['usn']);
						$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

						$sql = "SELECT * FROM users WHERE phone = '$phone'";
						$result = mysqli_query($conn, $sql);

						if($row = mysqli_fetch_assoc($result)){
							if(password_verify($pwd, $row['pwd'])){
								$userid = $row['id'];

								$sql = "SELECT * FROM members WHERE chamaid = '$chamaid' AND userid = '$userid'";
								$result = mysqli_query($conn, $sql);

								if(!$row = mysqli_fetch_assoc($result)){
									$sql = "INSERT INTO `members`(`chamaid`, `userid`, `status`) VALUES ('$chamaid','$userid','2')";
									mysqli_query($conn, $sql);
									?> 
									<p style="font-size: 14px;">Your request will be confirmed by the group admin!</p>
									<?php 
								}else{
									?>
									<p style="font-size: 14px;">Your request had already been sent!</p>
									<?php 
								}
							}else{		
		?>
		<div style="display: flex; flex-direction: column; align-items: center;">
			<p style="font-size: 24px; margin-bottom: 32px;">Jowari: <?php echo $name; ?></p>
			<form method="POST" style="display: flex; flex-direction: column; align-items: center;">
				<p style="color: #FF805D; width: 330px; font-size: 12px; margin-bottom: 8px;">Wrong credentials</p>
				<input name="usn" placeholder="Your phone number" value="<?php echo $phone; ?>">
				<input name="pwd" type="password" placeholder="Pasword">
				<input name="chama" style="display: none" value="<?php echo $classid; ?>">
				<button>Join</button>
			</form>
		</div>
		<?php
							}
						}else{
		?>
		<div style="display: flex; flex-direction: column; align-items: center;">
			<p style="font-size: 24px; margin-bottom: 32px;">Jowari: <?php echo $name; ?></p>
			<form method="POST" style="display: flex; flex-direction: column; align-items: center;">
				<p style="color: #FF805D; width: 330px; font-size: 12px; margin-bottom: 8px;">Wrong credentials</p>
				<input name="usn" placeholder="Your phone number" value="<?php echo $phone; ?>">
				<input name="pwd" type="password" placeholder="Pasword">
				<input name="chama" style="display: none" value="<?php echo $classid; ?>">
				<button>Join</button>
			</form>
		</div>
		<?php
						}
					}else{
					
		?>
		<div style="display: flex; flex-direction: column; align-items: center;">
			<p style="font-size: 24px; margin-bottom: 32px;">Jowari: <?php echo $row['name']; ?></p>
			<form method="POST" style="display: flex; flex-direction: column; align-items: center;">
				<input name="usn" placeholder="Your phone number">
				<input name="pwd" type="password" placeholder="Pasword">
				<input name="chama" style="display: none" value="<?php echo $row['id']; ?>">
				<button>Join</button>
			</form>
		</div>
		<?php }
				}else{
					?>
					<p style="font-size: 14px;">This chama doesn't exist!</p>
					<?php
				}
			}else{
				?>
				<p style="font-size: 14px;">Please use our app instead!</p>
				<?php
			}
		?>
	</body>
</html>