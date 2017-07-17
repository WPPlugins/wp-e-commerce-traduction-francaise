<?php
/*
Plugin Name:WP e-Commerce Traduction française
Plugin URI: http://wpcb.fr/plugin-traduction-francaise
Description: Plugin pour la traduction fraçaise de WP e-Commerce (Plugin requis : WP e-Commerce)
Version: 3.8.6.1
Author: Thomas Doki-Thonon
Author URI: http://6www.net
*/


// Translators info : got to Glotpress, export as po, use poEdit to generate .mo copy to subversion, commit !

define('__WPRoot__',dirname(dirname(dirname(dirname(__FILE__)))));
define('__ServerRoot__',dirname(dirname(dirname(dirname(dirname(__FILE__))))));



if (!class_exists('wpecommercetraductionfrancaiseLoader')) {
	class wpecommercetraductionfrancaiseLoader {
		function wpecommercetraductionfrancaiseLoader() {
			register_activation_hook( __file__, array(&$this, 'activate' ));
			register_deactivation_hook( __file__, array(&$this, 'deactivate' ));
			if(get_option('wpecommercetraductionfrancaise_msg')) {
				add_action( 'admin_notices', create_function('', 'echo \'<div id="message" class="error"><p><strong>'.get_option('wpecommercetraductionfrancaise_msg').'</strong></p></div>\';') );
				delete_option('wpecommercetraductionfrancaise_msg');
			}
		}
		// activate the plugin
		function activate() {
			$wpecommercePluginDir = dirname(dirname(__file__)).'/wp-e-commerce';
			
			if(file_exists($wpecommercePluginDir)) {
					//On déplace le fichier de langue vers wp-content/plugins/wp-e-commerce/wpsc-languages/
					if(!copy(dirname(__file__).'/wpsc-fr_FR.mo',$wpecommercePluginDir.'/wpsc-languages/wpsc-fr_FR.mo'))
					{update_option('wpecommercetraductionfrancaise_msg', 'Déplacer manuellement wpsc-fr_FR.mo vers  '.$wpecommercePluginDir.'/wpsc-languages/wpsc-fr_FR.mo');}
					else
					{
						if(!copy(dirname(__file__).'/wpsc-fr_FR.po',$wpecommercePluginDir.'/wpsc-languages/wpsc-fr_FR.po'))
						{update_option('wpecommercetraductionfrancaise_msg', 'Déplacer manuellement wpsc-fr_FR.po vers  '.$wpecommercePluginDir.'/wpsc-languages/wpsc-fr_FR.po');}
						else
						{
							// Ok
						}
					}
			}
			else
			{update_option('wpecommercetraductionfrancaise_msg', 'Le plugin WP-eCommerce doit être installé. ('.$wpecommercePluginDir.')');}
		}
		/**
		* deactivate the plugin
		*/
		function deactivate() {
			// Supprimer le pointeur de la racine de Wordpress
			//unlink( __WPRoot__.'/PointeurPointeur_automatic_response.php');
		}
	}
	$wpecommercetraductionfrancaiseLoad = new wpecommercetraductionfrancaiseLoader();
}
?>