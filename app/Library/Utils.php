<?php
namespace App\Library;

class Utils{

	public  static function export($fileNames,$title,$dataList,$extendName="",$isnonv=0){
        $showdata = "";
        foreach ($title as $vs) {
            $showdata .= $showdata ? "," . iconv('utf-8', 'gb2312//IGNORE', $vs) : iconv('utf-8', 'gb2312//IGNORE', $vs);
        }
        $showdata .= "\n";//"消耗时间,代理姓名,应用名,游戏名,消耗数量\n";
        if ($dataList) {
            foreach ($dataList as $key => $v) {
                $tk = 0;
                foreach ($v as $k => $li) {
                    $showdata .= $showdata && $tk > 0 ? ",".iconv('utf-8', 'gb2312//IGNORE', $li) :iconv('utf-8', 'gb2312//IGNORE', $li);
                    $tk++;
                }
                $showdata .= "\n";
            }
        }
        self::exportto($fileNames, $showdata);
	}
	static function exportto($filename,$data){
		ob_end_clean();
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Type: text/csv; charset=UTF-8");
        header("Pragma:no-cache");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-Disposition: attachment;filename=$filename");
        header("Content-Transfer-Encoding: binary ");
        echo $data;
        exit;
    }
}
