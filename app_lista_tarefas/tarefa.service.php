<?php

    class TarefaService {

        private $connection;
        private $tarefa;

        public function __construct(Conexao $connection, Tarefa $tarefa) {
            $this->connection = $connection->connect();
            $this->tarefa = $tarefa;
        }

        public function insert() {
            $query = 'INSERT INTO `tb_tarefas` (`tarefa`) VALUES (:tarefa);';

            $statement = $this->connection->prepare($query);
            $statement->bindValue(':tarefa', $this->tarefa->__get('tarefa'));

            $statement->execute();
        }

        public function get() {
            $query = '
                SELECT t.id, t.tarefa, st.status FROM `tb_tarefas` AS t LEFT JOIN `tb_status` AS st ON (t.id_status = st.id);
            ';

            $statement = $this->connection->prepare($query);
            $statement->execute();
            
            return $statement->fetchAll(PDO::FETCH_OBJ);
        }

        public function getAllPendings() {
            $query = '
                SELECT id, tarefa FROM `tb_tarefas` WHERE `id_status` = ?;
            ';

            $statement = $this->connection->prepare($query);
            $statement->bindValue(1, 1);
            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_OBJ);
        }

        public function update() {
            $query = '
                UPDATE `tb_tarefas` SET `tarefa` = ? WHERE `id` = ?;
            ';

            $statement = $this->connection->prepare($query);
            $statement->bindValue(1, $this->tarefa->__get('tarefa'));
            $statement->bindValue(2, $this->tarefa->__get('id'), PDO::PARAM_INT);

            return $statement->execute();
        }

        public function performTask() {
            $query = '
                UPDATE `tb_tarefas` SET `id_status` = ? WHERE `id` = ?;
            ';

            $statement = $this->connection->prepare($query);
            $statement->bindValue(1, 2);
            $statement->bindValue(2, $this->tarefa->__get('id'));
            
            return $statement->execute();
        }

        public function delete() {
            $query = '
                DELETE FROM `tb_tarefas` WHERE `id` = ?;
            ';

            $statement = $this->connection->prepare($query);
            $statement->bindValue(1, $this->tarefa->__get('id'));
            
            return $statement->execute();
        }
    }

?>