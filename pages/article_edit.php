<?php 

// on regarde si un ID a été fourni
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// on regarde si un formulaire a été soumis
if (isset($_POST['submit'])) {

	// on regarde si un id est passé dans le formulaire, si oui il est prioritaire
	if (isset($_POST['id'])&&$_POST['id']>0)
		$id = (int)$_POST['id'];

        $article=   new Article();
        $article->renseigner($id, $_POST['title'], $_POST['content']);
        $articlerepository->addOrUpdate($article);
  
	// on valide et on redirige
	addMessageRedirect(0,"valid","Votre article a bien été inséré");

} 

// si on est jusqu'ici, il n'y a pas eu de redirection
// il faut donc générer un formulaire
// mais d'abord, regardons si on a un article correspondant à l'identifiant demandé
if ($id>0) {
        $article=   $articlerepository->get($id);
	if ($article!=null) {
		// notre article est pret à etre utilisé
	} else {
		addMessageRedirect(0,"error","Aucun article trouvé avec cet identifiant.");
	}
}

?>
<h2>Ajout/édition d'un article</h2>

<form method="post" action="index.php?page=article_edit">
	<label>Title :<input type="text" name="title" value="<?php echo ($id>0 ? $article->getTitle() : ""); ?>" /></label>
	<label>Content:
		<textarea name="content"><?php echo ($id>0 ? $article->getContent() : ""); ?></textarea>
	</label>
	<input type="hidden" name="id" value="<?php echo $id; ?>" />
	<input type="submit" name="submit" value="Envoyer" />
</form>