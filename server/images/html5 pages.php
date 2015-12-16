<?php
	
	class wp2androidPluginModulePages
	{
		var $_pages = array();
		var $_loaded = false;

		function init()
		{
			$this->_pages['latest'] = __('Latest', 'wp2android-plugin');
			$this->_pages['pages'] = __('Pages', 'wp2android-plugin');
			$this->_pages['categories'] = __('Categories', 'wp2android-plugin');
			$this->_pages['tags'] = __('Tags', 'wp2android-plugin');
			$this->_pages['archive_years'] = __('Archive', 'wp2android-plugin');
			$this->_pages['archive_months'] = __('Archive By Months', 'wp2android-plugin');
			$this->_pages['bookmarks'] = __('Links', 'wp2android-plugin');
			$this->_pages['search'] = __('Search', 'wp2android-plugin');

			wp2android_plugin_hook()->hookInstall(array(&$this, 'install'));
			wp2android_plugin_hook()->hookUninstall(array(&$this, 'uninstall'));
			wp2android_plugin_hook()->hookLoad(array(&$this, 'load'));
			wp2android_plugin_hook()->hookLoadAdmin(array(&$this, 'load'));
		}

		function load()
		{
			if ($this->_loaded)
			{
				return;
			}
			$this->_loaded = true;

			register_post_type('wp2android', array(
				'labels' => array(
					'name' => __('wp2android Mobile Pages', 'wp2android-plugin'),
					'singular_name' => __('wp2android Mobile Page', 'wp2android-plugin'),
				),
				'public' => true,
				'publicly_queryable' => true,
				'show_ui' => false,
				'show_in_nav_menus' => true,
				'exclude_from_search' => true,
				'rewrite' => true,
				'supports' => array('title'),
				'can_export' => false
			));

			add_action('wp', array(&$this, 'route'));
		}

		function route(&$wp)
		{
			global $post;
			if (!empty($post) && isset($post->post_type) && $post->post_type === 'wp2android')
			{
				$wp->query_vars = array('wp2android_display' => $post->post_name, 'paged' => isset($wp->query_vars['paged'])?$wp->query_vars['paged']:1);
				$wp->query_vars = apply_filters('request', $wp->query_vars);
				do_action_ref_array('parse_request', array(&$wp));
				$wp->query_posts();
				$wp->handle_404();
				$wp->register_globals();
			}
		}

		function install()
		{
			$this->load();

			foreach ($this->_pages as $name => $title)
			{
				$this->get_page($name);
			}

			flush_rewrite_rules();
		}

		function uninstall()
		{
			$get_posts = new WP_Query();
			$get_menu_items = new WP_Query();
			foreach ($get_posts->query(array('post_type' => 'wp2android', 'cache_results' => false, 'post_status' => 'any', 'posts_per_page' => -1, 'ignore_sticky_posts' => true, 'no_found_rows' => true)) as $post)
			{
				foreach ($get_menu_items->query(array('post_type' => 'nav_menu_item', 'meta_query' => array(array('key' => '_menu_item_type', 'value' => 'post_type'), array('key' => '_menu_item_object_id', 'value' => $post->ID), array('key' => '_menu_item_object', 'value' => 'wp2android')), 'cache_results' => false, 'post_status' => 'any', 'posts_per_page' => -1, 'ignore_sticky_posts' => true, 'no_found_rows' => true, 'fields' => 'ids')) as $menu_item)
				{
					update_post_meta($menu_item, '_menu_item_wp2android_page_name', $post->post_name);
				}
				wp_delete_post($post->ID, true);
			}
		}

		function get_page($name)
		{
			if (!isset($this->_pages[$name]))
			{
				return false;
			}
			$title = $this->_pages[$name];
			$get_posts = new WP_Query();
			$posts = $get_posts->query(array('post_type' => 'wp2android', 'name' => $name, 'fields' => 'ids'));
			if (isset($posts[0]))
			{
				return $posts[0];
			}
			$post_id = wp_insert_post(array('post_status' => 'publish', 'post_type' => 'wp2android', 'post_name' => $name, 'post_title' => $title));
			$get_menu_items = new WP_Query();
			foreach ($get_menu_items->query(array('post_type' => 'nav_menu_item', 'meta_query' => array(array('key' => '_menu_item_type', 'value' => 'post_type'), array('key' => '_menu_item_wp2android_page_name', 'value' => $name), array('key' => '_menu_item_object', 'value' => 'wp2android')), 'cache_results' => false, 'post_status' => 'any', 'posts_per_page' => -1, 'ignore_sticky_posts' => true, 'no_found_rows' => true, 'fields' => 'ids')) as $menu_item)
			{
				update_post_meta($menu_item, '_menu_item_object_id', $post_id);
				delete_post_meta($menu_item, '_menu_item_wp2android_page_name');
			}
			return $post_id;
		}
	}

	function &wp2android_plugin_module_pages()
	{
		static $inst = null;
		if (!$inst)
		{
			$inst = new wp2androidPluginModulePages();
			$inst->init();
		}
		return $inst;
	}

	wp2android_plugin_module_pages();
