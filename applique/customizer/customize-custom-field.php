<?php

if ( !defined( 'ABSPATH' ) ) { exit; }

/**
 * Build the new field of customizer theme.
 * Such as : - Number Field,
 *           - Custom Css Textarea,
 *           - Category Dropdown
 *
 * @since 1.0.0
 */

if ( class_exists( 'WP_Customize_Control' ) ) {

	class Customize_Number_Control extends WP_Customize_Control {
		public $type = 'number';
		public $min  = '-1';
		public $max  = '12';

		public function render_content() {
			?>
			<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<input type="number" min="<?php echo esc_attr( $this->min ) ?>" max="<?php echo esc_attr( $this->max ) ?>" name="quantity" <?php esc_html( $this->link() ); ?> value="<?php echo esc_attr( $this->value() ); ?>" style="width:70px;">
			</label>
			<?php
		}
	}

    class WP_Customize_Category_Control extends WP_Customize_Control {

        public function render_content() {
            $dropdown = wp_dropdown_categories(
                array(
                    'name'              => '_customize-dropdown-categories-' . $this->id,
                    'echo'              => 0,
                    'show_option_none'  => esc_html__( 'Select Category', 'applique' ),
                    'option_none_value' => '0',
                    'selected'          => $this->value(),
                )
            );

            // Hackily add in the data link parameter.
            $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );

            printf(
                '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
                $this->label,
                $dropdown
            );
        }
    }
}