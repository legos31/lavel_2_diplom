<?php $this->layout('layout', ['title' => 'User Product']) ?>

<div class="card" style="width: 18rem;">
<div class="card-header">
    Featured
  </div>
  <img src="..." class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text"><?=$this->e($name)?></p>
    <a href="#" class="btn btn-primary">View</a>
    <a href="#" class="btn btn-warning">Edit</a>
    <a href="#" class="btn btn-danger">Delete</a>
  </div>
</div>
