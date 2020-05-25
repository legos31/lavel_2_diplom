<?php $this->layout('layout', ['title' => $results[0]['name'], 'category' => $category, 'auth'=>$auth]) ?>
<h4>Описание продукта</h4>
<?d($results)?>
<?d($category)?>
<form>
  <div class="form-group">


  <div class="form-group">
      <label for="formGroupExampleInput">Name</label>
      <input type="text" class="form-control" id="formGroupExampleInput" name="name" value="<?=$results[0]['name']?>" disabled>
    </div>
    <div class="form-group">
      <label for="formGroupExampleInput2">Description</label>
      <input type="text" class="form-control" id="formGroupExampleInput2" name="description" value="<?=$results[0]['description']?>" disabled>
    </div>
    <div class="form-group">
      <label for="formGroupExampleInput2">Parametrs</label>
      <input type="text" class="form-control" id="formGroupExampleInput2" name="text" value="<?=$results[0]['text']?>" disabled>
    </div>

    <div class="input-group">
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
        </div>
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" value="<?=$results[0]['img']?>" disabled>
          <label class="custom-file-label" for="inputGroupFile01">Выберете файл</label>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label for="formGroupExampleInput2">Category</label>
      <? foreach($category as $item) {
        if ($item['id'] == $results[0]['category']) {
          $name = $item['name'];
        }
      } ?>
      <input type="text" class="form-control" id="formGroupExampleInput2" name="text" value="<?=$name?>" disabled>
    </div>

    <div class="form-group">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="gridCheck" disabled>
        <label class="form-check-label" for="gridCheck">
          Hide
        </label>
      </div>
    </div>

  </div>

</form>