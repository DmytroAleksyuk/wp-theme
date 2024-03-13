<?php
/**
 * Allow users to sign up using an email address as their username.
 * Removes the default restriction of [a-z0-9] and replaces it with [a-z0-9+_.@-].
 *
 * @param $result
 *
 * @return array $result
 */
function disable_username_character_type_restriction( $result ) {
	$errors    = $result['errors'];
	$user_name = $result['user_name'];

	// The error message to look for. This should exactly match the error message from ms-functions.php -> wpmu_validate_user_signup().
	$error_message = __( 'Usernames can only contain lowercase letters (a-z) and numbers.' );

	// Look through the errors for the above message.
	if ( ! empty( $errors->errors['user_name'] ) ) {
		foreach ( $errors->errors['user_name'] as $i => $message ) {

			// Check if it's the right error message.
			if ( $message === $error_message ) {

				// Remove the error message.
				unset( $errors->errors['user_name'][ $i ] );

				// Validate using different allowed characters based on sanitize_email().
				$pattern = "/[^a-z0-9_.@-]/i";
				if ( preg_match( $pattern, $user_name ) ) {
					$errors->add( 'user_name', __( 'Username is invalid. Usernames can only contain: lowercase letters, numbers, and these symbols: <code>_ - .</code>.' ) );
				}

				// If there are no errors remaining, remove the error code
				if ( empty( $errors->errors['user_name'] ) ) {
					unset( $errors->errors['user_name'] );
				}
			}
		}
	}

	return $result;
}

add_filter( 'wpmu_validate_user_signup', 'disable_username_character_type_restriction', 20 );

/**
 * Enable unfiltered_html capability for Editors.
 *
 * @param  array $caps The user's capabilities.
 * @param  string $cap Capability name.
 * @param  int $user_id The user ID.
 *
 * @return array  $caps    The user's capabilities, with 'unfiltered_html' potentially added.
 */
function add_unfiltered_html_capability_to_editors( $caps, $cap, $user_id ) {
	if ( 'unfiltered_html' === $cap && ( user_can( $user_id, 'editor' ) || user_can( $user_id, 'administrator' ) ) ) {
		$caps = array( 'unfiltered_html' );
	}

	return $caps;
}

add_filter( 'map_meta_cap', 'add_unfiltered_html_capability_to_editors', 1, 3 );