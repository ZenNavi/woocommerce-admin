<?php
/**
 * WC Admin Action Scheduler Store.
 *
 * @package WooCommerce Admin/Classes
 */

/**
 * Class WC Admin Action Scheduler Store.
 */
class WC_Admin_ActionScheduler_WPPostStore extends ActionScheduler_wpPostStore {
	/**
	 * Action scheduler job priority (lower numbers are claimed first).
	 */
	const JOB_PRIORITY = 30;

	/**
	 * Create the post array for storing actions as WP posts.
	 *
	 * For WC Admin actions, force a lower action claim
	 * priority by setting a high value for `menu_order`.
	 *
	 * @param ActionScheduler_Action $action Action.
	 * @param DateTime               $scheduled_date Action schedule.
	 * @return array Post data array for usage in wp_insert_post().
	 */
	protected function create_post_array( ActionScheduler_Action $action, DateTime $scheduled_date = null ) {
		$postdata = parent::create_post_array( $action, $scheduled_date );

		if ( 0 === strpos( $postdata['post_title'], 'wc-admin_' ) ) {
			$postdata['menu_order'] = self::JOB_PRIORITY;
		}

		return $postdata;
	}
}