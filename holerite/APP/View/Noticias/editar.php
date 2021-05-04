<?php includePartial('header', 'Shared') ?>
<body>
	<?php includePartial('menu', 'Shared', array('page' => 'news')); ?>
	
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
				<h2 class="page-header"><a href="/Noticias/index">Avisos</a> - <?php echo (@$Data['form']) ? 'Editar' : 'Adicionar' ?></h2>
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
					<form method="post" action="/Noticias/_save/" enctype="multipart/form-data">
						<div class="panel panel-default">
							<div class="panel-heading"><?php echo (@$Data['form']) ? 'Editar' : 'Adicionar' ?> Aviso</div>
							<div class="panel-body">

								<input type="hidden" name="form_action" value="<?php echo @$Data['form']->news_id ? "edit" : "create" ?>" />

								<?php if (@$Data['form']->news_id): ?>
									<input type="hidden" name="news_id" value="<?php echo @$Data['form']->news_id ?>" />	
								<?php endif ?>

								<div class="form-group">
									<label>Título</label>
									<input type="text" name="news_title" class="form-control" placeholder="Título da Notícia" value="<?php echo @$Data['form']->news_title ?>" />
								</div>

								<div class="form-group">
									<!-- <label>Subtítulo</label> -->
									<input type="hidden" name="news_subtitle" class="form-control" placeholder="Subtítulo da Notícia" value="0" />
								</div>

								<div class="form-group">
									<label>Texto da Notícia</label>
									<textarea name="news_text" style="height: 200px;" class="form-control" placeholder="Notícia"><?php echo @$Data['form']->news_text ?></textarea>
								</div>

								<div class="form-group">
									<label>Anexo</label>
									<input type="file" accept="application/pdf" name="file" class="form-control" placeholder="Selecionar arquivo" />
								</div>

							</div>

							<div class="panel-footer">
								<div class="form-group" style="padding-top: 10px;">

									<input type="submit" class="btn btn-success pull-right" value="<?php echo @$Data['form']->funcionario_id ? "Editar" : "Adicionar" ?>" />

									<div class="clear"></div>
								</div>

							</div>
						</div>
					</form>
				</div>
			</div>

		</div><!--fim row-->
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			setInterval(function(){
					// não mata sessão de usuário por inatividade
					$.get('/Noticias/random', function(data) {
					});

				}, 60000);
		});
	</script>
</body>
</html>