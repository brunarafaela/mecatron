<?php includePartial('header', 'Shared');
$types = [
	'1' 	=> '<span class="label label-primary">administrativo</span>',
	'2'		=> '<span class="label label-info">operacional</span>',
];
$status = [
	'0'     => '',
	'1' 	=> '<span class="label label-primary">ativo</span>',
	'2'		=> '<span class="label label-info">inativo</span>',
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

		<div class="row">
			<div class="col-lg-12">
				<h2>
					<div class="col-md-6 pull-left">
						<?php echo @$Data['query'] ? 'Buscando' : 'Listando' ?> Funcionários <?php echo ($Data['filter']) ? ucfirst(strip_tags($status[$Data['filter']])) . 's' : ''  ?>
					</div>
					<div class="col-md-6 pull-right">
						<div class="input-group">
							<input type="text" value="<?php echo @$Data['query'] ?>" class="form-control" id="txt_busca" placeholder="Buscar funcionario...">
							<span class="input-group-btn">
								<button class="btn btn-default" id="btn_buscar" type="button">Buscar</button>
							</span>
						</div><!-- /input-group -->
					</div>
				</h2>
			</div>
		</div><!--/.row-->
		<hr />

		<div class="row">
			<div class="col-lg-12">
				Filtrar funcionários:
				<a class="btn btn-default" href="/Funcionarios/index/">Todos</a>
				<a class="btn btn-default" href="/Funcionarios/index/filter/1">Ativos</a>
				<a class="btn btn-default" href="/Funcionarios/index/filter/2">Inativos</a>
				<div class="col-md-6 pull-right"><a class="btn btn-primary pull-right" href="/Funcionarios/edit">Adicionar Funcionário</a></div>
			</div>
		</div><!--/.row-->
		<hr />
		<table class="table">
			<thead>
				<th>Registro</th>
				<th>Nome</th>
				<th>Status</th>
			</thead>
			<?php if (! $Data['list']): ?>
				<tr>
					<td colspan="6" class="text-center"><br /><br /><strong>⛔️ Nenhum funcionário encontrado</strong></td>
				</tr>
				<?php else: ?>
					<?php foreach ($Data['list'] as $list): ?>
						<tr>
							<td><?php echo $list->funcionario_id ?></td>
							<td><strong><?php echo $list->funcionario_nome ?></strong></td>
							<td><?php echo $status[$list->funcionario_status] ?></td>
							<td>
								<a class="btn btn-default pull-right" href="/Funcionarios/edit/<?php echo $list->funcionario_id ?>">Gerenciar</a>
							</td>
						</tr>
					<?php endforeach ?>
				<?php endif ?>
			</table>
			<center>
				<div class="pagination"><?php echo $Data['pager'] ?></div>
			</center>
			<div class="col-lg-12">
				<p class="back-link">Mecatron - Pontes Rolantes</p>
			</div>
		</div><!--/.main-->
	</body>
	</html>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#btn_buscar').click(function(){
				var busca = $('#txt_busca').val();

				location.href = '/Funcionarios/index/search/' + busca;
			})

			$('#txt_busca').keydown(function(e){
				if (e.keyCode == 13) {
					$('#btn_buscar').trigger('click');
				}
			})
		})
	</script>