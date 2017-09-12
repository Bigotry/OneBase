<?php
namespace app\index\controller;

class Common extends IndexBase
{
    
    public function page($current_page = 0, $last_page = 0, $offset = 3, $page_number = 7)
    {
        
        exit(get_page_html($current_page, $last_page, $offset, $page_number));
    }
}
