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
					Meus holerites
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
					<table class="table">
						<thead>
							<th width="100px">Ano</th>
							<th width="">Mês</th>
							<th></th>
						</thead>
						<?php if (! @$Data['list']): ?>
							<tr>
								<td colspan="5" class="text-center"><strong><br /><br />Nenhum Holerite Encontrado.</strong></td>
							</tr>
						<?php else: 
							$suplementar = 0;?>
							<?php foreach ($Data['list'] as $list): ?>
								<?php if($list->documento_mes == $suplementar) { ?>
									<tr style="background: #eee">
										<td><?php echo $list->documento_ano ?></td>
										<td><?php echo $list->documento_mes ?> <div class="badge badge-primary">complementar</div></td>
									<?php } else { ?>
										<tr>
											<td><?php echo $list->documento_ano ?></td>
											<td><?php echo $list->documento_mes ?></td>
										<?php } ?>
										<?php $suplementar = $list->documento_mes; ?>
										<td>
											<a class="btn btn-default pull-right" href="<?php echo $list->documento_name ?>" target="_blank">Baixar Holerite</a>
										</td>
									</tr>
								<?php endforeach ?>
							<?php endif ?>
						</table>
					</div>
				</div>
			</div>
		</body>
		</html>