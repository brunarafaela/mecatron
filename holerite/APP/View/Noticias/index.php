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
				<h2>
					<div class="col-md-6 pull-left">
						Avisos
					</div>
					<div class="col-md-6 pull-right">
						<a href="/Noticias/nova/" class="btn btn-primary pull-right">Novo Aviso</a> 		
					</div>
				</h2>
			</div>
		</div><!--/.row-->
		<hr />

		<div class="row">
			<div class="col-lg-12">
				<table class="table">
					<thead>
						<th>ID</th>
						<th>Título</th>
						<th>Data</th>
						<th></th>
					</thead>
					<?php foreach ($Data['list'] as $noticia): ?>
						<tr>
							<td><?php echo $noticia->news_id ?></td>
							<td><?php echo $noticia->news_title ?></td>
							<td><?php echo timestampToBr($noticia->news_created, true, true) ?></td>
							<td>
								<a class="btn btn-warning pull-right" style="margin-left: 20px" href="/Noticias/remover/<?php echo $noticia->news_id ?>">Remover</a>
								<a class="btn btn-default pull-right" href="/Noticias/edit/<?php echo $noticia->news_id ?>">Editar</a> 
							</td>
						</tr>						
					<?php endforeach ?>
				</table>
			</div>
		</div><!--/.row-->

	</div><!--/.row-->
</body>
</html>
