<?php
$kieu = CAL_GREGORIAN;
var_dump($lichkham);
// ch?n ki?u hi?n th? l?ch

if(!isset($_GET['thang'])) $thang = date('n'); else $thang = $_GET['thang']; // thang 1-12 m?c d?nh th�ng hi?n t?i
if(!isset($_GET['nam'])) $nam = date('Y'); else $nam = $_GET['nam']; // nam 4 so m?c d?nh nam hi?n t?i

$hom_nay = date('Y/n/d');// ng�y th�ng nam hi?n t?i

$dem_ngay = cal_days_in_month($kieu, $thang, $nam);

// d?m c� bao nhi�u ng�y trong th�ng r?t t?t cho vi?c theo d�i chu k? b�n h�ng :) trong th�ng b�n du?c h�ng .

echo "<div id='khung_lich'>";
echo "<div id='lich'>";

// ph?n n�y l� ph?n ch?nh cho l?ch d?p d? ch�t
    
$thang_truoc = $thang - 1;
$thang_sau = $thang + 1;

// l?y th�ng tru?c , th�ng sau

$nam_truoc = $nam - 1;
$nam_sau = $nam + 1;

// l?y nam tru?c nam sau

if($thang == 12):
    $doi_nam = $nam;
    $doi_thang  = $thang_truoc;
elseif($thang == 1):
    $doi_nam = $nam_truoc;
    $doi_thang  = '12';
else:
    $doi_nam = $nam;
    $doi_thang  = $thang_truoc;
endif;
    
if($thang == 1):
    $doi_nam_sau = $nam;
    $doi_thang_sau = $thang_sau;
elseif($thang == 12):
    $doi_nam_sau = $nam_sau;
    $doi_thang_sau  = '1';
else:
    $doi_nam_sau = $nam;
    $doi_thang_sau  = $thang_sau;
endif;

echo "<div class='tieu_de'>";
    
echo "<a href='?thang=". $doi_thang ."&nam=". $doi_nam ."'><div class='truoc'><<</div></a>";
echo "<h2 class='thang_hien_tai'>" . date('F',  mktime(0,0,0,$thang,1)) . "&nbsp;" . $nam . "</h2>";
echo "<a href='?thang=". $doi_thang_sau ."&nam=". $doi_nam_sau ."'><div class='sau'>>></div></a>";
    
    
echo "</div>";
echo "<br style='clear:both'/>";

    echo "<div class='tieu_de' >";
        echo "<div class='lich_thu' >Mon</div>";
        echo "<div class='lich_thu' >Tue</div>";
        echo "<div class='lich_thu' >Web</div>";
        echo "<div class='lich_thu' >Thu</div>";
        echo "<div class='lich_thu' >Fri</div>";
        echo "<div class='lich_thu' >Sat</div>";
        echo "<div class='lich_thu' >Sun</div>";
    echo "</div>";
    echo "<br style='clear:both'/>";

    /* Th�ng Tru?c */
    $ngay_dau_thang = $nam.'/'.$thang.'/'.'1';
    $ten_ngay_dau_thang = date('l', strtotime($ngay_dau_thang));
    $ten_ngay_dau_thang_rg = substr($ten_ngay_dau_thang, 0, 3); // rut gon
    switch($ten_ngay_dau_thang_rg)
    {
        /* ch� � ph?n n�y ph? thu?c v�o ki?u hi?n th? th? trong tu?n b�n tr�n nh� */
        case 'Mon' : $so_ngay_thang_truoc = 0; break ;
        case 'Tue' : $so_ngay_thang_truoc = 1; break ;
        case 'Wed' : $so_ngay_thang_truoc = 2; break ;
        case 'Thu' : $so_ngay_thang_truoc = 3; break ;
        case 'Fri' : $so_ngay_thang_truoc = 4; break ;
        case 'Sat' : $so_ngay_thang_truoc = 5; break ;
        case 'Sun' : $so_ngay_thang_truoc = 6; break ;
    }
    for($i=1;$i<=$so_ngay_thang_truoc;$i++)
    {
        echo "<div class='ngay_thang_truoc'>";
           /* T�y b?n mu?n l�m g� v?i ph?n n�y */
        echo "</div>";
    }

    /* Th�ng Hi?n T?i */
    for($i=1; $i<= $dem_ngay; $i++):

        $ngay = $nam.'/'.$thang.'/'.$i;
        
        $ten = date('l', strtotime($ngay));
        $ten_ngay = substr($ten, 0, 3); // c?t l?y 3 k� t? d?u
            
        echo "<div class='lich_ngay'>";
            
            echo "<div class='ten_ngay'>" . $ten_ngay . "</div>";
                    
            if($hom_nay == $ngay):

                // n?u ng�y v�ng l?p tr�ng v?i s? ng�y h�m nay th� t� d?m .v.v....
                echo "<div class='so_ngay hom_nay' ><a href='#' onclick='alert(".'"H�m nay c� h?n v?i m�o !"'.")' >".'click '. $i . ' me' ."</a></div>";
            else:
                echo "<div class='so_ngay'>" . $i . "</div>";
            endif;    
            
        echo "</div>";
        
    endfor;
        
    echo "</div>";
    echo "</div>";
?>