<body onload="check()">
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
                    Edit Pengajuan Mutasi
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
                    Form Edit Pengajuan Mutasi
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                    </small>
                </h1>
            </div><!-- /.page-header -->
            <div class="row"> 
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/proses/doUpdate/'.$this->uri->segment(4).'/'.$dataDetail['idDosen'];?>" enctype="multipart/form-data" role="form"> 
                       <?php
                       $dataOld = $this->session->flashdata('oldPost'); 
                       echo $this->session->flashdata('msgbox');

                       ?>
                        <!-- #section:elements.form -->
						<div class="form-group">        
                          <div class="col-sm-2" style="border-bottom: 2px solid #6EBACC;">
                            Harap isi isian di bawah ini:
                          </div>
                        </div>
						
						<div class="form-group"> 
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">NIP</label>
                            <div class="col-sm-9">
                                <input type="text" value="<?php echo $this->M_proses->getDosenName($dataDetail['idDosen'])['nip']; ?>" name="NIP" readonly />
                            </div>
                        </div>

                        <div class="form-group"> 
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nama Dosen</label>
                            <div class="col-sm-9">
                                <input type="text" value="<?php echo $this->M_proses->getDosenName($dataDetail['idDosen'])['nama']; ?>" name="namaDosen" readonly />
                            </div>
                        </div>

                        <div class="form-group"> 
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Institusi Asal</label>
                            <div class="col-sm-9">
                                <select class="col-xs-10 col-sm-5" name="fa_asal">
                                    <?php foreach($fakultas as $fa){ ?>
                                        <option value="<?php echo $fa['fa_ID']; ?>" <?php if($fa['fa_ID']==$dataDetail['fa_asal']) echo "Selected"; ?> ><?php echo $fa['fa_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Institusi Tujuan</label>
                            <div class="col-sm-9">
                                <select class="col-xs-10 col-sm-5" name="fa_tujuan">
                                    <?php foreach($fakultas as $fa){ ?>
                                        <option value="<?php echo $fa['fa_ID']; ?>" <?php if($fa['fa_ID']==$dataDetail['fa_tujuan']) echo "Selected"; ?>  ><?php echo $fa['fa_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group"> 
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Program Study Asal</label>
                            <div class="col-sm-9">
                                <select class="col-xs-10 col-sm-5" name="psd_asal">
                                    <?php foreach ($progstudi as $key => $value) {  ?>
                                        <option value="<?php echo $value['psd_ID']; ?>" <?php if($value['psd_ID']==$dataDetail['psd_asal']) echo "Selected"; ?>  ><?php echo $value['psd_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group"> 
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Program Study Tujuan</label>
                            <div class="col-sm-9">
                                <select class="col-xs-10 col-sm-5" name="psd_tujuan">
                                    <?php foreach ($progstudi as $key => $value) {  ?>
                                        <option value="<?php echo $value['psd_ID']; ?>" <?php if($value['psd_ID']==$dataDetail['psd_tujuan']) echo "Selected"; ?> ><?php echo $value['psd_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <?php foreach ($kriteria as $kr) { ?>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"><?php echo $kr['namaKriteria'] ?></label>
                            <div class="col-sm-9">
                                
                                <select class="col-xs-10 col-sm-5" name="subKrit[]" required>
                                    <?php 
                                    $idDetil = $this->M_pengajuan->listEdit_sub_kriteria($this->uri->segment(4),$kr['idKriteria'])['idDetilKandidat'];
                                    foreach ($this->M_pengajuan->list_sub_kriteria($kr['idKriteria']) as $sub) { 
                                    $subKrit = $this->M_pengajuan->listEdit_sub_kriteria($this->uri->segment(4),$kr['idKriteria'])['idSubKriteria'];
                                    $progstud = $this->M_pengajuan->listEdit_sub_kriteria($this->uri->segment(4),$kr['idKriteria'])['file'];
                                    ?>
                                        <option value="<?php echo $sub['idSubKriteria'];?>" <?php if($subKrit == $sub['idSubKriteria']) echo "Selected";  ?> ><?php echo $sub['namaSubKriteria']; ?></option>
                                    <?php } ?>
                                </select>
                                <?php if ($kr['is_jenjang']=="Y") {
                                    $style = "style='visibility: show;'";
                                }else{
                                    $style = "style='visibility: hidden'";
                                } 
                                ?>
                                &nbsp
                                <select name="jenjang_progStudi[]" <?php echo $style; ?> >
                                    <option value="D3" <?php if($progstud=="D3") echo "Selected"; ?> >D3</option>
                                    <option value="S1" <?php if($progstud=="S1") echo "Selected"; ?> >S1</option>
                                    <option value="S2" <?php if($progstud=="S2") echo "Selected"; ?> >S2</option>
                                    <option value="S3" <?php if($progstud=="S3") echo "Selected"; ?> >S3</option>
                                </select>
                                <input type="hidden" name="idDetil[]" value="<?php echo $idDetil; ?>"></input>
                            </div>
                        </div>

                        <?php } ?>
						<?php 
						$cek_antar_fakultas = $this->M_pengajuan->listEdit_sub_kriteria_cek($this->uri->segment(4));
						if(count($cek_antar_fakultas)>0){
							$antar_fakultas = 1;
						}else{
							$antar_fakultas = 0;
						}
						?>
						<div class="form-group"> 
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Apakah proses
mutasi ini antar fakultas?</label>
                            <div class="col-sm-9">
                                <select class="col-xs-10 col-sm-5" id="flag" name="flag" onclick="check()">
                                   <option value=1 <?php if($antar_fakultas=="1") echo "Selected"; ?>>Ya</option>
                                   <option value=0 <?php if($antar_fakultas=="0") echo "Selected"; ?>>Tidak</option>
                                </select>
                            </div>
                        </div>
						<i style=" color: rgb(31, 106, 191);">*) Supported File : (.xlxs, .xls, .doc, .docx, .pdf() AND Max Size : (2MB)</i><br/>
                        <i style=" color: red;">*) Silahkan isi data yang ingin di ubah, Data akan mengubah hanya pada dokumen yang di isi</i>
						<table id="" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Syarat Dokumen</th>
                                    <th>Action</th>
                                </tr>
                            </thead> 
                            <tbody>
                            <?php
							$no = 0;
							foreach ($kriteria2 as $kr) { ?>
                            <?php 
                                
                                foreach ($this->M_pengajuan->list_sub_kriteria($kr['idKriteria']) as $sub) { 
                                $idDetil2 = $this->M_pengajuan->listEdit_sub_kriteria2($this->uri->segment(4),$sub['idKriteria'],$sub['idSubKriteria'])['idDetilKandidat'];
                            if($sub['id'] == "C1"){
								$id = $sub['id']."_".$no++;
							}else{
								$id = $sub['id'];
							}
							?>
                                <tr id="<?php echo $id; ?>">
                                    <td>
                                        <?php echo $sub['namaSubKriteria']; ?>
                                        <input type="hidden" name="namaSubFile[]" value="<?php echo $sub['namaSubKriteria'] ?>"/>
                                        <input type="hidden" name="idSubFile[]" value="<?php echo $sub['idSubKriteria'] ?>" />
                                        <input type="hidden" name="idDetilFile[]" value="<?php echo $idDetil2; ?>"></input>
                                    </td>
                                    <td><input type="file" name="userfile[]" <?php echo $sub['required'] ?> /></td>
                                </tr>
                                
                            </tbody>
                            <?php }} ?>
                        </table> 

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
</body>
<script>
function check(){
	var flag = document.getElementById("flag");
    var selectedValue = flag.options[flag.selectedIndex].value;
	console.log("opsi : "+selectedValue);
	if(selectedValue > 0){
		$("#C13").show();
	}else{
		$("#C13").hide();
	}
}
</script>