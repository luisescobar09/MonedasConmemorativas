<?php


class Familias extends Controllers
{
    public function __construct()
    {
        parent::__construct();
        session_start();
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url() . '/login');
        }
    }

    public function familias()
    {
        $data['page_id'] = 1;
        $data['page_tag'] = "Familias";
        $data['page_title'] = "Familias de <small> monedas conmemorativas </small>";
        $data['page_name'] = "familias";
        $data['page_functions_js'] = "functions_familias.js";
        $this->views->getView($this, "familias", $data);
    }

    public function getSelectFamilias() {
        $htmlOptions = "";
        $arrData = $this->model->selectFamiliasNombre();
        if (count($arrData) > 0) {
            for ($i = 0; $i < count($arrData); $i++) {
                $htmlOptions .= '<option value="' . $arrData[$i]['id_familia'] . '">' . $arrData[$i]['nombre'] . '</option>';
            }
        }
        echo $htmlOptions;
        die();
    }

    public function getFamilias()
    {
        $arrData = $this->model->selectFamilias();
        for ($i = 0; $i < count($arrData); $i++) {
            $btnView = '<button class="btn btn-info btn-sm btnViewFamilia" onClick="fntViewFamilia(' . $arrData[$i]['id_familia'] . ')" title="Ver familia"><i class="far fa-eye"></i></button>';
            $btnEdit = '<button class="btn btn-primary btn-sm btnEditFamilia" onClick="fntEditFamilia(' . $arrData[$i]['id_familia'] . ')" title="Editar familia"><i class="fas fa-pencil-alt"></i></button>';
            $btnDelete = '<button class="btn btn-danger btn-sm btnDelFamilia" onClick="fntDelFamilia(' . $arrData[$i]['id_familia'] . ')" title="Eliminar familia"><i class="far fa-trash-alt"></i></button>';
            $arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
        }
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function getFamilia(int $idFamilia)
    {
        $intIdFamilia = intval(strClean($idFamilia));
        if ($intIdFamilia > 0) {
            $arrData = $this->model->selectFamilia($intIdFamilia);
            if (empty($arrData)) {
                $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
            } else {
                $arrResponse = array('status' => true, 'data' => $arrData);
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function setFamilia()
    {
        $intIdFamilia = intval($_POST['idFamilia']);
        $strFamilia = strClean($_POST['txtNombre']);
        $decDiametro = floatval($_POST['decDiametro']);
        $strForma = strClean($_POST['txtForma']);
        $decPeso = floatval($_POST['decPeso']);
        $strCanto = strClean($_POST['txtCanto']);
        $strComposicion = strClean($_POST['txtComposicion']);
        $request_familia = "";
        if ($intIdFamilia == 0) {
            $option = 1;
            $request_familia = $this->model->insertFamilia($strFamilia, $decDiametro, $strForma, $decPeso, $strCanto, $strComposicion);
        } else {
            $option = 2;
            $request_familia = $this->model->updateFamilia($intIdFamilia, $strFamilia, $decDiametro, $strForma, $decPeso, $strCanto, $strComposicion);
        }
        if ($request_familia > 0) {
            if ($option == 1) {
                $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
            } else {
                $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');
            }
        } else if ($request_familia == 'exist') {
            $arrResponse = array('status' => false, 'msg' => '¡Atención! La familia ya existe.');
        } else {
            $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
        }
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function delFamilia()
    {
        if ($_POST) {
            $intIdFamilia = intval($_POST['idFamilia']);
            $requestDelete = $this->model->deleteFamilia($intIdFamilia);
            if ($requestDelete == 'ok') {
                $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la familia correctamente.');
            } else if ($requestDelete == 'exist') {
                $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar una familia que tiene monedas asociadas.');
            } else {
                $arrResponse = array('status' => false, 'msg', 'Error al eliminar la familia.');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    
}

?>