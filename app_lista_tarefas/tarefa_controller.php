<?php
    
    require '../../app_lista_tarefas/tarefa.model.php';
    require '../../app_lista_tarefas/tarefa.service.php';
    require '../../app_lista_tarefas/conexao.php';

    $action = isset($_GET['acao']) ? $_GET['acao'] : $action;
    $page = isset($_GET['page']) ? $_GET['page'] : 'todas_tarefas';

    if($action == 'inserir') {
        $tarefa = new Tarefa();
        $tarefa->__set('tarefa', $_POST['tarefa']);

        $connection = new Conexao();
        $service = new TarefaService($connection, $tarefa);
        $service->insert();

        header('Location: nova_tarefa.php?inclusao=1');
        return;

    } else if($action == 'recuperar') {
        
        $tarefa = new Tarefa();
        $connection = new Conexao();
        $service = new TarefaService($connection, $tarefa);
        
        $tasks = $service->get();

    } else if($action == 'recuperar-pendentes') {

        $tarefa = new Tarefa();
        $connection = new Conexao();
        $service = new TarefaService($connection, $tarefa);
        
        $tasks = $service->getAllPendings();

    } else if($action == 'atualizar') {

        $tarefa = new Tarefa();
        $tarefa->__set('id', $_POST['id']);
        $tarefa->__set('tarefa', $_POST['tarefa']);

        $connection = new Conexao();
        $service = new TarefaService($connection, $tarefa);

        if($service->update()) header("Location: $page.php");

    } else if($action == 'remover') {
        
        $tarefa = new Tarefa();
        $tarefa->__set('id', $_GET['id']);

        $connection = new Conexao();
        $service = new TarefaService($connection, $tarefa);

        if($service->delete()) header("Location: $page.php");

    } else if($action == 'concluir') {

        $tarefa = new Tarefa();
        $tarefa->__set('id', $_GET['id']);

        $connection = new Conexao();
        $service = new TarefaService($connection, $tarefa);

        if($service->performTask()) header("Location: $page.php");
    }
?>