<?php namespace App\Rinekso;

use Carbon\Carbon;

class BaseRepo
{
    protected $model;
    public $timestamps = true;

    public function __construct($model = null)
    {
        $this->model = $model;
    }
    public function input($input)
    {
        $input['created_at'] = Carbon::now();
        $proses = $this->model->insert($input);
        if($proses)
            return true;
        return false;
    }
    public function update($input,$id)
    {
        $input['updated_at'] = Carbon::now();
        $this->model->where('id','=',$id)
            ->update($input);
        return true;
    }

    public function getData()
    {
        $proses = $this->model->select('*')
            ->get();
        return $proses;
    }
    public function getDataLast()
    {
        $proses = $this->model->select('*')
            ->orderBy("created_at","desc")
            ->first();
        return $proses;
    }
    public function detail($id)
    {
        return $this->model->find($id);
    }
    public function getDataWhere($kolom,$value)
    {
        $proses = $this->model
            ->where($kolom,'=',$value)
            ->get();
        return $proses;
    }
    public function getDataWhere2($kolom,$value,$kolom2,$value2)
    {
        $proses = $this->model
            ->where($kolom,'=',$value)
            ->where($kolom2,'=',$value2)
            ->get();
        return $proses;
    }
    public function getDataWhere3($kolom,$value,$kolom2,$value2,$kolom3,$value3)
    {
        $proses = $this->model
            ->where($kolom,'=',$value)
            ->where($kolom2,'=',$value2)
            ->where($kolom3,'=',$value3)
            ->get();
        return $proses;
    }
    public function delete($id)
    {
        $res = $this->model->where('id','=',$id)
            ->delete();
        return true;
    }
    public function deleteWhere($id,$kolom,$value)
    {
        $res = $this->model->where('id_target','=',$id)
            ->where($kolom,'=',$value)
            ->delete();
        return true;
    }

    public function getPaginate($limit = 10)
    {
        return $this->model->paginate($limit);
    }
    public function search($category,$search)
    {
        return $this->model->select('*')
            ->where($category,'like','%'.$search.'%')
            ->get();
    }

}
/**
 * Created by PhpStorm.
 * User: rinekso
 * Date: 02/02/17
 * Time: 13:56
 */