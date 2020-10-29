<?php

namespace App\Controllers;

use App\Models\AuthModel;
use App\Models\WallskreepLikesModel;
use App\Models\WallskreepModel;
use App\Models\WallskreepTagsModel;
use App\Models\WallskreepTagsRelationshipModel;
use CodeIgniter\RESTful\ResourceController;

class Wallskreep extends ResourceController
{

    protected $wallskreepModel;
    protected $wallskreepTagsModel;
    protected $wallskreepTagsRelationshipModel;
    protected $wallskreepLikesModel;
    protected $authModel;

    protected $view;

    protected $db;

    public function __construct()
    {
        $this->wallskreepModel = new WallskreepModel();

        $this->wallskreepTagsModel = new WallskreepTagsModel();

        $this->wallskreepTagsRelationshipModel = new WallskreepTagsRelationshipModel();

        $this->wallskreepLikesModel = new WallskreepLikesModel();

        $this->authModel = new AuthModel();

        $this->view = \Config\Services::renderer();

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

    public function add()
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

        $token = str_replace('Authorization: ', '', $this->request->getHeader('Authorization'));

        $checkTokenAuth = $this->authModel->checkToken($token);

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
        $content        = $json->content;
        $status         = $json->status;

        preg_match_all("/#(\\w+)/", $content, $matches);

        $tagging = json_encode($matches[0], true);

        $this->db->transStart();

        $this->wallskreepModel->insert([
            'userID'         => $checkTokenAuth['ID'],
            'wall_content'   => $content,
            'wall_status'    => $status,
            'tagging'        => $tagging
        ]);

        if (count($matches[0]) > 0) {
            for ($i = 0; $i < count($matches[0]); $i++) {

                $this->wallskreepTagsModel->ignore(true)->insert([
                    'tag' => $matches[0][$i]
                ]);

                if ($this->wallskreepTagsModel->getInsertID() == 0) {

                    $getTag = $this->wallskreepTagsModel->where('tag', $matches[0][$i])->first();

                    $this->wallskreepTagsRelationshipModel->insert([
                        'tagID'         => $getTag['ID'],
                        'wallskreepID'  => $this->wallskreepModel->getInsertID()
                    ]);
                } else {
                    $this->wallskreepTagsRelationshipModel->insert([
                        'tagID'         => $this->wallskreepTagsModel->getInsertID(),
                        'wallskreepID'  => $this->wallskreepModel->getInsertID()
                    ]);
                }
            }
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
                    'message' => 'Wallskreep added'
                ],
            ];
        }

        return $this->respond($response, $code);
    }

    public function edit($id = null)
    {
        if ($this->request->getMethod() != 'put' || !is_numeric($id)) {
            $response = [
                'status' => 500,
                'error' => true,
                'data' => [
                    'message' => 'Not found action. Code: 00 '
                ],
            ];

            return $this->respond($response, 500);
        }

        $token = str_replace('Authorization: ', '', $this->request->getHeader('Authorization'));

        $checkTokenAuth = $this->authModel->checkToken($token);

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

        $detailWall = $this->wallskreepModel->detailWallskreep($id, $checkTokenAuth['ID']);

        if (is_null($detailWall)) {
            $response = [
                'status' => 500,
                'error' => true,
                'data' => [
                    'message' => 'Wallskreep not found. Code: 404'
                ],
            ];

            return $this->respond($response, 500);
        }

        $json = $this->request->getJSON();

        // POST KEY
        $content        = $json->content;
        $status         = $json->status;

        preg_match_all("/#(\\w+)/", $content, $matches);

        $tagging = json_encode($matches[0], true);

        $this->db->transStart();

        $this->wallskreepModel->update($id, [
            'wall_content'   => $content,
            'wall_status'    => $status,
            'tagging'        => $tagging
        ]);

        if (count($matches[0]) > 0) {

            for ($i = 0; $i < count($matches[0]); $i++) {

                $this->wallskreepTagsModel->ignore(true)->insert([
                    'tag'   => $matches[0][$i]
                ]);

                if ($this->wallskreepTagsModel->getInsertID() != 0) {
                    $this->wallskreepTagsRelationshipModel->insert([
                        'tagID'         => $this->wallskreepTagsModel->getInsertID(),
                        'wallskreepID'  => $id
                    ]);
                }
            }
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
                    'message' => 'Wallskreep edited'
                ],
            ];
        }

        return $this->respond($response, $code);
    }

    public function delete($id = null)
    {
        if ($this->request->getMethod() != 'delete' || !is_numeric($id)) {
            $response = [
                'status' => 500,
                'error' => true,
                'data' => [
                    'message' => 'Not found action. Code: 00 '
                ],
            ];

            return $this->respond($response, 500);
        }

        $token = str_replace('Authorization: ', '', $this->request->getHeader('Authorization'));

        $checkTokenAuth = $this->authModel->checkToken($token);

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

        $detailWall = $this->wallskreepModel->detailWallskreep($id, $checkTokenAuth['ID']);

        if (is_null($detailWall)) {
            $response = [
                'status' => 500,
                'error' => true,
                'data' => [
                    'message' => 'Wallskreep not found. Code: 404'
                ],
            ];

            return $this->respond($response, 500);
        }

        $this->db->transStart();

        $this->wallskreepModel->update($id, [
            'deleted_at' => date("Y-m-d H:i:s")
        ]);

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
                    'message' => 'Wallskreep deleted'
                ],
            ];
        }

        return $this->respond($response, $code);
    }

    public function like()
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

        $token = str_replace('Authorization: ', '', $this->request->getHeader('Authorization'));

        $checkTokenAuth = $this->authModel->checkToken($token);

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
        $id      = $json->id;

        $detailWall = $this->wallskreepModel->where(['id' => $id, 'deleted_at' => NULL])->first();

        if (is_null($detailWall)) {
            $response = [
                'status' => 500,
                'error' => true,
                'data' => [
                    'message' => 'Wallskreep not found. Code: 404'
                ],
            ];

            return $this->respond($response, 500);
        }

        $checkLike = $this->wallskreepLikesModel->where(['wallskreepID' => $id, 'userID' => $checkTokenAuth['ID']])->first();

        $this->db->transStart();

        if (!is_null($checkLike)) {

            if ($checkLike['status'] == 1) {
                $this->wallskreepLikesModel->update($checkLike['ID'], [
                    'status'    => 0
                ]);
            } else {
                $response = [
                    'status' => 500,
                    'error' => true,
                    'data' => [
                        'message' => 'Wallskreep like exist. Code: 404'
                    ],
                ];

                return $this->respond($response, 500);
            }
        } else {
            $this->wallskreepLikesModel->insert([
                'userID'    => $checkTokenAuth['ID'],
                'wallskreepID'  => $id
            ]);
        }

        $this->wallskreepModel->update($id, [
            'like_count'    => $detailWall['like_count'] + 1
        ]);

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
                    'message' => 'Wallskreep liked'
                ],
            ];
        }

        return $this->respond($response, $code);
    }

    public function unlike()
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

        $token = str_replace('Authorization: ', '', $this->request->getHeader('Authorization'));

        $checkTokenAuth = $this->authModel->checkToken($token);

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
        $id      = $json->id;

        $detailWall = $this->wallskreepModel->where(['id' => $id, 'deleted_at' => NULL])->first();

        if (is_null($detailWall)) {
            $response = [
                'status' => 500,
                'error' => true,
                'data' => [
                    'message' => 'Wallskreep not found. Code: 404'
                ],
            ];

            return $this->respond($response, 500);
        }

        $checkLike = $this->wallskreepLikesModel->where(['wallskreepID' => $id, 'userID' => $checkTokenAuth['ID']])->first();

        if (is_null($checkLike)) {
            $response = [
                'status' => 500,
                'error' => true,
                'data' => [
                    'message' => 'Wallskreep like not exist. Code: 404'
                ],
            ];

            return $this->respond($response, 500);
        }

        if ($checkLike['status'] == 1) {
            $response = [
                'status' => 500,
                'error' => true,
                'data' => [
                    'message' => 'Wallskreep unlike not exist. Code: 404'
                ],
            ];

            return $this->respond($response, 500);
        }

        $this->db->transStart();

        $this->wallskreepLikesModel->update($checkLike['ID'], [
            'status'    => 1
        ]);

        $this->wallskreepModel->update($id, [
            'like_count'    => $detailWall['like_count'] - 1
        ]);

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
                    'message' => 'Wallskreep unliked'
                ],
            ];
        }

        return $this->respond($response, $code);
    }

    public function view($limit = 10, $offset = 0)
    {

        $token = str_replace('Authorization: ', '', $this->request->getHeader('Authorization'));

        $checkTokenAuth = $this->authModel->checkToken($token);

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

        $wallskreepCount = $this->wallskreepModel->viewWallskreepCount($limit, $offset);

        if ($wallskreepCount > 0) {
            foreach ($this->wallskreepModel->viewWallskreep($limit, $offset)->getResult() as $data) {

                $diffLike = $this->wallskreepLikesModel->where(['userID' => $checkTokenAuth['ID'], 'wallskreepID' => $data->ID])->first();

                $resArray[] = array(
                    'ID'                  => floatval($data->ID),
                    'content'             => $this->view->renderString($data->wall_content),
                    'status'              => $data->wall_status,
                    'parentID'            => floatval($data->wall_parentID),
                    'tagging'             => json_decode($data->tagging),
                    'info'                => array(
                        'comment'         => array(
                            'count'       => floatval($data->comment_count)
                        ),
                        'like'            => array(
                            'count'       => floatval($data->like_count),
                            'diff'        => (is_null($diffLike) ? 0 : (($diffLike['status'] == 0) ? 1 : 0))
                        )
                    ),
                    'author'              => array(
                        'name'            => $data->display_name,
                        'photo'           => $data->user_photo,
                        'diff'            => ($data->userID == $checkTokenAuth['ID']) ? 1 : 0
                    )
                );
            }
        } else {
            $resArray = array();
        }

        $page       = ($offset == 0) ? 1 : ($offset / $limit) + 1;
        $nextpage   = ($offset == 0) ? $limit : ($offset + $limit);

        $response = [
            'status' => 200,
            'error' => false,
            'data' => [
                'payload'   => $resArray,
                'page'      => $page,
                'offset'    => ($wallskreepCount < $limit) ? null : floatval($nextpage)
            ],
        ];

        return $this->respond($response, 200);
    }
}
