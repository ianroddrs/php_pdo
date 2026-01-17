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
            $query = '
                SELECT 
                    T.ID, S.STATUS, TAREFA 
                FROM TB_TAREFAS AS T
                LEFT JOIN TB_STATUS AS S ON (T.ID_STATUS = S.ID)
                ';
            $stmt = $this->conexao->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
                
        public function atualizar(){
            $query = '
                UPDATE TB_TAREFAS
                SET TAREFA = ? WHERE ID = ?
            ';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(1, $this->tarefa->__get('tarefa'));
            $stmt->bindValue(2, $this->tarefa->__get('id'));
            return $stmt->execute();
        }
        
        public function remover(){
            $query = '
            DELETE FROM TB_TAREFAS
            WHERE ID = ?
            ';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(1, $this->tarefa->__get('id'));
            $stmt->execute();
        }

        public function marcarRealizado(){
            $query = '
                UPDATE TB_TAREFAS
                SET ID_STATUS = ? WHERE ID = ?
            ';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(1, $this->tarefa->__get('id_status'));
            $stmt->bindValue(2, $this->tarefa->__get('id'));
            return $stmt->execute();
        }

    }
?>


