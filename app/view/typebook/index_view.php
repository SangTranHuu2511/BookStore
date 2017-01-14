<div id="right">
  <h2>Thể loại sách</h2>
  <section class="grid-holder features-books">
    <?php foreach ($dataTypeBook as $key => $b) : ?>
      <figure class="span4 slide first chinh1">
          <a href="?cn=index&m=detail&name=<?php echo vn2latin($b['TenSach']).'-'.$b['id']; ?>"><img src="<?php echo PATH_IMG_BOOK . $b['HinhAnh']; ?>" alt="" class="pro-img"/></a>
          <p>
              <span class="title">
                  <a href="?cn=index&m=detail&name=<?php echo vn2latin($b['TenSach']).'-'.$b['id']; ?>" style="font-weight: bold"><?php echo $b['TenSach']; ?></a>
              </span>
          </p>
          <p>Thể loại:
              <a class="nxb" href="?cn=typebook&m=index&idType=<?php echo $b['id_loai']; ?>" style="background-color: red;"><?php echo $b['TenLoai']; ?></a>
          </p>
          <p>Tác giả:
              <a class="nxb" href="#"><?php echo $b['TenTG']; ?></a>
          </p>
          <p>Nhà xuất bản:
              <a class="nxb" href="#"><?php echo $b['TenNXB']; ?></a>
          </p>
          <div class="cart-price">
              <a class="cart-btn2" href="?cn=cart&m=add&id=<?php echo $b['id']; ?>">Thêm vào giỏ hàng</a>
              <span class="price"><?php echo number_format(($b['GiaMoi'] != 0)? $b['GiaMoi']: $b['GiaCu']); ?> đ</span>
          </div>
      </figure>
  <?php endforeach; ?>
  </section>
</div>