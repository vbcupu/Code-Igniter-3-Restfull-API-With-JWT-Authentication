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


class Api extends RestController {
	function configToken(){
		$cnf['exp'] = 3600; //milisecond
		$cnf['secretkey'] = '2212336221';
		return $cnf;		
	}

    function __construct()
    {
        // Construct the parent class
        parent::__construct();        
    }

	public function getToken_get(){				
            $token = array(
                "iss" => 'pengguna1',
                "aud" => 'pengguna',
                "iat" => time(),
                "nbf" => time() + 10,
                "exp" => time() + 3600,
                "data" => array(
                    "id" =>'testtoken',
                    "firstname" => 'nama',
                    "lastname" => 'lastname',
                    "email" => 'emailnya'
                )
            );       
		
		$jwt = JWT::encode($token, $this->configToken()['secretkey']);
		$output = [
                'status' => 200,
                'message' => 'Berhasil login',
                "token" => $jwt,                
                "expireAt" => $token['exp']
            ];		
		$data = array('kode'=>'200', 'pesan'=>'token', 'data'=>$jwt);
		$this->response($data, 200 );		
	}
    public function siswa_get(){    	     
    	if ($this->authtoken() == 'salah'){
    		return $this->response(array('kode'=>'401', 'pesan'=>'signature tidak sesuai', 'data'=>[]), '401');
    		die();
    	}
        $this->db->select('*');        
        $data = array ('data'=>$this->db->get('siswa')->result());        
        $this->response($data, 200 );
    }
    public function siswa_post(){
        $isidata = array('nis'=>$this->input->post('nis'), 'namasiswa'=>$this->input->post('nama'));
        $this->db->insert('siswa', $isidata);
        $this->response(array("pesan"=>"berhasil"), 200);
    }    
    public function siswa_put(){                
        $isidata = array('namasiswa'=>$this->put('namasiswa'));
        $this->db->where(array('nis'=>$this->put('nis')));
        $this->db->Update('siswa', $isidata);        
        $this->response(array("pesan"=>"Ubah Data Berhasil"), 200);        
    }
    public function siswa_delete(){                        
        $this->db->where('nis', $this->delete('nis'));
        $this->db->delete('siswa');
        $this->response(array("pesan"=>"data berhasil dihapus"), 200);        
    }
    public function authtoken(){
        $secret_key = $this->configToken()['secretkey']; 
        $token = null; 
        $authHeader = $this->input->request_headers()['Authorization'];  
        $arr = explode(" ", $authHeader); 
        $token = $arr[1];        
        if ($token){
			try{
				$decoded = JWT::decode($token, $this->configToken()['secretkey'], array('HS256'));			
				if ($decoded){
					return 'benar';
				}
			} catch (\Exception $e) {
				$result = array('pesan'=>'Kode Signature Tidak Sesuai');
				return 'salah';
				
			}
		}  		
	}
}