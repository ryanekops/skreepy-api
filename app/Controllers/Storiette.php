<?php

namespace App\Controllers;

use App\Models\AuthModel;
use App\Models\BookmarkModel;
use App\Models\SessionModel;
use App\Models\StorietteModel;
use App\Models\ViewerModel;
use CodeIgniter\RESTful\ResourceController;

class Storiette extends ResourceController
{
    protected $storietteModel;
    protected $authModel;
    protected $bookmarkModel;
    protected $viewerModel;
    protected $sessionModel;
    protected $view;
    protected $db;

    public function __construct()
    {

        $this->storietteModel = new StorietteModel();

        $this->authModel = new AuthModel();

        $this->bookmarkModel = new BookmarkModel();

        $this->viewerModel = new ViewerModel();

        $this->sessionModel = new SessionModel();

        helper('date_helper');

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

        $storietteCount = $this->storietteModel->viewStorietteCount($limit, $offset);

        if ($storietteCount > 0) {

            foreach ($this->storietteModel->viewStoriette($limit, $offset)->getResult() as $data) {
                $resArray[] = array(
                    'slug'      => $data->story_slug,
                    'title'     => $data->story_title,
                    'content'   => $this->view->renderString($data->story_content),
                    'image'     => $data->story_image,
                    'info'      => array(
                        'author'     => $data->display_name,
                        'viewer'     => floatval($data->viewer),
                        'reader'     => floatval($data->reader),
                    ),
                    'created_at' => date_indo(explode(' ', $data->created_at)[0], false),
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
                'offset'    => ($storietteCount < $limit) ? null : floatval($nextpage)
            ],
        ];

        return $this->respond($response, 200);
    }

    public function detail($slug = null)
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

        $detailStoriette = $this->storietteModel->detailStoriette($slug);

        if (is_null($detailStoriette)) {
            $response = [
                'status' => 500,
                'error' => true,
                'data' => [
                    'message' => 'Story not found. Code: 404'
                ],
            ];

            return $this->respond($response, 500);
        }

        $checkBookmark = $this->bookmarkModel->checkUserBookmark($checkTokenAuth['ID'], $detailStoriette['ID']);

        $resArray = array(
            'slug'      => $detailStoriette['story_slug'],
            'title'     => $detailStoriette['story_title'],
            'content'   => $this->view->renderString($detailStoriette['story_content']),
            'image'     => $detailStoriette['story_image'],
            'jumpScare' => array(
                'image' => $detailStoriette['jump_scare_img'],
                'sec'   => floatval($detailStoriette['jump_scare_sec'])
            ),
            'info'      => array(
                'author'     => $detailStoriette['display_name'],
                'viewer'     => floatval($detailStoriette['viewer']),
                'reader'     => floatval($detailStoriette['reader']),
                'bookmark'   => (!is_null($checkBookmark)) ? $checkBookmark['deleted_at'] : date("Y-m-d H:i:s")
            ),
            'created_at' => date_indo(explode(' ', $detailStoriette['created_at'])[0], false),
        );

        $response = [
            'status' => 200,
            'error' => false,
            'data' => [
                'payload'   => $resArray
            ],
        ];

        return $this->respond($response, 200);
    }

    public function see()
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
        $storySlug    = $json->story_slug;

        $detailStoriette = $this->storietteModel->detailStoriette($storySlug);

        if (is_null($detailStoriette)) {
            $response = [
                'status' => 500,
                'error' => true,
                'data' => [
                    'message' => 'Story not found. Code: 404'
                ],
            ];

            return $this->respond($response, 500);
        }

        $checkSessionUser = $this->sessionModel->checkSession($token);

        if (count($checkSessionUser) == 0) {
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

        $this->viewerModel->insert([
            'userID' => $checkTokenAuth['ID'],
            'storietteID' => $detailStoriette['ID'],
            'sessionID' => $checkSessionUser['ID'],
            'created_at' => date("Y-m-d H:i:s")
        ]);

        $this->storietteModel->update($detailStoriette['ID'], [
            'viewer'    => ($detailStoriette['viewer'] + 1)
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
                    'message' => 'Success viewer'
                ],
            ];
        }

        return $this->respond($response, $code);
    }

    public function related($slug)
    {

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

        $storietteCount = $this->storietteModel->viewStorietteRelatedCount(5, $slug);

        if ($storietteCount > 0) {

            foreach ($this->storietteModel->viewStorietteRelated(5, $slug)->getResult() as $data) {
                $resArray[] = array(
                    'slug'      => $data->story_slug,
                    'title'     => $data->story_title,
                    'content'   => $this->view->renderString($data->story_content),
                    'image'     => $data->story_image,
                    'info'      => array(
                        'author'     => $data->display_name,
                        'viewer'     => floatval($data->viewer),
                        'reader'     => floatval($data->reader),
                    ),
                    'created_at' => date_indo(explode(' ', $data->created_at)[0], false),
                );
            }
        } else {
            $resArray = array();
        }

        $response = [
            'status' => 200,
            'error' => false,
            'data' => [
                'payload'   => $resArray
            ],
        ];

        return $this->respond($response, 200);
    }

    public function search($value = '')
    {

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

        $storietteCount = $this->storietteModel->searchStorietteCount($value);

        if ($storietteCount > 0) {
            foreach ($this->storietteModel->searchStoriette($value)->getResult() as $data) {
                $resArray[] = array(
                    'slug'      => $data->story_slug,
                    'title'     => $data->story_title,
                    'content'   => $this->view->renderString($data->story_content),
                    'image'     => $data->story_image,
                    'info'      => array(
                        'author'     => $data->display_name,
                        'viewer'     => floatval($data->viewer),
                        'reader'     => floatval($data->reader),
                    ),
                    'created_at' => date_indo(explode(' ', $data->created_at)[0], false),
                );
            }
        } else {
            $resArray = array();
        }

        $response = [
            'status' => 200,
            'error' => false,
            'data' => [
                'payload'   => $resArray
            ],
        ];

        return $this->respond($response, 200);
    }
}
