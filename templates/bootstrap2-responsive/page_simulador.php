<!DOCTYPE html>
<html lang="{lang_code}">
  <head>
    <?php _widget('head');?>
    <script>
    $(document).ready(function(){

    });    
    </script>
  </head>

  <body>
 
  
{template_header}

<?php _subtemplate('headers', _ch($subtemplate_header, 'empty')); ?>

<?php _widget('top_ads');?>
<a id="content"></a>
<div class="wrap-content pt-5 pb-5">
    <div class="container">
    
        <h1 class="mb-4">{page_title} <?php echo lang('CalculatorTitle')?></h1>
        <div class="row">

            <div class="col-sm-4">

                <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST">
                    <div class="form-group">
                        <span><?php echo lang('deuda')?>:</span>
                        <span><input type="text" class="form-control" name="deuda" maxlength=9 value="<?php echo $_POST['deuda']?>"></span>
                    </div>
                    <div class="form-group">
                        <span class="d-block"><?php echo lang('anos')?>:</span>
                        <span><input type="text" name="anos" class="form-control"  maxlength=2 value="<?php echo $_POST['anos']?>"></span>
                    </div>
                     <div class="form-group">
                        <span><?php echo lang('interes')?> :</span>
                        <span><input type="text" name="interes" class="form-control"  maxlength=9 value="<?php echo $_POST['anos']?>"></span>
                    </div>
                    <div class="form-group">
                        <p><input type="submit" class="btn btn-info float-right" value="<?php echo $_POST['Calculate']?>"><?php echo lang('interes')?> </p>
                    </div>
                </form>
                <?php
                if($_POST["deuda"] && $_POST["anos"] && $_POST["interes"])
                {
                    $deuda=$_POST["deuda"];
                    $anos=$_POST["anos"];
                    $interes=$_POST["interes"];
                 
                    // hacemos los calculos...
                    $interes=($interes/100)/12;
                    $m=($deuda*$interes*(pow((1+$interes),($anos*12))))/((pow((1+$interes),($anos*12)))-1);
                 
                    echo "<div><?php echo lang('InitialCapital')?>: ".number_format($deuda,2,",",".")." €";
                    echo "<br><?php echo lang('MonthlyInstallments')?>: ".number_format($m,2,",",".")." €</div>";

                    ?>
                    Pago total de intereses : <?php echo number_format($totalint,2,",",".")?> €


                      <?php
                }
                ?>


            </div>

         <div class="col-sm-8 pl-5">

            <?php
            if($_POST["deuda"] && $_POST["anos"] && $_POST["interes"])
            {
                $deuda=$_POST["deuda"];
                $anos=$_POST["anos"];
                $interes=$_POST["interes"];
             
                // hacemos los calculos...
                $interes=($interes/100)/12;
                $m=($deuda*$interes*(pow((1+$interes),($anos*12))))/((pow((1+$interes),($anos*12)))-1);
             
                ?>
             


            <div class="table table-striped table-scroll">
                <div class="row">
                    <div class="col-sm-3"><?php echo lang('mes')?> </div>
                    <div class="col-sm-3"><?php echo lang('intereses')?> </div>
                    <div class="col-sm-3"><?php echo lang('amortizacion')?> </div>
                    <div class="col-sm-3"><?php echo lang('capital_pendiente')?> </div>
                </div>
                <?php
                // mostramos todos los meses...
                for($i=1;$i<=$anos*12;$i++)
                {
                    echo "<div class='row'>";
                        echo "<div class='col-sm-3'>".$i."</div>";
                        $totalint=$totalint+($deuda*$interes);
                        echo "<div class='col-sm-3'>".number_format($deuda*$interes,2,",",".")."</div>";
                        echo "<div class='col-sm-3'>".number_format($m-($deuda*$interes),2,",",".")."</div>";
         
                        $deuda=$deuda-($m-($deuda*$interes));
                        if ($deuda<0)
                        {
                            echo "<div class='col-sm-3'>0</div>";
                        }else{
                            echo "<div class='col-sm-3'>".number_format($deuda,2,",",".")."</div>";
                        }
                    echo "</div>";
                }
                ?>
            </div>


            <?php
        }
        ?>

        </div>


        {has_page_documents}
        <h2>{lang_Filerepository}</h2>
        <ul>
        {page_documents}
        <li>
            <a href="{url}">{filename}</a>
        </li>
        {/page_documents}
        </ul>
        {/has_page_documents}
    </div>
</div>
    
<?php _subtemplate('footers', _ch($subtemplate_footer, 'standard')); ?>

<?php _widget('custom_javascript');?> 

  </body>
</html>



