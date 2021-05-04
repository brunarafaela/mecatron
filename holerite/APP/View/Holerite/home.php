<?php includePartial('header', 'Shared') ?>
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
					<div class="col-md-6 pull-left">Listando Holerites Cadastrados</div> 
					<?php if (Session()->get('tipo') == 1): ?>
					<div class="col-md-3 pull-left"><a href="/Holerite/meus" class="btn btn-success pull-right">Ver meus holerites</a></div>
				<?php endif ?> 
				<div class="col-md-3 pull-right">
					<a href="/Holerite/adicionar/" class="btn btn-success pull-right">Adicionar Holerites</a>
				</div>
			</h1>
		</div>
	</div><!--/.row-->

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
				<table class="table">
					<thead>
						<th width="100px">Ano</th>
						<th width="100px">Mês</th>
						<th width="100px">Holerites</th>
						<th></th>
					</thead>

					<?php foreach ($Data['list'] as $list): ?>
						<tr>
							<td><?php echo $list->documento_ano ?></td>
							<td><?php echo $list->documento_mes ?></td>
							<td><?php echo $list->total ?></td>

							<td>
								<a class="btn btn-default pull-right" href="/Holerite/listar/ano/<?php echo $list->documento_ano ?>/mes/<?php echo $list->documento_mes ?>">Editar</a>
							</td>
						</tr>
					<?php endforeach ?>
				</table>
			</div>
		</div>
	</div>
</body>
</html>