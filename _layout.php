<?php
if (!isset($page)): # формалізм, схожий на Python
	echo 'Invalid access';
endif;
?>
<!doctype html>
<html>

<head>
	<meta charset="utf-8" />
	<title>PV-111</title>
	<!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<!--Import Google Icon Font-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<!-- Local styles -->
	<link rel="stylesheet" href="/style.css" />
</head>

<body>
	<nav>
		<div class="nav-wrapper orange">
			<a href="/" class="brand-logo left ">PV-111</a>
			<ul id="nav-mobile" class="right">
				<li <?php if ($page == 'about.php')
					echo 'class="active"'; ?>>
					<a href="/about">About</a>
				</li>
				<li <?php if ($page == 'forms.php')
					echo 'class="active"'; ?>>
					<a href="/forms">Forms</a>
				</li>
				<li <?php if ($page == 'db.php')
					echo 'class="active"'; ?>>
					<a href="/db">DB</a>
				</li>
				<li>

					<!-- Modal Trigger -->
					<a class="waves-effect waves-light btn modal-trigger" href="#modal1"><span
							class="material-icons">login</span></a>

				</li>

			</ul>
		</div>
	</nav>
	<div class="container">
		<?php include $page; ?>
	</div>


	<!-- Modal Structure -->
	<div id="modal1" class="modal">
		<div class="modal-content">
			<h4>Modal Header</h4>
			<p>A bunch of text</p>
		</div>
		<div class="modal-footer">
			<a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
		</div>
	</div>


	<!-- Compiled and minified JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	<script type="module">
		document.addEventListener('DOMContentLoaded', function () {
			var elems = document.querySelectorAll('.modal');
			var instances = M.Modal.init(elems, {});
		});


	</script>
</body>

</html>