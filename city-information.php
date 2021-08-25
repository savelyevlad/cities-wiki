<?php
	define("ABS_PATH", $_SERVER['DOCUMENT_ROOT']);
	include(ABS_PATH . '/wiki/database/database.php');
	$limit = 4;
	$sql_request = "select count(id_miasto) from miasto";
	$sql_result = mysqli_query($connection, $sql_request);
	$row = mysqli_fetch_row($sql_result);
	$records_count = $row[0];
	$pages_count = ceil($records_count / $limit);
?>

<html>
	<head>
		<title>Miastopedia</title>
		<meta charset="utf-8">
		
		<!-- My CSS styles file -->
		<link rel="stylesheet" href="styles/style.css">
		<!-- Bootstrap CSS (jsDelivr CDN) -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<!-- Bootstrap Bundle JS (jsDelivr CDN) -->
		<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
		<!-- ajax -->
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
		<!-- my scripts -->	
		<!-- for some reason this doesn't work: -->
		<script src="scripts/scripts.js"></script>
		<!-- so i made this: -->
		<script>
			function onDonateClick() {
				alert('dziekuję');
			}
		</script>
	</head>
	
	<body>
		<div>
			<!-- header -->
			<?php
				include('templates/header.php');
			?>

			<!-- sidebar -->
			<?php
				include('templates/sidebar.php');
			?>

			<!-- main -->
			<main style="width: 85%; margin-left: 15%; margin-top:2%; position: absolute; ">
				<h2> 
					Miasto <?php echo $_GET["id"] ?> 
					<span style="font-size: 12;">
						[<a href="city-information.php" id="edit">edytuj</a>,
						 <a href="index.php" id="delete_page">usuń</a>]
					</span> 
					<button onclick="kek()">kek</button>
				</h2>
				<div id="content-to-work-with">
					<?php
						$miasto_name = $_GET["id"];
						$sql_request = "select * from miasto where name='$miasto_name'";
						$sql_result = mysqli_query($connection, $sql_request);
						$row = mysqli_fetch_array($sql_result);
						echo($row["description"]);
					?>
				<div>
			</main>
		</div>

		<!-- footer -->
		<?php
			include('templates/footer.php');
		?>

		<script>
			function kek() {
				alert('kek');
			}
			$("#delete_page").click(function(e) {
				if (confirm("Are you sure?")) {
					// <?php
					// 	$miasto_name = $_GET["id"];
					// 	$sql_request = "delete from miasto where name='$miasto_name'";
					// 	$sql_result = mysqli_query($connection, $sql_request);
					// ?>
				} else {
					e.preventDefault();
					return false;
				}
				return x; 
			});
			$("#edit").click(function(e) {
				alert('kek');
				// e.preventDefault();
				// $("#content-to-work-with").html("<?php include 'edit-area.php'; ?>");
			});
		</script>

	</body>
</html>