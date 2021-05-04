<?php includePartial('header', 'Shared');
$types = [
	'1' 	=> '<span class="label label-primary">admin</span>',
	'2'		=> '<span class="label label-info">comum</span>',
	'3'		=> '<span class="label label-default">inativo</span>',
];
?>
<body>
	<?php includePartial('menu', 'Shared', array('page' => 'hole')); ?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Bem vindo(a), <?php echo Session()->get('nome') ?></li>
			</ol>
		</div><!--/.row-->


		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header">
					<div class="col-md-6 pull-left">Listando Holerites de <?php echo $Data['documento_mes'] . '/' . $Data['documento_ano'] ?></div>
						<div class="col-md-6 pull-right">
					<a class="btn btn-success pull-right" id="confirm_delete" href="/Holerite/delete/mes/<?php echo $Data['documento_mes'] . '/ano/' . $Data['documento_ano'] ?>">Deletar todos</a>
					<?php if (@$Data['result']['success']): ?>
						<div class="alert alert-success" role="alert">
							<?php echo $Data['result']['success'] ?>
						</div>
						<?php elseif (@$Data['result']['error']): ?>
							<div class="alert alert-danger" role="alert">
								<?php echo $Data['result']['error'] ?>
							</div>
						<?php endif ?></div>
					</h2>
				</div>
			</div><!--/.row-->


			<div class="row">
				<div class="col-lg-12">
					<table class="table">
						<thead>
							<th width="100px">Ano</th>
							<th width="100px">Mês</th>
							<th>Registro</th>
							<th>Funcionário</th>
							<th></th>
						</thead>

						<?php foreach ($Data['list'] as $list): ?>
							<tr>
								<td><?php echo $list->documento_ano ?></td>
								<td><?php echo $list->documento_mes ?></td>
								<td><?php echo $list->funcionario_id ?></td>
								<td><?php echo (@$list->funcionario_nome) ? @$list->funcionario_nome . '<br />' . $types[$list->funcionario_type] : 'Funcionario não cadastrado <br> <a href="/Funcionarios/edit/'.$list->funcionario_id.'">Cadastrar Funcionário</a>' ?></td>

								<td>
									<a class="btn btn-default pull-right" href="<?php echo $list->documento_name ?>" target="_blank">Baixar Holerite</a>
								</td>
							</tr>
						<?php endforeach ?>
					</table>
				</div>
			</div>
		</div>
	</body>
	</html>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#confirm_delete').click(function(){ 
				return confirm("Deseja excluir os holerites deste mês?");
			});
		});
	</script>