<?php

namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Models\GfromModal;
use CodeIgniter\Controller;

class Gfrom extends Controller
{
    private $GfromModal;
    protected $session;
    protected $request;

    /**
     * Constructor.
     */
    public function __construct()
    {
        helper(['form', 'url']);
        $this->GfromModal = new GfromModal();
        $this->session = session();
        $this->request =  \Config\Services::Request();
    }


    public function gfrom($action = false, $record_id = 0)
    {
        if (!$this->GfromModal->check_login()) {
            return redirect()->to('/admin/login');
        }
        $data = [
            'username' => $this->session->get('user')->username,
            'action' => $action,
            'record_id' => $record_id,
        ];
        echo view('admin/render/header', $data);
        echo view('admin/render/sidebar', $data);

        switch ($action) {
            case 'new':
                if ($post = $this->request->getPost()) {
                    $result = $this->GfromModal->newRecord($post);
                }
                $data['message'] = $this->session->getFlashData('message');
                echo view('admin/gfrom-new', $data);
                break;
            case 'edit':
                if ($record = $this->GfromModal->editRecord($record_id)) {
                    $data['edit'] = $record;
                }

                if ($record && $post = $this->request->getPost()) {
                    $this->GfromModal->editRecord($record_id, $post);
                }
                $data['message'] = $this->session->getFlashData('message');
                echo view('admin/gfrom-new', $data);
                break;
            case 'delete':
                if ($record = $this->GfromModal->editRecord($record_id)) {
                    $data['edit'] = $record;
                }
                if ($record && $post = $this->request->getPost() && $result = $this->GfromModal->deleteRecord($record_id)) {
                    return redirect()->to('/admin/table');
                } else {

                    $data['message'] = $this->session->getFlashData('message');
                    echo view('admin/gfrom-new', $data);
                }
                break;
            default:
                $data['message'] = $this->session->getFlashData('message');
                $data['record'] = $this->GfromModal->getRecord();
                echo view('admin/tables', $data);
                break;
        }
        echo view('admin/render/footer', $data);
    }
}