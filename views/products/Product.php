<?php
//global $match;
dump($match);
$id = $match['params']['id'];
dump($id);
dump($params);

?>
<a href="<?php echo $router->generate('acceuil');?>"> acceuil</a>
<a href="<?php echo $router->generate('products');?>">products</a>