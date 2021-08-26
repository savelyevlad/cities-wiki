<?php
	define("ABS_PATH", $_SERVER['DOCUMENT_ROOT']);
	include(ABS_PATH . '/wiki/database/database.php');
	$limit = 5;
	$sql_request = "select count(id_rzeka) from rzeka";
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
                <div id="main-content"> 
                    <div class="table-wrapper">
                            <div id="target-content">loading...</div>
                            <div>
                                <ul class="pagination">
                                    <?php
                                    if(!empty($pages_count)) {
                                        for($i = 1; $i <= $pages_count; $i++) {
                                                if($i == 1) {
                                    ?>
                                                    <li class="pageitem active" id="<?php echo $i;?>"><a href="JavaScript:Void(0);" data-id="<?php echo $i;?>" class="page-link" ><?php echo $i;?></a></li>									
                                    <?php 
                                                }
                                                else {
                                    ?>
                                                    <li class="pageitem" id="<?php echo $i;?>"><a href="JavaScript:Void(0);" class="page-link" data-id="<?php echo $i;?>"><?php echo $i;?></a></li>
                                    <?php
                                                }
                                            }
                                        }
                                    ?>
                                    </ul>
                                </ul>
						    </div>
					    </div>
				    </div>
                </div>
			</main>
            <script>
				$(document).ready(function() {
				$("#target-content").load("pagination-rzeka.php?page=1");
				$(".page-link").click(function() {
					var id = $(this).attr("data-id");
					var select_id = $(this).parent().attr("id");
					$.ajax({
						url: "pagination-rzeka.php",
						type: "GET",
						data: {
							page : id
						},
						cache: false,
						success: function(dataResult) {
							$("#target-content").html(dataResult);
							$(".pageitem").removeClass("active");
							$("#" + select_id).addClass("active");
						}
					});
				});
			});
			</script>
		</div>

		<!-- footer -->
		<?php
			include('templates/footer.php');
		?>

	</body>
</html>