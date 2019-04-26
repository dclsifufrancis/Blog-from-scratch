<?php 

require_once('include/db.php');

if (isset($_POST['enregistrer'])) {

	$sql = " CREATE TABLE IF NOT EXISTS users (
		id int ( 11 ) NOT NULL,
		pseudo varchar ( 100 ) NOT NULL,
		email varchar ( 100 ) NOT NULL,
		password varchar ( 100 ) NOT NULL)";
		$pdo->exec($sql);


	// récup des valeurs des inputs
	$pseudo = $_POST['pseudo'];
	$email = $_POST['email'];
	$password1 = $_POST['password1'];
	$password2 = $_POST['password2'];

	// si le champs pseudo est vide 
	if (empty($pseudo)) { 
		// alors message d'erreur
		array_push($errors, "Le pseudo est requis !"); 
	}
	// si le champs email est vide 
	if (empty($email)) { 
		// alors message d'erreur
		array_push($errors, "L'Email est requis !"); 
	}
	// si le champs password1 est vide 
	if (empty($password1)) { 
		// alors message d'erreur
		array_push($errors, "Le mot de passe est requis !"); 
	}
	// si le champ password1 est différent du champ password2
	if ($password_1 != $password_2) {
		// alors message d'erreur
		array_push($errors, "Les mots de passe ne sont pas identique !");
	}

	// prépare la requete de vérif si pseudo saisie déjà existant dans la bdd via ?
	$req = $pdo->prepare('SELECT id FROM membre WHERE pseudo = ?');

	// execute la requete avec un parametre tableau avec 1 seule paramètre "$_POST ['pseudo']"
	$req->execute([$_POST['pseudo']]);

	//récup de l'enregistrement
	$user = $req->fetch();

	// si user existe
	if ($user) { 
		// si la saisie est strictement === $pseudo
		if ($pseudo['pseudo'] === $pseudo) {
			// alors message d'erreur 
			array_push($errors, "Le pseudo existe déjà !");
		}
		// si la saisie est strictement === $email
		if ($user['email'] === $email) {
			// alors message d'erreur 
			array_push($errors, "L'email est déjà utilisé pour un compte !");
		}
	}
	// Si il n'y a pas d'erreur 
	if (count($errors) == 0) {

		// Variable "$req" qui stock la préparation via "?" pour inscrire l'utilisateur
		$req = $pdo->prepare("INSERT INTO users SET pseudo = ?, email = ?, password = ?");

		// Cryptage mdp via methode intégrer à PHP "password_hash" puis l'algorithme à utiliser
		$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

		// execution de la requete avec les 3 paramètre via $_POST
		$req->execute([$_POST['pseudo'], $_POST['email'], $password]);



		$_SESSION['pseudo'] = $pseudo;
		$_SESSION['success'] = "Vous êtes connecté !";

		header('location: connexion.php');
	}
	}

?>



<!-- Header -->
<?php include('include/header.php');?>

<div class="container">
	<div class="card card-register mx-auto mt-5">
		<div class="card-header">Inscription</div>
			<div class="card-body">
				<form method="post" action="inscription.php">
					<?php include('errors.php'); ?>
					<div class="form-group">
						<div class="form-row">
							<div class="col-md-12">
								<label for="pseudo">Pseudo</label>
								<input class="form-control" id="pseudo" type="text"   name="pseudo" value="<?php echo $pseudo; ?>" >
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input class="form-control" id="email" type="email" aria-describedby="emailHelp" name="email" value="<?php echo $email; ?>" >
					</div>
					<div class="form-group">
						<div class="form-row">
							<div class="col-md-6">
							<label for="password1">Mot de passe</label>
							<input class="form-control" id="password1" type="password" name="password1" >
						</div>
						<div class="col-md-6">
							<label for="password2">Confirmation du mot de passe</label>
							<input class="form-control" id="password2" type="password" name="password2" >
							</div>
						</div>
					</div>
					<button type="submit" class="btn btn-primary btn-block" name="enregistrer">Enregistrer</button>
				</form>
			<div class="text-center">
				<a class="d-block small mt-3" href="connexion.php">Connexion</a>
			</div>
		</div>
	</div>
</div>

 <!-- footer -->
<?php include('include/footer.php');?>