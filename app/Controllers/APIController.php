<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class APIController extends ResourceController
{
    protected $modelName = 'App\Models\ModeloAnimal';
    protected $format    = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }
    public function findone($id)
    {
      $validar = $this->model->find($id);
      if($validar != null){
        return $this->respond($this->model->find($id));
      }else{
        $mensaje=array("mensaje"=>"El registro no existe!");
        return $this->respond(json_encode($mensaje),400);
      }
       
    }

    public function eliminar($id){

      $consulta = $this->model->where('id',$id)->delete();
      $filasAfectadas=$consulta->connID->affected_rows;

      if($filasAfectadas==1){
        $mensaje=array("mensaje"=>"Registro eliminado!");
        return $this->respond(json_encode($mensaje));
      }else{
        $mensaje=array("mensaje"=>"El registro no existe");
        return $this->respond(json_encode($mensaje),400);
      }


   

     

    }

      public function insertar(){

        $nombre=$this->request->getPost("nombre");
        $edad=$this->request->getPost("edad");
        $tipoanimal=$this->request->getPost("tipoanimal");
        $descripcion=$this->request->getPost("descripcion");
        $comida=$this->request->getPost("comida");
        $foto=$this->request->getPost("foto");

        $datosEnvio=array(
		    "nombre"=>$nombre,
        "edad"=>$edad,
        "tipoanimal"=>$tipoanimal,
        "descripcion"=>$descripcion,
        "comida"=>$comida,
        "foto"=>$foto
        );
      

        if($this->validate('animalPOST')){

          $id=$this->model->insert($datosEnvio);
          return $this->respond($this->model->find($id));

        }else{
            $validation = \Config\Services::validation();
            return $this->respond($validation->getErrors());
        }
        


    }

    public function editar ($id){

      $datosEditar=$this->request->getRawInput();
      

      $nombre=$datosEditar["nombre"];
      $edad=$datosEditar["edad"];
      $tipoanimal=$datosEditar["tipoanimal"];
      $descripcion=$datosEditar["descripcion"];
      $comida=$datosEditar["comida"];
      $foto=$datosEditar["foto"];

        $datosEnvio=array(
        "nombre"=>$nombre,
        "edad" =>$edad,
        "tipoanimal" =>$tipoanimal,
        "descripcion" =>$descripcion,
        "comida" =>$comida,
        "foto" =>$foto
      );

      if($this->validate('animalPUT')){
        $this->model->update($id,$datosEnvio);
        return $this->respond($this->model->find($id));
     

      }else{
        $validation = \Config\Services::validation();
        return $this->respond($validation->getErrors());
      }
    }

    

}