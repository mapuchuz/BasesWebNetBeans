

<!-- supprimer un article  -->
<h2>Confirmer la suppression</h2>

<form method="post" action="index.php?page=article_delete">
	<p><strong>Voulez-vous confirmer la suppression de l'article <?php echo $id; ?> ?<strong></p>
	<p>Titre : <?php echo $article->getTitle(); ?></p>
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
	<input type="submit" name="confirmer" value="Confirmer" />
	<input type="submit" name="annuler" value="Annuler" />
</form>