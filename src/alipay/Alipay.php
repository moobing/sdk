<?php

namespace mbing\sdk\alipay;

use mbing\sdk\alipay\AopClient;
use mbing\sdk\alipay\AlipayTradeAppPayRequest;
/**
 * Alipay SDK
 */
class Alipay
{
    public static $config = []; //加载配置
    //app支付
    public static function app($data)
    {
        $aop = new AopClient;
        $aop->gatewayUrl = "https://openapi.alipay.com/gateway.do";
        $aop->appId = self::$config['app_id'];
        $aop->rsaPrivateKey = self::$config['private_key'];
        $aop->format = "json";
        $aop->charset = "UTF-8";
        $aop->signType = "RSA2";
        $aop->alipayrsaPublicKey = self::$config['ali_public_key'];
        //实例化具体API对应的request类,类名称和接口名称对应,当前调用接口名称：alipay.trade.app.pay
        $request = new AlipayTradeAppPayRequest();
        //SDK已经封装掉了公共参数，这里只需要传入业务参数
        $bizcontent = "{\"body\":\"{$data['body']}\"," 
                        . "\"subject\": \"{$data['subject']}\","
                        . "\"out_trade_no\": \"{$data['out_trade_no']}\","
                        . "\"timeout_express\": \"{$data['timeout_express']}\"," 
                        . "\"total_amount\": \"{$data['total_amount']}\","
                        . "\"product_code\":\"{$data['product_code']}\""
                        . "}";
        $request->setNotifyUrl(self::$config['notify_url']);
        $request->setBizContent($bizcontent);
        //这里和普通的接口调用不同，使用的是sdkExecute
        $response = $aop->sdkExecute($request);
        //htmlspecialchars是为了输出到页面时防止被浏览器将关键参数html转义，实际打印到日志以及http传输不会有这个问题
        // return htmlspecialchars($response);//就是orderString 可以直接给客户端请求，无需再做处理。
        return $response;
    }
}