<?php

    // CRUD
    class TarefaService {

        private $conexao;
        private $tarefa;

        public function __construct(Conexao $conexao, Tarefa $tarefa){
            $this->conexao = $conexao->conectar();
            $this->tarefa = $tarefa;
        }
        
        public function inserir(){
            $query = 'INSERT INTO TB_TAREFAS(TAREFA) VALUES (:TAREFA)';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':TAREFA', $this->tarefa->__get('tarefa'));
            $stmt->execute();
        }
            
        public function recuperar(){
            $query = 'SELECT ID, ID_STATUS, TAREFA FROM TB_TAREFAS';
            $stmt = $this->conexao->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
                
        public function atualizar(){
            
        }

        public function remover(){

        }
    }


?>


