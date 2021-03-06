<?php

if (! defined('FW')) { die('Forbidden'); }

class FW_Icon_V2_Favorites_Manager
{
	private $key = 'fw-icon-v2-favorites';

	public function attach_ajax_actions()
	{
		add_action(
			'wp_ajax_fw_icon_v2_update_favorites',
			array($this, 'set_favorites_action')
		);

		add_action(
			'wp_ajax_fw_icon_v2_get_favorites',
			array($this, 'get_favorites_action')
		);
	}

	public function set_favorites_action()
	{
		$favorites = json_decode(FW_Request::POST( 'favorites' ), true);

		$this->set_favorites($favorites);

		$this->get_favorites_action();
	}

	public function get_favorites_action()
	{
		wp_send_json(
			$this->get_favorites()
		);
	}

	public function get_favorites()
	{
		return FW_WP_Option::get(
			$this->key,
			'type',
			array()
		);
	}

	public function set_favorites($favorites)
	{
		FW_WP_Option::set(
			$this->key,
			'type',
			$favorites
		);
	}
}
