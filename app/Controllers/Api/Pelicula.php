<?php

namespace App\Controllers\Api;
use CodeIgniter\RESTful\ResourceController;
use SebastianBergmann\CodeUnit\FunctionUnit;

    class Pelicula extends ResourceController{
        protected $modelName = 'App\Models\PeliculaModel';
        protected $format = 'json';
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
            if ($this->validate('pelicula')) {
                $id = $this->model->insert([
                    'titulo' =>$this->request->getPost('Titulo'),
                    'descripcion' =>$this->request->getPost('descripcion')
                ]);
            }else
            {
                return $this->respond($this->validator->getErrors());
            }
            return $this->respond($id);
        }
        public function update($id = null)
        {
            if ($this->validate('pelicula')) {                                
                $this->model->update($id,[
                    'titulo' => $this->request->getRawInput()['Titulo'],
                    'descripcion' => $this->request->getRawInput()['descripcion']
                ]);
            }else
            {
                if($this->validator->getError('titulo')){
                    return $this->respond($this->validator->getError('titulo'),400);  
                }

                if($this->validator->getError('descripcion')){
                    return $this->respond($this->validator->getError('descripcion'),400);  
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