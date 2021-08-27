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
        <!-- this doesn't work: -->
		<!-- <link rel="stylesheet" href="/styles/style.css"> -->
		<!-- Bootstrap CSS (jsDelivr CDN) -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<!-- Bootstrap Bundle JS (jsDelivr CDN) -->
		<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
		<!-- ajax -->
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
		<!-- my scripts -->	
		<!-- for some reason this doesn't work: -->
		<script src="scripts/scripts.js"></script>
	</head>
	
	<body>
        <article>
			<?php include 'templates/header.php' ?>
			<main class="main-grid-container">
				<!-- sidebar -->
				<?php include 'templates/sidebar.php'; ?>
				<!-- main -->
				<div id="main-content"> 
                <form action="add-city.php" method="post">
                    <div class="form-group">
                        <label for="nameInput"><a title="Pole wymagane">Nazwa*</a>:</label>
                        <input class="form-control" name="nameInput" placeholder="Podaj nazwę" style="width: 80%;" required>
                    </div>
                    <div class="form-group" style="margin-top: 10px;">
                        <label for="descriptionInput">Opis:</label>
                        <textarea class="form-control" name="descriptionInput" placeholder="Podaj opis" style="width: 80%; height: 200px;"></textarea>
                    </div>
                    <div class="form-group" style="margin-top: 10px;">
                        <label for="selectedWojewodstwo"><a title="Pole wymagane">Wojewodztwo*</a>:</label>
                        <select class="form-select" style="width: 80%;" name="selectedWojewodstwo" required>
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
                        <select class="form-select" style="width: 80%;" name="selectedRzeka">
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
				</div>
			</main>
			<?php include 'templates/footer.php' ?>
		</article>

	</body>
</html>