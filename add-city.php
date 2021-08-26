<?php
	define("ABS_PATH", $_SERVER['DOCUMENT_ROOT']);
	include(ABS_PATH . '/wiki/database/database.php');

    if(isset($_POST['nameInput'])) {
        /// isset($_POST['selectedWojewodstwo'])) is true as well
        if(isset($_POST['nameInput'])) {

            $name = $_POST['nameInput'];
            $description = $_POST['descriptionInput'];
            $id_wojewodstwo = $_POST['selectedWojewodstwo'];
            if(!isset($_POST['selectedRzeka'])) {
                $id_rzeka = NULL;
            }
            else {
                $id_rzeka = $_POST['selectedRzeka'];
            }

            $sql_request = "insert into `miasto` (`name`, `description`, `id_wojewodstwo`, `id_rzeka`)
                            values('$name', '$description', $id_wojewodstwo, " . 
                            (($id_rzeka == NULL) ? "NULL" : $id_rzeka) . ");";
            
            if ($connection -> query($sql_request)) {
               // echo "success";
            } else {
                // echo "Error: " . $sql_request . "<br>" . $connection->error;
            }
        }
    }
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
				<form action="add-city.php" method="post">
                    <div class="form-group">
                        <label for="nameInput"><a title="Pole wymagane">Nazwa*</a>:</label>
                        <input class="form-control" name="nameInput" placeholder="Podaj nazwę" style="width: 30%;" required>
                    </div>
                    <div class="form-group" style="margin-top: 10px;">
                        <label for="descriptionInput">Opis:</label>
                        <textarea class="form-control" name="descriptionInput" placeholder="Podaj opis" style="width: 50%; height: 200px;"></textarea>
                    </div>
                    <div class="form-group" style="margin-top: 10px;">
                        <label for="selectedWojewodstwo"><a title="Pole wymagane">Wojewodztwo*</a>:</label>
                        <select class="form-select" style="width: 50%;" name="selectedWojewodstwo" required>
                            <option value="">---</option>
                            <?php
                                $sql_request = "select name,id_wojewodstwo from wojewodstwo order by name;";
                                $sql_result = mysqli_query($connection, $sql_request);
                                while ($row = mysqli_fetch_array($sql_result)) {
                                    echo "<option value='$row[1]'>$row[0]</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group" style="margin-top: 10px;">
                        <label for="selectedRzeka">Rzeka:</label>
                        <select class="form-select" style="width: 50%;" name="selectedRzeka">
                            <option value="">---</option>
                            <?php
                                $sql_request = "select name,id_rzeka from rzeka order by name;";
                                $sql_result = mysqli_query($connection, $sql_request);
                                while ($row = mysqli_fetch_array($sql_result)) {
                                    echo "<option value='$row[1]'>$row[0]</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm" style="margin-top: 10px;">Dodać</button>
                </form>
			</main>
		</div>

		<!-- footer -->
		<?php
			include('templates/footer.php');
		?>

	</body>
</html>