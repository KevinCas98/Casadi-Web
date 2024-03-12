<?php 
 require "config.php";
class Commons {

    /**
     * uploadFile function
     *
     * @param string $fileTmpPath
     * @param string $fileName   
     * @param integer $id
     * @param string $namefolder
     * @return boolean 
     */
    public function uploadFile(string $fileTmpPath, string $fileName, int $id, string $namefolder){
        
        $path = '../web/upload/'.$namefolder.'/'.$id.'/';
        
        if(!file_exists($path)){
            mkdir($path, 0777);   
        }
        /** upload file for table */
        $target_file = $path.$fileName;

        if(move_uploaded_file($fileTmpPath, $target_file)){
            return true;
        }
        return false;
    }

    public function badREquest(int $code){

        switch ($code) {
            case 100: $text = 'Continue'; break;
            case 101: $text = 'Switching Protocols'; break;
            case 200: $text = 'OK'; break;
            case 201: $text = 'Created'; break;
            case 202: $text = 'Accepted'; break;
            case 203: $text = 'Non-Authoritative Information'; break;
            case 204: $text = 'No Content'; break;
            case 205: $text = 'Reset Content'; break;
            case 206: $text = 'Partial Content'; break;
            case 300: $text = 'Multiple Choices'; break;
            case 301: $text = 'Moved Permanently'; break;
            case 302: $text = 'Moved Temporarily'; break;
            case 303: $text = 'See Other'; break;
            case 304: $text = 'Not Modified'; break;
            case 305: $text = 'Use Proxy'; break;
            case 400: $text = 'Bad Request'; break;
            case 401: $text = 'Unauthorized'; break;
            case 402: $text = 'Payment Required'; break;
            case 403: $text = 'Forbidden'; break;
            case 404: $text = 'Not Found'; break;
            case 405: $text = 'Method Not Allowed'; break;
            case 406: $text = 'Not Acceptable'; break;
            case 407: $text = 'Proxy Authentication Required'; break;
            case 408: $text = 'Request Time-out'; break;
            case 409: $text = 'Conflict'; break;
            case 410: $text = 'Gone'; break;
            case 411: $text = 'Length Required'; break;
            case 412: $text = 'Precondition Failed'; break;
            case 413: $text = 'Request Entity Too Large'; break;
            case 414: $text = 'Request-URI Too Large'; break;
            case 415: $text = 'Unsupported Media Type'; break;
            case 500: $text = 'Internal Server Error'; break;
            case 501: $text = 'Not Implemented'; break;
            case 502: $text = 'Bad Gateway'; break;
            case 503: $text = 'Service Unavailable'; break;
            case 504: $text = 'Gateway Time-out'; break;
            case 505: $text = 'HTTP Version not supported'; break;
            default:$text ='Unknown http status code "' . htmlentities($code) . '"';break;
        }

        http_response_code($code);
        $dataError =   ['success' => false,
                        'msj'=>$text];

        return json_encode($dataError);
    }

    public function pushNotification($device_token, $title, $message) {

        $url = "https://fcm.googleapis.com/fcm/send";
        $token = $device_token;
        $serverKey = 'AAAASW2_KOc:APA91bFNLdhr-5gzEbSTskdrjBqgauVrvcAs2C6Xcv0CwtvaYudiZWFG-JV020pZJJJdgeS_aeZlh7n0SQH3MZChiTZRotmUyAms2xEAknoxlN76NB8FdR5KQSf8y5bOJ5665hLLXpPE';
        $body = $message;
        $notification = array('title' =>$title , 'body' => $body, 'sound' => 'default', 'badge' => '1');
        $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
        $json = json_encode($arrayToSend);
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key='. $serverKey;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
        //Send the request
        $response = curl_exec($ch);
        //Close request
        if ($response === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);

        return $response;
    }
}  
?>