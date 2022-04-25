<div class="main-content">
    <div class="main-content-inner">
        <!-- #section:basics/content.breadcrumbs -->

        <!-- /section:basics/content.breadcrumbs -->
        <div class="page-content">

           
            <style type="text/css">
                html { font-family: "Verdana, Arial"; }
                .title {
                    text-align: center;
                    font-size: 25px;
                }
                .prefrensi {
                 text-align: center;
                    font-size: 25px; 
                }
                td {
                    text-align: center;
                }
                table {
                    border-bottom: 1px solid;
                    /*width: 1200;*/
                }
            </style>
            <body onload="window.print()">
            <div class="row">
                <div class="col-xs-12">
                    <div class="clearfix">
                        <?php echo $this->session->flashdata('msgbox') ?>
                    </div>
                    <div>
                        
                    </div>
                    <div onload="window.print()">
                    <div class="title" >
                        Laporan Penilaian
                    </div>
                    <div class="preferensi">
                    <table class="table table-striped table-bordered table-hover" style="margin-left:auto;margin-right:auto" width="1200px">
                        <thead>
                            <tr>
                                <!--<th>No</th>-->
                                <th style="border-bottom: 1px dashed;">Kriteria</th>
                                <th style="border-bottom: 1px dashed;">Bobot</th>
                                <th style="border-bottom: 1px dashed;">Cost/Benefit</th>
                                <th style="border-bottom: 1px dashed;">Code</th>
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
                             
                                <td style="text-align : center;"><?php echo $row['namaKriteria']; ?></td>
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
            <div class="row">
                <div class="col-xs-12">
                    <div class="preferensi">
                    <?php
                    foreach ($bobot_kriteria as $row) { 
                        $nbobot[$row['idKriteria']]   = $row['bobot'];         
                    } ?>
                    &nbsp;
                    &nbsp;
                    <table class="table table-striped table-bordered table-hover" style="margin-left:auto;margin-right:auto" width="1200px" border="0.5px">
                        <thead>
                            <tr style="border-top: 1px dashed;">
                                <th style="border-bottom: 1px dashed;">Bobot/Kriteria</th>
                                <?php foreach ($label_kriteria as $row) { ?>
                                <th style="border-bottom: 1px dashed;"><?php echo $row['idKriteria'] ?></th>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td style="text-align : center;">Bobot Kepentingan</td>
                                <?php foreach ($label_kriteria as $row) { 
                                    $vbobot = isset($row['idKriteria']) ? $nbobot[$row['idKriteria']] : '';
                                    $bk = $vbobot/$total_bobot;
                                    echo "<td >$bk</td>";
                                } ?>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
            
            <div class="row" >
                <div class="col-xs-12" >
                    <?php 
                        $jml_bobot = array();
                        foreach ($penilaian as $row)
                        {
                            $jml_bobot[$row['idPengguna']][$row['idkriteria']] = $row['nilai'];
                        }
                    ?>
                    &nbsp;
                    &nbsp;
                    <table class="table table-striped table-bordered table-hover" style="margin-left:auto;margin-right:auto" width="1200px" >
                        <thead>
                            <tr>
                                <th style="border-bottom: 1px dashed;">Alternatif / Kriteria</th>
                                <?php foreach ($label_kriteria as $row) { ?>
                                <th style="border-bottom: 1px dashed;"><?php echo 'Total '.$row['idKriteria'] ?></th>
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
                    &nbsp;
                    &nbsp;
                    <table class="table table-striped table-bordered table-hover" style="margin-left:auto;margin-right:auto" width="1200px" border="0.5px">
                        <thead>
                            <tr>
                                <td style="font-weight: bold;">Pangkat</td>
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
                    &nbsp;
                    &nbsp;
                    <table class="table table-striped table-bordered table-hover" style="margin-left:auto;margin-right:auto" width="1200px" border="0.5px">
                        <thead>
                            <tr>
                                <th style="border-bottom: 1px dashed;">Alternatif / Kriteria</th>
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
                                <td style="border-top: 1px dashed; width: 200;">Total</td>
                                <td><?php echo $total_nialiakhirpw; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <table class="table table-striped table-bordered table-hover" style="margin-left:auto;margin-right:auto" width="1200px" border="0.5px">
                <thead>
                    <tr>
                        <th style="border-bottom: 1px dashed; width: 200;">Alternatif</th>
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
                            <td ><?php echo $arf['rank']; ?></td>
                        </tr>
                       <?php
                        }
                    ?>
                   
                </div>
                    
                </tbody>
            </table>
            
          
         </div>           


        </body>
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
