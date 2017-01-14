<div class="content-wrapper right_col">
<style type="text/css" media="screen">
  th, td {
    border-bottom: 1px solid #ddd;
}
</style>
  <div class="row">
    <h2 class="text-center">Danh sách đơn hàng !!!</h2>
  </div>
<?php foreach($listOrders as $key => $value): ?>
  <div class="row">
    
    <div class="col-md-12" style="border-bottom: 2px dotted green ; margin: 20px 0px;background-color: #CCFFFF;">
      <div class="col-md-2">
        <p>
          <img width="100%" height="250px;" src="<?php echo PATH_IMG_BOOK . $value['imgBook'];?>" alt="">
        </p>

        <h3 class="text-center"><?php echo $value['nameBook']; ?></h3>
      </div>
      <div class="col-md-10" style="background-color: white;">
        <div class="table-responsive">
          <table class="table table-bordered" style="margin-top: 10px;">
            <thead>
              <tr>
                <th>STT</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Address</th>
                <th>Qty</th>
                <th>Money</th>
                <th>Create</th>
                <th>Note</th>
                <th colspan="2" class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
            <?php $i = 1; ?>
            <?php foreach($value['list'] as $k => $v): ?>
              <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo$v['TenKH']; ?></td>
                <td><?php echo$v['SDT']; ?></td>
                <td><?php echo$v['Email']; ?></td>
                <td><?php echo$v['DiaChi']; ?></td>
                <td><?php echo$v['SoLuong']; ?></td>
                <td><?php echo number_format($v['ThanhTien']);?></td>
                <td><?php echo$v['create_time']; ?></td>
                <td><?php echo$v['GhiChu']; ?></td>
                <td><button type="button" class="btn btn-small btn-primary" onclick="update(<?php echo $v['id_hd']; ?>,1);">Xác nhận</button></td>
                <td><button type="button" class="btn btn-small btn-danger" onclick="update(<?php echo $v['id_hd']; ?>,2);">Hủy</button></td>
              </tr>
            <?php $i++; ?>
            <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
   
  </div>
<?php endforeach; ?>
</div>
<script type="text/javascript">
  function update(id,type){
    $.ajax({
      url: '?sk=orders&m=handleOrder',
      type: 'POST',
      data: {id: id,type:type},
      success : function(data){
        if(data == 'success'){
          alert('Thanh Cong');
          window.location.reload(true);

        }
        else if(data == 'false in db'){
          alert('Co Loi xay ra trong db');

        }
        else if(data == 'Xoa Thanh Cong'){
          alert('Xoa Thanh Cong');
          window.location.reload(true);
        }
        else if(data == 'delete That Bai Trong Db'){
          alert('Xoa That Bai Loi Trong Db');

        }

      }
    }) 
    
  }
</script>