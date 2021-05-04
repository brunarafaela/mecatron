	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
					<a class="navbar-brand" href="https://rh.mecatron.com.br/Dashboard/index/"> <img src="/imgs/logo.png"> <span>RH</span>Mecatron</a>
				</div>
			</div><!-- /.container-fluid -->
		</nav>

		<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
			<div class="profile-sidebar">
			<!-- 	<div class="profile-userpic">
					<img src="/imgs/logo.png">
				</div> -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name"> <?php echo Session()->get('nome') ?></div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="divider"></div>
			<ul class="nav menu">
				<li <?php echo ($pData['page'] == 'dash') 	? 'class="active"' : ''; ?>> <a href="/Dashboard/index/"><em class="fa fa-home">&nbsp;</em> Início</a></li>
				<?php if (Session()->get('tipo') == '1'): ?>
				<li <?php echo ($pData['page'] == 'func') 	? 'class="active"' : ''; ?>><a href="/Funcionarios/index/"><em class="fa fa-user">&nbsp;</em> Funcionários</a></li>
			<?php endif ?>
			<li <?php echo ($pData['page'] == 'hole') 	? 'class="active"' : ''; ?>><a href="/Holerite/index/"><em class="fa fa fa-calendar">&nbsp;</em> Holerites</a></li>
			<?php if (Session()->get('tipo') == '1'): ?>
			<li <?php echo ($pData['page'] == 'news') 	? 'class="active"' : ''; ?>><a href="/Noticias/index"><em class="fa fa-newspaper-o">&nbsp;</em> Avisos</a></li>
		<?php endif ?>
		<li  <?php echo ($pData['page'] == 'pref') 	? 'class="active"' : ''; ?>><a href="/Dashboard/pref/"><em class="fa fa-wrench">&nbsp;</em> Atualizações</a></li>
		<li><a href="/Index/logout/"><em class="fa fa-power-off">&nbsp;</em> Sair</a></li>
	</ul>
	</div><!--/.sidebar-->