<?php 
// API ATUALIZADA DIA 28.10
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

                        // CRIANDO DADOS

                        case 'createAluno':

                                isTheseParametersAvailable(array('nome', 'sexo', 'dataNasc', 'cell', 'email', 'ftAluno', 'codPer'));

                                $db = new dbOperation();

                                $result = $db->createAluno(
                                        $_POST['nome'],
                                        $_POST['sexo'],
                                        $_POST['dataNasc'],
                                        $_POST['cell'],
                                        $_POST['email'],
                                        $_POST['ftAluno'],
                                        $_POST['codPer']);



                                if($result){

                                        $response['error'] = false; 


                                        $response['message'] = 'Cadastro feito com sucesso';


                                        $response['alunos'] = $db->getAluno();
                                }else{


                                        $response['error'] = true; 


                                        $response['message'] = 'Algum erro ocorreu por favor tente novamente';
                                }

                        break; 


                        case 'createPersonal':

                                isTheseParametersAvailable(array('nome', 'cpf', 'sexo', 'ftPer', 'cell', 'cref', 'email', 'dataNasc'));

                                $db = new dbOperation();

                                $result = $db->createAluno(
                                        $_POST['nome'],
                                        $_POST['cpf'],
                                        $_POST['sexo'],
                                        $_POST['ftPer'],
                                        $_POST['cell'],
                                        $_POST['cref'],
                                        $_POST['email'],
                                        $_POST['dataNasc']);
                                        
                                        



                                if($result){

                                        $response['error'] = false; 


                                        $response['message'] = 'Cadastro feito com sucesso';


                                        $response['personal'] = $db->getPersonal();
                                }else{


                                        $response['error'] = true; 


                                        $response['message'] = 'Algum erro ocorreu por favor tente novamente';
                                }

                        break; 

                        case 'createLista':

                                isTheseParametersAvailable(array('codPer', 'nomeLista', 'observacao', 'objetivo'));

                                $db = new dbOperation();

                                $result = $db->createLista(
                                        $_POST['codPer'],
                                        $_POST['nomeLista'],
                                        $_POST['observacao'],
                                        $_POST['objetivo']);
                                        
                                        



                                if($result){

                                        $response['error'] = false; 


                                        $response['message'] = 'Cadastro feito com sucesso';


                                        $response['lista'] = $db->getLista();
                                }else{


                                        $response['error'] = true; 


                                        $response['message'] = 'Algum erro ocorreu por favor tente novamente';
                                }

                        break;

                        case 'createTreino':

                                isTheseParametersAvailable(array('codLista', 'nomeTreino', 'diaTreino'));

                                $db = new dbOperation();

                                $result = $db->createTreino(
                                        $_POST['codLista'],
                                        $_POST['nomeTreino'],
                                        $_POST['diaTreino']);
                                        
                                        



                                if($result){

                                        $response['error'] = false; 


                                        $response['message'] = 'Cadastro feito com sucesso';


                                        $response['treino'] = $db->getTreino();
                                }else{


                                        $response['error'] = true; 


                                        $response['message'] = 'Algum erro ocorreu por favor tente novamente';
                                }

                        break;

                        case 'createExercicio_Personal':

                                isTheseParametersAvailable(array('nomeExePer', 'descricao', 'video', 'ftExe', 'codCat', 'codPer'));

                                $db = new dbOperation();

                                $result = $db->createExercicio_Personal(
                                        $_POST['nomeExePer'],
                                        $_POST['descricao'],
                                        $_POST['video'],
                                        $_POST['ftExe'],
                                        $_POST['codCat'],
                                        $_POST['codPer']);
                                        
                                        



                                if($result){

                                        $response['error'] = false; 


                                        $response['message'] = 'Cadastro feito com sucesso';


                                        $response['exercicio'] = $db->getExercicio_Personal();
                                }else{


                                        $response['error'] = true; 


                                        $response['message'] = 'Algum erro ocorreu por favor tente novamente';
                                }

                        break;

                        case 'createExercicio_Personalizado':

                                isTheseParametersAvailable(array('numSer', 'tempDesc', 'numReps', 'numKg', 'codExePer', 'codExe'));

                                $db = new dbOperation();

                                $result = $db->createExercicio_Personalizado(
                                        $_POST['numSer'],
                                        $_POST['tempDesc'],
                                        $_POST['numReps'],
                                        $_POST['numKg'],
                                        $_POST['codExePer'],
                                        $_POST['codExe']);
                                        
                                        



                                if($result){

                                        $response['error'] = false; 


                                        $response['message'] = 'Cadastro feito com sucesso';


                                        $response['exercicio'] = $db->getExercicio_Personalizado();
                                }else{


                                        $response['error'] = true; 


                                        $response['message'] = 'Algum erro ocorreu por favor tente novamente';
                                }

                        break;


                        // MOSTRANDO DADOS


                        case 'getAluno':
                                $db = new dbOperation();
                                $response['error'] = false; 
                                $response['message'] = 'Mostrando com sucesso';
                                $response['alunos'] = $db->getAluno();
                        break; 


                        case 'getPersonal':
                                $db = new dbOperation();
                                $response['error'] = false; 
                                $response['message'] = 'Mostrando com sucesso';
                                $response['personal'] = $db->getPersonal();
                        break;

                        case 'getLista':
                                $db = new dbOperation();
                                $response['error'] = false; 
                                $response['message'] = 'Mostrando com sucesso';
                                $response['lista'] = $db->getLista();
                        break;

                        case 'getTreino':
                                $db = new dbOperation();
                                $response['error'] = false; 
                                $response['message'] = 'Mostrando com sucesso';
                                $response['treino'] = $db->getTreino();
                        break;

                        case 'getExercicio_Personal':
                                $db = new dbOperation();
                                $response['error'] = false; 
                                $response['message'] = 'Mostrando com sucesso';
                                $response['exercicio'] = $db->getExercicio_Personal();
                        break;

                        case 'getExercicio_Personalizado':
                                $db = new dbOperation();
                                $response['error'] = false; 
                                $response['message'] = 'Mostrando com sucesso';
                                $response['exercicio'] = $db->getExercicio_Personalizado();
                        break;


                        // ATUALIZANDO DADOS

                        case 'updateAluno':
                                isTheseParametersAvailable(array('codAlun','nome', 'sexo', 'dataNasc', 'cell', 'email', 'ftAluno', 'codPer'));
                                $db = new dbOperation();
                                $result = $db->updateAluno(

                                        $_POST['codAlun'],
                                        $_POST['nome'],
                                        $_POST['sexo'],
                                        $_POST['dataNasc'],
                                        $_POST['cell'],
                                        $_POST['email'],
                                        $_POST['ftAluno'],
                                        $_POST['codPer']);

                                if($result){
                                        $response['error'] = false; 
                                        $response['message'] = 'Cadastro atualizado com sucesso';
                                        $response['alunos'] = $db->getAluno();
                                }else{
                                        $response['error'] = true; 
                                        $response['message'] = 'Algum erro ocorreu por favor tente novamente';
                                }
                        break; 


                        case 'updatePersonal':
                                isTheseParametersAvailable(array('nome', 'cpf', 'sexo', 'ftPer', 'cell', 'cref', 'email', 'dataNasc'));
                                $db = new dbOperation();
                                $result = $db->updatePersonal(

                                        $_POST['nome'],
                                        $_POST['cpf'],
                                        $_POST['sexo'],
                                        $_POST['ftPer'],
                                        $_POST['cell'],
                                        $_POST['cref'],
                                        $_POST['email'],
                                        $_POST['dataNasc']);

                                if($result){
                                        $response['error'] = false; 
                                        $response['message'] = 'Cadastro atualizado com sucesso';
                                        $response['personal'] = $db->getPersonal();
                                }else{
                                        $response['error'] = true; 
                                        $response['message'] = 'Algum erro ocorreu por favor tente novamente';
                                }
                        break;


                        case 'updateLista':
                                isTheseParametersAvailable(array('codPer', 'nomeLista', 'observacao', 'objetivo'));
                                $db = new dbOperation();
                                $result = $db->updateLista(

                                        $_POST['codPer'],
                                        $_POST['nomeLista'],
                                        $_POST['observacao'],
                                        $_POST['objetivo']);

                                if($result){
                                        $response['error'] = false; 
                                        $response['message'] = 'Lista atualizada com sucesso';
                                        $response['lista'] = $db->getLista();
                                }else{
                                        $response['error'] = true; 
                                        $response['message'] = 'Algum erro ocorreu por favor tente novamente';
                                }
                        break;


                        case 'updateTreino':
                                isTheseParametersAvailable(array('codLista', 'nomeTreino', 'diaTreino'));
                                $db = new dbOperation();
                                $result = $db->updateTreino(

                                        $_POST['codLista'],
                                        $_POST['nomeTreino'],
                                        $_POST['diaTreino']);

                                if($result){
                                        $response['error'] = false; 
                                        $response['message'] = 'Treino atualizado com sucesso';
                                        $response['treino'] = $db->getTreino();
                                }else{
                                        $response['error'] = true; 
                                        $response['message'] = 'Algum erro ocorreu por favor tente novamente';
                                }
                        break;


                        case 'updateExercicio_Personal':
                                isTheseParametersAvailable(array('nomeExePer', 'descricao', 'video', 'ftExe', 'codCat', 'codPer'));
                                $db = new dbOperation();
                                $result = $db->updateExercicio_Personal(

                                        $_POST['nomeExePer'],
                                        $_POST['descricao'],
                                        $_POST['video'],
                                        $_POST['ftExe'],
                                        $_POST['codCat'],
                                        $_POST['codPer']);

                                if($result){
                                        $response['error'] = false; 
                                        $response['message'] = 'Exercício atualizado com sucesso';
                                        $response['exercicio'] = $db->getExercicio_Personal();
                                }else{
                                        $response['error'] = true; 
                                        $response['message'] = 'Algum erro ocorreu por favor tente novamente';
                                }
                        break;

                        case 'updateExercicio_Personalizado':
                                isTheseParametersAvailable(array('numSer', 'tempDesc', 'numReps', 'numKg', 'codExePer', 'codExe'));
                                $db = new dbOperation();
                                $result = $db->updateExercicio_Personalizado(

                                        $_POST['numSer'],
                                        $_POST['tempDesc'],
                                        $_POST['numReps'],
                                        $_POST['numKg'],
                                        $_POST['codExePer'],
                                        $_POST['codExe']);

                                if($result){
                                        $response['error'] = false; 
                                        $response['message'] = 'Exercício Personalizado atualizado com sucesso';
                                        $response['exercicio'] = $db->getExercicio_Personalizado();
                                }else{
                                        $response['error'] = true; 
                                        $response['message'] = 'Algum erro ocorreu por favor tente novamente';
                                }
                        break;


                        // DELETANDO DADOS

                        case 'deleteLista':


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


                        case 'deleteTreino':


                                if(isset($_GET['codTreino'])){
                                        $db = new dbOperation();
                                        if($db->deleteTreino($_GET['codTreino'])){
                                                $response['error'] = false; 
                                                $response['message'] = 'Treino excluído com sucesso';
                                                $response['Treino'] = $db->getTreino();
                                        }else{
                                                $response['error'] = true; 
                                                $response['message'] = 'Algum erro ocorreu por favor tente novamente';
                                        }
                                }else{
                                        $response['error'] = true; 
                                        $response['message'] = 'Não foi possível deletar, forneça um id por favor';
                                }
                        break;


                        case 'deleteExercicio_Personal':


                                if(isset($_GET['codExePer'])){
                                        $db = new dbOperation();
                                        if($db->deleteExercicio_Personal($_GET['codExePer'])){
                                                $response['error'] = false; 
                                                $response['message'] = 'Exercício excluído com sucesso';
                                                $response['Exercicio'] = $db->getExercicio_Personal();
                                        }else{
                                                $response['error'] = true; 
                                                $response['message'] = 'Algum erro ocorreu por favor tente novamente';
                                        }
                                }else{
                                        $response['error'] = true; 
                                        $response['message'] = 'Não foi possível deletar, forneça um id por favor';
                                }
                        break;

                        case 'deleteExercicio_Personalizado':


                                if(isset($_GET['codPexe'])){
                                        $db = new dbOperation();
                                        if($db->deleteExercicio_Personalizado($_GET['codPexe'])){
                                                $response['error'] = false; 
                                                $response['message'] = 'Exercício Personalizado excluído com sucesso';
                                                $response['Exercicio'] = $db->getExercicio_Personalizado();
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