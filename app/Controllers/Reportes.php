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
        if(in_array('Reporte de activos', array_column($this->session->permisos, 'nombre'))) {
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
        }else{
            return redirect()->to(base_url('/'));
        }
    }

    public function reporteBajas(){
        if(in_array('Reporte de bajas', array_column($this->session->permisos, 'nombre'))){
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
        }else{
            return redirect()->to(base_url('/'));
        }
    }


    public function generarReporteActivos(){
        if(in_array('Reporte de activos', array_column($this->session->permisos, 'nombre'))) {
            $activos = $this->activosModel->findAll();
            $inputFileName = 'templateActivos.xlsx';

            $reader = IOFactory::createReader('Xlsx');
            $spreadsheet = $reader->load($inputFileName);

            $contentStartRow = 10;
            $currentRow = 10;

            foreach($activos as $activo){
                $asignaciones = $this->asignacionModel->select('usuario.nombre, usuario.apellidoP, usuario.apellidoM, asignacion.fechaAsignacion, asignacion.observaciones, asignacion.fechaBaja')
                                                    ->join('usuario', 'asignacion.usuarioAsignado = usuario.idUsuario')
                                                    ->where('asignacion.idActivo', $activo['idActivo'])
                                                    ->withDeleted()
                                                    ->findAll();
                
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
                            ->setCellValue('I'.$currentRow, $activo['fechaAlta']);
                foreach($asignaciones as $asignacion){
                    $spreadsheet->getActiveSheet()->insertNewRowBefore($currentRow+1,1);
                    $spreadsheet->getActiveSheet()
                                ->setCellValue('J'.$currentRow, $asignacion['nombre']." ".$asignacion['apellidoP']." ".$asignacion['apellidoM'])
                                ->setCellValue('K'.$currentRow, $asignacion['fechaAsignacion'])
                                ->setCellValue('L'.$currentRow, $asignacion['observaciones'])
                                ->setCellValue('M'.$currentRow, $asignacion['fechaBaja']);
                    $currentRow++;
                }
                if(empty($asignaciones))  $currentRow++;
            
            }
            
            $spreadsheet->getActiveSheet()->removeRow($currentRow, 2);
            
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="reporte de activos.xlsx"');
            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('php://output');
        }else{
            return redirect()->to(base_url('/'));
        }
    }

    public function generarReporteMisActivos($id){
        if($this->session->idUsuario === $id) {
            $usuario = $this->usuarioModel->select('nombre, apellidoP, apellidoM')->find($id);
            $asignaciones = $this->asignacionModel->select('activo.noActivo, accesorio.nombre, asignacion.cantidad, activo.marca, activo.modelo, asignacion.fechaAsignacion, asignacion.observaciones')
                                            ->join('activo', 'asignacion.idActivo = activo.idActivo', 'left')
                                            ->join('accesorio', 'asignacion.idAccesorio = accesorio.idAccesorio', 'left')
                                            ->where('asignacion.usuarioAsignado', $id)
                                            ->findAll();
            $inputFileName = 'templateMisActivos.xlsx';

            $reader = IOFactory::createReader('Xlsx');
            $spreadsheet = $reader->load($inputFileName);

            $contentStartRow = 11;
            $currentRow = 11;

            $spreadsheet->getActiveSheet()->setCellValue('B9', $usuario['nombre']." ".$usuario['apellidoP']." ".$usuario['apellidoM']);
            foreach($asignaciones as $a){
                $spreadsheet->getActiveSheet()->insertNewRowBefore($currentRow+1,1);
                $spreadsheet->getActiveSheet()
                            ->setCellValue('A'.$currentRow, $a['noActivo'])
                            ->setCellValue('B'.$currentRow, $a['nombre'])
                            ->setCellValue('C'.$currentRow, $a['cantidad'])
                            ->setCellValue('D'.$currentRow, $a['marca'])
                            ->setCellValue('E'.$currentRow, $a['modelo'])
                            ->setCellValue('F'.$currentRow, $a['fechaAsignacion'])
                            ->setCellValue('G'.$currentRow, $a['observaciones']);
                $currentRow++;
            }

            $spreadsheet->getActiveSheet()->removeRow($currentRow, 2);
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="reporte de mis activos.xlsx"');
            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('php://output');
    
        }else{
            return redirect()->to(base_url('/'));
        }
    }

    public function generarReporteBajas(){
        if(in_array('Reporte de bajas', array_column($this->session->permisos, 'nombre'))){
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
        }else{
            return redirect()->to(base_url('/'));
        }
    }

}