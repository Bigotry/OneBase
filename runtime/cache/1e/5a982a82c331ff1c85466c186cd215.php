<?php
//000000000000s:23648:"O:32:"think\paginator\driver\Bootstrap":8:{s:9:" * simple";b:0;s:8:" * items";O:16:"think\Collection":1:{s:8:" * items";a:6:{i:0;O:20:"app\common\model\Api":32:{s:13:" * connection";a:0:{}s:9:" * parent";N;s:8:" * query";N;s:7:" * name";s:3:"Api";s:8:" * table";N;s:8:" * class";s:20:"app\common\model\Api";s:8:" * error";N;s:11:" * validate";N;s:5:" * pk";N;s:8:" * field";a:0:{}s:11:" * readonly";a:0:{}s:10:" * visible";a:0:{}s:9:" * hidden";a:0:{}s:9:" * append";a:0:{}s:7:" * data";a:21:{s:2:"id";i:191;s:4:"name";s:12:"修改密码";s:8:"group_id";i:34;s:12:"request_type";i:0;s:7:"api_url";s:21:"common/changepassword";s:8:"describe";s:18:"修改密码接口";s:13:"describe_text";s:0:"";s:15:"is_request_data";i:1;s:12:"request_data";s:203:"[{"field_name":"old_password","data_type":"0","is_require":"1","field_describe":"\u65e7\u5bc6\u7801"},{"field_name":"new_password","data_type":"0","is_require":"1","field_describe":"\u65b0\u5bc6\u7801"}]";s:13:"response_data";s:0:"";s:16:"is_response_data";i:0;s:13:"is_user_token";i:1;s:12:"is_data_sign";i:0;s:17:"response_examples";s:4:"dfdd";s:9:"developer";i:0;s:10:"api_status";i:0;s:7:"is_page";i:0;s:4:"sort";i:0;s:6:"status";i:1;s:11:"create_time";i:1504941496;s:11:"update_time";i:1504941496;}s:9:" * origin";a:21:{s:2:"id";i:191;s:4:"name";s:12:"修改密码";s:8:"group_id";i:34;s:12:"request_type";i:0;s:7:"api_url";s:21:"common/changepassword";s:8:"describe";s:18:"修改密码接口";s:13:"describe_text";s:0:"";s:15:"is_request_data";i:1;s:12:"request_data";s:203:"[{"field_name":"old_password","data_type":"0","is_require":"1","field_describe":"\u65e7\u5bc6\u7801"},{"field_name":"new_password","data_type":"0","is_require":"1","field_describe":"\u65b0\u5bc6\u7801"}]";s:13:"response_data";s:0:"";s:16:"is_response_data";i:0;s:13:"is_user_token";i:1;s:12:"is_data_sign";i:0;s:17:"response_examples";s:4:"dfdd";s:9:"developer";i:0;s:10:"api_status";i:0;s:7:"is_page";i:0;s:4:"sort";i:0;s:6:"status";i:1;s:11:"create_time";i:1504941496;s:11:"update_time";i:1504941496;}s:11:" * relation";a:0:{}s:7:" * auto";a:0:{}s:9:" * insert";a:0:{}s:9:" * update";a:0:{}s:21:" * autoWriteTimestamp";b:1;s:13:" * createTime";s:11:"create_time";s:13:" * updateTime";s:11:"update_time";s:13:" * dateFormat";s:11:"Y-m-d H:i:s";s:7:" * type";a:0:{}s:11:" * isUpdate";b:1;s:14:" * updateWhere";N;s:16:" * failException";b:0;s:17:" * useGlobalScope";b:1;s:16:" * batchValidate";b:0;s:16:" * resultSetType";s:5:"array";s:16:" * relationWrite";N;}i:1;O:20:"app\common\model\Api":32:{s:13:" * connection";a:0:{}s:9:" * parent";N;s:8:" * query";N;s:7:" * name";s:3:"Api";s:8:" * table";N;s:8:" * class";s:20:"app\common\model\Api";s:8:" * error";N;s:11:" * validate";N;s:5:" * pk";N;s:8:" * field";a:0:{}s:11:" * readonly";a:0:{}s:10:" * visible";a:0:{}s:9:" * hidden";a:0:{}s:9:" * append";a:0:{}s:7:" * data";a:21:{s:2:"id";i:190;s:4:"name";s:15:"详情页接口";s:8:"group_id";i:45;s:12:"request_type";i:0;s:7:"api_url";s:19:"combination/details";s:8:"describe";s:15:"详情页接口";s:13:"describe_text";s:0:"";s:15:"is_request_data";i:1;s:12:"request_data";s:96:"[{"field_name":"article_id","data_type":"0","is_require":"1","field_describe":"\u6587\u7ae0ID"}]";s:13:"response_data";s:217:"[{"field_name":"article_category_list","data_type":"2","field_describe":"\u6587\u7ae0\u5206\u7c7b\u6570\u636e"},{"field_name":"article_details","data_type":"2","field_describe":"\u6587\u7ae0\u8be6\u60c5\u6570\u636e"}]";s:16:"is_response_data";i:1;s:13:"is_user_token";i:0;s:12:"is_data_sign";i:0;s:17:"response_examples";s:811:"{
    &quot;code&quot;: 0,
    &quot;msg&quot;: &quot;操作成功&quot;,
    &quot;data&quot;: {
        &quot;article_category_list&quot;: [
            {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;测试文章分类2&quot;
            },
            {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;测试文章分类1&quot;
            }
        ],
        &quot;article_details&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;213&quot;,
            &quot;category_id&quot;: 1,
            &quot;describe&quot;: &quot;test001&quot;,
            &quot;content&quot;: &quot;第三方发送到&quot;&quot;&quot;,
            &quot;create_time&quot;: &quot;2014-07-22 11:56:53&quot;
        }
    }
}";s:9:"developer";i:0;s:10:"api_status";i:0;s:7:"is_page";i:0;s:4:"sort";i:0;s:6:"status";i:1;s:11:"create_time";i:1504922092;s:11:"update_time";i:1504923179;}s:9:" * origin";a:21:{s:2:"id";i:190;s:4:"name";s:15:"详情页接口";s:8:"group_id";i:45;s:12:"request_type";i:0;s:7:"api_url";s:19:"combination/details";s:8:"describe";s:15:"详情页接口";s:13:"describe_text";s:0:"";s:15:"is_request_data";i:1;s:12:"request_data";s:96:"[{"field_name":"article_id","data_type":"0","is_require":"1","field_describe":"\u6587\u7ae0ID"}]";s:13:"response_data";s:217:"[{"field_name":"article_category_list","data_type":"2","field_describe":"\u6587\u7ae0\u5206\u7c7b\u6570\u636e"},{"field_name":"article_details","data_type":"2","field_describe":"\u6587\u7ae0\u8be6\u60c5\u6570\u636e"}]";s:16:"is_response_data";i:1;s:13:"is_user_token";i:0;s:12:"is_data_sign";i:0;s:17:"response_examples";s:811:"{
    &quot;code&quot;: 0,
    &quot;msg&quot;: &quot;操作成功&quot;,
    &quot;data&quot;: {
        &quot;article_category_list&quot;: [
            {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;测试文章分类2&quot;
            },
            {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;测试文章分类1&quot;
            }
        ],
        &quot;article_details&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;213&quot;,
            &quot;category_id&quot;: 1,
            &quot;describe&quot;: &quot;test001&quot;,
            &quot;content&quot;: &quot;第三方发送到&quot;&quot;&quot;,
            &quot;create_time&quot;: &quot;2014-07-22 11:56:53&quot;
        }
    }
}";s:9:"developer";i:0;s:10:"api_status";i:0;s:7:"is_page";i:0;s:4:"sort";i:0;s:6:"status";i:1;s:11:"create_time";i:1504922092;s:11:"update_time";i:1504923179;}s:11:" * relation";a:0:{}s:7:" * auto";a:0:{}s:9:" * insert";a:0:{}s:9:" * update";a:0:{}s:21:" * autoWriteTimestamp";b:1;s:13:" * createTime";s:11:"create_time";s:13:" * updateTime";s:11:"update_time";s:13:" * dateFormat";s:11:"Y-m-d H:i:s";s:7:" * type";a:0:{}s:11:" * isUpdate";b:1;s:14:" * updateWhere";N;s:16:" * failException";b:0;s:17:" * useGlobalScope";b:1;s:16:" * batchValidate";b:0;s:16:" * resultSetType";s:5:"array";s:16:" * relationWrite";N;}i:2;O:20:"app\common\model\Api":32:{s:13:" * connection";a:0:{}s:9:" * parent";N;s:8:" * query";N;s:7:" * name";s:3:"Api";s:8:" * table";N;s:8:" * class";s:20:"app\common\model\Api";s:8:" * error";N;s:11:" * validate";N;s:5:" * pk";N;s:8:" * field";a:0:{}s:11:" * readonly";a:0:{}s:10:" * visible";a:0:{}s:9:" * hidden";a:0:{}s:9:" * append";a:0:{}s:7:" * data";a:21:{s:2:"id";i:189;s:4:"name";s:12:"首页接口";s:8:"group_id";i:45;s:12:"request_type";i:0;s:7:"api_url";s:17:"combination/index";s:8:"describe";s:18:"首页聚合接口";s:13:"describe_text";s:0:"";s:15:"is_request_data";i:1;s:12:"request_data";s:109:"[{"field_name":"category_id","data_type":"0","is_require":"0","field_describe":"\u6587\u7ae0\u5206\u7c7bID"}]";s:13:"response_data";s:202:"[{"field_name":"article_category_list","data_type":"2","field_describe":"\u6587\u7ae0\u5206\u7c7b\u6570\u636e"},{"field_name":"article_list","data_type":"2","field_describe":"\u6587\u7ae0\u6570\u636e"}]";s:16:"is_response_data";i:1;s:13:"is_user_token";i:0;s:12:"is_data_sign";i:1;s:17:"response_examples";s:1377:"{
    &quot;code&quot;: 0,
    &quot;msg&quot;: &quot;操作成功&quot;,
    &quot;data&quot;: {
        &quot;article_category_list&quot;: [
            {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;测试文章分类2&quot;
            },
            {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;测试文章分类1&quot;
            }
        ],
        &quot;article_list&quot;: {
            &quot;total&quot;: 8,
            &quot;per_page&quot;: &quot;2&quot;,
            &quot;current_page&quot;: &quot;1&quot;,
            &quot;last_page&quot;: 4,
            &quot;data&quot;: [
                {
                    &quot;id&quot;: 15,
                    &quot;name&quot;: &quot;tttttt&quot;,
                    &quot;category_id&quot;: 1,
                    &quot;describe&quot;: &quot;sddd&quot;,
                    &quot;create_time&quot;: &quot;2017-08-07 13:24:46&quot;
                },
                {
                    &quot;id&quot;: 14,
                    &quot;name&quot;: &quot;1111111111111111111&quot;,
                    &quot;category_id&quot;: 1,
                    &quot;describe&quot;: &quot;123123&quot;,
                    &quot;create_time&quot;: &quot;2017-08-04 15:37:20&quot;
                }
            ]
        }
    }
}";s:9:"developer";i:0;s:10:"api_status";i:0;s:7:"is_page";i:1;s:4:"sort";i:0;s:6:"status";i:1;s:11:"create_time";i:1504785072;s:11:"update_time";i:1504948716;}s:9:" * origin";a:21:{s:2:"id";i:189;s:4:"name";s:12:"首页接口";s:8:"group_id";i:45;s:12:"request_type";i:0;s:7:"api_url";s:17:"combination/index";s:8:"describe";s:18:"首页聚合接口";s:13:"describe_text";s:0:"";s:15:"is_request_data";i:1;s:12:"request_data";s:109:"[{"field_name":"category_id","data_type":"0","is_require":"0","field_describe":"\u6587\u7ae0\u5206\u7c7bID"}]";s:13:"response_data";s:202:"[{"field_name":"article_category_list","data_type":"2","field_describe":"\u6587\u7ae0\u5206\u7c7b\u6570\u636e"},{"field_name":"article_list","data_type":"2","field_describe":"\u6587\u7ae0\u6570\u636e"}]";s:16:"is_response_data";i:1;s:13:"is_user_token";i:0;s:12:"is_data_sign";i:1;s:17:"response_examples";s:1377:"{
    &quot;code&quot;: 0,
    &quot;msg&quot;: &quot;操作成功&quot;,
    &quot;data&quot;: {
        &quot;article_category_list&quot;: [
            {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;测试文章分类2&quot;
            },
            {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;测试文章分类1&quot;
            }
        ],
        &quot;article_list&quot;: {
            &quot;total&quot;: 8,
            &quot;per_page&quot;: &quot;2&quot;,
            &quot;current_page&quot;: &quot;1&quot;,
            &quot;last_page&quot;: 4,
            &quot;data&quot;: [
                {
                    &quot;id&quot;: 15,
                    &quot;name&quot;: &quot;tttttt&quot;,
                    &quot;category_id&quot;: 1,
                    &quot;describe&quot;: &quot;sddd&quot;,
                    &quot;create_time&quot;: &quot;2017-08-07 13:24:46&quot;
                },
                {
                    &quot;id&quot;: 14,
                    &quot;name&quot;: &quot;1111111111111111111&quot;,
                    &quot;category_id&quot;: 1,
                    &quot;describe&quot;: &quot;123123&quot;,
                    &quot;create_time&quot;: &quot;2017-08-04 15:37:20&quot;
                }
            ]
        }
    }
}";s:9:"developer";i:0;s:10:"api_status";i:0;s:7:"is_page";i:1;s:4:"sort";i:0;s:6:"status";i:1;s:11:"create_time";i:1504785072;s:11:"update_time";i:1504948716;}s:11:" * relation";a:0:{}s:7:" * auto";a:0:{}s:9:" * insert";a:0:{}s:9:" * update";a:0:{}s:21:" * autoWriteTimestamp";b:1;s:13:" * createTime";s:11:"create_time";s:13:" * updateTime";s:11:"update_time";s:13:" * dateFormat";s:11:"Y-m-d H:i:s";s:7:" * type";a:0:{}s:11:" * isUpdate";b:1;s:14:" * updateWhere";N;s:16:" * failException";b:0;s:17:" * useGlobalScope";b:1;s:16:" * batchValidate";b:0;s:16:" * resultSetType";s:5:"array";s:16:" * relationWrite";N;}i:3;O:20:"app\common\model\Api":32:{s:13:" * connection";a:0:{}s:9:" * parent";N;s:8:" * query";N;s:7:" * name";s:3:"Api";s:8:" * table";N;s:8:" * class";s:20:"app\common\model\Api";s:8:" * error";N;s:11:" * validate";N;s:5:" * pk";N;s:8:" * field";a:0:{}s:11:" * readonly";a:0:{}s:10:" * visible";a:0:{}s:9:" * hidden";a:0:{}s:9:" * append";a:0:{}s:7:" * data";a:21:{s:2:"id";i:188;s:4:"name";s:12:"文章列表";s:8:"group_id";i:44;s:12:"request_type";i:0;s:7:"api_url";s:19:"article/articlelist";s:8:"describe";s:18:"文章列表接口";s:13:"describe_text";s:0:"";s:15:"is_request_data";i:1;s:12:"request_data";s:161:"[{"field_name":"category_id","data_type":"0","is_require":"0","field_describe":"\u82e5\u4e0d\u4f20\u9012\u6b64\u53c2\u6570\u5219\u4e3a\u6240\u6709\u5206\u7c7b"}]";s:13:"response_data";s:0:"";s:16:"is_response_data";i:0;s:13:"is_user_token";i:0;s:12:"is_data_sign";i:0;s:17:"response_examples";s:904:"{
    &quot;code&quot;: 0,
    &quot;msg&quot;: &quot;操作成功&quot;,
    &quot;data&quot;: {
        &quot;total&quot;: 9,
        &quot;per_page&quot;: &quot;10&quot;,
        &quot;current_page&quot;: 1,
        &quot;last_page&quot;: 1,
        &quot;data&quot;: [
            {
                &quot;id&quot;: 16,
                &quot;name&quot;: &quot;11111111&quot;,
                &quot;category_id&quot;: 2,
                &quot;describe&quot;: &quot;22222222&quot;,
                &quot;create_time&quot;: &quot;2017-08-07 13:58:37&quot;
            },
            {
                &quot;id&quot;: 15,
                &quot;name&quot;: &quot;tttttt&quot;,
                &quot;category_id&quot;: 1,
                &quot;describe&quot;: &quot;sddd&quot;,
                &quot;create_time&quot;: &quot;2017-08-07 13:24:46&quot;
            }
        ]
    }
}";s:9:"developer";i:0;s:10:"api_status";i:0;s:7:"is_page";i:1;s:4:"sort";i:0;s:6:"status";i:1;s:11:"create_time";i:1504779780;s:11:"update_time";i:1504780445;}s:9:" * origin";a:21:{s:2:"id";i:188;s:4:"name";s:12:"文章列表";s:8:"group_id";i:44;s:12:"request_type";i:0;s:7:"api_url";s:19:"article/articlelist";s:8:"describe";s:18:"文章列表接口";s:13:"describe_text";s:0:"";s:15:"is_request_data";i:1;s:12:"request_data";s:161:"[{"field_name":"category_id","data_type":"0","is_require":"0","field_describe":"\u82e5\u4e0d\u4f20\u9012\u6b64\u53c2\u6570\u5219\u4e3a\u6240\u6709\u5206\u7c7b"}]";s:13:"response_data";s:0:"";s:16:"is_response_data";i:0;s:13:"is_user_token";i:0;s:12:"is_data_sign";i:0;s:17:"response_examples";s:904:"{
    &quot;code&quot;: 0,
    &quot;msg&quot;: &quot;操作成功&quot;,
    &quot;data&quot;: {
        &quot;total&quot;: 9,
        &quot;per_page&quot;: &quot;10&quot;,
        &quot;current_page&quot;: 1,
        &quot;last_page&quot;: 1,
        &quot;data&quot;: [
            {
                &quot;id&quot;: 16,
                &quot;name&quot;: &quot;11111111&quot;,
                &quot;category_id&quot;: 2,
                &quot;describe&quot;: &quot;22222222&quot;,
                &quot;create_time&quot;: &quot;2017-08-07 13:58:37&quot;
            },
            {
                &quot;id&quot;: 15,
                &quot;name&quot;: &quot;tttttt&quot;,
                &quot;category_id&quot;: 1,
                &quot;describe&quot;: &quot;sddd&quot;,
                &quot;create_time&quot;: &quot;2017-08-07 13:24:46&quot;
            }
        ]
    }
}";s:9:"developer";i:0;s:10:"api_status";i:0;s:7:"is_page";i:1;s:4:"sort";i:0;s:6:"status";i:1;s:11:"create_time";i:1504779780;s:11:"update_time";i:1504780445;}s:11:" * relation";a:0:{}s:7:" * auto";a:0:{}s:9:" * insert";a:0:{}s:9:" * update";a:0:{}s:21:" * autoWriteTimestamp";b:1;s:13:" * createTime";s:11:"create_time";s:13:" * updateTime";s:11:"update_time";s:13:" * dateFormat";s:11:"Y-m-d H:i:s";s:7:" * type";a:0:{}s:11:" * isUpdate";b:1;s:14:" * updateWhere";N;s:16:" * failException";b:0;s:17:" * useGlobalScope";b:1;s:16:" * batchValidate";b:0;s:16:" * resultSetType";s:5:"array";s:16:" * relationWrite";N;}i:4;O:20:"app\common\model\Api":32:{s:13:" * connection";a:0:{}s:9:" * parent";N;s:8:" * query";N;s:7:" * name";s:3:"Api";s:8:" * table";N;s:8:" * class";s:20:"app\common\model\Api";s:8:" * error";N;s:11:" * validate";N;s:5:" * pk";N;s:8:" * field";a:0:{}s:11:" * readonly";a:0:{}s:10:" * visible";a:0:{}s:9:" * hidden";a:0:{}s:9:" * append";a:0:{}s:7:" * data";a:21:{s:2:"id";i:187;s:4:"name";s:18:"文章分类列表";s:8:"group_id";i:44;s:12:"request_type";i:0;s:7:"api_url";s:20:"article/categorylist";s:8:"describe";s:24:"文章分类列表接口";s:13:"describe_text";s:0:"";s:15:"is_request_data";i:0;s:12:"request_data";s:0:"";s:13:"response_data";s:177:"[{"field_name":"id","data_type":"0","field_describe":"\u6587\u7ae0\u5206\u7c7bID"},{"field_name":"name","data_type":"0","field_describe":"\u6587\u7ae0\u5206\u7c7b\u540d\u79f0"}]";s:16:"is_response_data";i:1;s:13:"is_user_token";i:0;s:12:"is_data_sign";i:0;s:17:"response_examples";s:345:"{
    &quot;code&quot;: 0,
    &quot;msg&quot;: &quot;操作成功&quot;,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 2,
            &quot;name&quot;: &quot;测试文章分类2&quot;
        },
        {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;测试文章分类1&quot;
        }
    ]
}";s:9:"developer";i:0;s:10:"api_status";i:0;s:7:"is_page";i:0;s:4:"sort";i:0;s:6:"status";i:1;s:11:"create_time";i:1504765581;s:11:"update_time";i:1504769645;}s:9:" * origin";a:21:{s:2:"id";i:187;s:4:"name";s:18:"文章分类列表";s:8:"group_id";i:44;s:12:"request_type";i:0;s:7:"api_url";s:20:"article/categorylist";s:8:"describe";s:24:"文章分类列表接口";s:13:"describe_text";s:0:"";s:15:"is_request_data";i:0;s:12:"request_data";s:0:"";s:13:"response_data";s:177:"[{"field_name":"id","data_type":"0","field_describe":"\u6587\u7ae0\u5206\u7c7bID"},{"field_name":"name","data_type":"0","field_describe":"\u6587\u7ae0\u5206\u7c7b\u540d\u79f0"}]";s:16:"is_response_data";i:1;s:13:"is_user_token";i:0;s:12:"is_data_sign";i:0;s:17:"response_examples";s:345:"{
    &quot;code&quot;: 0,
    &quot;msg&quot;: &quot;操作成功&quot;,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 2,
            &quot;name&quot;: &quot;测试文章分类2&quot;
        },
        {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;测试文章分类1&quot;
        }
    ]
}";s:9:"developer";i:0;s:10:"api_status";i:0;s:7:"is_page";i:0;s:4:"sort";i:0;s:6:"status";i:1;s:11:"create_time";i:1504765581;s:11:"update_time";i:1504769645;}s:11:" * relation";a:0:{}s:7:" * auto";a:0:{}s:9:" * insert";a:0:{}s:9:" * update";a:0:{}s:21:" * autoWriteTimestamp";b:1;s:13:" * createTime";s:11:"create_time";s:13:" * updateTime";s:11:"update_time";s:13:" * dateFormat";s:11:"Y-m-d H:i:s";s:7:" * type";a:0:{}s:11:" * isUpdate";b:1;s:14:" * updateWhere";N;s:16:" * failException";b:0;s:17:" * useGlobalScope";b:1;s:16:" * batchValidate";b:0;s:16:" * resultSetType";s:5:"array";s:16:" * relationWrite";N;}i:5;O:20:"app\common\model\Api":32:{s:13:" * connection";a:0:{}s:9:" * parent";N;s:8:" * query";N;s:7:" * name";s:3:"Api";s:8:" * table";N;s:8:" * class";s:20:"app\common\model\Api";s:8:" * error";N;s:11:" * validate";N;s:5:" * pk";N;s:8:" * field";a:0:{}s:11:" * readonly";a:0:{}s:10:" * visible";a:0:{}s:9:" * hidden";a:0:{}s:9:" * append";a:0:{}s:7:" * data";a:21:{s:2:"id";i:186;s:4:"name";s:15:"登录或注册";s:8:"group_id";i:34;s:12:"request_type";i:0;s:7:"api_url";s:12:"common/login";s:8:"describe";s:168:"系统登录注册接口，若用户名存在则验证密码正确性，若用户名不存在则注册新用户，返回 user_token 用于操作需验证身份的接口";s:13:"describe_text";s:0:"";s:15:"is_request_data";i:1;s:12:"request_data";s:189:"[{"field_name":"username","data_type":"0","is_require":"1","field_describe":"\u7528\u6237\u540d"},{"field_name":"password","data_type":"0","is_require":"1","field_describe":"\u5bc6\u7801"}]";s:13:"response_data";s:99:"[{"field_name":"data","data_type":"2","field_describe":"\u4f1a\u5458\u6570\u636e\u53causer_token"}]";s:16:"is_response_data";i:1;s:13:"is_user_token";i:0;s:12:"is_data_sign";i:1;s:17:"response_examples";s:701:"{
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
}";s:9:"developer";i:0;s:10:"api_status";i:1;s:7:"is_page";i:0;s:4:"sort";i:0;s:6:"status";i:1;s:11:"create_time";i:1504501410;s:11:"update_time";i:1504949075;}s:11:" * relation";a:0:{}s:7:" * auto";a:0:{}s:9:" * insert";a:0:{}s:9:" * update";a:0:{}s:21:" * autoWriteTimestamp";b:1;s:13:" * createTime";s:11:"create_time";s:13:" * updateTime";s:11:"update_time";s:13:" * dateFormat";s:11:"Y-m-d H:i:s";s:7:" * type";a:0:{}s:11:" * isUpdate";b:1;s:14:" * updateWhere";N;s:16:" * failException";b:0;s:17:" * useGlobalScope";b:1;s:16:" * batchValidate";b:0;s:16:" * resultSetType";s:5:"array";s:16:" * relationWrite";N;}}}s:14:" * currentPage";i:1;s:11:" * lastPage";i:1;s:8:" * total";i:6;s:11:" * listRows";s:2:"10";s:10:" * hasMore";b:0;s:10:" * options";a:6:{s:8:"var_page";s:4:"page";s:4:"path";s:23:"/admin/api/apilist.html";s:5:"query";a:0:{}s:8:"fragment";s:0:"";s:4:"type";s:9:"bootstrap";s:9:"list_rows";i:15;}}";
?>