<?php

class Need_Feature_Image_nfic_Admin {

	public function __construct() {
		add_action( 'admin_menu', [ $this, 'nfic_add_menu' ] );
	}

	/**
	 *
	 */
	public function nfic_add_menu() {
		add_submenu_page(
			'options-general.php',
			'Need Featured Image',
			'Need Featured Image',
			'manage_options',
			'nfi',
			[ $this, 'nfi_add_options' ]
		);
	}


	public function nfi_add_options() {
		?>
        <div class="wrap">
            <h2><?php _e( 'Need Featured Image For Custom Post', 'nfic' ) ?></h2>
            <form action="" method="post">

                _<p>You can set the post type for Need Featured Image to work on. By default it set to be Posts
                    only.</p>
                <p>If you are not seeing a post type here that you think should be, it probably does not have support
                    for featured images. Only post types that support featured images will appear on this list.</p>

				<?php
				$get_all_post_types      = get_post_types();
				$get_selected_post_types = get_option( 'nfi_post_types' );

				if ( ! is_array( $get_selected_post_types ) ) {
					$get_selected_post_types = array();
				}

				foreach ( $get_all_post_types as $post_type => $type ) {
					if ( post_type_supports( $type, 'thumbnail' ) ) {

						$checked = "";
						if ( in_array( $post_type, $get_selected_post_types ) ) {
							$checked = "checked";
						}
						?>
                        <tr>
                            <td>
                                <input type="checkbox" name="nfi_post_types[]"
                                       value="<?php esc_attr_e( $type ); ?>" <?php echo $checked; ?>>
								<?php echo $type; ?><br>
                            </td>
                        </tr>
						<?php
					}
				}
				?>

                <input name="submit" type="submit"
                       value="<?php esc_attr_e( 'Save Changes', 'nfic' ); ?>"
                       class="button button-primary"/>
            </form>
        </div>
		<?php

		if ( isset( $_REQUEST['submit'] ) ) {
			$nfi_post_types = isset( $_POST['nfi_post_types'] ) ? $_POST['nfi_post_types'] : "";
			add_option( 'nfi_post_types', $nfi_post_types );
		}
	}


} //end main class

new Need_Feature_Image_nfic_Admin();