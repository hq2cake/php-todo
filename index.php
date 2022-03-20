<?php

require_once 'app/init.php';

$itemsQuery = $db->prepare("
    SELECT id,name,done
    FROM items
    WHERE user = :user
");

$itemsQuery->execute([
        'user' => $_SESSION['user_id']
]);

$items = $itemsQuery->rowCount() ? $itemsQuery : [];

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/style.css?1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>TODO</title>
</head>

<body>
 <div class="list">
     <h1 class="header">To do</h1>
     <?php  if(!empty($items)):?>
     <ul class="items">
         <?php foreach ($items as $item):?>
             <li>
                 <span class="item<?php echo $item['done'] ? ' done' : '';?>"><?php echo $item['name'];?></span>
                 <?php if(!$item['done']):?>
                    <a href="mark.php?as=done&item=<?php echo $item['id'];?>" class="done-button">Mark as done</a>
                 <?php endif?>
             </li>
         <?php endforeach;?>
     </ul>
     <?php else:?>
        <p>You haven't added any items yet</p>
     <?php endif;?>

     <form class="item-add" action="add.php" method="post">
         <input type="text" name="name" placeholder="Type a new item here." class="input" autocomplete="off" required>
         <input type="submit" value="add" class="submit" >
     </form>
 </div>
</body>
</html>

