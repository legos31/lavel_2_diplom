<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
   <link rel="stylesheet" href="http://lavel2/style.css">
   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
   <title><?=$this->e($title)?></title>
</head>
<body>
   <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
      
         <a class="navbar-brand" href="/">Main</a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>

         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
               <li class="nav-item active">
                  <?if (!$auth->isLoggedIn()) {?>   
                     <a class="nav-link" href="/login">LogIn <span class="sr-only">(current)</span></a>
                  <?} else {?>   
                     <a class="nav-link" href="/logout">LogOut <span class="sr-only" onclick="return confirm('Уверены?')">(current)</span></a>
                  <? }?>   
               </li>
               <li class="cnav-item active">
                  <?if (!$auth->isLoggedIn()) {?>   
                     <a class="nav-link" href="/register">Register <span class="sr-only">(current)</span></a>
                  <?} ?>   
               </li>
               <li class="cnav-item active">
                  <?if ($auth->isLoggedIn()) {?>   
                     <a class="nav-link" href="/users">Users <span class="sr-only">(current)</span></a>
                  <?} ?>   
               </li>
               <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     Category
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                     <? foreach ($category as $item) : ?>
                     <a class="dropdown-item" href="/category/<?=$item['id']?>"><?= $item['name'] ?></a>
                     <? endforeach ?>
                  </div>
               </li>
            </ul>
         </div>
      </nav>
      <?=$this->section('content')?>
   </div>

</body>
</html>