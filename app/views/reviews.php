<?php $this->layout('layout', ['title' => $results[0]['text_rev'], 'category' => $category, 'auth'=>$auth]) ?>
<h4>Редактирование отзыва на телефон <?=$results[0]['name']?></h4>
<? echo $errors->display(); ?>

<form action="" method="POST">
  <div class="form-group">


    <div class="form-group">
      <label for="formGroupExampleInput">Reviews</label>
      <input type="text" class="form-control" id="formGroupExampleInput" name="text_rev" value="<?=$results[0]['text_rev']?>">
    </div>

  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>