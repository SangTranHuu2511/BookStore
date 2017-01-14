<aside class="main-sidebar">
          <!-- sidebar: style can be found in sidebar.less -->
          <section class="sidebar">
              <!-- Sidebar user panel -->
              <div class="user-panel">
                  <div class="pull-left image">
                      <img src="../../public/images/dt.jpg" class="img-circle" alt="User Image">
                  </div>
                  <div class="pull-left info">
                      <p><?php echo (isset($_SESSION['username'])) ? $_SESSION['username'] : ''; ?></p>
                      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                  </div>
              </div>
              <!-- search form -->
              <form action="#" method="get" class="sidebar-form">
                  <div class="input-group">
                      <input type="text" name="q" class="form-control" placeholder="Search...">
                      <span class="input-group-btn">
                          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                          </button>
                      </span>
                  </div>
              </form>
              <!-- /.search form -->
              <!-- sidebar menu: : style can be found in sidebar.less -->
              <ul class="sidebar-menu">
                  <li <?php echo ($cn == 'index') ? "class='active'" : ""; ?>>
                      <a href="?sk=index"><i class="fa fa-home"></i>Trang chủ</a>
                  </li>
                  <li <?php echo ($cn == 'book') ? "class='active'" : ""; ?> >

                      <a href="?sk=book"><i class="fa fa-book"></i>Quản lý sách </a>
                  </li>
                  <li <?php echo ($cn == 'publisher') ? "class='active'" : ""; ?>>

                      <a href="?sk=publisher"><i class="fa fa-th"></i>Nhà xuất bản </a>
                  </li>
                  <li>
                      <a href="?sk=loaisach"><i class="fa fa-th"></i>Loại sách</a>
                  </li>
                  <li>
                      <a href="?sk=tacgia"><i class="fa fa-th"></i>Tác giả</a>
                  </li>
                  <li>
                      <a href="?sk=orders"><i class="fa fa-th"></i>Đơn hàng</a>
                  </li>
                  <li>
                      <a href=""><i class="fa fa-th"></i>Chi tiết đơn hàng</a>
                  </li>
                  <li>
                      <a href="?sk=taikhoan"><i class="fa fa-th"></i>Thành viên</a>
                  </li>
                  <li>
                      <a><i class="fa fa-th"></i>Thống kê</a>
                  </li>
                  <li>
                      <a><i class="fa fa-th"></i>Báo cáo</a>
                  </li>
              </ul>
          </section>
          <!-- /.sidebar -->
      </aside>
