<div class="content-wrapper right_col">
  <div class="row">
    <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="main-content">
        <h2><?php $msg->display(); ?></h2>
        <?php if(isset($_SESSION['error']) && !empty($_SESSION['error'])) : ?>
          <div class="row">
            <ul>
            <?php foreach ($_SESSION['error'] as $key => $val) : ?>
              <?php if(!empty($val)): ?>
              <li style="color: red;"><?php echo $val; ?></li>
              <?php endif; ?>
            <?php endforeach; ?>
            </ul>
          </div>
        <?php endif; ?>
        <h2 class="text-center">Add Books</h2>
        <a href="?sk=book" title="" class="btn btn-primary"><i class="fa fa-backward" aria-hidden="true"></i> &nbsp;&nbsp;Comeback</a>
        <br /> <br />
        <form action="?sk=book&m=add" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="txtNameBook">Name Book</label>
            <input type="text" class="form-control" id="txtNameBook" placeholder="name book" name="txtNameBook">
          </div>
          <div class="form-group">
            <label for="slcAuthor">Choose Author</label>
            <select name="slcAuthor" id="slcAuthor" class="form-control">
            <?php foreach ($dataAuthor as $key => $au) : ?>
              <option value="<?php echo $au['id_tg']; ?>"><?php echo $au['TenTG']; ?></option>
            <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="slcPublisher">Choose Publisher</label>
            <select name="slcPublisher" id="slcPublisher" class="form-control">
            <?php foreach($dataPublisher as $key => $pb) : ?>
              <option value="<?php echo $pb['id_nxb']; ?>"><?php echo $pb['TenNXB']; ?></option>
            <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label for="slcTypeBook">Choose Type Book</label>
            <select name="slcTypeBook" id="slcTypeBook" class="form-control">
            <?php foreach($dataTypeBook as $key => $type): ?>
              <option value="<?php echo $type['id_loai']; ?>"><?php echo $type['TenLoai']; ?></option>
            <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="txtFileName">Choose image</label>
            <input type="file" id="txtFileName" name="txtFile">
          </div>

          <div class="form-group">
            <label for="txtCostBook">Cost book</label>
            <input type="text" class="form-control" id="txtCostBook" placeholder="cost book" name="txtCostBook">
          </div>

          <div class="form-group">
            <label for="txtQTYBook">QTY book</label>
            <input type="text" class="form-control" id="txtQTYBook" placeholder="QTY book" name="txtQTYBook">
          </div>

          <div class="form-group">
            <label for="txPageBook">Page book</label>
            <input type="text" class="form-control" id="txPageBook" placeholder="Page book" name="txPageBook">
          </div>

          <button type="submit" name="btnSubmit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>