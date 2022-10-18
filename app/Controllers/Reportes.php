<?php

namespace App\Controllers;
use App\Models\PermisosUsuarioModel;
use App\Models\ActivosModel;
use App\Models\AsignacionModel;
use App\Models\UsuarioModel;
use \PhpOffice\PhpSpreadsheet\Spreadsheet;
use \PhpOffice\PhpSpreadsheet\IOFactory;
use \PhpOffice\PhpSpreadsheet\Style\Alignment;
use \PhpOffice\PhpSpreadsheet\Style\Fill;

class Reportes extends BaseController{
    private $permisoModel;
    private $usuarioModel;
    private $activosModel;
    private $asignacionModel;
    private $session;

    public function __construct(){
        $this->permisoModel = new PermisosUsuarioModel();
        $this->usuarioModel = new UsuarioModel();
        $this->activosModel = new ActivosModel();
        $this->asignacionModel = new AsignacionModel();
        $this->session = session();

    }

    public function reporteActivos(){
        if($this->session->has('idUsuario')){
            $datos = [
                'permisos' => $this->permisoModel->where('permisosusuario.idUsuario',$this->session->idUsuario)
                                                    ->select('permisos.nombre')
                                                    ->join('permisos', 'permisos.idPermiso = permisosusuario.idPermiso')
                                                    ->orderBy('permisos.idPermiso', 'ASC')
                                                    ->findAll(),
                'tipo' => 'Eliminar',
                'titulo' => 'Reporte de activos para TI'
            ];
            echo view('templates/header',$datos);
            echo view('mostrarActivos',$datos);
            echo view('templates/footer');
            echo view('templates/footer_js');
        }
    }

    public function generarReporteActivos(){
        $activos = $this->activosModel->select('activo.noActivo, activo.noSerie, activo.marca, activo.modelo, activo.memoriaRAM, activo.discoDuro, activo.procesador, activo.fechaAlta, usuario.nombre, usuario.apellidoP, usuario.apellidoM, asignacion.fechaAsignacion')
                                      ->join('asignacion','asignacion.idAsignacion = activo.idAsignacion','left')
                                      ->join('usuario', 'asignacion.usuarioAsignado = usuario.idUsuario','left')
                                      ->findAll();
                                      
        $filename = base_url("resources/templates/templateActivos.xlsx");
        $file = file_get_contents($filename);
        $inputFileName = 'tempfile.xlsx';
        file_put_contents($inputFileName, $file);

        $reader = IOFactory::createReader('Xlsx');
        $spreadsheet = $reader->load($inputFileName);

        $contentStartRow = 10;
        $currentRow = 10;

        foreach($activos as $activo){
            $spreadsheet->getActiveSheet()->insertNewRowBefore($currentRow+1,1);
            $spreadsheet->getActiveSheet()
                        ->setCellValue('A'.$currentRow, $activo['noActivo'])
                        ->setCellValue('B'.$currentRow, $activo['noSerie'])
                        ->setCellValue('C'.$currentRow, $activo['marca'])
                        ->setCellValue('D'.$currentRow, $activo['modelo'])
                        ->setCellValue('E'.$currentRow, $activo['memoriaRAM'])
                        ->setCellValue('F'.$currentRow, $activo['discoDuro'])
                        ->setCellValue('G'.$currentRow, $activo['procesador'])
                        ->setCellValue('H'.$currentRow, $activo['fechaAlta'])
                        ->setCellValue('I'.$currentRow, $activo['nombre']." ".$activo['apellidoP']." ".$activo['apellidoM'])
                        ->setCellValue('J'.$currentRow, $activo['fechaAsignacion']);
            $currentRow++;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="result.xlsx"');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

}