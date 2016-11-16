<?php
namespace DB;

class myphpExcel{

  public function excelfile($data, $name){
    require_once dirname(__FILE__).'/phpoffice/Classes/PHPExcel.php';
    require_once dirname(__FILE__).'/phpoffice/Classes/PHPExcel/IOFactory.php';
    $PHPExcel = new \PHPExcel();
    $PHPExcel->getProperties()->setTitle("Office 2007 XLSX Document")
               ->setSubject("Office 2007 XLSX Document")
               ->setDescription("XLSX document")
               ->setKeywords("office 2007");
    $title = array();
    $top = array(
      "memname" => "名字",
      "sex" => "性别",
      "callnumber" => "手机号",
      "meettime" => "入场场次",
      "meet1status" => "14：30签到状态",
      "meet2status" => "16：30签到状态",
      "inmeettime" => "实际到场时间"
    );
    $keys = array_keys($data[0]);
    $k = 65;
    foreach($keys as $x){
      $title[$x] = chr($k);
      $k++;
    }
    foreach($top as $x => $x_val){
      $PHPExcel->setActiveSheetIndex(0)->setCellValue($title[$x].'1', $x_val);
      $PHPExcel->getActiveSheet()->getStyle($title[$x].'1')->getFont()->setSize(11);
      $PHPExcel->getActiveSheet()->getStyle($title[$x].'1')->getFont()->setBold(true);
      $PHPExcel->getActiveSheet()->getStyle($title[$x].'1')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $PHPExcel->getActiveSheet()->getStyle($title[$x].'1')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
    }
    $count = count($data);
    for($x = 0; $x<$count; $x++){
      $z = $x+2;
      foreach($data[$x] as $d => $d_val){
        $PHPExcel->setActiveSheetIndex(0)->setCellValue($title[$d].$z, $d_val);
        $PHPExcel->getActiveSheet()->getStyle($title[$d].$z)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $PHPExcel->getActiveSheet()->getStyle($title[$d].$z)->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
      }
    }
    $PHPExcel->setActiveSheetIndex(0);
    foreach($title as $x){
      $PHPExcel->getActiveSheet()->getColumnDimension($x)->setAutoSize(true);
    }
    $PHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight('19');
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$name.'.xls"');
    header('Cache-Control: max-age=0');
    header('Cache-Control: max-age=1');
    header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header ('Pragma: public'); // HTTP/1.0

    $objWriter = \PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel5');
    $objWriter->save('php://output');
  }
}
