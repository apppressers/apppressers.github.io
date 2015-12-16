<?php


	class wp2androidPluginModuleIPad
	{
		function init()
		{
			wp2android_plugin_module_switcher()->hookGetTheme(array($this, 'getTheme'));
		}

		function getTheme()
		{
			if (!wp2android_plugin_settings()->getIPadActive())
			{
				return false;
			}
			if (!isset($_SERVER['HTTP_USER_AGENT']))
			{
				return false;
			}
			if (stripos($_SERVER['HTTP_USER_AGENT'], 'wp2android_user_agent=ipad_app') === false)
			{
				return false;
			}
			return array('theme' => wp2android_plugin_settings()->getIPadTheme(), 'menu' => wp2android_plugin_settings()->getIPadMenu());
		}
	}

	$module = new wp2androidPluginModuleIPad();
	$module->init();
