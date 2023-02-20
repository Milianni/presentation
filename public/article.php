<?php

use App\GuestBook;
use App\Message;

require '../elements/header.php';
$errors = null;
$title = "Conseils & Astuces";
if (isset($_POST['username']) && isset($_POST['message'])) {
    $message = new Message($_POST['username'], $_POST['message']);
    if ($message->is_valide()) {
        $geustbook = new GuestBook('..' / 'data ' . DIRECTORY_SEPARATOR . 'messages');
        $geustbook->addMessage($message);
    } else {
        $errors = $message->getErrors();
    }
}
?>
<!-- Begin page content -->

<div class="container">
	<h1>Conseil & Astuces</h1>
	<?php if (!empty($errors)) : ?>
	<div class="alert alert-danger">
		Formulaire invalide
		<?php endif ?>
	</div>
	<form action="" method="post">
		<div class="form-group">
			<input
				value="<?= ($_POST['username']) ?? '' ?>"
				type="text" name="username" placeholder="Votre pseudo"
				class="form-control <?= isset($errors['username']) ? 'is-invalid' : '' ?>">
			<?php if (isset($errors['username'])) : ?>
			<div class="invalid-feedback">
				<?= $errors['username'] ?>
			</div>
			<?php endif ?>

		</div>
		<div class="form-group">
			<textarea name="message" placeholder="Vos Conseils "
				class="form-control <?= isset($errors['message']) ? 'is-invalid' : '' ?>"><?= ($_POST['message']) ?? '' ?></textarea>
		</div>
		<?php if (isset($errors['message'])) : ?>
		<div class="invalid-feedback">
			<?= $errors['message'] ?>
		</div>
		<?php endif ?>

		<button class="btn btn-primary">Envoyer</button>
	</form>
</div>
</main>
<?php require '../elements/footer.php';
?>