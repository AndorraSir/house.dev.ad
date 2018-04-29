<!DOCTYPE html>
<html lang="{lang_code}">
  <head>
    <?php _widget('head');?>
    <script language="javascript">
    $(document).ready(function(){
        
        $("#search_expert").keyup( function() {
            if($(this).val().length > 2 || $(this).val().length == 0)
            {
                $.post('<?php echo $ajax_expert_load_url; ?>', {search: $('#search_expert').val()}, function(data){
                    $('.property_content_position').html(data.print);
                    
                    reloadElements();
                }, "json");
            }
        });
        

    });    
    </script>
  </head>

  <body>
  
{template_header}

<?php _subtemplate('headers', _ch($subtemplate_header, 'empty')); ?>

<a name="content" id="content"></a>
<div class="wrap-content">
    <div class="container">
    
        <h2>{page_title}</h2>
        <div class="property_content">
        {page_body}
        <?php _widget('center_imagegallery');?>
        
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
        <?php if(file_exists(APPPATH.'controllers/admin/expert.php')):?>
        <!-- SHOWROOM -->
        <div id="expert" class="news_content">
        <div class="row-fluid">
        <div class="col-9">
        <div class="property_content_position">
        <div class="row-fluid"
        <ul class="thumbnails">
            <?php foreach($expert_module_all as $key=>$row):?>
              <li class="col-12 li-list">
                  <div class="caption span12">
                    <p class="bottom-border">
                        <i class="qmark">?</i>
                        <strong><?php echo $row->question; ?></strong>
                        <br style="clear:both" />
                    </p>
                    <p class="prop-description">
                        <?php if(!empty($row->answer_user_id) && isset($all_experts[$row->answer_user_id])): ?>
                        <a class="image_expert" href="<?php echo site_url('expert/'.$row->answer_user_id.'/'.$lang_code); ?>#content-position">
                            <img src="<?php echo $all_experts[$row->answer_user_id]['image_url']?>" />
                        </a>
                        <?php else:?>
                        <span class="image_expert"> </span>
                        <?php endif;?>
                        <?php echo $row->answer; ?>
                        <br style="clear:both" />
                    </p>
                  </div>
              </li>
            <?php endforeach;?>
            </ul>
            <div class="pagination news">
            <?php echo $expert_pagination; ?>
            </div>
        </div>
        </div>
        </div>
        <div class="col-3">
        
            <input type="text" placeholder="{lang_Search}" id="search_expert" autocomplete="off"/>
        
            <ul class="nav nav-tabs nav-stacked">
            <?php foreach($categories_expert as $id=>$category_name):?>
            <?php if($id != 0): ?>
                <li><a href="{page_current_url}?cat=<?php echo $id; ?>#expert"><?php echo $category_name; ?></a></li>
            <?php endif;?>
            <?php endforeach;?>
            </ul>
            
          <h2>{lang_AskExpert}</h2>
          <div id="form" class="property-form">
            {validation_errors}
            {form_sent_message}
            <form method="post" action="{page_current_url}#form">
                <label>{lang_FirstLast}</label>
                <input class="{form_error_firstname}" name="firstname" type="text" placeholder="{lang_FirstLast}" value="{form_value_firstname}" />
                <label>{lang_Phone}</label>
                <input class="{form_error_phone}" name="phone" type="text" placeholder="{lang_Phone}" value="{form_value_phone}" />
                <label>{lang_Email}</label>
                <input class="{form_error_email}" name="email" type="text" placeholder="{lang_Email}" value="{form_value_email}" />

                <label>{lang_Question}</label>
                <textarea class="{form_error_question}" name="question" rows="3" placeholder="{lang_Question}">{form_value_question}</textarea>
                
                <?php if(config_item('captcha_disabled') === FALSE): ?>
                <label class="captcha"><?php echo $captcha['image']; ?></label>
                <input class="captcha {form_error_captcha}" name="captcha" type="text" placeholder="{lang_Captcha}" value="" />
                <br style="clear: both;" />
                <input class="hidden" name="captcha_hash" type="text" value="<?php echo $captcha_hash; ?>" />
                <?php endif; ?>
                
                <?php if(config_item('recaptcha_site_key') !== FALSE): ?>
                <div class="control-group" >
                    <label class="control-label captcha"></label>
                    <div class="controls">
                        <?php _recaptcha(true); ?>
                   </div>
                </div>
               <?php endif; ?>

                <br style="clear: both;" />
                <p style="text-align:right;">
                <button type="submit" class="btn btn-info">{lang_Send}</button>
                </p>
            </form>
          </div>

        </div>
        </div>
        </div>
        <!-- /SHOWROOM -->
        <?php endif;?>
    </div>
</div>
    
<?php _subtemplate('footers', _ch($subtemplate_footer, 'standard')); ?>

<?php _widget('custom_javascript');?> 

  </body>
</html>