<?php
namespace App\Controllers\Panel;
use App\Controllers\BaseController;
class Pelicula extends BaseController{
     
    public function index(){
        echo "Hola mundo test";
    }
    public function test($x= 0,$id = 0){
        echo "Hola mundo test " .$id . $x ;
    }
    public function new()
    {
        echo view("Pelicula/create");        
    }
    public function create()
    {
        echo "Insert";
        
    }
    public function edit($id)
    {
        echo view("pelicula/edit");        
    }
    public function update($id)
    {
        echo "Insert " .$id;
        
    }
}