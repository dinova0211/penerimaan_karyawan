<div class="main-content">
    <div class="main-content-inner">
        <!-- #section:basics/content.breadcrumbs -->
        <div class="breadcrumbs" id="breadcrumbs">
            <script type="text/javascript">
                try {
                    ace.settings.check('breadcrumbs', 'fixed')
                } catch (e) {
                }
            </script>
 
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Beranda</a>
                </li>

                <li>
                    Edit Data Karyawan
                </li>
            </ul><!-- /.breadcrumb -->

            <!-- #section:basics/content.searchbox -->
            <div class="nav-search" id="nav-search">
                <form class="form-search">
                    <span class="input-icon">
                        <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                        <i class="ace-icon fa fa-search nav-search-icon"></i>
                    </span>
                </form>
            </div><!-- /.nav-search -->

            <!-- /section:basics/content.searchbox -->
        </div>

        <!-- /section:basics/content.breadcrumbs -->
        <div class="page-content">
            <!-- #section:settings.box -->
            <div class="ace-settings-container" id="ace-settings-container">
                <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
                    <i class="ace-icon fa fa-cog bigger-130"></i>
                </div>

                <div class="ace-settings-box clearfix" id="ace-settings-box">
                    <div class="pull-left width-50">
                        <!-- #section:settings.skins -->
                        <div class="ace-settings-item">
                            <div class="pull-left">
                                <select id="skin-colorpicker" class="hide">
                                    <option data-skin="no-skin" value="#438EB9">#438EB9</option>
                                    <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                                    <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                                    <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
                                </select>
                            </div>
                            <span>&nbsp; Choose Skin</span>
                        </div>

                        <!-- /section:settings.skins -->

                        <!-- #section:settings.navbar -->
                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar" />
                            <label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
                        </div>

                        <!-- /section:settings.navbar -->

                        <!-- #section:settings.sidebar -->
                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar" />
                            <label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
                        </div>

                        <!-- /section:settings.sidebar -->

                        <!-- #section:settings.breadcrumbs -->
                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs" />
                            <label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
                        </div>

                        <!-- /section:settings.breadcrumbs -->

                        <!-- #section:settings.rtl -->
                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" />
                            <label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
                        </div>

                        <!-- /section:settings.rtl -->

                        <!-- #section:settings.container -->
                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container" />
                            <label class="lbl" for="ace-settings-add-container">
                                Inside
                                <b>.container</b>
                            </label>
                        </div>

                        <!-- /section:settings.container -->
                    </div><!-- /.pull-left -->

                    <div class="pull-left width-50">
                        <!-- #section:basics/sidebar.options -->
                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" />
                            <label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
                        </div>

                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" />
                            <label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
                        </div>

                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" />
                            <label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
                        </div>

                        <!-- /section:basics/sidebar.options -->
                    </div><!-- /.pull-left -->
                </div><!-- /.ace-settings-box -->
            </div><!-- /.ace-settings-container -->

            <!-- /section:settings.box -->
            <div class="page-header">
                <h1>
                    Halaman Penilaian Karyawan Baru
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('admin/karyawan/pnl_edit');?>" role="form"> 
                        <input type="hidden" name="id_penilaian" value="<?php echo $this->uri->segment(4); ?>">
                        <input type="hidden" name="id_karyawan" value="<?php echo $this->uri->segment(5); ?>">
                       <?php 
                       $dataOld = $this->session->flashdata('oldPost'); 
                       echo $this->session->flashdata('msgbox');?>
                        <!-- #section:elements.form -->
						<div class="form-group">        
                          <div class="col-sm-2" style="border-bottom: 2px solid #6EBACC;">  
                            Harap isi isian di bawah ini:
                          </div>
                        </div>
						
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nama Karyawan</label>
                            <div class="col-sm-9">
                                <input type="text" id="form-field-1" name="nama" value="<?php echo $detailkriteria['namaPengguna']; ?>" placeholder="Isi Nama Karyawan" class="col-xs-10 col-sm-5" readonly />
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Kriteria</label>
                            <div class="col-sm-9">
                               <select name="kriteria1" class="col-xs-10 col-sm-5" id="kriteria1" required >
                                   <option value="<?php echo $detailkriteria['idkriteria']; ?>"><?php echo $detailkriteria['namaKriteria']; ?></option>
                                    <?php $sql = $this->db->query("select * from kriteria order by namaKriteria asc")->result();
									foreach ($sql as $value){
									?>
									<option value="<?= $value->idKriteria?>"><?= $value->namaKriteria?></option>
									<?php } ?>
                                </select>
                            </div>
                        </div>
						
					    <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Sub Kriteria</label>
                            <div class="col-sm-9">
                               <select name="kriteria2" id="kriteria2" class="col-xs-10 col-sm-5" required>
                                    <option value="<?php echo $detailkriteria['idsubkriteria']; ?>"><?php echo $detailkriteria['namaSubKriteria']; ?></option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nilai</label>
                            <div class="col-sm-9">
                                <input type="number" name="nilai" id="nilai" min="1" max="100" class="col-xs-10 col-sm-5" value="<?php echo $detailkriteria['nilai']; ?>" required>
                            </div>
                        </div>

             
						
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-info" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                    Simpan
                                </button>

                                &nbsp; &nbsp; &nbsp;
                               <a href="<?php echo site_url('admin/karyawan/daftar'); ?>" class="btn">    <i class="ace-icon fa fa-undo bigger-110"></i>
                                    Kembali</a>
                                
                            </div>
                        </div>

                        <div class="hr hr-24"></div>

                    </form>


                </div><!-- /.col -->
                
                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Id Karyawan</th>
                            <th>Nama</th>
                            <th>Kriteria</th>
                            <th>Sub Kriteria</th>
                            <th>Nilai</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=0; foreach($data_penilaian as $row) { $no++; ?>
                        <tr>
                            <td><?php echo $no ?></td>
                            <td><?php echo $row['idpengguna']; ?></td>
                            <td><?php echo $row['namaPengguna']; ?></td>
                            <td><?php echo $row['namaKriteria']; ?></td>
                            <td><?php echo $row['namaSubKriteria']; ?></td>
                            <td><?php echo $row['nilai']; ?></td>
                            <td>
                                <a href="<?php echo base_url('admin/karyawan/edit_penilaian/'.$row['idpenilaian']).'/'.$row['idpengguna']; ?>"><button class="btn btn-primary btn-sm"   style="margin-left:2px" onclick="return confirm('Anda yakin ingin memperbarui data ini ? ')"><i class="fa fa-pencil" style="font-size: 14px;"></i>&nbsp;&nbsp;<span>Lihat/Edit</span></button></a>
                                &nbsp; &nbsp; &nbsp;
                                <a href="<?php echo base_url('admin/karyawan/pnDelete/'.$row['idpenilaian']).'/'.$row['idpengguna']; ?>"><button class="btn btn-danger btn-sm"   style="margin-left:2px" onclick="return confirm('Anda yakin ingin menghapus data ini ? ')"><i class="fa fa-trash" style="font-size: 14px;"></i>&nbsp;&nbsp;<span>Hapus</span></button></a>  
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
<script>
    $("#kriteria1").change(function(){
        var cb_kriteria1 = $("#kriteria1").val();
        var post_data = {
            'cb_kriteria1' : cb_kriteria1
        }
        // alert(cb_kriteria1);
        $.ajax({
            type : "POST",
            url : "<?php echo site_url('admin/karyawan/select_sub_kriteria') ?>",
            data : post_data,
            success : function(data)
            {
                $("#kriteria2").html(data);
                // console.log(data);
            }
        })
    })
</script>