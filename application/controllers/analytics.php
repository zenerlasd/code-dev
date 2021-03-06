<?php 

/**
* 
*/
class Analytics extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        date_default_timezone_set('America/Bogota');

        $this->load->helper('url');
        //error_reporting(0);
        session_start();
        $this->load->model('gtr/config_model');
        $this->load->model('gtr/test_model');
        $this->load->model('consolidados/checkList_model');

        $this->load->model('consolidados/Consolidados_model');
       
        $this->load->library('encrypt');
        $this->encrypt->set_cipher(MCRYPT_GOST);

        $this->load->library('form_validation');
        $this->load->helper('form');

	}


	function index($oficina = 0)
    {
        //echo "string";
        //echo "<h1>hola mundo<h1>";
        $data['title'] = 'Analytics';
        $data['lasd'] = 'COC';
        $data['listaCDEs'] = $this->config_model->getListaNombresCDEs();
        $data['nav'] = 'analytics';

        if (is_string($oficina) && $oficina != "0") {

            $data['oficina'] = $oficina;
            $data['ip_info'] = $this->config_model->getIP($oficina);

            $data['ipCifrada'] = $this->encrypt->encode($data['ip_info']['SER_SDSTRSERVIDOR']);
            
            $data['ipCifrada'] = str_replace("/", "-", $data['ipCifrada']);
            $data['ipCifrada'] = str_replace("+", "_", $data['ipCifrada']);
            $data['ipCifrada'] = str_replace("=", "", $data['ipCifrada']);

            $this->load->view('templates/header', $data);
            $this->load->view('gtr/includes/sidebarAnalytics', $data);
            $this->load->view('analytics/actividad', $data);
            $this->load->view('gtr/includes/endSidebar', $data); 
            $this->load->view('templates/footer', $data); 

        }elseif (is_string($oficina) && $oficina == "0"){

            $this->load->view('templates/header', $data);
             
            $this->load->view('analytics/index', $data);
    
            $this->load->view('templates/footer', $data); 

        }elseif ($oficina == 0) {
            redirect('analytics/index/0');
        }

    }

    function disponiblesNoJustificados(){

        $data['title'] = 'Analytics';
        $data['lasd'] = 'COC';
        $data['nav'] = 'analytics';

        $data['data'] = $this->Consolidados_model->getDisponiblesNoJustificados('2014-01-15 00:00:00', '2014-01-15 23:59:59');

        $this->load->view('templates/header', $data);
        echo "<pre>"; print_r($data['data']); echo "</pre>";
        $this->load->view('templates/footer', $data);

    }

// 
    function actividadWorstOffender($codPos){
        $ip = $this->config_model->getIPbyPos($codPos); //***************
        
        if (isset($ip)) {
            $this->test_model->inicializar($ip);
            echo $this->test_model->actividadWorstOffenderModel();
        }
        
    }

    function getIPS(){
        echo $this->config_model->getIPS();        
    }

    function getIPSmysql(){

        echo $this->checkList_model->getIPSmysql();
    }

    function setIPSmysql(){
        $data = file_get_contents('php://input');   
        echo $data;     
        //$data = json_decode($data, true);
        //echo "string";
        $this->checkList_model->setIPSmysql($data);
    }


    function getClientesSMS(){
        $data = $this->checkList_model->getClientesSMS();
        echo $data;
    }

    function setClienteSMS(){
        
        $this->gtrSMS_model->setClienteSMS();
    }

    function logingChecklist(){
        
        $data = file_get_contents('php://input');        
        $data = json_decode($data, true);

        if (!isset($data['cde']) ) { return;}
        $this->test_model->inicializar($data['cde']);

        $session = $this->test_model->logingChecklist($data['user'], $data['pass']);

        if (count($session) > 0) {
            $session['USU_SDSTRCLAVE'] = md5($session['USU_SDSTRCLAVE'] . rand(999,100000));
            
            $_SESSION['key'] =  $session['USU_SDSTRCLAVE'];

            $sessionJSON = json_encode($session, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT);
            //echo "<pre>"; print_r($session); echo "</pre>";
            echo $sessionJSON;
            //echo $_SESSION['key'];
        }
        
    }
    function keyValidate($key = null){
        if (isset($_SESSION['key'])) {
            if ($key == null || $key !=  $_SESSION['key']) {
                session_destroy();
                return;
            }else if($key ==  $_SESSION['key']) {
                echo "true";
            }else{
                return;
            }
        }
    }

    function insertChecklist(){

        $data = file_get_contents('php://input');        
        $data = json_decode($data, true);

        $this->checkList_model->insertChecklist($data);
    }

    function getCheckListCDE($paginacion){
        $data = file_get_contents('php://input');        
        $data = json_decode($data, true);
        $paginacion = $paginacion*10;
        echo $this->checkList_model->getCheckListCDE($data['ACC_PFKSTROFICINA'], $paginacion);
    }

    function getCheckListCDEid($Cod_Pos, $id){
        echo $this->checkList_model->getCheckListCDEid($Cod_Pos, $id);
    }
}

 ?>