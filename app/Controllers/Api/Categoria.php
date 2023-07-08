<?php

namespace App\Controllers\Api;
use CodeIgniter\RESTful\ResourceController;
use SebastianBergmann\CodeUnit\FunctionUnit;

    class Categoria extends ResourceController{
        protected $modelName = 'App\Models\CategoriaModel';
        //protected $format = 'json';
        //protected $format = 'xml';

        public function index()
        {
            return $this->respond($this->model->findAll());            
        }
        public function show($id= null)
        {
            return $this->respond($this->model->find($id));
        }
        public function create()
        {
            if ($this->validate('categorias')) {
                $id = $this->model->insert([
                    'Titulos' =>$this->request->getPost('Titulo')
                ]);
            }else
            {
                return $this->respond($this->validator->getErrors());
            }
            return $this->respond($id);
        }
        public function update($id = null)
        {
            if ($this->validate('categorias')) {                                
                $this->model->update($id,[
                    'Titulos' => $this->request->getRawInput()['Titulo']
                ]);
            }else
            {
                if($this->validator->getError('titulo')){
                    return $this->respond($this->validator->getError('titulo'),400);  
                }
                //return $this->respond($this->validator->getErrors(),400);
            }                    
            return $this->respond($id);                        
        }
        public function delete($id=null)
        {
            $this->model->delete($id);
            return $this->respond('Eliminado');
            
        }
    }
?>