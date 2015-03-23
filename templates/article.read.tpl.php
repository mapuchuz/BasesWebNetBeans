<?php
if ($article) {
    
// on affiche l'article 
?>
<h2>Lecture d'un article</h2>



<article id="<?php echo $article->id; ?>">
	<h1><?php echo $article->getTitle(); ?></h1>
	<p><?php echo nl2br($article->getContent()); ?></p>
</article>

<?php 
// sinon on affiche un message d'erreur
} else {
	echo "<h2>Aucun article avec cet identifiant.</h2>";
}