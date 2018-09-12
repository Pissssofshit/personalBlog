<?php

namespace App\Library;

class Pager {
	public static function createPage($base_url, $record_count, $page=1, $size=10, $display_page_count = 10, $max_size = 100){

		/**
		if (!is_numeric($size) || $size < 1)
		{
			$size = 10;
		}

		if (!is_numeric($page) || $page < 1)
		{
			$page = 1;
		}
*/


		//是否是包含了分页模板
		if(strpos($base_url,'{page}') == false){
			if(strpos($base_url,'?') == false){
				$base_url .= '?page={page}';
			}
			else{
				$base_url .= '&page={page}';
			}
		}

		$page = intval($page) > 0 ? intval($page) : 1;
		$size = intval($size) > 0 ? intval($size) : 10;
		$size = $size > $max_size ? $max_size : $size;

		$record_count = intval($record_count);
		//计算总的分页数
		$page_count = $record_count > 0 ? intval(ceil($record_count / $size)) : 0;

		//当分总的分页数小于想要显示分页数时，设置实际显示的分页数为总的分页数
		if($page_count <  $display_page_count)
			 $display_page_count = $page_count;

		if ($page > $page_count)
		{
			$page = $page_count;
		}

		$page_prev  = ($page > 1) ? $page - 1 : 1;
		$page_next  = ($page < $page_count) ? $page + 1 : $page_count;

		/* 将参数合成url字串 */
		$param_url = '';
		if (strpos($base_url,'?') == false )
			$param_url .= '?';
		else
			$param_url .= '&';
		$pager['start']        = ($page -1) * $size;
		$pager['page']         = $page;
		$pager['size']         = $size;
		$pager['record_count'] = $record_count;
		$pager['page_count']   = $page_count;
		$pager['display_page_count'] = $display_page_count;

		$page_content = array();
		//计算当前也相对于显示页面数量的中间值的偏移量
		$offset = intval(ceil($display_page_count/2));
		//最左边值
		$left = $page - $offset + 1;
		$left = $left > 0 ? $left : 1; 
		//最有边值
		$right = $page + $offset; 
		$right = $right < $page_count ? $right : $page_count;
	
		//从第一页开始
		if($left  == 1){
			$index =1;
			while(($index <= $display_page_count) && ($index <= $page_count)){
				//$page_content[$index] = $base_url . $param_url. 'page=' . $index . '&size=' . $size;
				$page_content[$index] = str_replace('{page}',$index,$base_url); 

				$index++;
			}

		}elseif($right == $page_count){//从最后一页开始
			$i = 0;
			$index = $right;
			while(($i < $display_page_count) && ($index >= 1)){
				//$page_content[$index] = $base_url . $param_url. 'page=' . $index . '&size=' . $size;
				$page_content[$index] = str_replace('{page}',$index,$base_url); 

				$i++;
				$index--;
			}
			//反转,数组key 按页码增序
			$page_content = array_reverse($page_content, true);
		}else{//从最左边到最右边
			$i =0;
			$index = $left;
			while(($i < $display_page_count) && ($index <= $right)){
				//$page_content[$index] = $base_url . $param_url. 'page=' . $index . '&size=' . $size;
				$page_content[$index] = str_replace('{page}',$index,$base_url); 

				$i++;
				$index++;
			}
		
		}
		//偏移量大于0 则显示页面从该该偏移量开始，则从1开始

		$pager['page_first']   = str_replace('{page}',1,$base_url); 
		$pager['page_prev']    = str_replace('{page}',$page_prev,$base_url); 
		$pager['page_next']    = str_replace('{page}',$page_next,$base_url); 
		$pager['page_last']    = str_replace('{page}',$page_count,$base_url);
		$pager['page_content'] = $page_content;
		return $pager;

	}
/*}}}*/
	

/*{{{function getDivPage*/
	static function getDivPage($base_url, &$record_count, &$page =1, &$size=10, &$display_page_count = 10, $max_size = 100,$show_last = true){
		$res = self::createPage($base_url, $record_count, $page, $size, $display_page_count, $max_size);
		$page_list = $res['page_content'];
		$page_count = ceil($record_count/$size);

		//实际可显示的页数
		$display_page_count = $res['display_page_count'];

		//当前页
		$page = $res['page'];

		//每页实际大小
		$size = $res['size'];

		$str = "";	
		//如果页面只有用一页则不显示分页
		if($display_page_count > 1){

			//判断首页
			if($page > 1)
			$str .= sprintf("<a href=\"%s\">首页</a>",$res['page_first']);

			//判断上一页
			if($page > 1)
				$str .= sprintf("<a href=\"%s\">上一页</a>",$res['page_prev']);

			//显示页码
			foreach($page_list as $index => $url){
				if($index == $page){
					$str .= "<a>[$index]</a>";
				}
				else{
					$str .= "<a href=\"$url\">$index</a>";
				}

			}

			//下一页
			if($page <  $page_count)
				$str .=	sprintf("<a href=\"%s\">下一页</a>",$res['page_next']);
			//最后页
			if($show_last && $page <  $page_count){
				$str .= sprintf("<a href=\"%s\">末页</a>",$res['page_last']);
			}
			
		}

		return $str;

	}
}

class Util_Pager {
	public static function createPage($base_url, $record_count, $page=1, $size=10, $display_page_count = 10, $max_size = 100){

		/**
		if (!is_numeric($size) || $size < 1)
		{
			$size = 10;
		}

		if (!is_numeric($page) || $page < 1)
		{
			$page = 1;
		}
*/


		//是否是包含了分页模板
		if(strpos($base_url,'{page}') == false){
			if(strpos($base_url,'?') == false){
				$base_url .= '?page={page}';
			}
			else{
				$base_url .= '&page={page}';
			}
		}

		$page = intval($page) > 0 ? intval($page) : 1;
		$size = intval($size) > 0 ? intval($size) : 10;
		$size = $size > $max_size ? $max_size : $size;

		$record_count = intval($record_count);
		//计算总的分页数
		$page_count = $record_count > 0 ? intval(ceil($record_count / $size)) : 0;

		//当分总的分页数小于想要显示分页数时，设置实际显示的分页数为总的分页数
		if($page_count <  $display_page_count)
			 $display_page_count = $page_count;

		if ($page > $page_count)
		{
			$page = $page_count;
		}

		$page_prev  = ($page > 1) ? $page - 1 : 1;
		$page_next  = ($page < $page_count) ? $page + 1 : $page_count;

		/* 将参数合成url字串 */
		$param_url = '';
		if (strpos($base_url,'?') == false )
			$param_url .= '?';
		else
			$param_url .= '&';
		$pager['start']        = ($page -1) * $size;
		$pager['page']         = $page;
		$pager['size']         = $size;
		$pager['record_count'] = $record_count;
		$pager['page_count']   = $page_count;
		$pager['display_page_count'] = $display_page_count;

		$page_content = array();
		//计算当前也相对于显示页面数量的中间值的偏移量
		$offset = intval(ceil($display_page_count/2));
		//最左边值
		$left = $page - $offset + 1;
		$left = $left > 0 ? $left : 1; 
		//最有边值
		$right = $page + $offset; 
		$right = $right < $page_count ? $right : $page_count;
	
		//从第一页开始
		if($left  == 1){
			$index =1;
			while(($index <= $display_page_count) && ($index <= $page_count)){
				//$page_content[$index] = $base_url . $param_url. 'page=' . $index . '&size=' . $size;
				$page_content[$index] = str_replace('{page}',$index,$base_url); 

				$index++;
			}

		}elseif($right == $page_count){//从最后一页开始
			$i = 0;
			$index = $right;
			while(($i < $display_page_count) && ($index >= 1)){
				//$page_content[$index] = $base_url . $param_url. 'page=' . $index . '&size=' . $size;
				$page_content[$index] = str_replace('{page}',$index,$base_url); 

				$i++;
				$index--;
			}
			//反转,数组key 按页码增序
			$page_content = array_reverse($page_content, true);
		}else{//从最左边到最右边
			$i =0;
			$index = $left;
			while(($i < $display_page_count) && ($index <= $right)){
				//$page_content[$index] = $base_url . $param_url. 'page=' . $index . '&size=' . $size;
				$page_content[$index] = str_replace('{page}',$index,$base_url); 

				$i++;
				$index++;
			}
		
		}
		//偏移量大于0 则显示页面从该该偏移量开始，则从1开始

		$pager['page_first']   = str_replace('{page}',1,$base_url); 
		$pager['page_prev']    = str_replace('{page}',$page_prev,$base_url); 
		$pager['page_next']    = str_replace('{page}',$page_next,$base_url); 
		$pager['page_last']    = str_replace('{page}',$page_count,$base_url);
		$pager['page_content'] = $page_content;
		return $pager;

	}
/*}}}*/
	

/*{{{function getDivPage*/
	static function getDivPage($base_url, &$record_count, &$page =1, &$size=10, &$display_page_count = 10, $max_size = 100,$show_last = true){
		$res = self::createPage($base_url, $record_count, $page, $size, $display_page_count, $max_size);
		$page_list = $res['page_content'];
		$page_count = ceil($record_count/$size);

		//实际可显示的页数
		$display_page_count = $res['display_page_count'];

		//当前页
		$page = $res['page'];

		//每页实际大小
		$size = $res['size'];

		$str = "";	
		//如果页面只有用一页则不显示分页
		if($display_page_count > 1){

			//判断首页
			if($page > 1)
			$str .= sprintf("<a href=\"%s\">首页</a>",$res['page_first']);

			//判断上一页
			if($page > 1)
				$str .= sprintf("<a href=\"%s\">上一页</a>",$res['page_prev']);

			//显示页码
			foreach($page_list as $index => $url){
				if($index == $page){
					$str .= "<a>[$index]</a>";
				}
				else{
					$str .= "<a href=\"$url\">$index</a>";
				}

			}

			//下一页
			if($page <  $page_count)
				$str .=	sprintf("<a href=\"%s\">下一页</a>",$res['page_next']);
			//最后页
			if($show_last && $page <  $page_count){
				$str .= sprintf("<a href=\"%s\">末页</a>",$res['page_last']);
			}
			
		}

		return $str;

	}
}
