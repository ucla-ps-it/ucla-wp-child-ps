<?php
// Load the Parent and Child Stylesheets
add_action( 'wp_enqueue_scripts', 'ucla_theme_enqueue_styles' );
function ucla_theme_enqueue_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_uri(),
        array( 'ucla-style' ),
        wp_get_theme()->get('Version') // this only works if you have Version in the style header
    );
}

add_action( 'after_setup_theme', 'remove_parent_widget_init' );

function remove_parent_widget_init()
{
  remove_action( 'widgets_init', 'ucla_widgets_init' );
  // Add Sidebar widget
  add_action( 'widgets_init', 'ucla_widgets_init_nolist' );
  function ucla_widgets_init_nolist() {
      register_sidebar( array(
        'name' => esc_html__( 'Sidebar Widget Area', 'ucla' ),
        'id' => 'primary-widget-area',
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
      ) );
  }
}

add_filter( 'upload_size_limit', 'AOS_increase_upload' );
function AOS_increase_upload( $bytes )
{
	return 26214400; // 1 megabyte
}                // CPT 


/**
 * Custom Avatar (Profile Picture) Without a Plugin
 */
// 1. Enqueue the needed scripts.
add_action( "admin_enqueue_scripts", "deptdir_enqueue" );
function deptdir_enqueue( $hook ){
	// Load scripts only on the user-edit page.
	if( $hook === 'user-edit.php' ){
		add_thickbox();
		wp_enqueue_script( 'media-upload' );
		wp_enqueue_media();
	}
}

// 2. Scripts for Media Uploader.
function deptdir_admin_media_scripts() {
	?>
	<script>
		jQuery(document).ready(function ($) {
			$(document).on('click', '.avatar-image-upload', function (e) {
				e.preventDefault();
				var $button = $(this);
				var file_frame = wp.media.frames.file_frame = wp.media({
					title: 'Select or Upload an Custom Avatar',
					library: {
						type: 'image' // mime type
					},
					button: {
						text: 'Select Avatar'
					},
					multiple: false
				});
				file_frame.on('select', function() {
					var attachment = file_frame.state().get('selection').first().toJSON();
					$button.siblings('#deptdir-custom-avatar').val( attachment.sizes.thumbnail.url );
					$button.siblings('.custom-avatar-preview').attr( 'src', attachment.sizes.thumbnail.url );
				});
				file_frame.open();
			});
		});
	</script>
	<?php
}
//add_action( 'admin_print_footer_scripts-profile.php', 'deptdir_admin_media_scripts' );
add_action( 'admin_print_footer_scripts-user-edit.php', 'deptdir_admin_media_scripts' );

// 3. Adding the Custom Image section for avatar.
function custom_user_profile_fields( $profileuser ) {
	?>
	<h3><?php _e('Custom Local Avatar', 'deptdir'); ?></h3>
	<table class="form-table deptdir-avatar-upload-options">
		<tr>
			<th>
				<label for="image"><?php _e('Custom Local Avatar', 'deptdir'); ?></label>
			</th>
			<td>
				<?php
				// Check whether we saved the custom avatar, else return the default avatar.
				$custom_avatar = get_the_author_meta( 'deptdir-custom-avatar', $profileuser->ID );
				if ( $custom_avatar == '' ){
					$custom_avatar = get_avatar_url( $profileuser->ID );
				}else{
					$custom_avatar = esc_url_raw( $custom_avatar );
				}
				?>
				<img style="width: 96px; height: 96px; display: block; margin-bottom: 15px;" class="custom-avatar-preview" src="<?php echo $custom_avatar; ?>">
				<input type="text" name="deptdir-custom-avatar" id="deptdir-custom-avatar" value="<?php echo esc_attr( esc_url_raw( get_the_author_meta( 'deptdir-custom-avatar', $profileuser->ID ) ) ); ?>" class="regular-text" />
				<input type='button' class="avatar-image-upload button-primary" value="<?php esc_attr_e("Upload Image","deptdir");?>" id="uploadimage"/><br />
				<span class="description">
					<?php _e('Please upload a custom avatar for your profile, to remove the avatar simple delete the URL and click update.', 'deptdir'); ?>
				</span>
			</td>
		</tr>
	</table>
	<?php
}
add_action( 'show_user_profile', 'custom_user_profile_fields', 10, 1 );
add_action( 'edit_user_profile', 'custom_user_profile_fields', 10, 1 );

// 4. Saving the values.
//add_action( 'personal_options_update', 'deptdir_save_local_avatar_fields' );
add_action( 'edit_user_profile_update', 'deptdir_save_local_avatar_fields' );
function deptdir_save_local_avatar_fields( $user_id ) {
	if ( current_user_can( 'edit_user', $user_id ) ) {
		if( isset($_POST[ 'deptdir-custom-avatar' ]) ){
			$avatar = esc_url_raw( $_POST[ 'deptdir-custom-avatar' ] );
			update_user_meta( $user_id, 'deptdir-custom-avatar', $avatar );
		}
	}
}

// 5. Set the uploaded image as default gravatar.
add_filter( 'get_avatar_url', 'deptdir_get_avatar_url', 10, 3 );
function deptdir_get_avatar_url( $url, $id_or_email, $args ) {
	$id = '';
	if ( is_numeric( $id_or_email ) ) {
		$id = (int) $id_or_email;
	} elseif ( is_object( $id_or_email ) ) {
		if ( ! empty( $id_or_email->user_id ) ) {
			$id = (int) $id_or_email->user_id;
		}
	} else {
		$user = get_user_by( 'email', $id_or_email );
		$id = !empty( $user ) ?  $user->data->ID : '';
	}
	//Preparing for the launch.
	$custom_url = $id ?  get_user_meta( $id, 'deptdir-custom-avatar', true ) : '';
	
	// If there is no custom avatar set, return the normal one.
	if( $custom_url == '' || !empty($args['force_default'])) {
		return esc_url_raw( 'https://wpgd-jzgngzymm1v50s3e3fqotwtenpjxuqsmvkua.netdna-ssl.com/wp-content/uploads/sites/12/2020/07/blm-avatar.png' ); 
	}else{
		return esc_url_raw($custom_url);
	}
}

function extra_profile_fields($user){ ?>

    <h3><?php _e('Extra User Information'); ?></h3>
<table class="form-table">
        <tr>
            <th><label for="phone-number">Phone number</label></th>
<td>
            <input type="text" name="phone-number" id="phone-number" value="<?php echo esc_attr( get_the_author_meta( 'phone-number', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description">Enter your work phone number.</span>
            </td>
 </tr>
        <tr>
            <th><label for="office-location">Office location</label></th>
            <td>
 <input type="text" name="office-location" id="office-location" value="<?php echo esc_attr( get_the_author_meta( 'office-location', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description">Enter your office building and number.</span>
            </td>
        </tr>
<tr>
            <th><label for="user-role">Position</label></th>
            <td>
 <input type="text" name="user-role" id="user-role" value="<?php echo esc_attr( get_the_author_meta( 'user-role', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description">Enter your position within the department.</span>
            </td>
        </tr>

</table>
<?php

}
add_action( 'show_user_profile', 'extra_profile_fields', 10 );
add_action( 'edit_user_profile', 'extra_profile_fields', 10 );

function save_extra_profile_fields( $user_id ) {


    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;
    update_usermeta( $user_id, 'phone-number', $_POST['phone-number'] );
    update_usermeta( $user_id, 'office-location', $_POST['office-location'] );
    update_usermeta( $user_id, 'user-role', $_POST['user-role'] );
    }

add_action( 'personal_options_update', 'save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_profile_fields' );





