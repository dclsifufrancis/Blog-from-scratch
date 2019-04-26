<?php 

include('server.php');



















?>

<!-- Header -->
<?php include('include/header.php');?>


<div class="container">
	<div class="card card-login mx-auto mt-5">
		<div class="card-header">Connexion</div>
			<div class="card-body">

				<form method="post" action="login.php">
					<?php include('errors.php'); ?>
					<div class="form-group">
						<label for="pseudo">Pseudo</label>
						<input class="form-control"  type="text" name="pseudo">
					</div>
					<div class="form-group">
						<label for="password">Mot de passe</label>
						<input class="form-control"  type="password" name="password">
					</div>
					<div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
							<input class="form-check-input" type="checkbox">Se souvenir de moi</label>
						</div>
					</div>
					<button type="submit" class="btn btn-primary btn-block" name="login_user">Se connecter</button>
				</form>

			<div class="text-center">
				<a class="d-block small mt-3" href="register.php">Inscription</a>
			</div>
		</div>
	</div>
</div>

 <!-- footer -->
<?php include('include/footer.php');?>