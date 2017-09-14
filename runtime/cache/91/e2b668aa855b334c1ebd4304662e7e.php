<?php
//000000000000s:4259:"O:20:"app\common\model\Api":32:{s:13:" * connection";a:0:{}s:9:" * parent";N;s:8:" * query";N;s:7:" * name";s:3:"Api";s:8:" * table";N;s:8:" * class";s:20:"app\common\model\Api";s:8:" * error";N;s:11:" * validate";N;s:5:" * pk";N;s:8:" * field";a:0:{}s:11:" * readonly";a:0:{}s:10:" * visible";a:0:{}s:9:" * hidden";a:0:{}s:9:" * append";a:0:{}s:7:" * data";a:21:{s:2:"id";i:186;s:4:"name";s:15:"登录或注册";s:8:"group_id";i:34;s:12:"request_type";i:0;s:7:"api_url";s:12:"common/login";s:8:"describe";s:168:"系统登录注册接口，若用户名存在则验证密码正确性，若用户名不存在则注册新用户，返回 user_token 用于操作需验证身份的接口";s:13:"describe_text";s:0:"";s:15:"is_request_data";i:1;s:12:"request_data";s:189:"[{"field_name":"username","data_type":"0","is_require":"1","field_describe":"\u7528\u6237\u540d"},{"field_name":"password","data_type":"0","is_require":"1","field_describe":"\u5bc6\u7801"}]";s:13:"response_data";s:99:"[{"field_name":"data","data_type":"2","field_describe":"\u4f1a\u5458\u6570\u636e\u53causer_token"}]";s:16:"is_response_data";i:1;s:13:"is_user_token";i:0;s:12:"is_data_sign";i:1;s:17:"response_examples";s:701:"{
    &quot;code&quot;: 0,
    &quot;msg&quot;: &quot;操作成功&quot;,
    &quot;data&quot;: {
        &quot;member_id&quot;: 51,
        &quot;nickname&quot;: &quot;sadasdas&quot;,
        &quot;username&quot;: &quot;sadasdas&quot;,
        &quot;create_time&quot;: &quot;2017-09-09 13:40:17&quot;,
        &quot;user_token&quot;: &quot;eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJPbmVCYXNlIEpXVCIsImlhdCI6MTUwNDkzNTYxNywiZXhwIjoxNTA0OTM2NjE3LCJhdWQiOiJPbmVCYXNlIiwic3ViIjoiT25lQmFzZSIsImRhdGEiOnsibWVtYmVyX2lkIjo1MSwibmlja25hbWUiOiJzYWRhc2RhcyIsInVzZXJuYW1lIjoic2FkYXNkYXMiLCJjcmVhdGVfdGltZSI6IjIwMTctMDktMDkgMTM6NDA6MTcifX0.6PEShODuifNsa-x1TumLoEaR2TCXpUEYgjpD3Mz3GRM&quot;
    }
}";s:9:"developer";i:0;s:10:"api_status";i:1;s:7:"is_page";i:0;s:4:"sort";i:0;s:6:"status";i:1;s:11:"create_time";i:1504501410;s:11:"update_time";i:1504949075;}s:9:" * origin";a:21:{s:2:"id";i:186;s:4:"name";s:15:"登录或注册";s:8:"group_id";i:34;s:12:"request_type";i:0;s:7:"api_url";s:12:"common/login";s:8:"describe";s:168:"系统登录注册接口，若用户名存在则验证密码正确性，若用户名不存在则注册新用户，返回 user_token 用于操作需验证身份的接口";s:13:"describe_text";s:0:"";s:15:"is_request_data";i:1;s:12:"request_data";s:189:"[{"field_name":"username","data_type":"0","is_require":"1","field_describe":"\u7528\u6237\u540d"},{"field_name":"password","data_type":"0","is_require":"1","field_describe":"\u5bc6\u7801"}]";s:13:"response_data";s:99:"[{"field_name":"data","data_type":"2","field_describe":"\u4f1a\u5458\u6570\u636e\u53causer_token"}]";s:16:"is_response_data";i:1;s:13:"is_user_token";i:0;s:12:"is_data_sign";i:1;s:17:"response_examples";s:701:"{
    &quot;code&quot;: 0,
    &quot;msg&quot;: &quot;操作成功&quot;,
    &quot;data&quot;: {
        &quot;member_id&quot;: 51,
        &quot;nickname&quot;: &quot;sadasdas&quot;,
        &quot;username&quot;: &quot;sadasdas&quot;,
        &quot;create_time&quot;: &quot;2017-09-09 13:40:17&quot;,
        &quot;user_token&quot;: &quot;eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJPbmVCYXNlIEpXVCIsImlhdCI6MTUwNDkzNTYxNywiZXhwIjoxNTA0OTM2NjE3LCJhdWQiOiJPbmVCYXNlIiwic3ViIjoiT25lQmFzZSIsImRhdGEiOnsibWVtYmVyX2lkIjo1MSwibmlja25hbWUiOiJzYWRhc2RhcyIsInVzZXJuYW1lIjoic2FkYXNkYXMiLCJjcmVhdGVfdGltZSI6IjIwMTctMDktMDkgMTM6NDA6MTcifX0.6PEShODuifNsa-x1TumLoEaR2TCXpUEYgjpD3Mz3GRM&quot;
    }
}";s:9:"developer";i:0;s:10:"api_status";i:1;s:7:"is_page";i:0;s:4:"sort";i:0;s:6:"status";i:1;s:11:"create_time";i:1504501410;s:11:"update_time";i:1504949075;}s:11:" * relation";a:0:{}s:7:" * auto";a:0:{}s:9:" * insert";a:0:{}s:9:" * update";a:0:{}s:21:" * autoWriteTimestamp";b:1;s:13:" * createTime";s:11:"create_time";s:13:" * updateTime";s:11:"update_time";s:13:" * dateFormat";s:11:"Y-m-d H:i:s";s:7:" * type";a:0:{}s:11:" * isUpdate";b:1;s:14:" * updateWhere";a:1:{s:7:"api_url";s:12:"common/login";}s:16:" * failException";b:0;s:17:" * useGlobalScope";b:1;s:16:" * batchValidate";b:0;s:16:" * resultSetType";s:5:"array";s:16:" * relationWrite";N;}";
?>