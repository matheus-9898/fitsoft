<?php 
    class painel{

        public static function login(){
            if(isset($_SESSION['login']) && $_SESSION['login'] == true){
                return true;
            }else{
                return false;
            }
        }

        public static function logout(){
            $_SESSION['login'] = false;
            session_destroy();
        }

        public static function carregarPaginas(){
            if(isset($_GET['meu-perfil']))
                include('meu-perfil.php');
            else if(isset($_GET['unidades']))
                include('config_unidades.php');
            else if(isset($_GET['exercicios']))
                include('config_exercicios.php');
            else if(isset($_GET['despesas']))
                include('config_despesas.php');
            else if(isset($_GET['alunos']))
                include('alunos.php');
            else if(isset($_GET['avaliacao-fisica']))
                include('avafis.php');
            else if(isset($_GET['lancamentos']))
                include('financ_lancamentos.php');
            else if(isset($_GET['analise']))
                include('financ_analise.php');
            else
                include('dashboard.php');
        }

        public static function pegarDadosPerfil(){
            $sql = mysql::conexaoBD()->prepare('SELECT * FROM usuarios_adm WHERE id=?');
            $sql->execute(array($_SESSION['id']));
        
            $info = $sql->fetchAll(PDO::FETCH_ASSOC);
    
            return $info;
        }

        public static function alterarDadosPerfil(){

            $nomeImg = $_SESSION['foto'];

            if(isset($_FILES['imagem'])){

                if(($_FILES['imagem']['type'] == 'image/jpeg' || $_FILES['imagem']['type'] == 'image/jpg' || $_FILES['imagem']['type'] == 'image/png')  && $_FILES['imagem']['size']/1024 < 300){

                    unlink('../uploads/foto-perfil/'.$_SESSION['foto']);
                    
                    move_uploaded_file($_FILES['imagem']['tmp_name'],'../uploads/foto-perfil/'.$_FILES['imagem']['name']);

                    $nomeImg = $_FILES['imagem']['name'];
                }else{
                    echo "<script> alert('Erro ao enviar a imagem')</script>";
                }
            }

            $sql = mysql::conexaoBD()->prepare('UPDATE usuarios_adm SET nome=?, email=?,telefone=?,foto=?,senha=? WHERE id=?');

            //atenção adicionar imagem no array
            $sql->execute(array($_POST['nome'],$_POST['email'],$_POST['telefone'],$nomeImg,$_POST['senha'],$_SESSION['id']));
    
            $_SESSION['nome']=$_POST['nome'];
            $_SESSION['email']=$_POST['email'];
            $_SESSION['foto']=$nomeImg;
        }

        public static function removerFotoPerfil(){
            //removendo foto perfil do BD
            $sql = mysql::conexaoBD()->prepare('UPDATE usuarios_adm SET foto=? WHERE id=?');
            
            $sql->execute(array('',$_SESSION['id']));
            
            //apagando foto da pasta upload
            unlink('../uploads/foto-perfil/'.$_SESSION['foto']);
            
            $_SESSION['foto'] = '';
        }
    }
?>