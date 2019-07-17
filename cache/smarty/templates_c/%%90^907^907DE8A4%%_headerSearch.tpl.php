<?php /* Smarty version 2.6.11, created on 2019-07-16 17:41:53
         compiled from themes/Sugar5/tpls/_headerSearch.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_getimage', 'themes/Sugar5/tpls/_headerSearch.tpl', 83, false),)), $this); ?>
<?php if ($this->_tpl_vars['AUTHENTICATED']): ?>    
    <?php if ($this->_tpl_vars['CURRENT_USER'] != 'Aeromedia' && $this->_tpl_vars['CURRENT_USER'] != 'Aeromedia1' && $this->_tpl_vars['CURRENT_USER'] != 'AreasPla1' && $this->_tpl_vars['CURRENT_USER'] != 'AreasPla2' && $this->_tpl_vars['CURRENT_USER'] != 'AreasPla3' && $this->_tpl_vars['CURRENT_USER'] != 'Asasur1' && $this->_tpl_vars['CURRENT_USER'] != 'Asasur2' && $this->_tpl_vars['CURRENT_USER'] != 'Jose Luis Calderon Rodriguez' && $this->_tpl_vars['CURRENT_USER'] != 'clickrepara1' && $this->_tpl_vars['CURRENT_USER'] != 'clickrepara2' && $this->_tpl_vars['CURRENT_USER'] != 'clickrepara3' && $this->_tpl_vars['CURRENT_USER'] != 'ConsultorPrueba' && $this->_tpl_vars['CURRENT_USER'] != 'DonAire1' && $this->_tpl_vars['CURRENT_USER'] != 'DonAire2' && $this->_tpl_vars['CURRENT_USER'] != 'DonAire3' && $this->_tpl_vars['CURRENT_USER'] != 'Efinca1' && $this->_tpl_vars['CURRENT_USER'] != 'Efinca2' && $this->_tpl_vars['CURRENT_USER'] != 'Efinca3' && $this->_tpl_vars['CURRENT_USER'] != 'Electro Escultura' && $this->_tpl_vars['CURRENT_USER'] != 'Estvdio' && $this->_tpl_vars['CURRENT_USER'] != 'iAlma1' && $this->_tpl_vars['CURRENT_USER'] != 'iAlma2' && $this->_tpl_vars['CURRENT_USER'] != 'iAlma3' && $this->_tpl_vars['CURRENT_USER'] != 'KRACK' && $this->_tpl_vars['CURRENT_USER'] != 'krack1' && $this->_tpl_vars['CURRENT_USER'] != 'krack2' && $this->_tpl_vars['CURRENT_USER'] != 'krack3' && $this->_tpl_vars['CURRENT_USER'] != 'LEDSHOME' && $this->_tpl_vars['CURRENT_USER'] != 'ledshome1' && $this->_tpl_vars['CURRENT_USER'] != 'ledshome2' && $this->_tpl_vars['CURRENT_USER'] != 'mercados' && $this->_tpl_vars['CURRENT_USER'] != 'Sofia Ruisanchez' && $this->_tpl_vars['CURRENT_USER'] != 'tuttotempo1' && $this->_tpl_vars['CURRENT_USER'] != 'tuttotempo2' && $this->_tpl_vars['CURRENT_USER'] != 'urban1' && $this->_tpl_vars['CURRENT_USER'] != 'urban2' && $this->_tpl_vars['CURRENT_USER'] != 'Winet1' && $this->_tpl_vars['CURRENT_USER'] != 'Winet2'): ?>
    <div id="search">
        <form name='UnifiedSearch' action='index.php' onsubmit='return SUGAR.unifiedSearchAdvanced.checkUsaAdvanced()'>
            <input type="hidden" name="action" value="UnifiedSearch">
            <input type="hidden" name="module" value="Home">
            <input type="hidden" name="search_form" value="false">
            <input type="hidden" name="advanced" value="false">
            <?php echo smarty_function_sugar_getimage(array('name' => 'searchMore','ext' => ".gif",'alt' => $this->_tpl_vars['APP']['LBL_SEARCH'],'other_attributes' => 'border="0" id="unified_search_advanced_img" '), $this);?>
&nbsp;
            <input type="text" name="query_string" id="query_string" size="20" value="<?php echo $this->_tpl_vars['SEARCH']; ?>
">&nbsp;
            <input type="submit" class="button" value="<?php echo $this->_tpl_vars['APP']['LBL_SEARCH']; ?>
">
        </form><br />
        <div id="unified_search_advanced_div"> </div>
    </div>
    <div id="sitemapLink">
        <span id="sitemapLinkSpan">
            <?php echo $this->_tpl_vars['APP']['LBL_SITEMAP']; ?>

            <?php echo smarty_function_sugar_getimage(array('name' => 'MoreDetail','alt' => $this->_tpl_vars['app_strings']['LBL_MOREDETAIL'],'ext' => ".png",'other_attributes' => ''), $this);?>

        </span>
    </div>
    <span id='sm_holder'></span>
    <?php endif; ?>
<?php endif; ?>