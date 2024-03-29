<?php global $post;

if ( ! get_option( 'resume_manager_force_application' ) ) {
	echo '<hr />';
}

if ( is_user_logged_in() && sizeof( $resumes ) ) : ?>
	<form class="apply_with_resume" method="post">
		<p><?php _e( 'Apply', 'wp-job-manager-resumes' ); ?></p>
		<p>
			<label for="resume_id"><?php _e( 'Online resume', 'wp-job-manager-resumes' ); ?>:</label>
			<select name="resume_id" id="resume_id" required>
				<option value=""><?php _e( 'Choose a resume...', 'wp-job-manager-resumes' ); ?></option>
				<?php
					foreach ( $resumes as $resume ) {
						echo '<option value="' . absint( $resume->ID ) . '">' . $resume->post_title . '</option>';
					}
				?>
			</select>
		</p>
		<p>
			<label><?php _e( 'Message', 'wp-job-manager-resumes' ); ?>:</label>
			<textarea name="application_message" cols="20" rows="4" required><?php
				if ( isset( $_POST['application_message'] ) ) {
					echo esc_textarea( stripslashes( $_POST['application_message'] ) );
				} else {
					echo _x( 'To whom it may concern,', 'default cover letter', 'wp-job-manager-resumes' ) . "\n\n";

					printf( _x( 'I am very interested in the %s position at %s. I believe my skills and work experience make me an ideal candidate for this role. I look forward to speaking with you soon about this position.', 'default cover letter', 'wp-job-manager-resumes' ), $post->post_title, get_post_meta( $post->ID, '_company_name', true ) );

					echo "\n\n" . _x( 'Thank you for your consideration.', 'default cover letter', 'wp-job-manager-resumes' );
				}
			?></textarea>
		</p>
		<p>
			<input type="submit" name="wp_job_manager_resumes_apply_with_resume" value="<?php esc_attr_e( 'Send application', 'wp-job-manager-resumes' ); ?>" />
			<input type="hidden" name="job_id" value="<?php echo absint( $post->ID ); ?>" />
		</p>
	</form>
<?php else : ?>
	<form class="apply_with_resume" method="post" action="<?php echo get_permalink( get_option( 'resume_manager_submit_resume_form_page_id' ) ); ?>">
		<p><?php _e( 'It appears you do not have an online resume. Click below to create one and apply.', 'wp-job-manager-resumes' ); ?></p>

		<p>
			<input type="submit" name="wp_job_manager_resumes_apply_with_resume_create" value="<?php esc_attr_e( 'Create resume and apply', 'wp-job-manager-resumes' ); ?>" />
			<input type="hidden" name="job_id" value="<?php echo absint( $post->ID ); ?>" />
		</p>
	</form>
<?php endif; ?>