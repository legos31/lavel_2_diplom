<?php $this->layout('layout', ['title' => 'Каталог продуктов', 'category' => $category, 'auth'=>$auth]) ?>
<h3>Список пользователей</h3>
<? if ($auth->isLoggedIn()):?>
  <div><a href="/insert" class="btn btn-success">New product</a></div>
<?endif?>
<? foreach($results as $result):?>
  <div class="card" style="width: 18rem;">
  <div class="card-header">
    <?=$result['username']?>
  </div>
  
  <div class="card-body">
    <h5 class="card-title"><?=$result['email']?></h5>
    <p class="card-text"><?=$result['status']?></p>
    <a href="/users/delete/<?=$result['id']?>" onclick="return confirm('Yes?')" class="btn btn-danger">Delete</a>
  </div>
</div>
<?php endforeach?>