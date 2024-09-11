<?php 

        require_once '../includes/dbOperation.php';

        function isTheseParametersAvailable($params){

                $available = true; 
                $missingparams = ""; 

                foreach($params as $param){
                        if(!isset($_POST[$param]) || strlen($_POST[$param])<=0){
                                $available = false; 
                                $missingparams = $missingparams . ", " . $param; 
                        }
                }


                if(!$available){
                        $response = array(); 
                        $response['error'] = true; 
                        $response['message'] = 'Parameters ' . substr($missingparams, 1, strlen($missingparams)) . ' missing';


                        echo json_encode($response);


                        die();
                }
        }


        $response = array();


        if(isset($_GET['apicall'])){

                switch($_GET['apicall']){

                        case 'createAluno':

                                isTheseParametersAvailable(array('nome','senha', 'sexo', 'dataNasc', 'cell', 'email', 'ftAluno', 'cep', 'estado', 'cidade', 'rua', 'bairro', 'num','codPer'));

                                $db = new dbOperation();

                                $result = $db->createAluno(
                                        $_POST['nome'],
                                        $_POST['senha'],
                                        $_POST['sexo'],
                                        $_POST['dataNasc'],

$_POST['cell'],

$_POST['email'],

$_POST['ftAluno'],

$_POST['cep'],

$_POST['estado'],

$_POST['cidade'],

$_POST['rua'],

$_POST['bairro'],

$_POST['num'],

$_POST['codPer']
                                );



                                if($result){

                                        $response['error'] = false; 


                                        $response['message'] = 'Cadastro feito com sucesso';


                                        $response['alunos'] = $db->getAluno();
                                }else{


                                        $response['error'] = true; 


                                        $response['message'] = 'Algum erro ocorreu por favor tente novamente';
                                }

                        break; 


                        case 'getAluno':
                                $db = new dbOperation();
                                $response['error'] = false; 
                                $response['message'] = 'Pedido concluído com sucesso';
                                $response['alunos'] = $db->getAluno();
                        break; 



                        case 'updateAluno':
                                isTheseParametersAvailable(array('codAlun','nome','senha', 'sexo', 'dataNasc', 'cell', 'email', 'ftAluno', 'cep', 'estado', 'cidade', 'rua', 'bairro', 'num','codPer'));
                                $db = new dbOperation();
                                $result = $db->updateAluno(

$_POST['codAlun'],
                                                                               $_POST['nome'],
                                        $_POST['senha'],
                                        $_POST['sexo'],
                                        $_POST['dataNasc'],

$_POST['cell'],

$_POST['email'],

$_POST['ftAluno'],

$_POST['cep'],

$_POST['estado'],

$_POST['cidade']

$_POST['rua'],

$_POST['bairro'],

$_POST['num'],

$_POST['codPer']
                                );

                                if($result){
                                        $response['error'] = false; 
                                        $response['message'] = 'Cadastro atualizado com sucesso';
                                        $response['alunos'] = $db->getAlunos();
                                }else{
                                        $response['error'] = true; 
                                        $response['message'] = 'Algum erro ocorreu por favor tente novamente';
                                }
                        break; 


                        case 'deleteAluno':


                                if(isset($_GET['codLista'])){
                                        $db = new dbOperation();
                                        if($db->deleteLista($_GET['codLista'])){
                                                $response['error'] = false; 
                                                $response['message'] = 'Lista excluída com sucesso';
                                                $response['Lista'] = $db->getLista();
                                        }else{
                                                $response['error'] = true; 
                                                $response['message'] = 'Algum erro ocorreu por favor tente novamente';
                                        }
                                }else{
                                        $response['error'] = true; 
                                        $response['message'] = 'Não foi possível deletar, forneça um id por favor';
                                }
                        break; 
                }

        }else{

                $response['error'] = true; 
                $response['message'] = 'Chamada de API inválida';
        }


        echo json_encode($response);