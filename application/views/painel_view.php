<!doctype html>
<html class="no-js" lang="pt-br">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php if (isset($titulo)): ?>{titulo}  | <?php endif; ?>{titulo_padrao}</title>
    <!-- Included CSS Files (Compressed)  funcoes_helper/init_painel-->
    {headerinc}
  </head>
        <body>
                 <?php if(esta_logado(FALSE)): ?>
                <div class="row header">
                    <div class="small-8 columns">
                        <a href="<?php echo base_url('painel'); ?>"><h1>Painel ADM</h1></a>
                    </div>
                    <div class="small-4 columns">
                        <p class="text-right">Logado como <strong><?php echo $this->session->userdata('user_nome'); ?></strong></p>
                        <p class="text-right">
                            <?php echo anchor('usuarios/alter_senha/'.$this->session->userdata('user_id'), 'Alterar senha', 'class="button radius tiny" '); ?>
                            <?php echo anchor('usuarios/logoff/', 'Sair', 'class="button radius tiny alert" '); ?>
                        </p>
                    </div>
                </div><!--Fim do cabeçalho canto direito-->

                <div class="row">
                    <div class="small-12 columns menu-site">

                        <nav class="top-bar" data-topbar role="navigation">
                          <ul class="title-area">
                                <li class="name"><!-- Leave this empty --></li>
                          </ul>
                             <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
                            <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
                          </ul>

                          <section class="top-bar-section">
                            <!-- Left Nav Section -->
                            <ul class="left">
                              <li><?php echo anchor('painel', 'Inicio'); ?></li>
                              <li class="divider"></li>
                              <li class="has-dropdown not-click">
                                <?php echo anchor('usuarios/gerenciar', 'Gerenciar'); ?>
                                <ul class="dropdown">
                                    <li><?php echo anchor('usuarios/gerenciar', 'Usuarios'); ?></li>
                                     <li><?php echo anchor('usuarios/cadastrar', 'Cadastrar'); ?></li>
                                </ul>
                              </li>
                              <li class="divider"></li>
                                <li class="has-dropdown not-click">
                                    <?php echo anchor('midia/gerenciar', 'Midia'); ?>
                                <ul class="dropdown">
                                    <li><?php echo anchor('midia/cadastrar', 'Cadastrar'); ?></li>
                                     <li><?php echo anchor('midia/gerenciar', 'Gerenciar'); ?></li>
                                </ul>
                              </li>
                              <li class="divider"></li>
                                <li class="has-dropdown not-click">
                                    <?php echo anchor('paginas/gerenciar', 'Paginas'); ?>
                                <ul class="dropdown">
                                    <li><?php echo anchor('paginas/cadastrar', 'Cadastrar'); ?></li>
                                     <li><?php echo anchor('paginas/gerenciar', 'Gerenciar'); ?></li>
                                </ul>
                              </li>
                              <li class="divider"></li>
                              <li class="has-dropdown not-click">
                                    <a href=" ">Administração</a>
                                <ul class="dropdown">
                                     <li><?php echo anchor('auditoria/gerenciar', 'Auditoria'); ?></li>
                                     <li><?php echo anchor('settings/gerenciar', 'Configurações'); ?></li>
                                     <li><?php echo anchor_popup('http://10.3.1.131/session_teste.php', 'Session Teste'); ?></li>
                                </ul>
                              </li>
								<li class="divider"></li>
								  <li class="has-dropdown not-click">
										<a href=" ">Analise</a>
									<ul class="dropdown">
										 <li><?php echo anchor('chart/init', 'grafico'); ?></li>
										 <li><?php echo anchor('teste/init', 'TESTE'); ?></li>

									</ul>
								  </li>
                              <li class="divider"></li>
                            </ul>
                            <!-- Right Nav Section -->

                          </section>
                        </nav>



                    </div>
                </div><!--Fim do cabeçalho canto esquerdo-->
                <?php endif;?>
<br>
                <div class="row paineladm">
                    {conteudo}
                </div>
<br>
                <div class="row rodape">
                    <div class="small-12 columns text-center">
                        {rodape}
                    </div>
                </div>

                <!-- Included JSFiles (Compressed)  funcoes_helper/init_painel-->
               {footerinc}
        </body>
</html>