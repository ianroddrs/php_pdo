<?php

    require "tarefa.model.php";
    require "tarefa.service.php";
    require "conexao.php";

    $acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

    if( $acao == 'inserir'){
        $tarefa = new Tarefa();
        $tarefa->__set('tarefa', $_POST['tarefa']);
    
        $conexao = new Conexao();
        
        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefaService->inserir();

        header('Location: nova_tarefa.php?inclusao=1');

    } else if ($acao == 'recuperar'){

        $tarefa = new Tarefa();
        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefas = $tarefaService->recuperar();
        
    } else if ($acao == 'atualizar'){
        
        $tarefa = new Tarefa();
        $tarefa->__set('id', $_POST['id']);
        $tarefa->__set('tarefa', $_POST['tarefa']);
        
        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);

        if($tarefaService->atualizar()){
            if(isset($_GET['page']) && $_GET['page'] == 'index'){
                header('location: index.php');
            }else{
                header('location: todas_tarefas.php');
            }
        }

    } else if ($acao == 'remover'){
        
        $tarefa = new Tarefa();
        $tarefa->__set('id', $_GET['id']);

        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefaService->remover();

        if(isset($_GET['page']) && $_GET['page'] == 'index'){
            header('location: index.php');
        }else{
            header('location: todas_tarefas.php');
        }

    } else if ($acao == 'marcarRealizado'){
        
        $tarefa = new Tarefa();
        $tarefa->__set('id', $_GET['id']);
        $tarefa->__set('id_status', $_GET['id']);

        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefaService->marcarRealizado();

        if(isset($_GET['page']) && $_GET['page'] == 'index'){
            header('location: index.php');
        }else{
            header('location: todas_tarefas.php');
        }

    }


?>