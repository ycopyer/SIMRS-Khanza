<?php
    include '../../../conf/conf.php';
?>
<html>
    <head>
        <link href="../../css/default.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
   <?php
        $keyword = $_GET['keyword'];
        $keyword = validTeks($keyword);
        $_sql    = "SELECT stts_kerja.stts,stts_kerja.ktg,stts_kerja.indek,stts_kerja.hakcuti FROM stts_kerja ".(!empty($keyword)?"where stts_kerja.stts like '%".$keyword."%' or stts_kerja.ktg like '%".$keyword."%'":"")." ORDER BY stts_kerja.indek desc";
        $hasil   = bukaquery($_sql);
        $no      = 1;
        if(mysqli_num_rows($hasil)!=0) {
            echo "<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' class='tbl_form'>
                    <caption><h3><font color='999999'>Laporan Master Status Kerja</font></h3></caption>
                    <tr class='head'>
                        <td width='10%'><div align='center'>No.</strong></div></td>
                        <td width='28%'><div align='center'>Status</div></td>
                        <td width='40%'><div align='center'>Keterangan</div></td>
                        <td width='10%'><div align='center'>Index Status</div></td>
                        <td width='10%'><div align='center'>Hak Cuti</div></td>
                    </tr>";
            while($baris = mysqli_fetch_array($hasil)) {
                echo "<tr class='isi'>
                        <td>$no</td>  
                        <td>$baris[0]</td>
                        <td>$baris[1]</td>
                        <td align='center'>$baris[2]</td>
                        <td align='center'>$baris[3]</td>  
                     </tr>";
                $no++;
            }
            echo "</table>";
        }else{
            echo "<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' class='tbl_form'>
                    <caption><h3><font color='999999'>Laporan Master Status Kerja</font></h3></caption>
                    <tr class='head'>
                        <td width='10%'><div align='center'>No.</strong></div></td>
                        <td width='28%'><div align='center'>Status</div></td>
                        <td width='40%'><div align='center'>Keterangan</div></td>
                        <td width='10%'><div align='center'>Index Status</div></td>
                        <td width='10%'><div align='center'>Hak Cuti</div></td>
                    </tr>
                  </table>";
        } 
    ?>
    </body>
</html>

