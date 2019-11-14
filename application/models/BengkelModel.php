<?php
defined('BASEPATH') or exit ('no direct script access allowed');

class BengkelModel extends CI_Model
{
    private $table = 'branches';

    public $id;
    public $name;
    public $address;
    public $phoneNumber;
    public $created_at;

    public $rule = [
        [
            'field' => 'name',
            'label' => 'name',
            'rules' => 'required'
        ],
    ];
    public function Rules() {return $this->rule; }

    public function getAll() { return
        $this->db->get('data_mahasiswa')->result();
    }

    public function store($request) {
        $this->name = $request->name;
        $this->phoneNumber = $request->phoneNumber;
        $this->address = $request->address;
        $this->created_at = date("Y-m-d H:i:s");
        if($this->db->insert($this->table, $this)) {
            return ['msg'=>'Berhasil','error'=>false];
        }
        return ['msg'=>'Gagal','error'=>true];
    }

    public function update($request,$id) { 
        $updateData = ['phoneNumber' => $request->phoneNumber, 'name' =>$request->name, 
                        'address'=>$request->address, 'created_at'=>date("Y-m-d H:i:s")]; 
        if($this->db->where('id',$id)->update($this->table, $updateData)){ 
            return ['msg'=>'Berhasil','error'=>false]; 
        } 
            return ['msg'=>'Gagal','error'=>true]; 
    }

    public function destroy($id){ 
        if (empty($this->db->select('*')->where(array('id' => $id))->get($this->table)->row())) 
            return ['msg'=>'Id tidak ditemukan','error'=>true]; 
        else if($this->db->delete($this->table, array('id' => $id))){ 
            return ['msg'=>'Berhasil','error'=>false]; 
        } 
        return ['msg'=>'Gagal','error'=>true]; 
    }
}

?>