<?php

/**
 * author hzbskak
 * email  hzbskak@gmail.com
 * date   2021/7/16
 */

use Hyperf\HttpServer\Annotation\PostMapping;

class Demo
{
    /**
     * @PostMapping(path="/index/index")
     */
    public function index()
    {
        // Request
        var_dump(request()->path());
        // redis
        var_dump(redis()->keys('*'));
        // ip
        var_dump(get_client_ip());
        // 控制台打印
        p("我的p");
        // 控制台日志打印
        Logger()->error('ahahh');
        // 验证ip
        var_dump(verify_ip('127.0.0.1'));
        // 生成随机uid
        var_dump(uuid(32));
        // 验证uri
        var_dump(is_validURL('https://github.com/hyperf-plus/admin/blob/v2/composer.json'));
    }
}