<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/JWT.php';
require APPPATH . '/libraries/ExpiredException.php';
require APPPATH . '/libraries/BeforeValidException.php';
require APPPATH . '/libraries/SignatureInvalidException.php';
require APPPATH . '/libraries/JWK.php';

use chriskacerguis\RestServer\RestController;
use \Firebase\JWT\JWT;
use \Firebase\JWT\ExpiredException;


class GetToken extends RestController {
    function configToken(){
        $cnf['exp'] = 10; //detik
        $cnf['secretkey'] = '2212336221';
        return $cnf;		
    }
    public function get_post(){
        $exp = time() + 3600;
                $token = array(
                    "iss" => 'apprestservice',
                    "aud" => 'pengguna',
                    "iat" => time(),
                    "nbf" => time() + 10,
                    "exp" => $exp,
                    "data" => array(
                        "username" => $this->input->post('username'),
                        "password" => $this->input->post('password')
                    )
                );       
            
            $jwt = JWT::encode($token, $this->configToken()['secretkey']);
            $output = [
                    'status' => 200,
                    'message' => 'Berhasil login',
                    "token" => $jwt,                
                    "expireAt" => $token['exp']
                ];		
            $data = array('kode'=>'200', 'pesan'=>'token', 'data'=>array('token'=>$jwt, 'exp'=>$exp));
            $this->response($data, 200 );
    }
}
