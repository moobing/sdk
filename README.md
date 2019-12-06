SDK
===================

sdk拓展包 包含支付宝支付alipay、OpenSSL加密解密等

## 安装

```
composer require mbing/sdk
```


## 加密解密类 - DEMO

```php
use mbing\sdk\Openssl\Cryptor;

$encodeData = 'Here is the data to be encrypted.';
$key = 'eiort832j39fe8we';
//encrypto
$encrypted = Cryptor::Encrypt($encodeData, $key);
//decrypto
$decrypted = Cryptor::Decrypt($encrypted, $key);

```


## 支付宝APP支付类 - DEMO

```php
use mbing\sdk\alipay\Alipay;

$config = array(
        'app_id' => 'xxx',//商户号
        'notify_url' => 'http://api.xxx.com/api/Payment/aliPayNotify',//回调通知
        'return_url' => 'http://api.xxx.com/api/Payment/aliRefundedNotify',//
        'ali_public_key' => 'xxx',//官方提供的一句话支付宝公钥(即去头去尾去换行的一行字符串，下同)
        'private_key' => 'xxx',//官方提供的一句话私钥
);
Alipay::$config = $config;
$aliData['body'] = '测试支付';
$aliData['subject'] = '测试支付';
$aliData['out_trade_no'] = '20170125test01';
$aliData['timeout_express'] = '30m';
$aliData['total_amount'] = '0.01';
$aliData['product_code'] = 'QUICK_MSECURITY_PAY';
$result['order_info'] = Alipay::app($aliData);
```