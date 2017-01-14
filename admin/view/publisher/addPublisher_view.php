<div class="content-wrapper right_col">
  <div class="row">
    <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="main-content">
        <h2><?php $msg->display(); ?></h2>
        <h2 class="text-center">Add Publisher</h2>
        <a href="?sk=publisher" title="" class="btn btn-primary"><i class="fa fa-backward" aria-hidden="true"></i> &nbsp;&nbsp;Comeback</a>
        <br /> <br />
        <form action="?sk=publisher&m=add" method="POST" enctype="multipart/form-data" >
          <div class="form-group">
            <label for="txtName">Name Publisher</label>
            <input type="text" class="form-control" id="txtName" placeholder="Name..." name="txtName">
          </div>
          <div class="form-group">
            <label for="txtPhone">Phone Number</label>
            <input type="text" class="form-control" id="txtPhone" placeholder="Phone..." name="txtPhone">
          </div>
          <div class="form-group">
            <label for="txtAddress">Address</label>
            <input type="text" class="form-control" id="txtAddress" placeholder="Address..." name="txtAddress">
          </div>
          <div class="form-group">
            <label for="exampleInputFile">Choose logo</label>
            <input type="file" id="txtFile" name="txtFile">
          </div>
          <button type="submit" name="btnSubmit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" charset="utf-8" async defer>

</script>