<?php namespace App\Models;

use CodeIgniter\Model;

class ModeloAnimal extends Model
{
    protected $table = 'descripcion';
    protected $primaryKey = 'id';

protected $allowedFields = ['nombre','edad','tipoanimal','descripcion','comida','foto'];

}