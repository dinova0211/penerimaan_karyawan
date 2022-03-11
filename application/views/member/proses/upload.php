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
                    Detail Data Mutasi Mutasi
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
                    Form Upload Surat Mutasi
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                    </small>
                </h1>
            </div><!-- /.page-header -->
            <div class="row"> 
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <form class="form-horizontal" enctype="multipart/form-data" id="form1" method="post"> 
                       <?php 
                       $dataOld = $this->session->flashdata('oldPost'); 
                       echo $this->session->flashdata('msgbox');?>
                        <!-- #section:elements.form -->
						<div class="form-group">        
                          <div class="col-sm-2" style="border-bottom: 2px solid #6EBACC;">
                            Harap isi isian di bawah ini:
                          </div>
                        </div>
						<?php //debugCode($detailKandidat); ?>
						<div class="form-group"> 
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">NIP </label>
                            <div class="col-sm-9">
                                <div class="col-sm-3 control-label" style="text-align: left; width: 1px; padding-left: 1px; font-weight: bold;" for="form-field-1">
                                    :
                                </div>
                                <div class="col-sm-3 control-label" style="text-align: left; padding-left: 2px; font-weight: bold;" for="form-field-1">
                                    <?php echo $detailKandidat['nipDosen']; ?>
                                    <input type="hidden" name="idDosen" value="<?php echo $detailKandidat['idDosen'] ?>"></input>
                                </div>
                                
                            </div>
                        </div>

                        <div class="form-group"> 
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nama Dosen </label>
                            <div class="col-sm-9">
                                <div class="col-sm-3 control-label" style="text-align: left; width: 1px; padding-left: 1px; font-weight: bold;" for="form-field-1">
                                    :
                                </div>
                                <div class="col-sm-3 control-label" style="text-align: left; padding-left: 2px; font-weight: bold;" for="form-field-1">
                                    <?php echo $detailKandidat['namaDosen']; ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group"> 
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Fakultas Asal </label>
                            <div class="col-sm-9">
                                <div class="col-sm-3 control-label" style="text-align: left; width: 1px; padding-left: 1px; font-weight: bold;" for="form-field-1">
                                    :
                                </div>
                                <div class="col-sm-3 control-label" style="text-align: left; padding-left: 2px; font-weight: bold;" for="form-field-1">
                                    <?php echo $detailKandidat['faAsal']; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Fakultas Tujuan </label>
                            <div class="col-sm-9">
                                <div class="col-sm-3 control-label" style="text-align: left; width: 1px; padding-left: 1px; font-weight: bold;" for="form-field-1">
                                    :
                                </div>
                                <div class="col-sm-3 control-label" style="text-align: left; padding-left: 2px; font-weight: bold;" for="form-field-1">
                                    <?php echo $detailKandidat['faTujuan']; ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Program Studi Asal </label>
                            <div class="col-sm-9">
                                <div class="col-sm-3 control-label" style="text-align: left; width: 1px; padding-left: 1px; font-weight: bold;" for="form-field-1">
                                    :
                                </div>
                                <div class="col-sm-3 control-label" style="text-align: left; padding-left: 2px; font-weight: bold;" for="form-field-1">
                                    <?php echo $detailKandidat['psd_asal']; ?>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Program Studi Tujuan </label>
                            <div class="col-sm-9">
                                <div class="col-sm-3 control-label" style="text-align: left; width: 1px; padding-left: 1px; font-weight: bold;" for="form-field-1">
                                    :
                                </div>
                                <div class="col-sm-3 control-label" style="text-align: left; padding-left: 2px; font-weight: bold;" for="form-field-1">
                                    <?php echo $detailKandidat['psd_tujuan']; ?>
                                </div>
                            </div>
                        </div>

						<div class="form-group"> 
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Surat Mutasi </label>
                            <div class="col-sm-9">
                                <div class="col-sm-3 control-label" style="text-align: left; width: 1px; padding-left: 1px; font-weight: bold;" for="form-field-1">
                                    :
                                </div>
                                <div class="col-sm-3 control-label" style="text-align: left; padding-left: 2px;" for="form-field-1">
                                   <input type="file" name="file"/>
                                </div>
                            </div>
						&nbsp; &nbsp; <i style=" color: rgb(31, 106, 191);">*) Supported File : (.xlxs, .xls, .doc, .docx, .pdf() AND Max Size : (2MB)</i>
                        </div>
                       

                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <a href="<?php echo base_url('admin/proses/dapprove/') ?>" class="btn btn-sm"   style="margin-left:2px">
                                        <i class="fa fa-arrow-left" style="font-size: 14px;"></i>&nbsp;&nbsp;<span>Back</span>
                                </a>
                                <a onclick="submitForm1()"  class="btn btn-primary btn-sm btnEmptySaldo" style="margin-left:2px">
                                    <i class="fa fa-pencil-square" style="font-size: 14px;"></i>&nbsp;&nbsp;<span>Upload</span>
                                </a>
                                

                                
                            </div>
                        </div>

                        <div class="hr hr-24"></div>

                    </form>


                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<script type="text/javascript">
    function submitForm1(){
        document.getElementById('form1').action = "<?php echo base_url('admin/proses/doUpload/'.$this->uri->segment(4)) ?>";
        document.getElementById('form1').submit();
    }

  
</script>