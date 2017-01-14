    <style type="text/css">
    .table > tbody > tr > td {
      vertical-align: middle;
    }
    .myinput{width: 320px;}
    </style>
    <div class="container">
      <div class="row">
        <h3 class="text-center"><?php echo (isset($mess_not_exist_cart) && empty($mess3)) ? $mess_not_exist_cart.' <a href="?cn=index">về trang chủ</a>'.' để mua hàng' : '' ;?></h3>
        <h3 class="text-center"><?php echo $mess3;?></h3>
        <h3 class="text-center"><?php echo $mess1;?></h3>
        <h3 class="text-center"><?php echo $mess2;?></h3>
      </div>
    </div>
     <!--  <div class="heading-bar">
          <a class="more-btn">Tiến hành kiểm tra</a>
      </div> -->
  <?php if(isset($_SESSION['cart'])): ?>
    <div class="container">  
        <div class="table_gio_hang">
            <form method="POST" action="?cn=cart&m=edit" id="form_gio_hang">
                <table class="table table-hover table-striped" style="margin: 0px;padding: 0px;">
                    <tr>
                      <th>&nbsp;</th>
                      <th>Tên sách</th>
                      <th class="center1">Giá 1 Quyển</th>
                      <th class="center1">Số Lượng</th>
                      <th class="center1" >Hình Ảnh</th>
                      <th class="">Thành Tiền</th>
                      <th>Xóa</th>
                    </tr>
                    <?php $i =1;  ?>
                    <?php foreach ($_SESSION['cart'] as $key => $value):?>
                    <tr>
                      <td class="center1">
                      <?php echo $i; ?>
                      </td>
                      <td><?php echo $value['nameBook']; ?>
                        
                      </td>
                      <td class="center1"><?php echo number_format($value['cost']); ?>
                        
                      </td>
                      <td class="center1" ><input class="soluong1" required pattern="[0-9]{1,3}" title="Số lượng phải là chữ số và nhỏ hơn 4 kí tự" name="txtSoLuong[<?php echo $value['idBook']; ?>]" size="2" type="text" value="<?php echo $value['qty']; ?>"/>
                      </td>
                      <td  class="center1 img_gio_hang"><img src="<?php echo PATH_IMG_BOOK.$value['imageBook']; ?>" alt="">
                      </td>
                      <td class="center1"><?php echo number_format($value['qty'] * $value['cost']);?></td>
                      <td ><a href="?cn=cart&m=delete&id=<?php echo $value['idBook']; ?>"><i class="icon-trash"></i></a></td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                    <tr>
                      <td colspan="6" style="text-align: right">
                        <a href="?cn=index" class="btn btn-primary">Tiếp tục mua hàng</a>
                        <button type="submit" style="" class="btn btn-info" name="update">Cập nhật giỏ hàng</button>
                        <a href="?cn=cart&m=remove" class="btn btn-warning">Xóa tất cả</a>
                      </td>
                    </tr>
                </table>
            </form>
        </div>
      
     
        <div class="table_gio_hang">
        <form id="enableForm3" action="?cn=cart&m=orders" method="POST" class="form-horizontal">
          <div class="row">
              <div class="col-md-6 col-xs-12">
                <div class="form-group">
                  <label class="col-md-5 control-label">Họ Tên (*)</label>
                  <div class="col-md-7">
                    <input class="myinput" type="text" value="<?php echo (isset($_SESSION['fullname']) ? get_session_fullname() : ''); ?>" class="form-control" name="txtHoTen" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-5 control-label">Số điện thoại (*)</label>
                  <div class="col-md-7">
                    <input class="myinput" type="text" value="<?php echo get_session_phone(); ?>" class="form-control" name="txtSoDienThoai" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-5 control-label">Email (*)</label>
                  <div class="col-md-7">
                    <input class="myinput" type="email" value="<?php echo get_session_email(); ?>" class="form-control" name="txtEmail" />
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xs-12">
                <div class="form-group">
                  <label class="col-md-5 control-label">Địa chỉ (*)</label>
                  <div class="col-md-7">
                    <input class="myinput" type="text"  value="<?php echo get_session_address(); ?>" class="form-control" name="txtDiaChi" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-5 control-label">Ghi chú</label>
                  <div class="col-md-7">
                    <textarea style="width: 550px;" name="txtGhiChu" ></textarea>
                  </div>
                </div>
              </div>
              <div class="form-group">
                  <input type="submit" name="btnSubmit" class="btn btn-info btn-block" value="Đặt hàng"/>
              </div>
          </div>
        </form>
        </div>
    </div>
  <?php endif; ?>
  