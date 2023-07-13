<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\CategoriaModel;
use App\Models\EtiquetaModel;

class Etiqueta extends BaseController
{
    
    public function show($id)
    {
        $etiquetaModel = new EtiquetaModel();

        echo view('dashboard/etiqueta/show',[
            'etiqueta' => $etiquetaModel->find($id)
        ]);
    }
    public function new() 
    {
        $categoriaModel = new  CategoriaModel();
        echo view('dashboard/etiqueta/new',[
            'etiqueta'=> new EtiquetaModel(),
            'categorias' => $categoriaModel->find()
        ]);
        
    }
    public function create() 
    {
        $etiquetaModel = new EtiquetaModel();
        if ($this->validate('etiquetas')) {
            $etiquetaModel->insert([
                'titulo' =>$this->request->getPost('Titulo'),                
                'categoria_id' =>$this->request->getPost('categoria_id')
            ]);
        }else
        {
            session()->setFlashdata([
                'validation' =>$this->validator
            ]);
            return redirect()->back()->withInput();
        }
        
        return redirect()->to('/dashboard/etiqueta')->with('mensaje','Registro Gestiondo de manera exitosa');
    }
    public function edit($id)
    {
        $etiquetaModel = new EtiquetaModel();
        $categoriaModel = new  CategoriaModel();

        echo view('dashboard/etiqueta/edit',[
            'etiqueta'=> $etiquetaModel->asObject()->find($id),
            'categorias' => $categoriaModel->find()
        ]);
    }
    public function update($id)
    {
        $etiquetaModel = new EtiquetaModel();

        if ($this->validate('etiqueta')) {                    
            $etiquetaModel->update($id,[
            'titulo' => $this->request->getPost('Titulo'),            
            'categoria_id' => $this->request->getPost('categoria_id')
            ]);
        }else
        {
            session()->setFlashdata([
                'validation' =>$this->validator
            ]);
            return redirect()->back()->withInput();
        }
        
        return redirect()->back()->with('Mensaje','Registro Gestiondo de manera exitosa');
    }
    public function delete($id)
    {
        $etiquetaModel = new EtiquetaModel();
        $etiquetaModel->delete($id);         
        return redirect()->back();        
    }    
    public function index()
    {
        $etiquetaModel = new EtiquetaModel();        
        $data = [
            'etiqueta' => $etiquetaModel->select('etiquetas.*, categorias.titulos as categoria')->join('categorias','categorias.id = etiquetas.categoria_id')
            ->paginate(5),
            'pager' => $etiquetaModel->pager
            //->find()            
        ];
        
        echo view('dashboard/etiqueta/index',$data);
    }
}
