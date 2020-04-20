<?php
	header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
	header('Pragma: no-cache'); // HTTP 1.0.
	header('Expires: 0'); // Proxies.
	$error = "";
	if(isset($_POST['submit'])){
		include_once("php_scripts/db_conn.php");
		$_uid = $_POST['username'];
		$_pass = $_POST['password'];

		if(isset($_uid) && isset($_pass)){
			$_login_query = mysqli_query($GLOBALS['conn'],"SELECT * FROM computicket_staff JOIN user_roles 
			WHERE computicket_staff.username = '$_uid' AND computicket_staff.pass_key = '$_pass'  
			AND computicket_staff.role = user_roles.role_id LIMIT 1") or die(mysqli_error($conn));
			if($_login_query){
				if(mysqli_num_rows($_login_query) > 0){
					$rows = mysqli_fetch_assoc($_login_query);
					if($rows['status'] === "Active"){	
						session_start();
						$_SESSION['timeout'] = time();
						$_SESSION['uid'] = $_uid;
						$_SESSION['access'] = "granted";
						$_SESSION['fullname'] = $rows['f_name']." ".$rows['l_name'];
						$_SESSION['role'] = $rows['role'];

						header("LOCATION: index.php");
					}else if($rows['status'] === "Deactivated"){
						$GLOBALS['error'] = "<div class='ui warning message'>Alert: Your account is no longer in service!</div>";
					}else if($rows['status'] === "Unconfirmed"){
						$GLOBALS['error'] = "<div class='ui warning message'>Alert: Please verify your account before proceeding!</div>";
					}
				}else{
					$GLOBALS['error'] = "<div class='ui negative message'>Access Denied: Wrong Username or Password!</div>";
				}
			}else{
				$GLOBALS['error'] = "<div class='ui negative message'>Error: Could not perform authentication process!: ".mysqli_error($GLOBALS['conn'])."</div>";
			}
		}else{
			$GLOBALS['error'] = "<div class='ui negative message'>Error: Failed to authenticate!</div>";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Authentication</title>
	<link rel="stylesheet" type="text/css" href="../lib/semantic/dist/semantic.min.css">
    <link rel="icon" href="../assets/img/Computicket.jpg" type="image/jpg">

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/custom.css">
  <link rel="stylesheet" href="../css/fonts.css">


    <script type="text/javascript" src="../js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="../lib/semantic/dist/semantic.min.js"></script>
    <style>
	    @font-face{
		  font-family:"electra";
		  src:url("http://localhost/maxiko_dashboard/fonts/electr.ttf");
		}
		@font-face{
		  font-family:"era";
		  src:url("http://localhost/maxiko_dashboard/fonts/eras.ttf");
		}

    	body{
    		background: #fff;
    	}
    	#password,#username{
    		text-align: center;
    		font-family: nuni-reg;
    		text-align: center;
    	}
    	#login_btn{
    		font-family: nuni-reg;
    		
    	}#login_title{
    		font-family: mali-reg;
    		color:red;
    		font-size: 2.5em;
    	}
    	#login_form{
    		padding:.3em;
    		padding-top: 10%;
    		background: rgb(0,0,0,.7);
    	}
    </style>
</head>
<body>
	<div class="ui grid">
		<div class="six wide column"></div>
		<div class="four wide column">
			<center>
				<div class="ui image small">
					<img src="../assets/img/logo-main.png">
				</div>
				<h1 id="login_title">ADMIN LOGIN PORTAL</h1>
				<br>
				<form  action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
					<div class="row">
						<div class="col-12 form-group">
							<input type="email" name="username" id="username" class="form-control form-control-md flat-field" placeholder="Username" required/>
						</div><br>
						<div class="col-12 form-group">
							<input type="password"  name="password" id="password" class="form-control form-control-md flat-field" placeholder="Password" required/>
						</div><br>
						<div class="col-12 form-group">
							<input style="width:60%;" type="submit" name="submit" value="Log In"  class="btn btn-success btn-md flat-field"/>
						</div>
					</div>	
				</form>
				<?php echo $GLOBALS['error']; ?>
			</center>
		</div>
		<div class="six wide column"></div>
	</div>

</body>
</html>