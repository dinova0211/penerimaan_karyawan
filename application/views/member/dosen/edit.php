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
                    Edit Data Restoran
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
                    Form Edit Data Restoran
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo base_url().'admin/dosen/doUpdate/'.$this->uri->segment(4);?>" role="form"> 
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
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Kode</label>
                            <div class="col-sm-9">
                                <input type="text" id="form-field-1" name="NIP" value="<?php echo $dataDetail['nip'] ?>" placeholder="Isi NIP" class="col-xs-10 col-sm-5" readonly required/>
                            </div>
                        </div>
						
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nama Dosen</label>
                            <div class="col-sm-9">
                                <input type="text" id="form-field-1" name="nama" value="<?php echo $dataDetail['nama'] ?>" placeholder="Isi Nama Dosen" class="col-xs-10 col-sm-5" required/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">E-mail</label>
                            <div class="col-sm-9">
                                <input type="text" id="form-field-1" name="email" value="<?php echo $dataDetail['email'] ?>" placeholder="Isi E-Mail" class="col-xs-10 col-sm-5" required/>
                            </div>
                        </div>
						
						<!--
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Password</label>
                            <div class="col-sm-9">
                                <input type="password" id="form-field-1" name="password" value="" placeholder="Isi Password" class="col-xs-10 col-sm-5"/>
                                <i style="color:red;">*) Jika tidak di ubah silahkan kosongkan password</i>
                            </div>
                        </div>
						-->

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">No Hp</label>
                            <div class="col-sm-9">
                                <input type="text" id="form-field-1" name="noHp" value="<?php echo $dataDetail['nohp'] ?>" placeholder="Isi No Hp" class="col-xs-10 col-sm-5" required/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Alamat</label>
                            <div class="col-sm-9">
                                <textarea  name="alamat"  class="col-xs-10 col-sm-5" required> <?php echo $dataDetail['alamat'] ?></textarea>
                            </div>
                        </div>
						<!--
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Jenis Kelamin</label>
                            <div class="col-sm-9">
                                <select name="jk" required>
                                    <option value="laki" <?php if($dataDetail['jeniskelamin']=="laki") echo "selected"; ?>>Laki - Laki</option>
                                    <option value="perempuan" <?php if($dataDetail['jeniskelamin']=="perempuan") echo "selected"; ?>>Perempuan</option>
                                </select>
                            </div>
                        </div>-->
						
						<div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Foto</label>
                            <div class="col-sm-9">
                                <input type="file" id="form-field-1" name="foto" >
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"></label>
                            
							<div class="col-sm-9">
							<img src="<?php echo base_url('uploads/'.$dataDetail['foto']); ?>" width="100">
							</div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Is Active</label>
                            <div class="col-sm-9">
                                <select name="isActive" required>
                                    <option value="1" <?php if($dataDetail['is_active']=="1") echo "selected"; ?> >Yes</option>
                                    <option value="0" <?php if($dataDetail['is_active']=="0") echo "selected"; ?> >No</option>
                                </select>
                            </div>
                        </div>
						
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-info" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                    Simpan
                                </button>

                                &nbsp; &nbsp; &nbsp;
                                <button class="btn" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i>
                                    Reset
                                </button>
                            </div>
                        </div>

                        <div class="hr hr-24"></div>

                    </form>


                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->