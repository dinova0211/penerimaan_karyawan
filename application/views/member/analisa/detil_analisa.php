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
                    <a href="<?php echo base_url('admin/dashboard') ?>">Beranda</a>
                </li>

                
                <li class="active">Detil Analisa</li>
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
                    Halaman Detail Analisa Mutasi
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <div class="clearfix">
                        <?php echo $this->session->flashdata('msgbox') ?>
                    </div>
                    <div class="table-header">
                        Nilai Preferensi Masing-Masing Kriteria WPM
                    </div>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <!--<th>No</th>-->
                                <th style="text-align : center;">Kriteria</th>
                                <th style="text-align : center;">Bobot</th>
                                <th style="text-align : center;">Cost/Benefit</th>
                                <th style="text-align : center;">Code</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            function cariMultiplikasi($array){
                                $kali=1;
                                for($i=0;$i<count($array);$i++){
                                    $kali*=$array[$i];            
                                }
                                return $kali;      
                            }
    
                            $no=0; 
                            $total_bobot = 0;
                            foreach ($kriteria as $row) { $no++;
                            
                            $total_bobot=$total_bobot+$row['bobot'];
                            ?>
                            <tr>
                             
                                <td><?php echo $row['namaKriteria']; ?></td>
                                <td style="text-align : center;"><?php echo $row['bobot']; ?></td>
                                <td style="text-align : center;"><?php echo $row['type']; ?></td>
                                <td style="text-align : center;"><?php echo $row['idKriteria']; ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td style="text-align : center;font-weight: bold;">Jumlah</td>
                                <td style="text-align : center;font-weight: bold;"><?php echo $total_bobot; ?></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <?php
                    foreach ($bobot_kriteria as $row) { 
                        $nbobot[$row['idKriteria']]   = $row['bobot'];         
                    } ?>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Bobot/Kriteria</th>
                                <?php foreach ($label_kriteria as $row) { ?>
                                <th><?php echo $row['idKriteria'] ?></th>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td>Bobot Kepentingan</td>
                                <?php foreach ($label_kriteria as $row) { 
                                    $vbobot = isset($row['idKriteria']) ? $nbobot[$row['idKriteria']] : '';
                                    $bk = $vbobot/$total_bobot;
                                    echo "<td>$bk</td>";
                                } ?>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-12">
                    <?php 
                        $jml_bobot = array();
                        foreach ($penilaian as $row)
                        {
                            $jml_bobot[$row['idPengguna']][$row['idkriteria']] = $row['nilai'];
                        }
                    ?>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Alternatif / Kriteria</th>
                                <?php foreach ($label_kriteria as $row) { ?>
                                <th><?php echo 'Total '.$row['idKriteria'] ?></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $nama_karyawan=array(); foreach ($data_karyawan as $row => $karyawan) {
                                $nama_karyawan[$karyawan['idPengguna']] = $karyawan['namaPengguna'];
                            ?>
                            <tr>
                                <td><?php echo $karyawan['namaPengguna']; ?></td>
                                    <?php 
                                        // echo "<pre>";
                                        // print_r($karyawan['idPengguna']);
                                        // echo "</pre>";
                                        foreach ($label_kriteria as $row)
                                        {
                                        $bobot_kriteria = isset($karyawan['idPengguna']) ? $jml_bobot[$karyawan['idPengguna']][$row['idKriteria']] : '0';
                                        echo "<td>$bobot_kriteria</td>";   
                                        }
                                                                         
                                    ?>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <td>Pangkat</td>
                                <?php foreach ($label_kriteria as $row) { 
                                    $vbobot = isset($row['idKriteria']) ? $nbobot[$row['idKriteria']] : '';
                                    
                                    if ($row['type']=="benefit")
                                        $pangkat = 1;
                                    else
                                        $pangkat = -1;
                                    $bk = ($vbobot/$total_bobot)*$pangkat;    
                                    echo "<td>$bk</td>";
                                    
                                    $kalipangkat[$row['idKriteria']]=array('pangkat' =>$bk);
                                    
                                } ?>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-12">
                    <?php 
                       
                        $this->M_kriteria->delete();
                        foreach ($penilaian as $row)
                        {
                           $drow[$row['idPengguna']][$row['idkriteria']] = $row;
                        }
                    ?>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th colspan="2">Alternatif / Kriteria</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                             
                             $tt=0; $total_nialiakhirpw=0;
                            foreach ($data_karyawan as $row => $karyawan) { 
                                $n_kriteria = $this->M_kriteria->get_kriteria();
                                
                            ?>
                            <tr>
                                <td><?php echo $karyawan['namaPengguna']; ?></td>
                                    <td>
                                    <?php $pw=0;$total_prefensi = 0 ; 
                                        foreach ($n_kriteria as $rowc)
                                        {
                                            $datatotalkriteria = $this->M_kriteria->get_total_kriteria($rowc['idKriteria'],$karyawan['idPengguna']);
                                            
                                            if ($datatotalkriteria['type']=="benefit")
                                                $npangkat = 1;
                                            else
                                                $npangkat =-1;
                                            
                                            $pangkat = $npangkat*$datatotalkriteria['total_k'];
                                            
                                            $pw=pow($datatotalkriteria['total_n'],$pangkat);
                                            // $ct = $this->M_kriteria->check_calback_nilai($karyawan['idPengguna'],$datatotalkriteria['idKriteria'],$pw);
                                            // if ($ct=="0")
                                            // {
                                                $this->M_kriteria->insert_pw($karyawan['idPengguna'],$datatotalkriteria['idKriteria'],$pw);
                                            // }
                                            // else
                                            // {
                                                // $this->M_kriteria->update_pw($karyawan['idPengguna'],$datatotalkriteria['idKriteria'],$pw);
                                            // }
                                        }

                                        $show_pw = $this->M_kriteria->getshow_nilai($karyawan['idPengguna']);
                                        // print_r($show_pw[0]['htg']);
                                        $output_n = ($show_pw[0]['htg']);
                                        $arr_perkalian = explode(",",$output_n);
                                        
                                        $nialiakhirpw = cariMultiplikasi($arr_perkalian) ;
                                        $total_nialiakhirpw=$total_nialiakhirpw+$nialiakhirpw;
                                        
                                        $arr_rank[] = array('idpengguna' => $karyawan['idPengguna'], 'rank' => $nialiakhirpw);
                                        
                                        echo $nialiakhirpw;
                                        
                                      
                                    ?>
                                    </td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <td>Total</td>
                                <td><?php echo $total_nialiakhirpw; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th colspan="2">Alternatif</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                       
                        usort($arr_rank,function($a,$b){
                           
                            return ($b['rank'])-($a['rank']);
                        });
                        $ttl_hitung=0;
                        $rr=0;foreach ($arr_rank as $showr)
                        { 
                            $rr++;
                            $nama = isset($showr['idpengguna']) ? $nama_karyawan[$showr['idpengguna']] : '';
                            $ttl_hitung =$showr['rank']/$total_nialiakhirpw;
                             $arr_rank_final[] = array('nama' => $nama, 'rank' => $ttl_hitung);
                            ?>
                            
                            <?php
                            
                        }
                        
                       usort($arr_rank_final,function($a,$b){
                            // return ($b['rank'])-($a['rank']);
                            $result = 0;
                            if ($a['rank'] < $b['rank']) {
                                $result = 1;
                            } else if ($a['rank'] > $b['rank']) {
                                $result = -1;
                            }
                            return $result; 
                        });
                        foreach ($arr_rank_final as $arf)
			            {
                           ?>
                        <tr>
                            <td><?php echo $arf['nama']; ?></td>
                            <td><?php echo $arf['rank']; ?></td>
                        </tr>
                       <?php
		                }
                    ?>
                </tbody>
            </table>
            
          
                    
			<?php
			
			
			
			    
			
    $time_start = microtime(true);
    sleep(1);
    $time_end = microtime(true);
    $time = $time_end - $time_start;
    echo "Process Time: {$time}";
    // Process Time: 1.0000340938568
?>
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
