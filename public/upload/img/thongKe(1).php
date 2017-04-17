<?php

//include '../config.php';

$timedefault=strtotime("6:38pm");
$tr = strtotime("8:00pm");
$models_settimeupdate=new Models_Timeupdate();
$models_settimeupdate =$models_settimeupdate->getLastObject();
$settimeupdate=strtotime($models_settimeupdate->timeupdate.'pm');
if($settimeupdate>$timedefault)
{
   $tr= $settimeupdate;
}
$timeHienTai = strtotime(date("h:i:sa"));

$s         = strtotime("11:59pm");
$dateToday = strtotime(date("Y-m-d"));


$model_menu  = new Models_Menus();
$show        = $model_menu->getObject1();
if(is_object($show)) {
$dateUpdate1 = strtotime(date("Y-m-d", $show->getTimeUpdate()));
//            update data in 8 pay
if ($timeHienTai > $tr && $timeHienTai < $s && $dateToday != $dateUpdate1) {
    $listJson = json_decode(file_get_contents('http://8pay.vn/getNotify.php?userid='.$id_user));
    foreach ($listJson as $key => $item1) {
        $idKetQua    = $key;
        $user_id     = $item1->user_id;
        $name        = $item1->name;
        $getcontent=explode(':',$item1->content);
        $content='';
        if(isset($getcontent[1])) {
            $content=$getcontent[1];
        }
        //$content     = preg_replace('/[^0-9]/', ' ', $getcontent[1]);
        $money       = $item1->money;
        $time_create = $item1->time_create;
        $time_update = $item1->time_update;
        $orders      = $item1->orders;
        $status      = $item1->status;

        $model_ketqua = new Models_KetQua();
        $check        = $model_ketqua->getObjectByCondition('', array('id_send' => $idKetQua));
        if (!is_object($check)) {
            
            $add = new Persistents_KetQua();
            $add->setIdSend($idKetQua);
            $add->setUserId($user_id);
            $add->setName($name);
            $add->setContent($content);
            $add->setMoney($money);
            $add->setTimeCreate($time_create);
            $add->setTimeUpdate($time_update);
            $add->setOrders($orders);
            $add->setStatus($status);            
             $model_ketqua = new Models_KetQua($add);
             $model_ketqua->add();                               
        } else {
            $check->setIdSend($idKetQua);
            $check->setUserId($user_id);
            $check->setName($name);
            $check->setContent($content);
            $check->setMoney($money);
            $check->setTimeCreate($time_create);
            $check->setTimeUpdate($time_update);
            $check->setOrders($orders);
            $check->setStatus($status);
            $model_ketqua->setPersistents($check);
            $model_ketqua->edit();           
        }
    }
    
    $listJson = json_decode(file_get_contents('http://laythongtin.net/mini-content/traditional-lottery-api.php?type=json&date=' . date('d-m-Y')));

    $datetoday    = strtotime(substr($listJson->ngay, -10));
    $de         = substr($listJson->dac_biet, -2);
    $lo         = substr($listJson->dac_biet, -2) . "," . substr($listJson->nhat, -2) . "," . substr($listJson->nhi_1, -2) . "," . substr($listJson->nhi_2, -2) . "," . substr($listJson->ba_1, -2) . "," . substr($listJson->ba_2, -2) . "," . substr($listJson->ba_3, -2) . "," . substr($listJson->ba_4, -2) . "," . substr($listJson->ba_5, -2) . "," . substr($listJson->ba_6, -2) . "," . substr($listJson->tu_1, -2) . "," . substr($listJson->tu_2, -2) . "," . substr($listJson->tu_3, -2) . "," . substr($listJson->tu_4, -2) . "," . substr($listJson->nam_1, -2) . "," . substr($listJson->nam_2, -2) . "," . substr($listJson->nam_3, -2) . "," . substr($listJson->nam_4, -2) . "," . substr($listJson->nam_5, -2) . "," . substr($listJson->nam_6, -2) . "," . substr($listJson->sau_1, -2) . "," . substr($listJson->sau_2, -2) . "," . substr($listJson->sau_3, -2) . "," . substr($listJson->bay_1, -2) . "," . substr($listJson->bay_2, -2) . "," . substr($listJson->bay_3, -2) . "," . substr($listJson->bay_4, -2);
    $bacang     = substr($listJson->dac_biet, -3);
    $dau        = substr($listJson->dac_biet, -2, -1);
    $duoi       = substr($listJson->dac_biet, -1);
    $dauduoi=$dau.','.$duoi;
    $model_ketquaxosos = new Models_KetQuaXoSo();
    $check_ketquaxoso = $model_ketquaxosos->getLastObject();
    if (is_object($check_ketquaxoso)) {
         $check_ketquaxoso->setDatetoday($datetoday);
         $check_ketquaxoso->setDe($de);
         $check_ketquaxoso->setBacang($bacang); 
         $check_ketquaxoso->setLo($lo);        
         $check_ketquaxoso->setDauduoi($dauduoi); 
         $check_ketquaxoso->setOrders(1);  
         $check_ketquaxoso->setStatus(1);
         $model_ketquaxosos->setPersistents($check_ketquaxoso);
         $model_ketquaxosos->edit(); 
    } else {
            $add = new Persistents_KetQuaXoSo();
            $add->setDatetoday($datetoday);
            $add->setDe($de);
            $add->setLo($lo);
            $add->setBacang($bacang); 
            $add->setDauduoi($dauduoi); 
            $add->setOrders(1);
            $add->setStatus(1);        
            $model_ketqua = new Models_KetQuaXoSo($add);
            $model_ketqua->add();
    }
    
} else {
    
}
//end update date in 8 pay


$list = $model_menu->getList();
foreach ($list as $item) {
    $idThongKe = $item->getIdThongKe();
    $titleMenu = $item->getTitle();
    $content   = $item->getContent();
    $id        = $item->getId();
    $type      = $item->getType();
     $type2      = $item->getType2();
    $soluongdanh1=$item->getSoluongdanh();
    $xacxuattrung=$item->getSoluongtrung();
    $napthe=file_get_contents('http://8pay.vn/checkcard.php?userid='.$_SESSION['id_user'].'&linkid='.$idThongKe);

//bat dau xet cho trung truot
    if($napthe == 0) {
        $models_ketquasoxos=new Models_KetQuaXoSo();
        $models_ketquasoxo=$models_ketquasoxos->getLastObject();        
        $conso="";
        $thongke="";
        //laydu lieu
        $de=trim($models_ketquasoxo->getDe());
        $bacang=trim($models_ketquasoxo->getBacang());
        $lo=trim($models_ketquasoxo->getLo());
        $lo=explode(',',$lo);
        $nhaylo=array_count_values($lo);
        $dauduoi=trim($models_ketquasoxo->getDauduoi());
        $dauduoi=explode(',',$dauduoi); 
        //lay bang
        //lay de truot
        for($j=0;$j<20;$j++) {
        $ngaunhien=0;
        while($ngaunhien==0) {
            $ngaunhien=rand(10,99);            
            if($ngaunhien==$de) {
                $ngaunhien=0;
            };
        }       
        $detruot[$j]=$ngaunhien;
        }
        //lay ba cang truot
        for($j=0;$j<15;$j++) {
        $ngaunhien=0;
        while($ngaunhien==0) {
            $ngaunhien=rand(100,999);            
            if($ngaunhien==$bacang) {
                $ngaunhien=0;
            };
        }
        $bacangtruot[$j]=$ngaunhien;
        }
        //lay so truot
        for($j=0;$j<20;$j++) {
        $ngaunhien=0;
        while($ngaunhien==0) {
            $ngaunhien=rand(10,99);
            for($i=0;$i<27;$i++) {
            if($ngaunhien==$lo[$i]) {
                $ngaunhien=0;
            };
        };
        }
        $sotruot[$j]=$ngaunhien;
        }
        //lau dau duoi truot
        $ngaunhien=0;
        while($ngaunhien==0) {
            $ngaunhien=rand(0,9);
            for($i=0;$i<10;$i++) {
            if($ngaunhien==$dauduoi[0]) {
                $ngaunhien=0;
            };
        };
        }
        $dauduoitruot[0]=$ngaunhien;
        $ngaunhien=0;
        while($ngaunhien==0) {
            $ngaunhien=rand(0,9);
            for($i=0;$i<10;$i++) {
            if($ngaunhien==$dauduoi[1]) {
                $ngaunhien=0;
            };
        };
        }
        $dauduoitruot[1]=$ngaunhien;
        $demde=array_unique($detruot);
        $detruot=array_values($demde);
        //loc du lieu lap lai
        $dembacang=array_unique($bacangtruot);
       $bacangtruot=array_values($dembacang);
       //
       $demsotruot=array_unique($sotruot);     
       $sotruot=array_values($demsotruot);
       //
       $demlo= array_unique($lo);
       $lo=array_values($demlo);
       //lo kep 
       $lokep=array('88','22','55','33','11','44','99','77','66','00');
       $lokeptrung=array();
       $lokeptruot=array();
       
        for($i=0;$i<10;$i++) {
            $d=0;
           foreach($lo as $bientam) {
            if($lokep[i]==$bientam) {
                $d=1;
            }           
            }
            if($d==1) {
                $lokeptrung[]=$lokep[$i];
            } else {
                $lokeptruot[]=$lokep[$i];
            }
            
       }
       //lay lo kep truot
       $lokeptrung=array_unique($lokeptrung);
       $lokeptrung=array_values($lokeptrung);
       //
       $lokeptruot2=array_unique($lokeptruot);
        $lokeptruot2=array_values($lokeptruot2);
        $demmang=count($lokeptruot2);
        $chisocuoi=$demmang-1;
        $mang2=array();
        $ngaunhien=rand(0,$chisocuoi);
        for($i=0,$j=$ngaunhien;$i<$chisocuoi;$i++) {
            if($j<0) {
                $mang2[$i]=$lokeptruot2[$i];
            } else {
                $mang2[$i]=$lokeptruot2[$j];
                $j--;
            }
        }
       //$lokeptruot=array_values($mang2);
       $lokeptruot=$mang2;
        //
        $model_ketqua = new Models_KetQua();
    $object       = $model_ketqua->getObjectByCondition('', array('id_send' => $idThongKe));
    
    
    
    if (isset($object)) {
        $socondanh    =trim(preg_replace('/[^0-9]/',' ', $object->content));
        $mangsocondanh=explode(' ',$socondanh);
        $soluongdanh=count($mangsocondanh);
        $demsocon=0;
         for($i=0;$i<$soluongdanh;$i++) {
            if($mangsocondanh[$i]!=null) {
               $demsocon++; 
            }
         }
         $soluongdanh=$demsocon;
        $dateUpdate = strtotime(date("Y-m-d", $item->getTimeUpdate()));

        if ($timeHienTai > $tr && $timeHienTai < $s && $dateToday != $dateUpdate) {

//        lấy giá trị của bảng kết quả
//        end lấy giá trị bảng KetQua

            list($title, $ketquaNew, $ketqua) = split('[*]', $content);
            $tomorow      = mktime(0, 0, 0, date("m"), date("d") + 1, date("Y"));
            // date tomorrow
            $dateTomorrow = date("d/m/Y", $tomorow);
//and date tomorrow
 $gettitledate=date("D", $tomorow);
            switch($gettitledate) {
                case 'Mon':$gettitledate='Thứ Hai';break; 
                case 'Tue':$gettitledate='Thứ Ba';break; 
                case 'Wed':$gettitledate='Thứ Tư';break; 
                case 'Thu':$gettitledate='Thứ Năm';break; 
                case 'Fri':$gettitledate='Thứ Sáu';break; 
                case 'Sat':$gettitledate='Thứ Bảy';break; 
                default :$gettitledate='Chủ nhật';
            }
//date hien tai
            $date         = date("d/m/Y");
//end date hien tai
//doan xac xuat
$xacxuatchotso=0;
 $ngaunhientt=rand(0,99);
    if($ngaunhientt<$xacxuattrung) {
        $xacxuatchotso=1;
    }

$conso='';
$thongke='';
//xet truong hop theo xac xuat cho truoc
if($xacxuatchotso==1) {
//cac truong hop lay so va thong ke
if($type==1) {
    $conso=$de.' ';
    $thongke='Trúng đề '.$de;
        if($soluongdanh>1) {
    $dem2=1;
    $moc=$soluongdanh-1;
while($dem2<=$moc) {
    $conso.=$sotruot[$dem2].' ';
    $dem2++;
}
}
} 
if($type==2) {
    $dem=1;
$soluongtruot=0;
$soluongtrung=rand(1,$soluongdanh);
if($soluongdanh>$soluongtrung) {
$soluongtruot=$soluongdanh-$soluongtrung;
}
$thongke='ăn lô ';
$demxien=0;
$n=rand(1,15);
while($dem<=$soluongtrung) {
    $n=$n+$dem;
    $conlo=$lo[$n];
    $sonhay='';
    if($nhaylo[$conlo]!=0) {
      $sonhay=' x '.$nhaylo[$conlo];  
    }
    $demxien++;
    $conso.=$conlo.' ';
    $thongke.=$conlo.$sonhay.' ';
    $dem++;
}
if($soluongtruot>0) {
    $dem2=1;
while($dem2<=$soluongtruot) {
    $conso.=$sotruot[$dem2].' ';
    $dem2++;
}
}
//ket lo bat dau xien
                    if($type2==2 && $demxien==2) {
                       $thongke='ăn xiên'; 
                    }
                    if($type2==3 && $demxien==3) {
                       $thongke='ăn xiên'; 
                    } 
                     if($type2==4 && $demxien==4) {
                       $thongke='ăn xiên'; 
                    }     
//ket xien
} 
if($type==5) {
    $demkep=0;
    $demkep=count($lokeptrung);
    if($demkep!=0) {
      $soluongtruot=0;
      $soluongtrung=rand(1,$demkep); 
      if($soluongdanh>$soluongtrung) {
        $soluongtruot=$soluongdanh-$soluongtrung;
        }
        else {
           $soluongtrung= $soluongdanh;
        }
        $thongke='ăn lô ';
        $demxien=0;
        $n=0;
        $dem=1;
        while($dem<=$soluongtrung) {
            $conlo=$lokeptrung[$n];
            $n++;
            $sonhay='';
            if($nhaylo[$conlo]!=0) {
              $sonhay=' x '.$nhaylo[$conlo];  
            }
            $conso.=$conlo.' ';
            $thongke.=$conlo.$sonhay.' ';
            $dem++;
        }
        if($soluongtruot>0) {
            $dem2=0;
        while($dem2<$soluongtruot) {
            $conso.=$lokeptruot[$dem2].' ';
            $dem2++;
        }
        } 
    }
    else {
        $thongke='Trượt';
        $conso='';
             $dem2=0;
        while($dem2<$soluongdanh) {
            $conso.=$lokeptruot[$dem2].' ';
            $dem2++;
        }
    }
} 
if($type==3) {
    $conso=$bacang.' ';
    $thongke='Ăn ba càng '.$bacang;
    if($soluongdanh>1) {
    $dem2=1;
    $moc=$soluongdanh-1;
while($dem2<=$moc) {
    $conso.=$bacangtruot[$dem2].' ';
    $dem2++;
}
}
} 
if($type==4) {
    $soluongtrung=rand(1,3);
    switch($soluongtrung) {
        case 1:$conso='đầu '.$dauduoi[0].' đuôi '.$dauduoitruot[1];
                $thongke='ăn đầu '.$dauduoi[0];break;
        case 2:$conso='đầu '.$dauduoitruot[0].' đuôi '.$dauduoi[1];
                $thongke='ăn đuôi '.$dauduoi[1];break;
        default:$conso='đầu '.$dauduoi[0].' đuôi '.$dauduoi[1];
                $thongke='ăn đầu '.$dauduoi[0].' ăn đuôi '.$dauduoi[1];break;
    }
}   

//end số đã chọn;
} else                                                                  //truong hop xac xuat roi vao truot
 {
    if($type==1) {
      $conso='';
      $dem2=1;
      while($dem2<=$soluongdanh) {
    $conso.=$detruot[$dem2].' ';
    $dem2++;
}
    $thongke='Trượt';
} 
if($type==2) {
    $conso='';
    $thongke='Trượt';
    $dem2=1;
while($dem2<=$soluongdanh) {
    $conso.=$sotruot[$dem2].' ';
    $dem2++;
}
} 
if($type==5)  {
        $thongke='Trượt';
        $conso='';
        $dem2=0;
        while($dem2<$soluongdanh) {
            $conso.=$lokeptruot[$dem2].' ';
            $dem2++;
        }
    }
if($type==3) {
    $conso='';
    $thongke='Trượt';
    $dem2=1;
while($dem2<=$soluongdanh) {
    $conso.=$bacangtruot[$dem2].' ';
    $dem2++;
}
} 
if($type==4) {
    $conso='đầu '.$dauduoitruot[0].' đuôi '.$dauduoitruot[1];
    $thongke='Trượt';
}  
}
//ket thuc lay so    
//        update ketquaNew
            $ketquaNew = ' 
    <tr>
    <td style="height:13px; text-align:center;vertical-align:top;font-weight: normal;"> 
    HÔM NAY 
        </td>
    <td style="height:13px; text-align:center; vertical-align:top">
    <img src="' . $base_url . '/images/anh-quay.gif" style="border:0px; box-sizing:border-box; vertical-align:middle; display:inline" />'
                . '<img src="' . $base_url . '/images/anh-quay.gif" style="border:0px; box-sizing:border-box; vertical-align:middle; display:inline" />'
                . '<img src="' . $base_url . '/images/anh-quay.gif" style="border:0px; box-sizing:border-box; vertical-align:middle; display:inline" />
                    </td>
    <td style="height:13px; text-align:center; vertical-align:top">
    <img src="' . $base_url . '/images/anh-quay.gif" style="border:0px; box-sizing:border-box;  vertical-align:middle; display:inline" />'
                . '<img src="' . $base_url . '/images/anh-quay.gif" style="border:0px; box-sizing:border-box;  vertical-align:middle; display:inline" />'
                . '<img src="' . $base_url . '/images/anh-quay.gif" style="border:0px; box-sizing:border-box;  vertical-align:middle; display:inline" />&nbsp;*
                    </td>
</tr>
<tr>
    <td style="height:13px; text-align:center;vertical-align:top;font-weight: normal;">
    ' . $date .
                '
        </td>
    <td style="height:13px; text-align:center; vertical-align:top;font-weight: normal;">
    ' . $conso .
                ' 
        </td>
    <td style="height:13px; text-align:center; vertical-align:top;font-weight: normal;">
    ' . $thongke .
                '</td>
</tr>';
//        end update ketquaNew
//khai báo lại $title. do mất "*"
            $title     = '<table border="1" class="table table-bordered table-hover table-striped" style="border-collapse:collapse; border-spacing:0px; border:1px solid rgb(221, 221, 221); box-sizing:border-box; font-family:helvetica neue,helvetica,arial,sans-serif; font-size:14px; line-height:20px; margin-bottom:20px; margin-left:auto; margin-right:auto; width:100%; ">
	<tbody>
		<tr>
			<td style="height:13px; text-align:center; vertical-align:top"><strong><span style="color:rgb(255, 0, 0)">NG&Agrave;Y</span></strong></td>
			<td style="height:13px; text-align:center; vertical-align:top"><strong><span style="color:rgb(255, 0, 0)">' . $titleMenu . '</span></strong></td>
			<td style="height:13px; text-align:center; vertical-align:top"><strong><span style="color:rgb(255, 0, 0)">KẾT QUẢ*</span></strong></td>
		</tr>';
//        kết thúc khai báo lại $title


            if ($ketqua == NULL) {
                $ketqua = '</table>';
            }

//        khai bao bien content trong bảng Menus
            $newThongKe = " $title $ketquaNew $ketqua ";
//        end khai bao
//        update thông tin thống kê cho bảng Menus
            $time       = time();
            $update     = $model_menu->updateThongKe($newThongKe, $id, $time);
//        echo $model_menu->getSql();
//        end kết thúc update thống kê
        } else {
            
        }
    }  
    //out truong hop chon trung
    //
    //
    //
        
    }
     else
      {
    $model_ketqua = new Models_KetQua();
    $object       = $model_ketqua->getObjectByCondition('', array('id_send' => $idThongKe));
    if (isset($object)) {
        
        $dateUpdate = strtotime(date("Y-m-d", $item->getTimeUpdate()));

        if ($timeHienTai > $tr && $timeHienTai < $s && $dateToday != $dateUpdate) {

//        lấy giá trị của bảng kết quả
            $id_send = $object->getIdSend();
            $user_id = $object->getUserId();
//        end lấy giá trị bảng KetQua

            list($title, $ketquaNew, $ketqua) = split('[*]', $content);
            $tomorow      = mktime(0, 0, 0, date("m"), date("d") + 1, date("Y"));
            // date tomorrow
            $dateTomorrow = date("d/m/Y", $tomorow);
//and date tomorrow
 $gettitledate=date("D", $tomorow);
            switch($gettitledate) {
                case 'Mon':$gettitledate='Thứ Hai';break; 
                case 'Tue':$gettitledate='Thứ Ba';break; 
                case 'Wed':$gettitledate='Thứ Tư';break; 
                case 'Thu':$gettitledate='Thứ Năm';break; 
                case 'Fri':$gettitledate='Thứ Sáu';break; 
                case 'Sat':$gettitledate='Thứ Bảy';break; 
                default :$gettitledate='Chủ nhật';
            }
//date hien tai
            $date         = date("d/m/Y");
//end date hien tai
//kết quả thống kê
             if($type!=4) {
            $result       = json_decode(file_get_contents('http://lotoxoso.net/thongke.php?id=' . $id_send . '&userid=' . $user_id . '&type=' . $type));
            }
            else {
               $result       = json_decode(file_get_contents('http://lotoxoso.net/thongke.php?id=' . $id_send . '&userid=' . $user_id . '&type=1&dauduoi=1'));          
            }
            if ($result != NULL) {
                $thongke="ăn lô ";
                if($type==1) {
                    foreach ($result as $key => $item) {   
                        $thongke='Trúng đề '.$key;
                        } 
                    }
                    else {
                if($type==4) {
                    $thongke="ăn ";
                    foreach ($result as $key => $item) {   
                        if($key=='dau')
                        {
                          $thongke.='đầu '.$item.' ';  
                        }
                        if($key=='duoi')
                        {
                          $thongke.='đuôi '.$item.' ';  
                        }
                        } 
                }
                    else {
                        $dem=0;
                foreach ($result as $key => $item) {
                        $dem++;
                        $thongke .= $key . 'x' . $item . ',';
                    }  
                    if($type2==2 && $dem==2) {
                       $thongke='ăn xiên'; 
                    }
                    if($type2==3 && $dem==3) {
                       $thongke='ăn xiên'; 
                    } 
                     if($type2==4 && $dem==4) {
                       $thongke='ăn xiên'; 
                    }                 
                }
                }
            } else {
                $thongke = 'trượt';
            }
//        end kết quả thống kê
// số đã chọn
            $conso     = $object->getContent();
//end số đã chọn;   
//        update ketquaNew
            $ketquaNew = ' 
    <tr>
    <td style="height:13px; text-align:center;vertical-align:top;font-weight: normal;"> 
    HÔM NAY 
        </td>
    <td style="height:13px; text-align:center; vertical-align:top">
    <img src="' . $base_url . '/images/anh-quay.gif" style="border:0px; box-sizing:border-box; vertical-align:middle; display:inline" />'
                . '<img src="' . $base_url . '/images/anh-quay.gif" style="border:0px; box-sizing:border-box; vertical-align:middle; display:inline" />'
                . '<img src="' . $base_url . '/images/anh-quay.gif" style="border:0px; box-sizing:border-box; vertical-align:middle; display:inline" />
                    </td>
    <td style="height:13px; text-align:center; vertical-align:top">
    <img src="' . $base_url . '/images/anh-quay.gif" style="border:0px; box-sizing:border-box;  vertical-align:middle; display:inline" />'
                . '<img src="' . $base_url . '/images/anh-quay.gif" style="border:0px; box-sizing:border-box;  vertical-align:middle; display:inline" />'
                . '<img src="' . $base_url . '/images/anh-quay.gif" style="border:0px; box-sizing:border-box;  vertical-align:middle; display:inline" />&nbsp;*
                    </td>
</tr>
<tr>
    <td style="height:13px; text-align:center;vertical-align:top;font-weight: normal;">
    ' . $date .
                '
        </td>
    <td style="height:13px; text-align:center; vertical-align:top;font-weight: normal;">
    ' . $conso .
                ' 
        </td>
    <td style="height:13px; text-align:center; vertical-align:top;font-weight: normal;">
    ' . $thongke .
                '</td>
</tr>';
//        end update ketquaNew
//khai báo lại $title. do mất "*"
            $title     = '<table border="1" class="table table-bordered table-hover table-striped" style="border-collapse:collapse; border-spacing:0px; border:1px solid rgb(221, 221, 221); box-sizing:border-box; font-family:helvetica neue,helvetica,arial,sans-serif; font-size:14px; line-height:20px; margin-bottom:20px; margin-left:auto; margin-right:auto; width:100%; ">
	<tbody>
		<tr>
			<td style="height:13px; text-align:center; vertical-align:top"><strong><span style="color:rgb(255, 0, 0)">NG&Agrave;Y</span></strong></td>
			<td style="height:13px; text-align:center; vertical-align:top"><strong><span style="color:rgb(255, 0, 0)">' . $titleMenu . '</span></strong></td>
			<td style="height:13px; text-align:center; vertical-align:top"><strong><span style="color:rgb(255, 0, 0)">KẾT QUẢ*</span></strong></td>
		</tr>';
//        kết thúc khai báo lại $title


            if ($ketqua == NULL) {
                $ketqua = '</table>';
            }

//        khai bao bien content trong bảng Menus
            $newThongKe = " $title $ketquaNew $ketqua ";
//        end khai bao
//        update thông tin thống kê cho bảng Menus
            $time       = time();
            $update     = $model_menu->updateThongKe($newThongKe, $id, $time);
//        echo $model_menu->getSql();
// up date trung truot
            $models_menu2=new Models_Menus();
            $updatetrung=$models_menu2->getObject($id);
            $updatetrung->setSoluongdanh(1);
            $models_menu2->setPersistents($updatetrung);
            $models_menu2->edit(array('soluongdanh'));

//        end kết thúc update thống kê
        } else {
            
        }
    }
    }
//    end xet object != NULL
} 
} 
//end foreach
