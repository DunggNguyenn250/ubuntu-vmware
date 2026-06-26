<?php

class UserController extends \Core\Controller {
    private $authRepo;
    private $studentRepo;
    private $incidentRepo;
    private $roomRepo;

    public function __construct() {
        $this->authRepo = new AuthRepository();
        $this->studentRepo = new StudentRepository();
        $this->incidentRepo = new IncidentRepository();
        $this->roomRepo = new RoomRepository();
    }

    public function login() {
        $masv = $this->getInput('masv');
        $password = $this->getInput('password');
        $result = $this->authRepo->login($masv, $password);
        $this->jsonResponse($result);
    }

    public function student() {
        $masv = $this->getInput('masv');
        $result = $this->studentRepo->findByMasv($masv);
        $this->jsonResponse($result ? ['status'=>'success','data'=>$result]
                            : ['status'=>'error','message'=>'Không tìm thấy sinh viên']);
    }

    public function room() {
        $masv = $this->getInput('masv');
        $data = $this->roomRepo->findByStudent($masv);
        $this->jsonResponse(['status'=>'success','data'=>$data]);
    }

    public function contract() {
        $masv = $this->getInput('masv');
        $data = $this->roomRepo->getContract($masv);
        $this->jsonResponse(['status'=>'success','data'=>$data]);
    }

    public function incident() {
        $masv = $this->getInput('masv');
        $data = $this->incidentRepo->findByStudent($masv);
        $this->jsonResponse(['status'=>'success','data'=>$data]);
    }

    public function student_update() {
        $data = [
            'masv'=>$this->getInput('masv'),
            'hoten'=>$this->getInput('hoten'),
            'lop'=>$this->getInput('lop'),
            'gioitinh'=>$this->getInput('gioitinh'),
            'cccd'=>$this->getInput('cccd'),
            'sodienthoai'=>$this->getInput('sodienthoai'),
            'email'=>$this->getInput('email'),
            'diachi'=>$this->getInput('diachi')
        ];
        $ok = $this->studentRepo->update($data);
        $this->jsonResponse($ok ? ['status'=>'success'] : ['status'=>'error','message'=>'Lỗi lưu thông tin']);
    }

    public function change_password() {
        $masv = $this->getInput('masv');
        $old_pw = $this->getInput('old_password');
        $new_pw = $this->getInput('new_password');
        $result = $this->authRepo->changePassword($masv,$old_pw,$new_pw);
        $this->jsonResponse($result);
    }

    public function reportIncident() {
        $data = [
            'masv'=>$this->getInput('masv'),
            'maphong'=>$this->getInput('maphong'),
            'mota'=>$this->getInput('mota'),
            'ngaybao'=>$this->getInput('ngaybao')
        ];
        $ok = $this->incidentRepo->insertRequest($data);
        $this->jsonResponse($ok ? ['status'=>'success','message'=>'Yêu cầu sự cố đã được gửi'] : ['status'=>'error','message'=>'Lỗi khi gửi yêu cầu']);
    }
}