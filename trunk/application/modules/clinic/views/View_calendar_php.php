<?php
$kieu = CAL_GREGORIAN;
var_dump($lichkham);
// chọn kiểu hiển thị lịch

if(!isset($_GET['thang'])) $thang = date('n'); else $thang = $_GET['thang']; // thang 1-12 mặc định tháng hiện tại
if(!isset($_GET['nam'])) $nam = date('Y'); else $nam = $_GET['nam']; // nam 4 so mặc định năm hiện tại

$hom_nay = date('Y/n/d');// ngày tháng năm hiện tại

$dem_ngay = cal_days_in_month($kieu, $thang, $nam);

// đếm có bao nhiêu ngày trong tháng rất tốt cho việc theo dõi chu kỳ bán hàng :) trong tháng bán được hàng .

echo "<div id='khung_lich'>";
echo "<div id='lich'>";

// phần này là phần chỉnh cho lịch đẹp đẽ chút
    
$thang_truoc = $thang - 1;
$thang_sau = $thang + 1;

// lấy tháng trước , tháng sau

$nam_truoc = $nam - 1;
$nam_sau = $nam + 1;

// lấy năm trước năm sau

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

    /* Tháng Trước */
    $ngay_dau_thang = $nam.'/'.$thang.'/'.'1';
    $ten_ngay_dau_thang = date('l', strtotime($ngay_dau_thang));
    $ten_ngay_dau_thang_rg = substr($ten_ngay_dau_thang, 0, 3); // rut gon
    switch($ten_ngay_dau_thang_rg)
    {
        /* chú ý phần này phụ thuộc vào kiểu hiển thị thứ trong tuần bên trên nhé */
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
           /* Tùy bạn muốn làm gì với phần này */
        echo "</div>";
    }

    /* Tháng Hiện Tại */
    for($i=1; $i<= $dem_ngay; $i++):

        $ngay = $nam.'/'.$thang.'/'.$i;
        
        $ten = date('l', strtotime($ngay));
        $ten_ngay = substr($ten, 0, 3); // cắt lấy 3 ký tự đầu
            
        echo "<div class='lich_ngay'>";
            
            echo "<div class='ten_ngay'>" . $ten_ngay . "</div>";
                    
            if($hom_nay == $ngay):

                // nếu ngày vòng lặp trùng với số ngày hôm nay thì tô đậm .v.v....
                echo "<div class='so_ngay hom_nay' ><a href='#' onclick='alert(".'"Hôm nay có hẹn với mèo !"'.")' >".'click '. $i . ' me' ."</a></div>";
            else:
                echo "<div class='so_ngay'>" . $i . "</div>";
            endif;    
            
        echo "</div>";
        
    endfor;
        
    echo "</div>";
    echo "</div>";
?>