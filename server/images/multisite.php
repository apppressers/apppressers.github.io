<?php


	class wp2androidPluginModuleMultisite
	{

		function init()
		{
			if (!is_multisite())
			{
				return;
			}
			wp2android_plugin_module_switcher()->hookThemeCustomization(array(&$this, 'addHookAllowedthemes'));
		}

		function addHookAllowedthemes()
		{
			add_filter('pre_site_option_allowedthemes', array(&$this, 'hookAllowedthemes'));
		}

		function hookAllowedthemes($allowed_themes)
		{
			if (!is_object($GLOBALS['wp_customize']))
			{
				return $allowed_themes;
			}
			$template = $GLOBALS['wp_customize']->get_stylesheet();
			if (empty($template))
			{
				return $allowed_themes;
			}
			if (is_array($allowed_themes))
			{
				$allowed_themes[$template] = true;
			}
			else
			{
				$allowed_themes = array($template => true,);
			}
			return $allowed_themes;
		}
	}

	$module = new wp2androidPluginModuleMultisite();
	$module->init();
