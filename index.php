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
		<title>Wikipedia Polskich miast</title>
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
		<script type="text/javascript" src="scripts/scripts.js"></script>
	</head>
	
	<body>

	 	<!-- header -->
		<nav class="navbar navbar-light bg-light">
			<span class="navbar-text" style="margin-left: 2%;">
				<h1 style="float:left;">Wikipedia</h1>
			</span>
			<div style="float:right; margin-right: 3%; margin-top:1%; margin-bottom:1%;">
				<button type="button" class="btn btn-secondary" style="height:40px;" onclick="onDonateClick()">
					<p>Donate us</p>
				</button>
			</div>
		</nav>

		<!-- sidebar -->
		<div class="flex-shrink-0 p-3 bg-white" style="width: 15%; position:absolute;">
			<ul class="list-unstyled ps-0">
				<li class="mb-1">
					<button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="false">
						Home
					</button>
					<div class="collapse" id="home-collapse">
						<ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
							<li><a href="#" class="link-dark rounded">Overview</a></li>
							<li><a href="#" class="link-dark rounded">Updates</a></li>
							<li><a href="#" class="link-dark rounded">Reports</a></li>
						</ul>
					</div>
				</li>
				<li class="mb-1">
					<button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
					Dashboard
					</button>
					<div class="collapse" id="dashboard-collapse">
						<ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
							<li><a href="#" class="link-dark rounded">Overview</a></li>
							<li><a href="#" class="link-dark rounded">Updates</a></li>
							<li><a href="#" class="link-dark rounded">Reports</a></li>
						</ul>
					</div>
				</li>
				<li class="border-top my-3"></li>
				<li class="mb-1">
					<button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
					Orders
					</button>
					<div class="collapse" id="orders-collapse">
						<ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
							<li><a href="#" class="link-dark rounded">Overview</a></li>
							<li><a href="#" class="link-dark rounded">Updates</a></li>
							<li><a href="#" class="link-dark rounded">Reports</a></li>
						</ul>
					</div>
				</li>
			</ul>
		</div>

		<!-- main -->
		<main class="container" style="width: 85%; margin-left: 15%; margin-top:2%; position: absolute; "> 
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
		</main>

		<script>
			$(document).ready(function() {
			$("#target-content").load("pagination.php?page=1");
			$(".page-link").click(function() {
				var id = $(this).attr("data-id");
				var select_id = $(this).parent().attr("id");
				$.ajax({
					url: "pagination.php",
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

	</body>
</html>