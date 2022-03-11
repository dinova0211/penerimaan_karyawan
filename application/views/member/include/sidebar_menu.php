<div id="sidebar" class="sidebar                  responsive">
    <script type="text/javascript">
        try {
            ace.settings.check('sidebar', 'fixed')
        } catch (e) {
        }
    </script>

    <div class="sidebar-shortcuts" id="sidebar-shortcuts">

        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">

            <!--
            <button class="btn btn-success">
                    <i class="ace-icon fa fa-signal"></i>
            </button>

            <button class="btn btn-info">
                    <i class="ace-icon fa fa-pencil"></i>
            </button>


            <button class="btn btn-warning">
                    <i class="ace-icon fa fa-users"></i>
            </button>

            <button class="btn btn-danger">
                    <i class="ace-icon fa fa-cogs"></i>
            </button>
            -->

        </div>

        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <!--
            <span class="btn btn-success"></span>

            <span class="btn btn-info"></span>

            <span class="btn btn-warning"></span>

            <span class="btn btn-danger"></span>
            -->
        </div>
    </div>
    <?php
    $cur1 = $this->uri->segment(2);
    ?>
    <ul class="nav nav-list">
      <li class="<?php echo ($cur1=="dashboard") ? "active" : ""; ?>" style="height: 100%;">
          <a href="<?php echo base_url('admin/dashboard') ?>">
              <i class="menu-icon fa fa-home"></i>
              <span class="menu-text"> Beranda </span>
          </a>
          <b class="arrow"></b>
      </li>
	  <!--
      <li class="<?php echo ($cur1=="datadosen") ? "active" : ""; ?>" style="height: 100%;">
          <a href="<?php echo base_url('admin/datadosen') ?>">
              <i class="menu-icon fa fa-home"></i>
              <span class="menu-text"> Data Dosen </span>
          </a>
          <b class="arrow"></b>
      </li>
	  -->
		<!-- <li class="<?php echo ($cur1=="pengajuan") ? "active" : ""; ?>" style="height: 100%;">
		  <a href="<?php echo base_url('admin/pengajuan') ?>">
			  <i class="menu-icon fa fa-tags"></i>
			  <span class="menu-text"> Pengajuan Mutasi </span>
		  </a>
		  <b class="arrow"></b>
		</li> -->
		<?php if($this->session->loginData['lvl'] == '99'){ ?>

		<!-- ########################### DOSEN ########################### -->
		<li class="<?php echo ($cur1=="pengajuan") ? "active" : ""; ?>">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-tags"></i>
				<span class="menu-text">
					Pengajuan Mutasi
				</span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
				<li class="">
					<a href="<?php echo base_url('admin/pengajuan/add') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						Ajukan Mutasi
					</a>

					<b class="arrow"></b>
				</li>
				<li class="">
					<a href="<?php echo base_url('admin/pengajuan/daftar') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						List Mutasi
					</a>
					<b class="arrow"></b>
				</li>
			</ul>
		</li>
		<?php }else{ ?>
		<!-- ########################### PETUGAS ########################### -->
				<?php if ($this->session->loginData['lvl'] == '6' or $this->session->loginData['lvl']=='1' or  $this->session->loginData['lvl']=='7'){ ?>
				<li class="<?php echo ($cur1=="kriteria") ? "active" : ""; ?>">
					<a href="#" class="dropdown-toggle">
						<i class="menu-icon fa fa-tags"></i>
						<span class="menu-text">
							Kriteria & Sub
						</span>
						<b class="arrow fa fa-angle-down"></b>
					</a>
					<b class="arrow"></b>
					<ul class="submenu">
						<li class="">
							<a href="<?php echo base_url('admin/kriteria/add') ?>">
								<i class="menu-icon fa fa-caret-right"></i>
								Tambah Kriteria
							</a>

							<b class="arrow"></b>
						</li>
						<li class="">
							<a href="<?php echo base_url('admin/kriteria/addsub') ?>">
								<i class="menu-icon fa fa-caret-right"></i>
								Tambah Sub Kriteria
							</a>

							<b class="arrow"></b>
						</li>
						<li class="">
							<a href="<?php echo base_url('admin/kriteria/daftar') ?>">
								<i class="menu-icon fa fa-caret-right"></i>
								List Kriteria
							</a>
							<b class="arrow"></b>
						</li>
						<li class="">
							<a href="<?php echo base_url('admin/kriteria/daftarsub') ?>">
								<i class="menu-icon fa fa-caret-right"></i>
								List Sub Kriteria
							</a>
							<b class="arrow"></b>
						</li>
					</ul>
				</li>
				<!--
				<li class="<?php echo ($cur1=="artikel") ? "active" : ""; ?>">
					<a href="#" class="dropdown-toggle">
						<i class="menu-icon fa fa-tags"></i>
						<span class="menu-text">
							Berita & Informasi
						</span>
						<b class="arrow fa fa-angle-down"></b>
					</a>
					<b class="arrow"></b>
					<ul class="submenu">
						<li class="">
                        <a href="<?php echo base_url('admin/artikel/kategori') ?>">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Data Kategori Artikel
                        </a>

                        <b class="arrow"></b>
                    </li>
					<li class="">
                        <a href="<?php echo base_url('admin/artikel/daftar') ?>">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Data Artikel
                        </a>

                        <b class="arrow"></b>
                    </li>
					</ul>
				</li>-->
				<!--
				<li class="<?php echo ($cur1=="institusi") ? "active" : ""; ?>">
					<a href="#" class="dropdown-toggle">
						<i class="menu-icon fa fa-tags"></i>
						<span class="menu-text">
							Institusi
						</span>
						<b class="arrow fa fa-angle-down"></b>
					</a>
					<b class="arrow"></b>
					<ul class="submenu">
						<li class="">
							<a href="<?php echo base_url('admin/institusi/add') ?>">
								<i class="menu-icon fa fa-caret-right"></i>
								Add
							</a>

							<b class="arrow"></b>
						</li>
						<li class="">
							<a href="<?php echo base_url('admin/institusi/daftar') ?>">
								<i class="menu-icon fa fa-caret-right"></i>
								List
							</a>
							<b class="arrow"></b>
						</li>
					</ul>
				</li>

				<li class="<?php echo ($cur1=="programStudy") ? "active" : ""; ?>">
					<a href="#" class="dropdown-toggle">
						<i class="menu-icon fa fa-tags"></i>
						<span class="menu-text">
							Program Studi
						</span>
						<b class="arrow fa fa-angle-down"></b>
					</a>
					<b class="arrow"></b>
					<ul class="submenu">
						<li class="">
							<a href="<?php echo base_url('admin/programStudy/add') ?>">
								<i class="menu-icon fa fa-caret-right"></i>
								Add
							</a>

							<b class="arrow"></b>
						</li>
						<li class="">
							<a href="<?php echo base_url('admin/programStudy/daftar') ?>">
								<i class="menu-icon fa fa-caret-right"></i>
								List
							</a>
							<b class="arrow"></b>
						</li>
					</ul>
				</li>-->

				

				<li class="<?php echo ($cur1=="karyawan") ? "active" : ""; ?>">
					<a href="#" class="dropdown-toggle">
						<i class="menu-icon fa fa-tags"></i>
						<span class="menu-text">
							Karyawan
						</span>
						<b class="arrow fa fa-angle-down"></b>
					</a>
					<b class="arrow"></b>
					<ul class="submenu">
					
						<li class="">
							<a href="<?php echo base_url('admin/karyawan/add') ?>">
								<i class="menu-icon fa fa-caret-right"></i>
								Add
							</a>

							<b class="arrow"></b>
						</li>
						<li class="">
							<a href="<?php echo base_url('admin/karyawan/daftar') ?>">
								<i class="menu-icon fa fa-caret-right"></i>
								List
							</a>
							<b class="arrow"></b>
						</li>
					</ul>
				</li>
			<?php } ?>
			<?php if ($this->session->loginData['lvl'] == '6' or $this->session->loginData['lvl']=='1' ){ ?>
			<li class="<?php echo ($cur1=="petugas") ? "active" : ""; ?>">
					<a href="#" class="dropdown-toggle">
						<i class="menu-icon fa fa-tags"></i>
						<span class="menu-text">
							User/ Petugas
						</span>
						<b class="arrow fa fa-angle-down"></b>
					</a>
					<b class="arrow"></b>
					<ul class="submenu">
						<li class="">
							<a href="<?php echo base_url('admin/petugas/add') ?>">
								<i class="menu-icon fa fa-caret-right"></i>
								Add
							</a>

							<b class="arrow"></b>
						</li>
						<li class="">
							<a href="<?php echo base_url('admin/petugas/daftar') ?>">
								<i class="menu-icon fa fa-caret-right"></i>
								List
							</a>
							<b class="arrow"></b>
						</li>
					</ul>
				</li>
			<?php } if($this->session->loginData['lvl']=='3' OR $this->session->loginData['lvl']=='2' OR $this->session->loginData['lvl']=='6' OR $this->session->loginData['lvl']=='4' OR $this->session->loginData['lvl']=='5' OR $this->session->loginData['lvl']=='1' or $this->session->loginData['lvl']=='7'){ ?>
	
		<li class="<?php echo ($cur1=="analisa") ? "active" : ""; ?>" style="height: 100%;">
          <a href="<?php echo base_url('admin/analisa/detil_analisa') ?>">
              <i class="menu-icon fa fa-tags"></i>
              <span class="menu-text"> Proses Analisa </span>
          </a>
          <b class="arrow"></b>
		</li>
		<!--
		<li class="<?php echo ($cur1=="proses") ? "active" : ""; ?>">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-tags"></i>
				<span class="menu-text">
					Proses Pengajuan
				</span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
				<li class="">
					<a href="<?php echo base_url('admin/analisa/detil_analisa') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						Proses Analisa
					</a>
					<b class="arrow"></b>
				</li>
				<li class="">
					<a href="<?php echo base_url('admin/proses/daftar') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						Proses Approval & Rejection
					</a>

					<b class="arrow"></b>
				</li>
				<li class="">
					<a href="<?php echo base_url('admin/proses/dapprove') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						List Pengajuan Yang Di Approve
					</a>
					<b class="arrow"></b>
				</li>
				<li class="">
					<a href="<?php echo base_url('admin/proses/dreject') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						List Pengajuan Yang Di Reject
					</a>
					<b class="arrow"></b>
				</li>
			</ul>
		</li>
		-->
		<?php } ?>

			
		<?php } ?>
		<li class="<?php echo ($cur1=="changepassword") ? "active" : ""; ?>" style="height: 100%;">
			<a href="<?php echo base_url('admin/changepassword') ?>">
				<i class="menu-icon fa fa-tags"></i>
				<span class="menu-text"> Ubah Password </span>
			</a>
			<b class="arrow"></b>
		</li>
		<!-- <li class="<?php echo ($cur1=="ketegori") ? "active" : ""; ?>">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-tags"></i>
				<span class="menu-text">
					Contoh Menu
				</span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
				<li class="">
					<a href="<?php echo base_url('admin/kategori/add') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						contoh submenu
					</a>

					<b class="arrow"></b>
				</li>
				<li class="">
					<a href="<?php echo base_url('admin/kategori/daftar') ?>">
						<i class="menu-icon fa fa-caret-right"></i>
						contoh submenu
					</a>
					<b class="arrow"></b>
				</li>
			</ul>
		</li> -->

    </ul><!-- /.nav-list -->

    <!-- #section:basics/sidebar.layout.minimize -->
    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>

    <!-- /section:basics/sidebar.layout.minimize -->
    <script type="text/javascript">
        try {
            ace.settings.check('sidebar', 'collapsed')
        } catch (e) {
        }
    </script>
</div>
