<?php

/**
 * author hzbskak
 * email  hzbskak@gmail.com
 * date   2021/7/16
 */


declare(strict_types=1);

use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\HttpMessage\Server\Response;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\HttpServer\Request;
use Hyperf\Utils\ApplicationContext;
use Hyperf\Utils\Context;
use Psr\Http\Message\ServerRequestInterface;
use Hyperf\Redis\RedisFactory;


if (!function_exists('redis')) {
    /**
     * Redis
     *
     * @param string $name
     *
     * @return \Hyperf\Redis\RedisProxy|Redis
     */
    function redis($name = 'default')
    {
        return ApplicationContext::getContainer()->get(RedisFactory::class)
            ->get($name);
    }
}

if (!function_exists('Logger')) {
    /**
     * Redis
     *
     * @return StdoutLoggerInterface
     */
    function Logger()
    {
        return ApplicationContext::getContainer()
            ->get(StdoutLoggerInterface::class);
    }
}

if (!function_exists('get_client_ip')) {
    function get_client_ip()
    {
        /**
         * @var ServerRequestInterface $request
         */
        $request = Context::get(ServerRequestInterface::class);
        $ip_addr = $request->getHeaderLine('x-forwarded-for');
        if (verify_ip($ip_addr)) {
            return $ip_addr;
        }
        $ip_addr = $request->getHeaderLine('remote-host');
        if (verify_ip($ip_addr)) {
            return $ip_addr;
        }
        $ip_addr = $request->getHeaderLine('x-real-ip');
        if (verify_ip($ip_addr)) {
            return $ip_addr;
        }
        $ip_addr = $request->getServerParams()['remote_addr'] ?? '0.0.0.0';
        if (verify_ip($ip_addr)) {
            return $ip_addr;
        }

        return '0.0.0.0';
    }
}


if (!function_exists('get_container')) {
    function get_container($id)
    {
        return ApplicationContext::getContainer()->get($id);
    }
}

if (!function_exists('verify_ip')) {
    function verify_ip($realip)
    {
        return filter_var($realip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
    }
}
//?????????????????????
if (!function_exists('p')) {
    function p($val, $title = null, $starttime = '')
    {
        print_r('[ '.date("Y-m-d H:i:s").']:');
        if ($title != null) {
            print_r("[".$title."]:");
        }
        print_r($val);
        print_r("\r\n");
    }
}

if (!function_exists('uuid')) {
    function uuid($length)
    {
        if (function_exists('random_bytes')) {
            $uuid = bin2hex(\random_bytes($length));
        } else {
            if (function_exists('openssl_random_pseudo_bytes')) {
                $uuid = bin2hex(\openssl_random_pseudo_bytes($length));
            } else {
                $pool
                    = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $uuid = substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
            }
        }

        return $uuid;
    }
}
if (!function_exists('generate_tree')) {
    function generate_tree(
        array $array,
        $pid_key = 'pid',
        $id_key = 'id',
        $children_key = 'children',
        $callback = null
    ) {
        if (!$array) {
            return [];
        }
        //????????? ????????????
        $items = [];
        foreach ($array as $value) {
            if ($callback && is_callable($callback)) {
                $callback($value);
            }
            $items[$value[$id_key]] = $value;
        }
        //????????? ???????????? ??????????????????
        $tree = [];
        foreach ($items as $key => $value) {
            //??????pid??????????????????
            if (isset($items[$value[$pid_key]])) {
                $items[$value[$pid_key]][$children_key][] = &$items[$key];
            } else {
                $tree[] = &$items[$key];
            }
        }

        return $tree;
    }
}


if (!function_exists('is_validURL')) {

    function is_validURL($url)
    {
        $check = 0;
        if (filter_var($url, FILTER_VALIDATE_URL) !== false) {
            $check = 1;
        }

        return $check;
    }
}


if (!function_exists('request')) {
    /**
     * Get admin path.
     *
     * @param null $key
     * @param null $default
     *
     * @return string
     */
    function request($key = null, $default = null)
    {
        if ($key !== null) {
            return (new  Request())->all()[$key] ?? $default;
        }

        return new  Request();
    }
}


if (!function_exists('response')) {
    /**
     * Get admin path.
     *
     * @param string $path
     *
     * @return string
     */
    function response(): ResponseInterface
    {
        return new Response();//return $res->withBody(new SwooleStream(json_encode($re_data,256)));
    }
}
