<?php 
    class alunos{

        public static function excluirAluno(){
            $sql = mysql::conexaoBD()->prepare('DELETE FROM alunos WHERE id=?');
        
            $sql->execute(array($_GET['excluirAluno']));
    
            header('Location:'.PATH_PAINEL.'?alunos');
        }

        public static function pegandoAlunos(){
            $sql = mysql::conexaoBD()->prepare('SELECT * FROM alunos');

            $sql->execute();
        
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function pegandoDadosAlunoEditar(){
            $sql = mysql::conexaoBD()->prepare('SELECT * FROM alunos WHERE id=?');
    
            $sql->execute(array($_GET['editarAluno']));
        
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function editandoAluno(){
            $sql = mysql::conexaoBD()->prepare('UPDATE alunos SET nome=?,email=?,telefone=?,nascimento=?,sexo=?,id_unidade=? WHERE id=?');
    
            $sql->execute(array($_POST['nome'],$_POST['email'],$_POST['telefone'],$_POST['nascimento'], $_POST['sexo'], $_POST['unidade'], $_GET['editarAluno']));
        }

        public static function cadastrandoAluno(){
            $sql = mysql::conexaoBD()->prepare('INSERT INTO alunos VALUES (null,?,?,?,?,?,?,?)');
    
            $sql->execute(array($_POST['nome'],$_POST['email'],$_POST['telefone'],$_POST['nascimento'],date('Y-m-d'), $_POST['sexo'], $_POST['unidade']));
        }

        public static function pegandoUnidades(){
            $sql = mysql::conexaoBD()->prepare('SELECT * FROM unidades');

            $sql->execute();
        
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }

    }

?>