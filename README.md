# 适用于Hypef2.1的公共函数类


## 安装

```
composer require 4927525/hyperf-common
```
### 使用示例

```php
<?php
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
```
### 控制台输出
```
string(11) "index/index"
array(2) {
  [0]=>
  string(13) "queue:waiting"
  [1]=>
  string(13) "queue:delayed"
}
string(10) "172.18.0.1"
[ 2021-07-16 08:39:01]:我的p
[ERROR] ahahh
string(9) "127.0.0.1"
string(64) "61b1588086cca4afff8614311ddf28e3eceebef500484ac0f826684d3ee0a4dd"
int(1)
```