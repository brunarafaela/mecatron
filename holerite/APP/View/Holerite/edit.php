<?php includePartial('header', 'Shared');
$meses = [
	'Selecione o mês',
	'Janeiro',
	'Fevereiro',
	'Março',
	'Abril',
	'Maio',
	'Junho',
	'Julho',
	'Agosto',
	'Setembro',
	'Outubro',
	'Novembro',
	'Dezembro',
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
					<a href="/Holerite/index">Holerites</a> - <?php echo (@$Data['form']) ? 'Editar' : 'Adicionar' ?>
				</h2>
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
					<form method="post" action="/Holerite/_save/" enctype="multipart/form-data">
						<div class="panel panel-default">
							<div class="panel-heading">Adicionar novos holerites</div>
							<div class="panel-body">
								<?php if (@$Data['form']): ?>
									<input type="hidden" name="category_id" value="<?php echo $Data['form']->org_id ?>" />
								<?php endif ?>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Mês</label>
											<select type="number" name="mes" class="form-control" placeholder="Mês de referência">
												<?php foreach ($meses as $key => $value): ?>
													<option value="<?php echo $key ?>" ><?php echo $value ?></option>
												<?php endforeach ?>
											</select>
										</div>	
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Ano</label>
											<input type="number" name="ano" class="form-control" placeholder="Ano de referência" />
										</div>	
									</div>
								</div>
								<div class="form-group">
									<label>Arquivos</label>
									<input type="file" accept="application/pdf" name="file[]" class="form-control" placeholder="Selecionar arquivos" multiple />
								</div>
								<div class="form-group">
									<input type="submit" class="btn btn-success pull-right" value="Adicionar Holerites" />
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
	</html>