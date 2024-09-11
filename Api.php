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
                                        $_POST['dataNasc']

$_POST['cell']

$_POST['email']

$_POST['ftAluno']

$_POST['cep']

$_POST['estado']

$_POST['cidade']

$_POST['rua']

$_POST['bairro']

$_POST['num']

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


                        case 'getheroes':
                                $db = new DbOperation();
                                $response['error'] = false; 
                                $response['message'] = 'Pedido concluído com sucesso';
                                $response['heroes'] = $db->getHeroes();
                        break; 



                        case 'updatehero':
                                isTheseParametersAvailable(array('id','name','realname','rating','teamaffiliation'));
                                $db = new DbOperation();
                                $result = $db->updateHero(
                                        $_POST['id'],
                                        $_POST['name'],
                                        $_POST['realname'],
                                        $_POST['rating'],
                                        $_POST['teamaffiliation']
                                );

                                if($result){
                                        $response['error'] = false; 
                                        $response['message'] = 'Herói atualizado com sucesso';
                                        $response['heroes'] = $db->getHeroes();
                                }else{
                                        $response['error'] = true; 
                                        $response['message'] = 'Algum erro ocorreu por favor tente novamente';
                                }
                        break; 


                        case 'deletehero':


                                if(isset($_GET['id'])){
                                        $db = new DbOperation();
                                        if($db->deleteHero($_GET['id'])){
                                                $response['error'] = false; 
                                                $response['message'] = 'Herói excluído com sucesso';
                                                $response['heroes'] = $db->getHeroes();
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