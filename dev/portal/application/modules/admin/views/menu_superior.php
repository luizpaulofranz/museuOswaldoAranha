<!-- Administrativo - Módulos -->
<ul class="nav navbar-nav">

    <li class="dropdown">
        <a href="#" class="dropdown-toggle alteraFonte" data-toggle="dropdown">
            Administrador <b class="caret"></b><!--A classe caret exibe a setinha do dropdown-->
        </a>
        <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo base_url('admin/administrador/cadastrar'); ?>" class="alteraFonte"><span class="glyphicon glyphicon-plus"></span> Adicionar</a></li>
            <li><a href="<?php echo base_url('admin/administrador/pg'); ?>" class="alteraFonte"><span class="glyphicon glyphicon-th-list"></span> Listar</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo base_url('admin/administrador/alterar/' . $this->session->userdata('idAdministrador')); ?>" class="alteraFonte"><span class="glyphicon glyphicon-user"></span> Meu perfil</a></li>
        </ul>
    </li>
    
    <li class="dropdown">
        <a href="#" class="dropdown-toggle alteraFonte" data-toggle="dropdown">
            Aprenda <b class="caret"></b><!--A classe caret exibe a setinha do dropdown-->
        </a>
        <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo base_url('admin/conteudo/acervo-cientifico'); ?>" class="alteraFonte"><span class="glyphicon glyphicon-edit"></span> Acervo Científico</a></li>
            <li><a href="<?php echo base_url('admin/conteudo/acervo-museu'); ?>" class="alteraFonte"><span class="glyphicon glyphicon-edit"></span> Acervo Museu</a></li>
        </ul>
    </li>

    <li>
        <a href="<?php echo base_url('admin/conteudo/noticias'); ?>" class="alteraFonte"> Notícias</a>
    </li>
    
    <li>
        <a href="<?php echo base_url('admin/conteudo/eventos'); ?>" class="alteraFonte"> Eventos</a>
    </li>
    
</ul>
<ul class="nav navbar-nav navbar-right">
    <a class="btn btn-danger btn-sair alteraFonte" href="<?php echo base_url('admin/logout'); ?>" role="button"><span class="glyphicon glyphicon-log-out "></span> Sair</a>
</ul>


