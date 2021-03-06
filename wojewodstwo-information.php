<?php
	define("ABS_PATH", $_SERVER['DOCUMENT_ROOT']);
	include(ABS_PATH . '/wiki/database/database.php');
	$limit = 4;
	$sql_request = "select count(id_wojewodstwo) from wojewodstwo";
	$sql_result = mysqli_query($connection, $sql_request);
	$row = mysqli_fetch_row($sql_result);
	$records_count = $row[0];
	$pages_count = ceil($records_count / $limit);

	if(isset($_POST['editedText'])) {
		$wojewodstwo_name = $_GET["id"];
		$edited_text = $_POST["editedText"];
		$sql_request =  "update wojewodstwo 
						set description='$edited_text'
						where name='$wojewodstwo_name';";
		if($connection->query($sql_request)) {
			echo 'updated';
			// updated
		}
		else {
			echo 'not updated';
			echo $sql_request;
			// not updated
		}
	}

	if(isset($_POST['delete'])) {
		$wojewodstwo_name = $_GET["id"];
		$sql_request = "delete from wojewodstwo where name='$wojewodstwo_name'";
		if($connection->query($sql_request)) {
			echo 'updated';
			// updated
		}
		else {
			echo 'not updated';
			echo $sql_request;
			// not updated
		}
	}
?>

<html>
	<head>
		<title>Miastopedia</title>
		<meta charset="utf-8">
		<style>
			article {
				min-height: 100%;
				display: grid;
				grid-template-rows: auto 1fr auto;
				grid-template-columns: 100%;
			}

			footer {
				background-color: rgb(238, 239, 230);
    			color: rgb(112, 112, 113);
				padding: 1rem;
				text-align: center;
    			vertical-align: middle;
			}

			.main-grid-container {
				display: grid;
				grid-template-columns: 160px auto;
				margin-top: 10px;
				margin-right: 10px;
			}

			.main-link {
                color: rgb(112, 112, 113); 
                text-decoration: none;
            }
		</style>
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
		<script>
            // not needed:
			/*$("#delete_page").click(function(e) {
			 	if (confirm("Are you sure?")) {
					$.post(document.URL, {delete: 1}, function(returnedData) {});
					return true;
			 	} else {
			 		e.preventDefault();
			 		return false;
			 	}
			});*/
			$("#edit").click(function(e) {
				e.preventDefault();
				$("#content-to-work-with").html('<?php include 'edit-area-wojewodstwo.php'; ?>');
			});
			function reloadPage() {
				window.location.reload(false);
			}
			function saveDescription() {
				var editedText = $("#edited-text").val();
				$.post(document.URL, {editedText: editedText}, function(returnedData) {});
				// i made this timeout so sql can update db
				setTimeout(function () {
					location.reload()
				}, 100);
			}
		</script>
	</head>
	
	<body>
		<article>
			<?php include 'templates/header.php' ?>
			<main class="main-grid-container">
				<!-- sidebar -->
				<?php include 'templates/sidebar.php'; ?>
				<!-- main -->
				<div id="main-content"> 
					<h2> 
						Wojew??dstwo <?php echo $_GET["id"] ?> 
						<span style="font-size: 12;">
							[<a href="city-information.php" id="edit">edytuj</a>]
							<!-- <a href="index.php" id="delete_page">usu??</a>] -->
						</span>
					</h2>
					<div id="content-to-work-with">
						<?php
							$wojewodstwo_name = $_GET["id"];
							$sql_request = "select * from wojewodstwo where name='$wojewodstwo_name'";
							$sql_result = mysqli_query($connection, $sql_request);
							$row = mysqli_fetch_array($sql_result);
							echo($row["description"]);
						?>
					<div>
				</div>
			</main>
			<?php include 'templates/footer.php' ?>
		</article>
	</body>
</html>