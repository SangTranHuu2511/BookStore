<div class="content-wrapper right_col">
  <div class="row">
    <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="main-content">
          <h2><?php $msg->display(); ?></h2>
          <div class="col-lg-3">
            <a href="?sk=book&m=add" title="" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> &nbsp;&nbsp;Add Books</a>

            <a href="?sk=book&m=index" title="" class="btn btn-primary">&nbsp;&nbsp;View All</a>
          </div>
          <div class="col-lg-9">
            <button id="btnSearch" name="btnSearch" type="button" class="btn btn-primary pull-right">Search</button>

          <input class="form-control pull-right" type="text" name="txtSearch" id="txtSearch" placeholder="Enter keyword..." style="width: 300px;" value="" />
          </div>
          <br /><br /><br/>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>IMG</th>
              <th>TypeBook</th>
              <th>Author</th>
              <th>Publisher</th>
              <th>Cost</th>
              <th>Create time</th>
              <th colspan="2">Action</th>
            </tr>
          </thead>
          <tbody>
          <?php $i=1; ?>
          <?php foreach ($allDataBook as $key => $b) :?>
            <tr>
              <td><?php echo $i; ?></td>
              <td><?php echo $b['TenSach']; ?></td>
              <td><img src="<?php echo PATH_IMG_BOOK . $b['HinhAnh']; ?>" height="120" width="120" alt=""></td>
              <td><?php echo $b['TenLoai']; ?></td>
              <td><?php echo $b['TenTG']; ?></td>
              <td><?php echo $b['TenNXB']; ?></td>
              <td><?php echo number_format($b['GiaCu']); ?></td>
              <td><?php echo $b['create_time'] ?></td>
              <td>
                <a href="#" class="btn btn-primary" title="">Delete</a>
              </td>
              <td>
                <a href="?sk=book&m=edit&id=<?php echo $b['id']; ?>" class="btn btn-primary" title="">Edit</a>
              </td>
            </tr>
          <?php $i++; ?>
          <?php endforeach; ?>
          </tbody>
        </table>
        </div>
    </div>
  </div>
</div>
