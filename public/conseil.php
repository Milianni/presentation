<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="../style/conseil.css" />
	<?php

    use App\GuestBook;
	use App\Message;

	require '../src/Message.php';
	require '../src/GuestBook.php';
	$errors = null;



	require '../elements/header.php';
	?>
</head>

<?php

//logique recup des message et validation

$errors = null;
	$success = false;
	$geustbook = new GuestBook('..' . DIRECTORY_SEPARATOR . 'data ' . DIRECTORY_SEPARATOR . 'messages');

	if (isset($_POST['username']) && isset($_POST['message'])) {
	    $message = new Message($_POST['username'], $_POST['message']);
	    if ($message->is_valide()) {
	        $geustbook->addMessage($message);
	        $_POST = [];
	        $success = true;
	    } else {
	        $errors = $message->getErrors();
	    }
	}
	$messages = $geustbook->getMessages();
	?>

<body>
	<section>
		<div id="intercaler">


		</div>
		<h1>Conseils trucs & astuces</h1>
		<?php if ($success) : ?>
		<div class="alert alert-success">
			Merci pour votre Message
		</div>
		<?php endif ?>
		<?php if (!empty($errors)) : ?>
		<div class="alert alert-danger">
			Formulaire invalide
		</div>
		<?php endif  ?>

		<form action="" method="post">
			<div class="form-group">
				<div id="username"><input
						value="<?= htmlentities($_POST['username'] ?? '') ?>"
						type="text" name="username" placeholder="Votre pseudo"
						class="form-control <?= isset($errors['username']) ? 'is-invalid' : '' ?>">

					<?php if (isset($errors['username'])) : ?>
					<div class="invalid-Feedback">
						<?= $errors['username'] ?>
					</div>
					<?php endif ?>
				</div>
				<div id="message">

					<div class="form-group">
						<textarea name="message" placeholder="Votre Commentaire"
							class="form-control <?= isset($errors['message']) ? 'is-invalid' : '' ?>">
						<?= htmlentities($_POST['message'] ?? '') ?> </textarea>
						<?php if (isset($errors['message'])) : ?>
						<div class="invalid-Feedback">
							<?= $errors['message'] ?>

							<?php endif ?>
						</div>
					</div>
				</div>
				<div id="button"> <button class="btn btn-primary">Envoyer</button>
				</div>
			</div>
		</form>

	</section>

	<footer>
		<article>
			<?php if ($messages) : ?>
			<div id="intercaler">

			</div>

			<h2>Vos Messages</h2>

			<div id="intercaler">

			</div>

			<div id="messages">

				<?php foreach ($messages as $message) : ?>


				<ul>
					<li><?= $message->toHTML() ?>
					</li>
				</ul>


				<?php endforeach  ?>
				<?php endif ?>
		</article>

		</div>

		</div>

		<nav>
			<ul>
				<li><a href="presentation.html">Présentation</a></li>
				<li><a href="conseil.php">conseils</a></li>
				<li><a href="cv.html">CV</a></li>
				<li><a href="#">Contact</a></li>
				<li><a href="#">Le Pendue</a></li>
			</ul>
		</nav>



	</footer>
</body>



<?php require '../elements/footer.php';
	?>