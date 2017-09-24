<?php namespace App\Rinekso\Gallery;
use App\Rinekso\BaseRepo;

class GalleryRepo extends BaseRepo{
    public function __construct(Gallery $gallery)
    {
        $this->model = $gallery;
    }
}
/**
 * Created by PhpStorm.
 * User: rinekso
 * Date: 22/09/17
 * Time: 14:12
 */