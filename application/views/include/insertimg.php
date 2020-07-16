<script type="text/javascript">
    $(function(){
        $('.buscarimg').click(function(){
            var destino = "<?php echo base_url('index.php/midia/get_imgs') ?>";
            var dados = $(".buscartxt").serialize();
            $.ajax({
                type : "POST",
                url : destino,
                data: dados,
                success: function(retorno){
                    $(".retorno").html(retorno);
                }
            });
        });
        $(".limparimg").click(function(){
            $(".buscartxt").val(' ');
            $(".retorno").html(' ');
        });
    });
</script>
<div id="myModal" class="reveal-modal large" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog" style="display: none; opacity: 1; visibility: hidden; top: 188px;">
    <div class="row collapse">
        <div class="collapse small-6 columns">
            <?php echo form_input(array('name'=>'pesquisarimg', 'class'=>'buscartxt')); ?>
        </div>
        <div class="small-2 columns">
            <?php echo form_button('', 'Buscar', 'class="buscarimg button postfix"'); ?>
        </div>
        <div class="small-2 columns end">
            <?php echo form_button('', 'Limpar', 'class="limparimg button postfix alert radius"'); ?>
        </div>
    </div>
    <div class="retorno">&nbsp;</div>
    <a class="close-reveal-modal">&#215;</a>

</div>


 <script>
    $(document).foundation();
  </script>