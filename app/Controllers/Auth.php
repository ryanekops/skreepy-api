<?php

namespace App\Controllers;

use App\Models\AuthModel;
use App\Models\SessionModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\RESTful\ResourceController;

class Auth extends ResourceController
{

    protected $authModel;
    protected $sessionModel;

    protected $db;

    public function __construct()
    {
        $this->authModel = new AuthModel();

        $this->sessionModel = new SessionModel();

        $this->db = \Config\Database::connect();

        $this->db = db_connect();
    }

    public function index()
    {
        $response = [
            'status' => 500,
            'error' => true,
            'data' => [
                'message' => 'Link Expired. Code: 05'
            ],
        ];

        return $this->respond($response, 500);
    }

    public function options(): Response
    {
        return $this->response->setHeader('Access-Control-Allow-Origin', '*')
            ->setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE')
            ->setHeader('Content-Type', 'application/json')
            ->setHeader('Access-Control-Allow-Headers', 'Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
    }

    public function login()
    {
        if ($this->request->getMethod() != 'post') {
            $response = [
                'status' => 500,
                'error' => true,
                'data' => [
                    'message' => 'Not found action. Code: 00 '
                ],
            ];

            return $this->respond($response, 500);
        }

        $json = $this->request->getJSON();

        // POST KEY
        $uid        = $json->uid;
        $email      = $json->email;
        $token      = $json->token;
        $fcm        = $json->fcm;
        $photo      = $json->photo;
        $name       = $json->name;
        $verified   = $json->verified;
        $devos      = $json->device_os;
        $devname    = $json->device_name;
        $devuuid    = $json->device_uuid;

        $checkUser = $this->authModel->checkLogin($email);

        $this->db->transStart();

        if (count($checkUser) > 0) {

            $this->authModel->update($json->uid, [
                'user_email'                     => $email,
                'user_photo'                     => $photo,
                'user_name'                      => $name,
                'user_token'                     => $token,
                'email_verified'                 => ($verified) ? true : false,
                'user_fcm'                       => $fcm
            ]);
        } else {

            $this->authModel->insert([
                'uniqueID'                       => $uid,
                'user_email'                     => $email,
                'user_photo'                     => $photo,
                'user_name'                      => $name,
                'user_token'                     => $token,
                'user_fcm'                       => $fcm,
                'email_verified'                 => ($verified) ? true : false,
                'display_name'                   => $name,
                'user_registered'                => date("Y-m-d H:i:s")
            ]);
        }

        $checkSessionUser = $this->sessionModel->checkSessionUser($uid);

        if (count($checkSessionUser) > 0) {
            $this->sessionModel->where('user_uniqueID', $uid)->set([
                'session_active'    => 0
            ])->update();
        }

        $agent = $this->request->getUserAgent();

        $this->sessionModel->insert([
            'user_uniqueID'                  => $uid,
            'session_agent'                  => $agent->getAgentString(),
            'device_os'                      => $devos,
            'device_name'                    => $devname,
            'device_uuid'                    => $devuuid,
            'session_type'                   => 1,
            'signup_date'                    => date("Y-m-d H:i:s")
        ]);

        $getSessionNew = $this->sessionModel->find($this->sessionModel->getInsertID());

        if ($this->db->transStatus() === FALSE) {

            $this->db->transRollback();

            $code = 500;

            $response = [
                'status' => $code,
                'error' => true,
                'data' => [
                    'message' => 'Server error. Code: 01'
                ],
            ];
        } else {

            $this->db->transComplete();

            $code = 200;

            $response = [
                'status' => $code,
                'error' => false,
                'data' => [
                    'payload' => array(
                        'user'  => array(
                            'name'  => $name,
                            'email' => $email,
                            'photo' => $photo,
                        ),
                        'token'     => $token,
                        'sessionID' => $getSessionNew['uniqueID'],
                        'info'  => array(
                            'bookmark' => 0,
                            'reading'  => 0
                        )
                    ),
                    'message' => 'Login successfully'
                ],
            ];
        }

        return $this->respond($response, $code);
    }

    public function resume()
    {

        if ($this->request->getMethod() != 'post') {
            $response = [
                'status' => 500,
                'error' => true,
                'data' => [
                    'message' => 'Not found action. Code: 00 '
                ],
            ];

            return $this->respond($response, 500);
        }

        $checkTokenAuth = $this->authModel->checkToken(str_replace('Authorization: ', '', $this->request->getHeader('Authorization')));

        if (count($checkTokenAuth) == 0) {
            $response = [
                'status' => 500,
                'error' => true,
                'data' => [
                    'message' => 'Token expired. Code: 03'
                ],
            ];

            return $this->respond($response, 500);
        }

        $json = $this->request->getJSON();

        // POST KEY
        $sessionID = $json->sessionID;

        $checkSession = $this->sessionModel->checkSession($sessionID);

        if (count($checkSession) == 0) {
            $response = [
                'status' => 500,
                'error' => true,
                'data' => [
                    'message' => 'Session Expired. Code: 02'
                ],
            ];

            return $this->respond($response, 500);
        }

        $this->db->transStart();

        $this->sessionModel->update($checkSession['ID'], [
            'session_active'                 => 0
        ]);

        $agent = $this->request->getUserAgent();

        $this->sessionModel->insert([
            'user_uniqueID'                  => $checkTokenAuth['uniqueID'],
            'session_agent'                  => $agent->getAgentString(),
            'device_os'                      => $checkSession['device_os'],
            'device_name'                    => $checkSession['device_name'],
            'device_uuid'                    => $checkSession['device_uuid'],
            'session_type'                   => 1,
            'signup_date'                    => date("Y-m-d H:i:s")
        ]);

        $getSessionNew = $this->sessionModel->find($this->sessionModel->getInsertID());

        if ($this->db->transStatus() === FALSE) {

            $this->db->transRollback();

            $code = 500;

            $response = [
                'status' => $code,
                'error' => true,
                'data' => [
                    'message' => 'Server error. Code: 01'
                ],
            ];
        } else {

            $this->db->transComplete();

            $code = 200;

            $response = [
                'status' => $code,
                'error' => false,
                'data' => [
                    'payload' => array(
                        'sessionID' => $getSessionNew['uniqueID']
                    ),
                    'message' => 'Resume successfully'
                ],
            ];
        }

        return $this->respond($response, $code);
    }

    public function logout()
    {
        if ($this->request->getMethod() != 'post') {
            $response = [
                'status'    => 500,
                'error'     => true,
                'data'      => [
                    'message' => 'Not found action. Code: 00 '
                ],
            ];

            return $this->respond($response, 500);
        }

        $checkTokenAuth = $this->authModel->checkToken(str_replace('Authorization: ', '', $this->request->getHeader('Authorization')));

        if (count($checkTokenAuth) == 0) {
            $response = [
                'status' => 500,
                'error' => true,
                'data' => [
                    'message' => 'Token expired. Code: 03'
                ],
            ];

            return $this->respond($response, 500);
        }

        $json = $this->request->getJSON();

        // POST KEY
        $sessionID  = $json->sessionID;
        $logout     = $json->logout;

        $checkSession = $this->sessionModel->checkSession($sessionID);

        if (count($checkSession) == 0) {
            $response = [
                'status' => 500,
                'error' => true,
                'data' => [
                    'message' => 'Session Expired. Code: 02'
                ],
            ];

            return $this->respond($response, 500);
        }

        $this->db->transStart();

        $agent = $this->request->getUserAgent();

        $wasting = date_diff(date_create($checkSession['signup_date']), date_create(date("Y-m-d H:i:s")));

        $this->sessionModel->insert([
            'session_unique_ID'              => $sessionID,
            'user_uniqueID'                  => $checkTokenAuth['uniqueID'],
            'session_agent'                  => $agent->getAgentString(),
            'device_os'                      => $checkSession['device_os'],
            'device_name'                    => $checkSession['device_name'],
            'device_uuid'                    => $checkSession['device_uuid'],
            'session_type'                   => 0,
            'session_active'                 => 0,
            'signup_date'                    => $checkSession['signup_date'],
            'signout_date'                   => date("Y-m-d H:i:s"),
            'time_wasting'                   => $wasting->i
        ]);

        $this->sessionModel->update($checkSession['ID'], [
            'session_active'                 => 1
        ]);

        if ($logout == true) {
            $this->authModel->update($checkTokenAuth['uniqueID'], [
                'user_token'                     => null,
                'user_fcm'                       => null
            ]);
        }

        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();

            $code = 500;

            $response = [
                'status' => $code,
                'error' => true,
                'data' => [
                    'message' => 'Server error. Code: 01'
                ],
            ];
        } else {
            $this->db->transComplete();

            $code = 200;

            $response = [
                'status' => $code,
                'error' => false,
                'data' => [
                    'message' => 'Log successfully'
                ],
            ];
        }

        return $this->respond($response, $code);
    }
}
