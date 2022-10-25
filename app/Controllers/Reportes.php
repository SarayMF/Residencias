<?php

namespace App\Controllers;
use App\Models\PermisosUsuarioModel;
use App\Models\ActivosModel;
use App\Models\AplicacionActivoModel;
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
    private $aplicacionesModel;
    private $asignacionModel;
    private $session;

    public function __construct(){
        $this->permisoModel = new PermisosUsuarioModel();
        $this->usuarioModel = new UsuarioModel();
        $this->aplicacionesModel = new AplicacionActivoModel();
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

    public function reporteBajas(){
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
            echo view('reporteBajas',$datos);
            echo view('templates/footer');
            echo view('templates/footer_js');
        }
    }


    public function generarReporteActivos(){
        $activos = $this->activosModel->select('activo.idActivo, activo.noActivo, activo.noSerie, activo.marca, activo.modelo, activo.memoriaRAM, activo.discoDuro, activo.procesador, activo.fechaAlta, usuario.nombre, usuario.apellidoP, usuario.apellidoM, asignacion.fechaAsignacion')
                                      ->join('asignacion','asignacion.idAsignacion = activo.idAsignacion','left')
                                      ->join('usuario', 'asignacion.usuarioAsignado = usuario.idUsuario','left')
                                      ->findAll();
        $inputFileName = 'templateActivos.xlsx';

        $reader = IOFactory::createReader('Xlsx');
        $spreadsheet = $reader->load($inputFileName);

        $contentStartRow = 10;
        $currentRow = 10;

        foreach($activos as $activo){
            $aplicaciones = $this->aplicacionesModel->select('aplicaciones.nombre')
                                                    ->where('idActivo', $activo['idActivo'])
                                                    ->join('aplicaciones', 'activoaplicaciones.idAplicacion = aplicaciones.idAplicacion')
                                                    ->findAll();
            
            $lista = implode(', ', array_column($aplicaciones, 'nombre'));
            $spreadsheet->getActiveSheet()->insertNewRowBefore($currentRow+1,1);
            $spreadsheet->getActiveSheet()
                        ->setCellValue('A'.$currentRow, $activo['noActivo'])
                        ->setCellValue('B'.$currentRow, $activo['noSerie'])
                        ->setCellValue('C'.$currentRow, $activo['marca'])
                        ->setCellValue('D'.$currentRow, $activo['modelo'])
                        ->setCellValue('E'.$currentRow, $activo['memoriaRAM'])
                        ->setCellValue('F'.$currentRow, $activo['discoDuro'])
                        ->setCellValue('G'.$currentRow, $activo['procesador'])
                        ->setCellValue('H'.$currentRow, $lista)
                        ->setCellValue('I'.$currentRow, $activo['fechaAlta'])
                        ->setCellValue('J'.$currentRow, $activo['nombre']." ".$activo['apellidoP']." ".$activo['apellidoM'])
                        ->setCellValue('K'.$currentRow, $activo['fechaAsignacion']);
            $currentRow++;
        }
        
        $spreadsheet->getActiveSheet()->removeRow($currentRow, 2);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="reporte de activos.xlsx"');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

    public function generarReporteBajas(){
        $activos = $this->activosModel->select('activo.noActivo, activo.noSerie, activo.marca, activo.modelo, activo.fechaAlta ,activo.fechaBaja, usuario.nombre, usuario.apellidoP, usuario.apellidoM')
                                        ->join('usuario', 'activo.usuarioBaja = usuario.idUsuario')
                                        ->onlyDeleted()
                                        ->find();

        $inputFileName = 'templateBajas.xlsx';

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
                        ->setCellValue('E'.$currentRow, $activo['fechaAlta'])
                        ->setCellValue('F'.$currentRow, $activo['nombre']." ".$activo['apellidoP']." ".$activo['apellidoM'])
                        ->setCellValue('G'.$currentRow, $activo['fechaBaja']);
            $currentRow++;
        }

        $spreadsheet->getActiveSheet()->removeRow($currentRow, 2);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="reporte de bajas.xlsx"');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

}