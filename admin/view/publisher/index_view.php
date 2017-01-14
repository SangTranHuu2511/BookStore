
<div class="content-wrapper right_col">
<style type="text/css">
.table > tbody > tr > td {
  vertical-align: middle;
}
</style>
  <div class="row">
    <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="main-content">
        <h2><?php $msg->display(); ?></h2>
        <div class="col-md-3">
          <a href="?sk=publisher&m=add" title="" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> &nbsp;&nbsp;Add Publisher</a>
          <a href="?sk=publisher&m=index" title="" class="btn btn-primary">&nbsp;&nbsp;View All</a>
        </div>
        <div class="col-md-9">
          <button id="btnSearch" name="btnSearch" type="button" class="btn btn-primary pull-right">Search</button>
          <input class="form-control pull-right" type="text" name="txtSearch" id="txtSearch" placeholder="Enter keyword..." style="width: 300px;" value="<?php echo $keyword; ?>" />
        </div>
        <br /><br />
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Logo</th>
              <th>Phone</th>
              <th>Address</th>
              <th>Create Time</th>
              <th class="text-center" colspan="2">Action</th>
            </tr>
          </thead>
          <tbody>
          <?php $i = 1; ?>
          <?php foreach ($dataPublisher as $key => $pb) : ?>
            <tr>
              <td><?php echo $i; ?></td>
              <td><?php echo $pb['TenNXB']; ?></td>
              <td>
                <img width="120" height="120" src="<?php echo PATH_IMG_PUBLISHER . $pb['logo_NXB']; ?>" alt="">
              </td>
              <td><?php echo $pb['SDTNXB']; ?></td>
              <td><?php echo $pb['DiaChiNXB']; ?></td>
              <td><?php echo $pb['create_time']; ?></td>
              <td><a href="?sk=publisher&m=edit&id=<?php echo $pb['id_nxb']; ?>" title="" class="btn btn-primary">Edit</a></td>
              <td><a onclick="deleteData(<?php echo $pb['id_nxb']; ?>);" title="" class="btn btn-primary">Delete</a></td>
            </tr>
          <?php $i++; ?>
          <?php endforeach; ?>
          </tbody>
        </table>
        <?php echo $dataPaging['html']; ?>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" charset="utf-8" async defer>
  function deleteData(id){
    if(confirm("Xoa khong?")){
      window.location.href = "?sk=publisher&m=delete&id="+id;
    }
  }

  $(document).ready(function() {
    $("#btnSearch").click(function() {
      var keyword = $.trim($("#txtSearch").val());
      window.location.href = "?sk=publisher&m=index&page=1&keyword="+keyword;
    });
  });
</script>
