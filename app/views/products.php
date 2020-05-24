<?php $this->layout('layout', ['title' => 'Каталог продуктов', 'category' => $category, 'auth'=>$auth]) ?>
<h3>Каталог продуктов</h3>
<div><a href="#" class="btn btn-success">New product</a></div>
<? foreach($results as $result):?>
  <div class="card" style="width: 18rem;">
  <div class="card-header">
    <?=$result['name']?>
  </div>
  <div class="img">
    <img src="http://lavel2/<?=$result['img']?>" class="card-img-top" alt="Image">
  </div>
  <div class="card-body">
    <h5 class="card-title"><?=$result['description']?></h5>
    <p class="card-text"><?=$result['text']?></p>
    <a href="/product/<?=$result['id']?>" class="btn btn-primary">View</a>
    <a href="#" class="btn btn-warning">Edit</a>
    <a href="#" class="btn btn-danger">Delete</a>
  </div>
</div>
<?php endforeach?>

