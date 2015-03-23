<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

<!--
<li id="<?php echo $article['id']; ?>">
	<a href="index.php?page=article_read&id=<?php echo $article['id']; ?>"><?php echo $article['title']; ?></a>
	- <a href="index.php?page=article_edit&id=<?php echo $article['id']; ?>">edit</a>
	- <a href="index.php?page=article_delete&id=<?php echo $article['id']; ?>">delete</a>
</li>
-->


<!--
<article id="<?php echo $article['id']; ?>">
	<h1><?php echo $article['title']; ?></h1>
	<p><?php echo nl2br($article['content']); ?></p>
</article>
-->

	<p>Titre : <?php echo $article['title']; ?></p>

        
        	<label>Title :<input type="text" name="title" value="<?php echo ($id>0 ? $article['title'] : ""); ?>" /></label>
	<label>Content:
		<textarea name="content"><?php echo ($id>0 ? $article['content'] : ""); ?></textarea>
	</label>

                
                // on forge la requete SQL
$sql = "SELECT * FROM article WHERE id=".$id;

// on passe la requete SQL à PDO
$statement = $db->query($sql);

// on récupère le premier (et unique) résultat de la requete
// si on a un article on l'affiche
$statement->setFetchMode(PDO::FETCH_CLASS, "Article");
if ($article = $statement->fetch()) {