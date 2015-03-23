
<h2>Ajout/édition d'un article</h2>

<form method="post" action="index.php?control=article&action=edit">
	<label>Title :<input type="text" name="title" value="<?php echo ($id>0 ? $article->getTitle() : ""); ?>" /></label>
	<label>Content:
		<textarea name="content"><?php echo ($id>0 ? $article->getContent() : ""); ?></textarea>
	</label>
	<input type="hidden" name="id" value="<?php echo $id; ?>" />
	<input type="submit" name="submit" value="Envoyer" />
</form>