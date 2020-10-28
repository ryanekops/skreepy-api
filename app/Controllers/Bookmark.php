<?php

namespace App\Controllers;

use App\Models\AuthModel;
use App\Models\BookmarkModel;
use App\Models\StorietteModel;
use CodeIgniter\RESTful\ResourceController;

class Bookmark extends ResourceController
{
    protected $bookmarkModel;
    protected $authModel;
    protected $storietteModel;

    protected $db;

    public function __construct()
    {
        $this->bookmarkModel = new BookmarkModel();

        $this->authModel = new AuthModel();

        $this->storietteModel = new StorietteModel();

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

        $bookmarkCount = $this->bookmarkModel->viewBookmarkCount($limit, $offset);

        if ($bookmarkCount > 0) {
            foreach ($this->bookmarkModel->viewBookmark($limit, $offset)->getResult() as $data) {
                $resArray[] = array(
                    'uniqueID'  => $data->uniqueID,
                    'image'     => $data->story_image,
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
                'offset'    => ($bookmarkCount < $limit) ? null : floatval($nextpage)
            ],
        ];

        return $this->respond($response, 200);
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
        $storyUid   = $json->storyUid;
        $lastBook   = $json->lastBook; // Not Important

        $detailStoriette = $this->storietteModel->detailStoriette($storyUid);

        if (is_null($detailStoriette)) {
            $response = [
                'status' => 500,
                'error' => true,
                'data' => [
                    'message' => 'Data not found. Code: 404'
                ],
            ];

            return $this->respond($response, 500);
        }

        $checkBookmark = $this->bookmarkModel->checkUserBookmark($checkTokenAuth['uniqueID'], $storyUid);

        $this->db->transStart();

        if (is_null($checkBookmark)) {

            $this->bookmarkModel->insert([
                'user_uniqueID'         => $checkTokenAuth['uniqueID'],
                'storiette_uniqueID'    => $detailStoriette['uniqueID']
            ]);

            $message = 'Added to Bookmark';
        } else {

            if (is_null($checkBookmark['deleted_at'])) {
                $this->bookmarkModel->update($checkBookmark['uniqueID'], [
                    'deleted_at' => date("Y-m-d H:i:s")
                ]);

                $message = 'Removed to Bookmark';
            } else {
                $this->bookmarkModel->update($checkBookmark['uniqueID'], [
                    'deleted_at' => NULL
                ]);

                $message = 'Added to Bookmark';
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
                    'message' => $message
                ],
            ];
        }

        return $this->respond($response, $code);
    }
}
