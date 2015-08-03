<div class="note-tab-wrap">
    <h3><?php _e( 'Notes', 'wp-erp' ) ?></h3>

    <form action="" class="note-form" method="post">
        <?php erp_html_form_input( array(
            'name'        => 'note',
            'required'    => true,
            'placeholder' => __( 'Add a note...', 'wp-erp' ),
            'type'        => 'textarea',
            'custom_attr' => array( 'rows' => 3, 'cols' => 30 )
        ) ); ?>

        <input type="hidden" name="user_id" value="<?php echo $employee->id; ?>">
        <input type="hidden" name="action" id="erp-employee-action" value="erp-hr-employee-new-note">

        <?php wp_nonce_field( 'wp-erp-hr-employee-nonce' ); ?>
        <?php submit_button( __( 'Add Note', 'wp-erp' ), 'primary' ); ?>
    </form>

    <?php
    $no_of_notes = 10;
    $total_notes = $employee->count_notes();
    $notes = $employee->get_notes( $no_of_notes );

    if ( $notes ) {
        ?>
        <ul class="erp-list notes-list">
            <?php foreach( $notes as $note ) { ?>
            <li>
                <div class="avatar-wrap">
                    <?php echo get_avatar( $note->user->user_email, 64 ); ?>
                </div>

                <div class="note-wrap">
                    <div class="by">
                        <a href="#" class="author"><?php echo $note->user->display_name; ?></a>
                        <span class="date"><?php echo erp_format_date( $note->created_at, __( 'M j, Y \a\t g:i a', 'wp-erp' ) ); ?></span>
                    </div>

                    <div class="note-body">
                        <?php echo wpautop( $note->comment ); ?>
                    </div>

                    <div class="row-actions">
                        <span class="delete"><a href="#" class="delete_note" data-note_id="<?php echo $note->id; ?>"><?php _e( 'Delete Permanently', 'wp-erp' ); ?></a></span>
                    </div>
                </div>
            </li>
            <?php } ?>
        </ul>

        <?php if ( $no_of_notes < $total_notes ): ?>
            <?php submit_button( 'Load More', false, 'erp-load-notes', true, array( 'id' => 'erp-load-notes', 'data-total_no' => $no_of_notes, 'data-offset_no' => $no_of_notes, 'data-user_id' => $employee->id ) ); ?>
        <?php endif ?>

    <?php } ?>
</div>