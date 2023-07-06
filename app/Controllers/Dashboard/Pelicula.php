<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\PeliculaModel;
class Pelicula extends BaseController
{
    
    public function show($id)
    {
        $peliculaModel = new PeliculaModel();
        
        //var_dump($peliculaModel->asArray()->find($id));
        //var_dump($peliculaModel->asObject()->find($id));
        echo view('dashboard/pelicula/show',[
            'pelicula' => $peliculaModel->find($id)
        ]);
    }
    public function create() 
    {
        $peliculaModel = new PeliculaModel();
        if ($this->validate('pelicula')) {
            $peliculaModel->insert([
                'titulo' =>$this->request->getPost('Titulo'),
                'descripcion' =>$this->request->getPost('descripcion')
            ]);
        }else
        {
            session()->setFlashdata([
                'validation' =>$this->validator
            ]);
            return redirect()->back()->withInput();
        }
        
        return redirect()->to('/dashboard/pelicula')->with('Mensaje','Registro Gestiondo de manera exitosa');
    }
    public function edit($id)
    {
        $peliculaModel = new PeliculaModel();

        echo view('dashboard/pelicula/edit', [
            'pelicula' => $peliculaModel->find($id)
        ]);
    }
    public function update($id)
    {
        if ($this->validate('pelicula')) {
            $peliculaModel = new PeliculaModel();
            $peliculaModel->update($id,[
            'titulo' => $this->request->getPost('Titulo'),
            'descripcion' => $this->request->getPost('descripcion')
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
        $peliculaModel = new PeliculaModel();
        $peliculaModel->delete($id);
         session()->setFlashdata('Mensaje','Registro eliminado de manera exitosa');
        return redirect()->back();
        //return redirect()->back()->with('Mensaje','Registro Gestiondo de manera exitosa');
    }
    public function new() 
    {
        echo view('dashboard/pelicula/new',[
            'pelicula'=>new PeliculaModel()
        ]);
        
    }
    public function index()
    {
        $peliculaModel = new PeliculaModel();

        echo view('dashboard/pelicula/index',[
            'pelicula' => $peliculaModel->findAll()
        ]);
    }
}
