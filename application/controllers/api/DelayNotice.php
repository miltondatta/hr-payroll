<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DelayNotice extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('api/ValidateRequest');
        $this->load->model('api/DelayNotice_model');
    }

    public function all()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'GET') {
            json_output(400,
                array('status' => 400,
                    'message' => 'Bad request, Check Request Type',
                    'data' => array()));
        } else {
            $valid = $this->ValidateRequest->validate();
            if ($valid) {
                $result = array();
                $params = $_REQUEST;
                $user_type = $params['user_type'] ?? null;
                $name = $params['name'] ?? null;

                if ($user_type == null || $user_type == '' || $name == null || $name == '') {
                    json_output(400, array('status' => 400,
                        'message' => 'Invalid request Parameter',
                        'data' => array()));
                    return;
                }

                if ($user_type == 'EMPLOYEE') {
                    $delay_notice = $this->DelayNotice_model->GetDelayNoticeByUser($name);
                } else {
                    $delay_notice = $this->DelayNotice_model->GetDelayNotice();
                }

                foreach ($delay_notice as $record) {
                    $prep_data = array(
                        'id' => $record->id,
                        'description' => $record->description,
                        'hour' => $record->hour,
                        'status' => $record->status,
                        'added_by' => $record->added_by,
                        'created_at' => $record->created_at,
                        'updated_at' => $record->updated_at,
                    );
                    array_push($result, $prep_data);
                }
                json_output(200, array('status' => 200,
                    'message' => 'Get Delay Notice Data',
                    'data' => $result));
            } else {
                json_output(403, array('status' => 403,
                    'message' => 'Request Unauthorized',
                    'data' => array()));
            }
        }
    }

    public function add()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400,
                array('status' => 400,
                    'message' => 'Bad request, Check Request Type',
                    'data' => array()));
        } else {
            $valid = $this->ValidateRequest->validate();
            if ($valid) {
                $result = array();
                $description = $this->input->post('description');
                $hour = $this->input->post('hour');
                $added_by = $this->input->post('added_by');
                $now = new DateTime();

                /*
                 * Status 1 = Pending
                 * Status 2 = Approve
                 * Status 3 = Reject
                 * */

                if ($description && $hour && $added_by) {
                    $data = array(
                        'description' => $description,
                        'hour' => $hour,
                        'status' => 1,
                        'added_by' => $added_by,
                        'created_at' => $now->format('Y-m-d H:i:s'),
                    );

                    $insert_id = $this->DelayNotice_model->addDelayNotice($data);

                    $data['id'] = $insert_id;
                    $result = $data;
                    json_output(201, array('status' => 201,
                        'message' => 'Delay Notice Saved Successfully',
                        'data' => $result));
                } else {
                    json_output(400, array('status' => 400,
                        'message' => 'Wrong Parameter. Check Please',
                        'data' => $result));
                }
            } else {
                json_output(403, array('status' => 403,
                    'message' => 'Request Unauthorized',
                    'data' => array()));
            }
        }
    }

    public function update()
    {
        json_output(400,
            array('status' => 400,
                'message' => 'Bad request, Check Request Type',
                'data' => array()));

        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400,
                array('status' => 400,
                    'message' => 'Bad request, Check Request Type',
                    'data' => array()));
        } else {
            $valid = $this->ValidateRequest->validate();
            if ($valid) {
                $result = array();
                $params = $_REQUEST;

                $id = $params['id'];
                $status = $params['status'];
                $updated_by = $params['updated_by'];
                $now = new DateTime();

                /*
                 * Status 1 = Pending
                 * Status 2 = Approve
                 * Status 3 = Reject
                 * */

                $data = array(
                    'status' => $status,
                    'updated_by' => $updated_by,
                    'updated_at' => $now->format('Y-m-d H:i:s'),
                );

                $data = $this->DelayNotice_model->updateDelayNotice($id, $data);
                $result['affacted_row'] = $data;

                json_output(200, array('status' => 200,
                    'message' => 'Update Successful',
                    'data' => $result));
            } else {
                json_output(403, array('status' => 403,
                    'message' => 'Request Unauthorized',
                    'data' => array()));
            }
        }
    }
}