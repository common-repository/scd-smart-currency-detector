<?php

/* ------------------------------------------------------------------------
   This module handles the operations of the SCM Currencies Settings tab
   ------------------------------------------------------------------------ */

/**
 * Render setting: Webpages default currency
 */  
function scd_form_render_default_currency() {


    $curs = get_option('scd_currency_options');
    $selection = $curs['fallbackCurrency'];
    $woo_currency = get_option('woocommerce_currency');
    ?>

    <div class="help-tip">
        <p> <?php _e( 'Select the default currency to use for your store. This currency will be selected for display if location based currency selection is not enabled or if the currency corresponding to the user location is not in the list of enabled currencies for your store. The default value of this setting is to use the "Base Currency", which is the currency selected in the woocommerce setting', 'ch_scd_woo' ); ?> </p>
    </div>

    <select data-placeholder="Select default/fallback currency" name='scd_currency_options[fallbackCurrency]'  style="width:300px;" class="scd_chosen_select" >
        <option value=""></option>
        <optgroup label="<?php _e('Base Currency', 'ch_scd_woo'); ?>">
            <option value="basecurrency" <?php echo ($selection == "basecurrency") ? "selected" : ""; ?>><?php _e('Base Currency ('.$woo_currency.')', 'ch_scd_woo'); ?></option>
        </optgroup>
        <optgroup label="<?php _e('Fixed currency', 'ch_scd_woo'); ?>">

            <?php
            $currencies_list=scd_get_list_currencies();
            foreach ($currencies_list as $key => $val) {

                $sel = ($selection == $key) ? "selected" : "";
                    echo "<option value='$key' $sel>$key - $val</option>";
            }
            ?>

        </optgroup>
    </select>

    <?php
}

/**
 * Render setting: Select currency based on user location
 */ 
function scd_form_render_locationBasedSelect() {
    ?>

    <div class="help-tip">
        <p><?php _e('If this setting is checked, the currency used for display and payment will be selected according to the users location. E.g. a customer located in the USA will see products prices in USD. A customer located in France will see the same products displayed in EUR. You can use the next setting to limit the set of currencies available for your store.', 'ch_scd_woo'); ?></p>
    </div>

    <input type="hidden" name='scd_currency_options[autodetectLocation]' value="0" />
    <input id="scd_locationBasedSelect" name='scd_currency_options[autodetectLocation]' style="margin-left: 20px; margin-top: 3px;" type='checkbox' value='1' <?php scd_echoChecked('scd_currency_options', 'autodetectLocation'); ?>/>

    <?php
}

function scd_form_render_pricebycurrency() {
    ?>

    <input id="scd_pricebycurrency" name='scd_currency_options[priceByCurrency]' style="margin-left: 20px; margin-top: 3px;" type='checkbox' value='1' <?php scd_echoChecked('scd_currency_options', 'priceByCurrency'); ?>/>

    <?php
}


/**
 * Render setting: User currency display choice
 */ 
function scd_form_render_userCurrencyChoice() {

    $curs = get_option('scd_currency_options');
    $curs = $curs['userCurrencyChoice'];
    ?>

    <div class="help-tip">
        <p> <?php _e('Filter which currencies are available to the end users. You can use this setting to specify the set of curencies that your store supports. Selecting "All" means that all currencies are available and enabled. If the SCM widget is included on the webpage, only the enabled currencies will be included in the widget selection list.', 'ch_scd_woo'); ?> </p>
    </div>


    <input type='hidden' name='scd_currency_options[userCurrencyChoice]' id="userCurrencyChoiceField" value="<?php echo $curs; ?>"/>
    <select data-placeholder=" <?php _e('Set user currencies', 'ch_scd_woo'); ?> "  style="width:300px;" class="scd_widget" multiple >

        <optgroup label="<?php _e('All', 'ch_scd_woo'); ?>">
            <option value="allcurrencies" <?php echo (substr_count($curs, "allcurrencies") != 0) ? "selected" : ""; ?>><?php _e('All', 'ch_scd_woo'); ?></option>
        </optgroup>
        <optgroup label="<?php _e('Fixed currencies', 'ch_scd_woo'); ?>">

            <?php
                $currencies_list=scd_get_all_currencies();
                foreach ($currencies_list as $key => $val) {

                        if (substr_count($curs, $key) != 0)
                            $sel = "selected";
                        else
                            $sel = "";
                        echo "<option value='$key' $sel>$key - $val</option>";
                }
          
            ?>

        </optgroup>
    </select>

    <?php 
}

/**
 * Render setting: Enable decimal number display
 */ 
function scd_form_render_decimalNumber() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function () {

            jQuery('#scd_decimalNumber').change(function () {
                if (this.checked) {
                    jQuery("#decimal").fadeIn('slow');
                    jQuery("#decimal2").fadeIn('slow');
                } else {
                    jQuery("#decimal").fadeOut('slow');
                    jQuery("#decimal2").fadeOut('slow');
                }
            });
        });
    </script>

    <div class="help-tip">
        <p> <?php _e('Enable the display of decimal numbers in your webpage, for the resulting prices. If enabled you can select the number of decimals within the next setting. If not the decimals are removed after conversion.', 'ch_scd_woo'); ?> </p>
    </div>

    <input id="scd_decimalNumber" name='scd_currency_options[decimalNumber]' style="margin-left: 20px; margin-top: 3px;" type='checkbox' value='1' <?php scd_echoChecked('scd_currency_options', 'decimalNumber'); ?>/>
    
    <?php
}

/**
 * Render setting: Number of decimals
 */ 
function scd_form_render_decimalPrecision() {
    $dec = get_option('scd_currency_options');
    $dec = $dec['decimalPrecision'];
    $va = (scd_isChecked('scd_currency_options', 'decimalNumber') == false) ? 'style="display: none"' : "";
    ?>

    <script type="text/javascript">
        jQuery(document).ready(function () {

            jQuery('#scd_decimalPrecision').on("keypress keyup blur", function (event) {

                jQuery(this).val(jQuery(this).val().replace(/[^0-9\.]/g, ''));

                if ((event.which != 46 || jQuery(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57) && event.which != 8) {
                    event.preventDefault();
                }
            });
        });
    </script>

    <div id="decimal2" <?php echo $va; ?>>

        <div style="width: 8%;display: inline-block;">
            <div class="help-tip">
                <p> <?php _e('Sets the number of digits after the decimal point.', 'ch_scd_woo'); ?> </p>
            </div>
            <input id="scd_decimalPrecision" name='scd_currency_options[decimalPrecision]' style="width: 100%;margin-left: 20px;border-radius: 3px;border: 1px solid #ccc;" type='text' value='<?php echo $dec; ?>' />
        </div>

    </div>

    <?php
}


function scd_form_render_displayCurrencyMenu(){
    $options=  get_option('scd_currency_options',true);
    $checked=  isset($options['displayCurrencyMenu'])&& !empty($options['displayCurrencyMenu'])?'checked':false;
    $checked= $checked?"checked":"";
    
echo '<input type="checkbox" value="1" name="scd_currency_options[displayCurrencyMenu]" '.$checked.'  />';
}

function scd_form_render_menuTitle(){
    $options=  get_option('scd_currency_options',true);
    $title=  isset($options['menuTitle'])?$options['menuTitle']:'Currency';
    
    echo '<input type="text" name="scd_currency_options[menuTitle]" value="'.$title.'" />';
}

function scd_form_render_menuPosition(){
    $options=  get_option('scd_currency_options',true);
    $position=  isset($options['menuPosition'])?$options['menuPosition']:0;
    
    echo '<input type="number" name="scd_currency_options[menuPosition]" value="'.$position.'" />';
}
function render_scd_menuLocation(){
    $locations = get_nav_menu_locations();
    
    $options=  get_option('scd_currency_options',true);
    $locs=  isset($options['menuPosition'])?$options['menuLocation']:'';
    
    ?>
    <div class="help-tip">
        <p> <?php _e('Select the menu location in the active theme in which the currency menu will be displayed', 'ch_scd_woo'); ?> </p>
    </div>
        <input type='hidden' name='scd_currency_options[menuLocation]' id="scd_menuLocationField" value="<?php echo $locs; ?>"/>
        <select data-placeholder=" <?php _e('Select menu location', 'ch_scd_woo'); ?> "  style="width:300px;" class="scd_menu_location" multiple >

        <optgroup label="<?php _e('All', 'ch_scd_woo'); ?>">
            <option value="alllocations" <?php echo (substr_count($locs, "alllocations") != 0) ? "selected" : ""; ?>><?php _e('All', 'ch_scd_woo'); ?></option>
        </optgroup>
        <optgroup label="<?php _e('Fixed locations', 'ch_scd_woo'); ?>">

            <?php
            foreach ($locations as $key => $val) {

                    if (substr_count($locs, $key) != 0)
                        $sel = "selected";
                    else
                        $sel = "";
                    echo "<option value='$key' $sel>$key</option>";
            }
            ?>

        </optgroup>
    </select>

        <script type="text/javascript">
        jQuery(document).ready(function(){
            
            jQuery('.scd_menu_location').chosen();
            
            jQuery('.scd_menu_location').change(function(){
                jQuery('#scd_menuLocationField').val(jQuery(this).val());
                
            });
        });
        </script>
    <?php
    
}



function scd_form_render_mobilewidget(){
    ?>
<script type="text/javascript">
    jQuery(document).ready(function () {

        jQuery('#scd_color').change(function () {
            if (this.checked) {
                jQuery("#position").fadeIn('slow');
                jQuery("#scd_position").fadeIn('slow');
				jQuery("#pages").fadeIn('slow');
                jQuery("#scd_pages").fadeIn('slow');
                jQuery("#mobilewidgetcolor").fadeIn('slow');
                jQuery("#mobilewidgetpopup").fadeIn('slow');
                jQuery("#scd_wcolor2").fadeIn('slow');
                jQuery("#scd_wpopup2").fadeIn('slow');
           } else {
                jQuery("#position").fadeOut('slow');
                jQuery("#scd_position").fadeOut('slow');
				jQuery("#pages").fadeOut('slow');
                jQuery("#scd_pages").fadeOut('slow');
                jQuery("#mobilewidgetcolor").fadeOut('slow');
                jQuery("#mobilewidgetpopup").fadeOut('slow');
                jQuery("#textpopup").fadeOut('slow');
                jQuery("#scd_wcolor2").fadeOut('slow');
                jQuery("#scd_wpopup2").fadeOut('slow');
                jQuery("#scd_text2").fadeOut('slow');
            }
        });
    });
</script>

<div class="help-tip" >
    <p> <?php _e('if this setting is checked, it allows you to use a mobile currency conversion widget that you have a possibility to move on anywhere on your website.', 'ch_scd_woo'); ?> </p>
</div>
<?php
$options=  get_option('scd_currency_options',true);
$checked=  isset($options['mobilewidget']) && !empty($options['mobilewidget'])?'checked':false;
$checked= $checked?"checked":"";  
?>
&emsp;&emsp;<input id="scd_color"  type="checkbox" value="1"<?php scd_echoChecked('scd_currency_options', 'mobilewidget'); ?> name="scd_currency_options[mobilewidget]"  />
<?php 
}

/**
 * Render setting: Position of mobile widget
 */ 
function scd_form_mobilewidgetposition() {
    $posi = get_option('scd_currency_options');
    $placeV = $posi['fallbackPositionV'];
    $placeH = $posi['fallbackPositionH'];
    $con = (scd_isChecked('scd_currency_options', 'mobilewidget') == false) ? 'style="display: none"' : "";
    ?>

        <script type="text/javascript">
            jQuery(document).ready(function(){
                
                jQuery('.scd_position_mobile').chosen();
                
                jQuery('.scd_position_mobile').change(function(){
                    jQuery('#scd_position').val(jQuery(this).val());
                    
                });
            });
        </script>
     <div id="scd_position" <?php echo $con; ?>>
    <div style="width: 8%; display: inline-block;">
        H: 
            <div class="help-tip">
                <p> <?php _e('Horizontal position', 'ch_scd_woo'); ?> </p>
            </div>
    <select data-placeholder=" <?php _e('Select position', 'ch_scd_woo'); ?> " name='scd_currency_options[fallbackPositionH]'  style="width:300px;" class="scd_position_mobile" >
        <!-- <option value=""></option> -->
        <option value="Right" <?php echo ($placeH == "Right") ? "selected" : "";?>> <?php _e('Right', 'ch_scd_woo'); ?> </option>
        <option value="Center" <?php echo ($placeH == "Center") ? "selected" : "";?>> <?php _e('Center', 'ch_scd_woo'); ?> </option>
        <option value="Left" <?php echo ($placeH == "Left") ? "selected" : "";?>> <?php _e('Left', 'ch_scd_woo'); ?> </option>
        
    </select>
    
    
        V:

        <div style="width: 100%;display: inline-block;">
            <div class="help-tip">
                <p> <?php _e('Vertical position in pixel (px)', 'ch_scd_woo'); ?> </p>
            </div>
            <input id="scd_position_v" name='scd_currency_options[fallbackPositionV]' style="width: 100%;margin-left: 20px;border-radius: 3px;border: 1px solid #ccc;" type='number' value='<?php echo $placeV; ?>' />
        </div>

    </div> 
    <?php
}


function scd_form_mobilewidgetpages() {
    $option = get_option('scd_currency_options');
    
    if ($option['fallbackPages']==0 || !isset($option['fallbackPages'])) {
        $option['fallbackPages'] = ["All"];
        $page = $option['fallbackPages'];
    }else{
        $page = $option['fallbackPages'];
    }
    
    $con = (scd_isChecked('scd_currency_options', 'mobilewidget') == false) ? 'style="display: none"' : "";
    ?>

        <script type="text/javascript">
            jQuery(document).ready(function(){
                
                jQuery('.scd_pages_mobile').chosen();
                
                jQuery('.scd_pages_mobile').change(function(){
                    jQuery('#scd_pages').val(jQuery(this).val());
                    
                });
            });
        </script>
     <div id="scd_pages" <?php echo $con; ?>>
    <div style="width: 8%; display: inline-block;">
        <select multiple data-placeholder=" <?php _e('Select page', 'ch_scd_woo'); ?> "  name='scd_currency_options[fallbackPages][]' style="width:300px;" class="scd_pages_mobile">
            <?php // Tableau d'arguments pour personalisé la liste des pages
            $args = array(
                'sort_order' => 'ASC', // ordre
                'sort_column' => 'post_title', // par titre (post_date = par date ,post_modified = dernière modification, post_author = Par auteur)
                'hierarchical' => 1, // Hiérarchie des sous pages
                'exclude' => '', // page a exclure avec leurs ID ex: (2,147)
                'include' => '', // page a inclure avec leurs ID (5,10)
                'meta_key' => '',  // Inclure uniquement les pages qui ont cette clé des champs personnalisés
                'meta_value' => '', // Inclure uniquement les pages qui ont cette valeur de champ personnalisé
                'authors' => '', // Inclure uniquement les pages écrites par l'auteur(ID)
                'child_of' => 0, // niveau des sous-pages
                'parent' => -1, // Affiche les pages qui ont cet ID en tant que parent. La valeur par défaut -1 
                'exclude_tree' => '', // Le contraire de «child_of», «exclude_tree 'supprimera tous les sous pages par ID.
                'number' => '', // Défini le nombre de pages à afficher
                'offset' => 0, //  nombre de pages à passer au-dessus
                'post_type' => 'page', // post type
                'post_status' => 'publish' // publish = Publier, private = page privé
            ); 
            $pages = get_pages($args);   
            ?>   
            <option value="All" <?php echo in_array("All",$page)? "selected" : "";?>> <?php _e('All Pages', 'ch_scd_woo'); ?> </option>
            <?php
                foreach ($pages as $pagg) {?>
                    <option value="<?php echo $pagg->post_title ?>" <?php echo in_array($pagg->post_title,$page)? "selected" : "";?>> <?php  _e(" $pagg->post_title ", 'ch_scd_woo'); ?> </option>
                    <?php
                }
            ?>
        </select>
    </div> 
    <?php
}



/**
 * Render setting: color of mobile widget
 */
function scd_form_mobilewidgetcolor(){
    
//    $va1 = (scd_isChecked('scd_currency_options', 'mobilewidget') == false) ? 'style="display: none"' : "";
    ?>

    <script type="text/javascript">
        jQuery(document).ready(function () {

            jQuery('#scd_wcolor2').on("keypress keyup blur", function (event) {

                jQuery(this).val(jQuery(this).val().replace(/[^0-9\.]/g, ''));

                if ((event.which != 46 || jQuery(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57) && event.which != 8) {
                    event.preventDefault();
                }
            });
        });
    </script>
  <?php  
      if ((scd_isChecked('scd_currency_options', 'mobilewidget') == false)){
          
          $options=  get_option('scd_currency_options',true);
    $color=  isset($options['mobilewidgetcolor'])?$options['mobilewidgetcolor']:'#ffffff';
  echo '&emsp;&emsp;<div style="width: 8%; display: none;" id="scd_wcolor2" ><input  type="color" name="scd_currency_options[mobilewidgetcolor]" value="'.$color.'" /></div>';
      }  else {
          $options=  get_option('scd_currency_options',true);
    $color=  isset($options['mobilewidgetcolor'])?$options['mobilewidgetcolor']:'#ffffff';
  echo '&emsp;&emsp;<div style="width: 8%; display: inline-block; " id="scd_wcolor2" ><input  type="color" name="scd_currency_options[mobilewidgetcolor]" value="'.$color.'" /></div>';

      }
   
}
/**
 * Render setting: Text of popup
 */
function scd_form_mobilewidgetpopup(){
    ?>

    <script type="text/javascript">
        jQuery(document).ready(function () {
            
            jQuery('#scd_wpopup22').change(function () { 
                if (this.checked) {
                    jQuery("#textpopup").fadeIn('slow');
                    jQuery("#scd_text2").fadeIn('slow');
                } else {
                    jQuery("#textpopup").fadeOut('slow');
                    jQuery("#scd_text2").fadeOut('slow');
                }
        });

    });
    </script>
  <?php  
  if ((scd_isChecked('scd_currency_options', 'mobilewidget') == false)){
      $options=  get_option('scd_currency_options',true);
    $checked=  isset($options['mobilewidgetpopup'])&& !empty($options['mobilewidgetpopup'])?'checked':false;
    $checked= $checked?"checked":"";  
  echo '&emsp;&emsp;<div style="width: 8%;display: none;" id="scd_wpopup2" ><input  id="scd_wpopup22" type="checkbox" value="1"  name="scd_currency_options[mobilewidgetpopup]" '.$checked.' /></div>';
  }  else {
      $options=  get_option('scd_currency_options',true);
    $checked=  isset($options['mobilewidgetpopup'])&& !empty($options['mobilewidgetpopup'])?'checked':false;
    $checked= $checked?"checked":"";  
  echo '&emsp;&emsp;<div style="width: 8%;display: inline-block;" id="scd_wpopup2" ><input  id="scd_wpopup22" type="checkbox" value="1"  name="scd_currency_options[mobilewidgetpopup]" '.$checked.' /></div>';
    
}
   

}

/**
 * Render setting: Text of popup
 */ 
function scd_form_textpopup() {
    $var1 = (scd_isChecked('scd_currency_options', 'mobilewidget') == false) ? 'style="display: none"' : "";
    $var = ((scd_isChecked('scd_currency_options', 'mobilewidget') == false) && (scd_isChecked('scd_currency_options', 'mobilewidgetpopup') == false))? 'style="display: none"' : "";
    $options=  get_option('scd_currency_options',true);
    $textpopup=  isset($options['textpopup']) && !empty($options['textpopup'])?$options['textpopup'] : _e('SHOPPERS! CHOOSE YOUR CURRENCY HERE ...', 'ch_scd_woo') ;
    $current_user_id =get_current_user_id();
    update_post_meta($current_user_id,'scd_form_textpopup',$textpopup); 
    ?>

        <div id="scd_text2" <?php echo $var; $var1; ?>>

          <div style="width: 75%;display: inline-block;">

              <input id="scd_text22" name='scd_currency_options[textpopup]' style="width: 100%;margin-left: 20px;border-radius: 3px;border: 1px solid #ccc;" type='text' value='<?php echo _e($textpopup, 'ch_scd_woo'); ?>' />
        
          </div>
        </div>
    <?php
    }
