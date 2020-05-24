<?php $this->layout('layout', ['title' => $results[0]['name'], 'category' => $category, 'auth'=>$auth]) ?>
<h4>Описание продукта</h4>
<form>
  <div class="form-group">
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text">Имя</span>
      </div>
      <textarea class="form-control" aria-label="With textarea"><?=$results[0]['name']?></textarea>
    </div>

    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text">Описание</span>
      </div>
      <textarea class="form-control" aria-label="With textarea"><?=$results[0]['description']?></textarea>
    </div>

    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text">Праметры</span>
      </div>
      <textarea class="form-control" aria-label="With textarea"><?=$results[0]['text']?></textarea>
    </div>

    <div class="input-group">
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
        </div>
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
          <label class="custom-file-label" for="inputGroupFile01">Выберете файл</label>
        </div>
      </div>
    </div>

    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <div class="input-group-text">
          <input type="checkbox" aria-label="Checkbox for following text input">
        </div>
      </div>
      <input type="text" class="form-control" aria-label="Text input with checkbox">
    </div>

  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>