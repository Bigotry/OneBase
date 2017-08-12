<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\logic;

use app\common\logic\LogicBase;

/**
 * Admin基础逻辑
 */
class AdminBase extends LogicBase
{

    /**
     * 权限检测
     */
    public function authCheck($url = '', $url_list = [])
    {

        $pass_data = [RESULT_SUCCESS, '权限检查通过'];
        
        $allow_url = config('allow_url');
        
        $allow_url_list  = parse_config_attr($allow_url);
        
        if (IS_ROOT) : return $pass_data; endif;
        
        if (!empty($allow_url_list)) {
            
            foreach ($allow_url_list as $v) {
                
                if (strpos(strtolower($url), strtolower($v)) !== false) : return $pass_data; endif;
            }
        }
        
        $result = in_array(strtolower($url), $url_list) ? true : false;
        
        return $result ? $pass_data : [RESULT_ERROR, '未授权操作'];
    }
    
    /**
     * 获取过滤后的菜单树
     */
    public function getMenuTree($menu_list = [], $url_list = [])
    {
        
        foreach ($menu_list as $key => $menu_info) {
            
            list($status, $message) = $this->authCheck(MODULE_NAME . SYS_DSS . $menu_info['url'], $url_list);
            
            [$message];
            
            if ((!IS_ROOT && RESULT_ERROR == $status) || !empty($menu_info['is_hide'])) : unset($menu_list[$key]); endif;
        }
        
        return $this->getListTree($menu_list);
    }
    
    /**
     * 获取列表树结构
     */
    public function getListTree($list = [])
    {
        
        return list_to_tree(array_values($list), 'id', 'pid', 'child');
    }
    
    /**
     * 过滤页面内容
     */
    public function filter($content = '', $url_list = [])
    {
        
        $expression_ob_link = '%<ob_link.*?>(.*?)</ob_link>%si';

        $results = [];
        
        preg_match_all($expression_ob_link, $content, $results);
        
        $expression_href = '/href=\"([^(\}>)]+)\"/';
        $expression_url  = '/url=\"([^(\}>)]+)\"/';
        
        foreach ($results[1] as $a)
        {
            
            $href_results = []; 
            
            preg_match_all($expression_href, $a, $href_results);
            
            empty($href_results[0]) && empty($href_results[1]) && preg_match_all($expression_url, $a, $href_results);
            
            $url_array = explode(SYS_DSS, $href_results[1][0]); 
            $url_array_html = explode('.', $url_array[2]); 
            
            $check_url = MODULE_NAME . SYS_DSS . $url_array[1] . SYS_DSS . $url_array_html[0];
            
            $result = $this->authCheck($check_url, $url_list);
            
            $result[0] != RESULT_SUCCESS && $content = str_replace($a, '', $content);
        }
        
        return $content;
    }
    
    /**
     * 获取首页数据
     */
    public function getIndexData()
    {
        
        $query = new \think\db\Query();
        
        $system_info_mysql = $query->query("select version() as v;");
        
        $cache_info = cache(AUTO_CACHE_KEY);
        
        // 系统信息
        $data['ob_version']     = SYS_VERSION;
        $data['think_version']  = THINK_VERSION;
        $data['os']             = PHP_OS;
        $data['software']       = $_SERVER['SERVER_SOFTWARE'];
        $data['mysql_version']  = $system_info_mysql[0]['v'];
        $data['upload_max']     = ini_get('upload_max_filesize');
        $data['php_version']    = PHP_VERSION;
        
        // 产品信息
        $data['product_name']   = 'OneBase开源免费基础架构';
        $data['author']         = 'Bigotry';
        $data['website']        = 'www.onebase.org';
        $data['qun']            = '<a target="_blank" href="//shang.qq.com/wpa/qunwpa?idkey=58d4c9b78a027fb2f74bcaecc07e75a64d2136f9243a26f5a88824284c25ced9"><img border="0" src="//pub.idqqimg.com/wpa/images/group.png" alt="OneBase ①" title="OneBase ①"></a>'
                                . '&nbsp;&nbsp;&nbsp;<a target="_blank" href="//shang.qq.com/wpa/qunwpa?idkey=d568bba1db4a9cb96f44e291d3192cf6538c3a64e5a7e4c8484aa8b332f25101"><img border="0" src="//pub.idqqimg.com/wpa/images/group.png" alt="OneBase ②" title="OneBase ②"></a>';
        $data['document']       = '制作中...';
        $data['chache_number']  = $cache_info[CACHE_NUMBER_KEY];
        $data['hit']            = round($cache_info[CACHE_EXE_HIT_KEY] / $cache_info[CACHE_EXE_NUMBER_KEY] * 100, 2) . '%';

        return $data;
    }
    
}
