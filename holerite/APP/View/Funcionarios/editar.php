<?php includePartial('header', 'Shared');
$types = [
	"Selecione",
	"Administrativo",
	"Operacional",
];
$status = [
	"Selecione",
	"Ativo",
	"Inativo",
];
?>
<body>
	<?php includePartial('menu', 'Shared', array('page' => 'func')); ?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Bem vindo(a), <?php echo Session()->get('nome') ?></li>
			</ol>
		</div><!--/.row-->
		
		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Alterar Senha</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form method="post" action="/Funcionarios/_edit_password">
						<div class="modal-body">
							<input type="hidden" name="funcionario_id" value="<?php echo @$Data['form']->funcionario_id ?>" />
							<div class="form-group">
								<label>Senha</label>

								<a style = "cursor:Pointer"class="" data-toggle="popover" title="Dica de senha" data-content="Deve conter pelo menos um número e uma letra maiúscula e minúscula e pelo menos 8 ou mais caracteres"><i class="fa fa-question-circle"></i></a>
								<div class="input-group" id="show_hide_password">
									<input onkeyup="validarSenhaForca()" type="password" name="funcionario_hash" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" id="senha1" class="form-control"  placeholder="Digite a nova senha" required>
									<div class="input-group-addon" style="padding: 10px 15px;margin-bottom: 0;font-size: 17px;font-weight: 400;line-height: 1.25;color: #495057;text-align: center;background-color: #e9ecef;border: 1px solid rgba(0,0,0,.15);border-radius: .25rem;border-left: 0px;border-top-left-radius: 0px; border-bottom-left-radius: 0px;">
										<a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>      
									</div>
								</div>
								<div class="form-group">
									<div id="erroSenhaForca">

									</div>
									<div class = "input-group" id = "impForcaSenha"></div>
									<div id="erroSenhaForca">
									</div>
								</div>							</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
								<button type="submit" onsubmit="validar()" onclick="return vSenha()" class="btn btn-primary">Alterar Senha</button>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12">
					<h2 class="page-header">
						<a href="/Funcionarios/index">Funcionários</a> - <?php echo (@$Data['form']) ? 'Editar' : 'Adicionar' ?></h2>
						<hr>
					</div>
				</div>

				<?php if (@$Data['result']['success']): ?>
					<div class="alert alert-success" role="alert">
						<?php echo $Data['result']['success'] ?>
					</div>
					<?php elseif (@$Data['result']['error']): ?>
						<div class="alert alert-danger" role="alert">
							<?php echo $Data['result']['error'] ?>
						</div>
					<?php endif ?>

					<div class="row">
						<div class="col-lg-12">

							<form method="post" action="/Funcionarios/_save/">
								<div class="panel panel-default">
									<div class="panel-heading"><?php echo @$Data['form']->funcionario_id ? "Editar" : "Adicionar novo" ?> <?php echo @$Data['form']->funcionario_nome ?></div>
									<div class="panel-body">
										<input type="hidden" name="form_action" value="<?php echo @$Data['form']->funcionario_id ? "edit" : "create" ?>" />
										<div class="form-group">
											<label>Registro Funcionario</label>
											<input type="text" <?php echo @$Data['form']->funcionario_id ? "readonly=\"readonly\"" : "" ?> name="funcionario_id" class="form-control" placeholder="Registro do Funcionario" value="<?php echo $Data['id'] ? $Data['id'] : @$Data['form']->funcionario_id ?>" />
										</div>

										<div class="form-group">
											<label>Nome Funcionario</label>
											<input type="text" name="funcionario_nome" class="form-control" placeholder="Nome do Funcionario" value="<?php echo @$Data['form']->funcionario_nome ?>" />
										</div>

										<div class="form-group">
											<label>Função</label>
											<input type="text" name="funcionario_funcao" class="form-control" placeholder="Nome da função" value="<?php echo @$Data['form']->funcionario_funcao ?>" />
										</div>

										<div class="form-group">
											<label>Divisão</label>
											<input type="text" name="funcionario_divisao" class="form-control" placeholder="Número da divisão" value="<?php echo @$Data['form']->funcionario_divisao ?>" />
										</div>


										<div class="form-group">
											<label>CPF</label>
											<input type="text" name="funcionario_cpf" class="form-control" placeholder="CPF" value="<?php echo @$Data['form']->funcionario_cpf ?>" />
										</div>

										<div class="form-group">
											<label>Tipo de funcionário</label>

											<select class="form-control" name="funcionario_tipo">
												<?php foreach ($types as $key => $value): ?>
													<option <?php echo ($key == @$Data['form']->funcionario_type) ? "selected" : "" ?> value="<?php echo $key ?>"><?php echo $value ?></option>
												<?php endforeach ?>
											</select>
										</div>

										<div class="form-group">
											<label>Status</label>

											<select class="form-control" name="funcionario_status">
												<?php foreach ($status as $key => $value): ?>
													<option <?php echo ($key == @$Data['form']->funcionario_status) ? "selected" : "" ?> value="<?php echo $key ?>"><?php echo $value ?></option>
												<?php endforeach ?>

											</select>
										</div>

										<?php if (! @$Data['form']): ?>
											<div class="form-group">
												<label>Senha</label>
												<input type="password" name="funcionario_hash" class="form-control" placeholder="Senha" value="<?php echo @$Data['form']->funcionario_hash ?>" />
											</div>
										<?php endif; ?>

										<hr />

										<h2>Informações Pessoais</h2>

										<div class="form-group">
											<label>Rua e Número</label>
											<input type="text" name="funcionario_rua" class="form-control" placeholder="Rua e número" value="<?php echo @$Data['form']->funcionario_rua ?>" />
										</div>

										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Bairro</label>
													<input type="text" name="funcionario_bairro" class="form-control" placeholder="Bairro" value="<?php echo @$Data['form']->funcionario_bairro ?>" />
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>CEP</label>
													<input type="text" name="funcionario_cep" class="form-control" placeholder="CEP" value="<?php echo @$Data['form']->funcionario_cep ?>" />
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Estado</label>
													<input type="text" name="funcionario_estado" class="form-control" placeholder="Estado" value="<?php echo @$Data['form']->funcionario_estado ?>" />
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Cidade</label>
													<input type="text" name="funcionario_cidade" class="form-control" placeholder="Cidade" value="<?php echo @$Data['form']->funcionario_cidade ?>" />
												</div>
											</div>
										</div>

										<div class="form-group">
											<label>Telefones</label>
											<input type="text" name="funcionario_telefone" class="form-control" placeholder="Telefones" value="<?php echo @$Data['form']->funcionario_telefone ?>" />
										</div>

									</div>

									<div class="panel-footer">
										<div class="form-group" style="padding-top: 10px;">

											<?php if (Session()->get('tipo') == 1): ?>
											<?php if (@$Data['form']): ?>
												<button type="button" class="btn btn-default" data-toggle="modal" data-target="#exampleModal">Alterar Senha</button>
											<?php endif ?>
										<?php endif ?>

										<input type="submit" class="btn btn-success" value="<?php echo @$Data['form']->funcionario_id ? "Editar" : "Adicionar" ?> funcionário" />
									</div>

								</div>
							</div>
						</form>
					</div>
				</div>

				<div class="panel panel-default">
					<div class="panel-heading">Lista de Holerites de <?php echo @$Data['form']->funcionario_nome ?></div>
					<div class="panel-body">
						<table class="table">
							<thead>
								<th>Mês</th>
								<th>Ano</th>
								<th>Adicionado</th>
								<th></th>
							</thead>
							<?php if (@$Data['holerites']):
								$suplementar = 0; ?>
								<?php foreach ($Data['holerites'] as $list): ?>
									<?php if($list->documento_mes == $suplementar) { ?>
										<tr>
											<td><?php echo $list->documento_ano ?></td>
											<td><?php echo $list->documento_mes ?> <div class="badge badge-primary">complementar</div></td>
											<td><?php echo $list->documento_adicionado ?></td>
										<?php } else { ?>
											<tr>
												<td><?php echo $list->documento_ano ?></td>
												<td><?php echo $list->documento_mes ?></td>
												<td><?php echo $list->documento_adicionado ?></td>
											<?php } ?>
											<?php $suplementar = $list->documento_mes; ?>
											<td>
												<a class="btn btn-default pull-right" href="<?php echo $list->documento_name ?>" target="_blank">Baixar Holerite</a>
											</td>
										</tr>
									<?php endforeach ?>
									<?php else: ?>
										<tr>
											<td colspan="4" class="text-center">
												Nenhum holerite encontrado.
											</td>
										</tr>
									<?php endif ?>									
								</table>
							</div>
						</div>
					</div>
				</div><!-- Fim row -->
			</div><!--Fim col -->
		</body>
		</html>
		<script type="text/javascript">
			function setError(error) {
				$('#alertbox').html('');
				$('#alertbox').append('<div class="alert alert-danger" role="alert">'+error+'</div>');
			}
		</script>

		<script type="text/javascript" language="JavaScript">
			function validarSenhaForca(){
				var senha = document.getElementById('pass').value;
				var forca = 0;

				if((senha.length >= 4) && (senha.length <= 7)){
					forca += 10;
				}else if(senha.length > 7){
					forca += 25;
				}

				if((senha.length >= 5) && (senha.match(/[a-z]+/))){
					forca += 10;
				}

				if((senha.length >= 6) && (senha.match(/[A-Z]+/))){
					forca += 20;
				}

				if((senha.length >= 7) && (senha.match(/[@#$%&;*]/))){
					forca += 25;
				}

				if(senha.match(/([1-9]+)\1{1,}/)){
					forca += -25;
				}

				mostrarForca(forca);
			}

			function mostrarForca(forca){
				if(forca < 30 ){
					document.getElementById("erroSenhaForca").innerHTML = 'Força da Senha<div class="progress"><div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div></div>';
				}else if((forca >= 30) && (forca < 50)){
					document.getElementById("erroSenhaForca").innerHTML = 'Força da Senha<div class="progress"><div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div></div>';
				}else if((forca >= 50) && (forca < 70)){
					document.getElementById("erroSenhaForca").innerHTML = 'Força da Senha<div class="progress"><div class="progress-bar bg-info" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div></div>';
				}else if((forca >= 70) && (forca < 100)){
					document.getElementById("erroSenhaForca").innerHTML = 'Força da Senha<div class="progress"><div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div>';
				}
			}

			$(function () {
				$('[data-toggle="popover"]').popover()
			})

			$(document).ready(function() {
				$("#show_hide_password a").on('click', function(event) {
					event.preventDefault();
					if($('#show_hide_password input').attr("type") == "text"){
						$('#show_hide_password input').attr('type', 'password');
						$('#show_hide_password i').addClass( "fa-eye-slash" );
						$('#show_hide_password i').removeClass( "fa-eye" );
					}else if($('#show_hide_password input').attr("type") == "password"){
						$('#show_hide_password input').attr('type', 'text');
						$('#show_hide_password i').removeClass( "fa-eye-slash" );
						$('#show_hide_password i').addClass( "fa-eye" );
					}
				});
			});
		</script> 