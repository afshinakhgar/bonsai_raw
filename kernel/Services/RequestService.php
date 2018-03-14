<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 3/14/18
 * Time: 1:04 PM
 */

namespace Kernel\Services;


use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;


use Kernel\Abstracts\AbstractServices;

class RequestService extends AbstractServices
{

    private $allowedMethods = [
        'get',
        'post',
        'delete',
        'head',
        'options',
        'patch',
        'put'
    ];

    public function Request($url , $method = 'get' , $options = [])
    {

        if(!in_array($method,$this->allowedMethods)){
            return false;
        }

        $client = new Client();
        $response = $client->request($method, 'https://api.github.com/user', [
            $options
        ]);


        $code = $response->getStatusCode(); // 200
        $reason = $response->getReasonPhrase(); // OK
        $body = $response->getBody(getBody);

        foreach ($response->getHeaders() as $name => $values) {
            $headers[$name] = $values;
        }



        return [
            'code' => $code,
            'reason' => $reason,
            'body' => $body,
        ];

    }


    public function psr7Request($url , $method = 'get')
    {
        if(!in_array($method,$this->allowedMethods)){
            return false;
        }
        $request = new Request($method, $url);

        $code = $request->getStatusCode(); // 200
        $reason = $request->getReasonPhrase(); // OK
        $body = $request->getBody(getBody);

        foreach ($request->getHeaders() as $name => $values) {
            $headers[$name] = $values;
        }



        return [
            'code' => $code,
            'reason' => $reason,
            'body' => $body,
        ];


    }

}