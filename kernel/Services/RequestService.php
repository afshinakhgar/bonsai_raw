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



    /**
     * curl get content
     * method GET
     * @param string $url
     * @return mixed
     */
    public static function get_apiCall(string $url)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
        ));

        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT ,0);
        curl_setopt($curl, CURLOPT_TIMEOUT, 400); //timeout in seconds

        $resp = curl_exec($curl);

        $curl_errno = curl_errno($curl);
        $curl_error = curl_error($curl);
        curl_close($curl);

        if ($curl_errno > 0) {
            echo "cURL Error ($curl_errno): $curl_error\n";
        } else {
            return $resp;
        }
    }


    /**
     * @param string $path
     * @return mixed
     */
    public function xml_curl_call(string $path){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$path);
        curl_setopt($ch, CURLOPT_FAILONERROR,1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 4);
        $retValue = curl_exec($ch);
        curl_close($ch);
        return $retValue;
    }


    function post_apiCall($url, $data=NULL, $headers = NULL, $basicAuth = NULL) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if(!empty($data)){
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }

        if (!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        if (!empty($basicAuth)) {
            curl_setopt($ch, CURLOPT_USERPWD, $basicAuth['username'] . ":" . $basicAuth['password']);
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        }

        $response = curl_exec($ch);

        if (curl_error($ch)) {
            trigger_error('Curl Error:' . curl_error($ch));
        }

        curl_close($ch);
        return $response;
    }

}