<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 3/3/18
 * Time: 4:09 PM
 */

namespace Kernel\Services;


use Kernel\Abstracts\AbstractContainer;
/**
 * @property \Swift_Mailer $mailer
 */
class SmsService extends AbstractContainer
{

    protected $api ;
    protected $apiKey ;
    protected $sender ;
    public function __construct($container)
    {
        $this->apiKey = $GLOBALS['settings']['sms']['api_key'];
        $this->sender = $GLOBALS['settings']['sms']['sender'];
        $this->api = new \Kavenegar\KavenegarApi($this->apiKey);

    }



    public function send(string $message ,array $receptor)
    {

        try{
            $result = $this->api->Send($this->sender,$receptor,$message);
//            if($result){
//                foreach($result as $r){
//                    echo "messageid = $r->messageid";
//                    echo "message = $r->message";
//                    echo "status = $r->status";
//                    echo "statustext = $r->statustext";
//                    echo "sender = $r->sender";
//                    echo "receptor = $r->receptor";
//                    echo "date = $r->date";
//                    echo "cost = $r->cost";
//                }
//            }


            return $result;
        }
        catch(\Kavenegar\Exceptions\ApiException $e){
            // در صورتی که خروجی وب سرویس 200 نباشد این خطا رخ می دهد
            echo $e->errorMessage();
        }
        catch(\Kavenegar\Exceptions\HttpException $e){
            // در زمانی که مشکلی در برقرای ارتباط با وب سرویس وجود داشته باشد این خطا رخ می دهد
            echo $e->errorMessage();
        }
    }
}