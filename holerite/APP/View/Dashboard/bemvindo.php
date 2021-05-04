<?php includePartial('header', 'Shared') ?>
<body>
	<?php includePartial('menu', 'Shared', array('page' => 'cat')); ?>
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
				<h2 class="page-header">Avisos Mecatron</h1>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<?php foreach ($Data['noticia'] as $news): ?>
					<div class="panel panel-default" style="margin-top: 40px;">
						<div class="panel-body">
							<h2 style="color: #222; margin-top: 10px;"><?php echo $news->news_title ?></h2>
							<!-- <h3><?php echo $news->news_created ?></h3> -->
							<hr />
							<p><?php echo nl2br($news->news_text) ?></p>
							<?php if ($news->news_attachment): ?>
								<hr />
								<a class="btn btn-primary center btn-lg" href="<?php echo $news->news_attachment ?>"> <i class="fa fa-eye"></i> Visualizar Comunicado</a>
							<?php endif ?>
						</div>
						<div class="panel-footer">
							<p>Publicado em <?php echo timestampToBr($news->news_created, true, true) ?></p>
						</div>
					</div>
				<?php endforeach ?>
			</div>
		</div>
		
		<div class="col-sm-12">
			<p class="back-link">Mecatron - Pontes Rolantes</p>
		</div>
	</div><!--/.row-->
</div><!--/.main-->
</body>
</html>