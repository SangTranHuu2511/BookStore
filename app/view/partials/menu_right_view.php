</section>
    <section class="span3">
        <div class="side-holder">
            <article class="banner-ad">
                <img src="public/images/khuyenmai.jpg" alt=""/>
            </article>
        </div>
        <div class="side-holder">
            <article class="shop-by-list">
                <h2>Danh mục sản phẩm</h2>
                <div class="side-inner-holder">
                    <strong class="title">Thể loại</strong>
                    <ul class="side-list">
                    <?php foreach($typeBook as $k => $type): ?>
                        <li><a href="?cn=typebook&m=index&idType=<?php echo $type['id_loai']; ?>"><?php echo $type['TenLoai']; ?></a></li>
                    <?php endforeach; ?>
                    </ul>

                    <strong class="title">Giá</strong>
                    <ul class="side-list">
                        <li><a href="?cn=price&m=index&idPC=1">Từ 0đ - 500,000đ</a></li>
                        <li><a href="?cn=price&m=index&idPC=2">Từ 500,000đ - 1,000,000đ</a></li>
                        <li><a href="?cn=price&m=index&idPC=3">Lớn hơn 1,000,000đ</a></li>
                    </ul>
                    <strong class="title">Tác giả</strong>
                    <ul class="side-list">
                    <?php foreach($author as $k => $au): ?>
                        <li><a href="#"><?php echo $au['TenTG']; ?></a></li>
                    <?php endforeach; ?>
                    </ul>
                    <strong class="title">Nhà xuất bản</strong>
                    <ul class="side-list">
                    <?php foreach($publisher as $k => $pb): ?>
                        <li><a href="?cn=publisher&m=index&idPB=<?php echo $pb['id_nxb']; ?>"><?php echo $pb['TenNXB']; ?></a></li>
                    <?php endforeach; ?>
                    </ul>
                </div>
            </article>
        </div>
        <div class="side-holder">
            <article class="l-reviews">
                <h2>Sách xem nhiều nhất</h2>
                <?php foreach($bookTop5 as $key => $value): ?>
                    <div class="side-inner-holder">
                        <article class="r-post sach_xem_nhieu">
                            <div class="r-img-title">
                                <a href="#"><img src="<?php echo PATH_IMG_BOOK.$value['HinhAnh']; ?>"/></a>
                                <div class="r-det-holder span6">
                                    <strong class="r-author">Tên sách: <a href="?cn=index&m=detail&name=<?php echo vn2latin($value['TenSach']).'-'.$value['id'];?>"><?php echo $value['TenSach']; ?></a></strong>
                                </div>
                                <div class="r-det-holder span6">
                                    <span class="r-by">Tên tác giả:<a href="#"><?php echo $value['TenTG']; ?></a></span>
                                    <span class="r-by">Giá: <?php echo number_format(($value['GiaMoi']!= 0) ? $value['GiaMoi'] : $value['GiaCu']); ?></span>
                                    <span class="r-by">Số Lượt Xem: <?php echo $value['SoLuotXem']; ?></span>
                                </div>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
            </article>
        </div>
    </section>
  </section>
</section>