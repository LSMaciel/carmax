<?php
include 'partials/header.php';

//buscar users do banco de dados 
$current_admin_id = $_SESSION['user-id'];

$query = "SELECT * FROM produtos";
$produtos = mysqli_query($connection, $query);


?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Admin Carmax</title>
</head>

<body>
    <div class="container principal">
        <?php
        include 'partials/aside.php';
        ?>
        <!--============================ FIM MENU LATERAL ===========================-->
        <main class="dashboard">
            <h1>Configurações do Site</h1>
            <hr>

            <?php if (isset($_SESSION['add-produto-success'])) : ?><!-- Mensagem produto ADICIONADO com sucesso -->
                <div class="alert__message success">
                    <p>
                        <?= $_SESSION['add-produto-success'];
                        unset($_SESSION['add-produto-success']);
                        ?>
                    </p>

                </div>
            <?php elseif (isset($_SESSION['delete-produto-success'])) : ?> <!-- Mensagem produto DELETADO com sucesso -->
                <div class="alert__message success">
                    <p>
                        <?= $_SESSION['delete-produto-success'];
                        unset($_SESSION['delete-produto-success']);
                        ?>
                    </p>
                </div>
            <?php elseif (isset($_SESSION['delete-produto'])) : ?> <!-- Mensagem de erro produto não DELETADO-->
                <div class="alert__message error">
                    <p>
                        <?= $_SESSION['delete-produto'];
                        unset($_SESSION['delete-produto']);
                        ?>
                    </p>
                </div>
                <?php elseif (isset($_SESSION['edit-produto-success'])) : ?> <!-- Mensagem produto EDITADO com sucesso -->
                <div class="alert__message success">
                    <p>
                        <?= $_SESSION['edit-produto-success'];
                        unset($_SESSION['edit-produto-success']);
                        ?>
                    </p>
                </div>
                
            <?php endif ?>

            
          <!-- Nav tabs -->
			  <ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#dados_pessoais" aria-controls="home" role="tab" data-toggle="tab">Dados Pessoais</a></li>
				<li role="presentation"><a href="#dados_de_acesso" aria-controls="dados_de_acesso" role="tab" data-toggle="tab">Dados de Acesso</a></li>
				<li role="presentation"><a href="#endereco" aria-controls="endereco" role="tab" data-toggle="tab">Endereço</a></li>
			  </ul>

			  <!-- Tab panes -->
			  <div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="dados_pessoais">
					<div style="padding-top:20px;">
						<form class="form-horizontal" action="" method="POST">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nome</label>
                                <div class="col-sm-10">
                                    <input type="text" name='nome' class="form-control" id="nome" placeholder="Nome Completo" value="<?php if(isset($_SESSION['nome'])){ echo $_SESSION['nome']; }?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">CPF</label>
                                <div class="col-sm-10">
                                    <input type="text" name='cpf' class="form-control" id="cpf" placeholder="CPF" value="<?php if(isset($_SESSION['cpf'])){ echo $_SESSION['cpf']; } ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-success">Cadastrar</button>
                                </div>
                            </div>
                        </form>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="dados_de_acesso">
					<div style="padding-top:20px;">
					 <form class="form-horizontal"  action="" method="POST">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Usuário</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="usuario" placeholder="Usuário">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Senha</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="senha" placeholder="Senha">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-success">Cadastrar</button>
                                </div>
                            </div>
                        </form>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="messages">
				
				</div>
			  </div>

			</div>
		</div>
</main>
</div>

</body>

</html>