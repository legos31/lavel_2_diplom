<?php $this->layout('layout', ['title' => $results[0]['name'], 'category' => $category, 'auth'=>$auth]) ?>
<h4>Новый продукт</h4>
<form action="" method="POST" enctype='multipart/form-data'>
  <div class="form-group">


  <div class="form-group">
      <label for="formGroupExampleInput">Name</label>
      <input type="text" class="form-control" id="formGroupExampleInput" name="name" value="">
    </div>
    <div class="form-group">
      <label for="formGroupExampleInput2">Description</label>
      <input type="text" class="form-control" id="formGroupExampleInput2" name="description" value="">
    </div>
    <div class="form-group">
      <label for="formGroupExampleInput2">Parametrs</label>
      <input type="text" class="form-control" id="formGroupExampleInput2" name="text" value="">
    </div>

    <div class="input-group">
      <div class="input-group mb-3">
        <div class="custom-file">
          <input type="file" name="img">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label for="formGroupExampleInput2">Category</label>
      <select id="inputState" class="form-control" name="category">
        <? foreach($category as $item) {
          if ($item['id'] == $results[0]['category']) {?>
            <option selected><?= $item['name'] ?></option> 
          <?} else {?>
            <option><?= $item['name'] ?></option>
        <?} ?>
          <? }?>
      </select>
    </div>

    <div class="form-group">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="gridCheck" name="status" <? if ($results['0']['status']=='0') echo "checked"?>>
        <label class="form-check-label" for="gridCheck">
          Hide
        </label>
      </div>
    </div>

  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>