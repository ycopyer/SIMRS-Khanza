<div id="post">
    <div class="entry"> 
        <div align="center" class="link">
            <a href=?act=InputSttskerja&action=TAMBAH>| Input Data |</a>
            <a href=?act=ListSttskerja>| List Data |</a>
            <a href=?act=HomeAdmin>| Menu Utama |</a>
        </div>   
        <form name="frm_aturadmin" onsubmit="return validasiIsi();" method="post" action="" enctype=multipart/form-data>
            <?php
                    $action  = isset($_GET['action'])?$_GET['action']:NULL;
                    $keyword = trim(isset($_POST['keyword']))?trim($_POST['keyword']):NULL;
                    $keyword = validTeks($keyword);
                    echo "<input type=hidden name=keyword value=$keyword><input type=hidden name=action value=$action>";
            ?>
            <table width="100%" align="center">
                <tr class="head">
                    <td width="25%" >Keyword</td><td width="">:</td>
                    <td width="82%">
                        <input name="keyword" class="text" onkeydown="setDefault(this, document.getElementById('MsgIsi1'));" type=text id="TxtIsi1" value="<?php echo $keyword;?>" size="65" maxlength="50" pattern="[a-zA-Z 0-9-]{1,50}" title=" a-z A-Z 0-9 (Maksimal 50 karakter)" autocomplete="off"  autofocus/>
                        <input name=BtnCari type=submit class="button" value="&nbsp;&nbsp;Cari&nbsp;&nbsp;">
                    </td>
                </tr>
            </table><br>
        </form>
        <div style="width: 100%; height: 78%; overflow: auto;">
        <?php
            $_sql   = "SELECT stts_kerja.stts,stts_kerja.ktg,stts_kerja.indek,stts_kerja.hakcuti FROM stts_kerja ".(!empty($keyword)?"where stts_kerja.stts like '%".$keyword."%' or stts_kerja.ktg like '%".$keyword."%'":"")." ORDER BY stts_kerja.indek desc";
            $hasil  = bukaquery($_sql);
            $jumlah = mysqli_num_rows($hasil);
            if(mysqli_num_rows($hasil)!=0) {
                echo "<table width='99.6%' border='0' align='center' cellpadding='0' cellspacing='0' class='tbl_form'>
                        <tr class='head'>					   
                            <td width='12%'><div align='center'>Proses</div></td>
                            <td width='28%'><div align='center'>Status</div></td>
                            <td width='40%'><div align='center'>Keterangan</div></td>
                            <td width='10%'><div align='center'>Index Status</div></td>
                            <td width='10%'><div align='center'>Hak Cuti</div></td>
                        </tr>";
                        while($baris = mysqli_fetch_array($hasil)) {
                            echo "<tr class='isi'>
                                    <td>
                                        <center>
                                            <a href=?act=InputSttskerja&action=UBAH&stts=".str_replace(" ","_",$baris[0]).">[edit]</a>
                                            <a href=?act=ListSttskerja&action=HAPUS&stts=".str_replace(" ","_",$baris[0]).">[hapus]</a>
                                    </center>
                                    </td>
                                    <td>$baris[0]</td>
                                    <td>$baris[1]</td>
                                    <td align='center'>$baris[2]</td>
                                    <td align='center'>$baris[3]</td>                                   
                                  </tr>";
                        }
                echo "</table>";
            } else {
                echo "<table width='99.6%' border='0' align='center' cellpadding='0' cellspacing='0' class='tbl_form'>
                        <tr class='head'>					   
                            <td width='12%'><div align='center'>Proses</div></td>
                            <td width='28%'><div align='center'>Status</div></td>
                            <td width='40%'><div align='center'>Keterangan</div></td>
                            <td width='10%'><div align='center'>Index Status</div></td>
                            <td width='10%'><div align='center'>Hak Cuti</div></td>
                        </tr>
                      </table>";
            }

            $aksi=isset($_GET['action'])?$_GET['action']:NULL;
            if ($aksi=="HAPUS") {
                Hapus(" stts_kerja "," stts ='".validTeks(str_replace("_"," ",$_GET['stts']))."' ","?act=ListSttskerja");
            }
        ?>
        </div>
        <?php
            echo("<table width='99.6%' border='0' align='center' cellpadding='0' cellspacing='0' class='tbl_form'>
                    <tr class='head'>
                        <td><div align='left'>Data : $jumlah | <a target=_blank href=../penggajian/pages/statuskerja/LaporanStatusKerja.php?&keyword=$keyword>Laporan</a> | <a target=_blank href=../penggajian/pages/statuskerja/LaporanStatusKerjaExel.php?&keyword=$keyword>Excel</a> |</div></td>                        
                    </tr>     
                 </table>");
        ?>
    </div>
</div>
