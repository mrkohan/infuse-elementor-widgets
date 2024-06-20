<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
use Elementor\Controls_Manager;
add_action('elementor/widgets/widgets_registered', function () {
    
class Elementor_Testimonial_Slider_Widget extends \Elementor\Widget_Base {
    public function get_name() {
        return 'testimonial_slider';
    }

    public function get_title() {
        return __( 'Testimonial Slider', 'infuse-elementor-widgets' );
    }

    public function get_icon() {
        return 'eicon-slider-album';
    }

    public function get_categories() {
        return [ 'basic' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'infuse-elementor-widgets' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'testimonial_content',
            [
                'label' => __( 'Testimonial', 'infuse-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Testimonial Content', 'infuse-elementor-widgets' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'testimonial_author',
            [
                'label' => __( 'Author', 'infuse-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'John Doe', 'infuse-elementor-widgets' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'testimonial_position',
            [
                'label' => __( 'Position', 'infuse-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Marketing and Advertising', 'infuse-elementor-widgets' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'testimonials',
            [
                'label' => __( 'Testimonials', 'infuse-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'testimonial_content' => __( 'Testimonial Content #1', 'infuse-elementor-widgets' ),
                        'testimonial_author' => __( 'John Doe', 'infuse-elementor-widgets' ),
                        'testimonial_position' => __( 'Marketing and Advertising', 'infuse-elementor-widgets' ),
                    ],
                ],
                'title_field' => '{{{ testimonial_author }}}',
            ]
        );

        $this->end_controls_section();
    }

  protected function render() {
    $settings = $this->get_settings_for_display();
    ?>
    <div class="testimonial-slider">
        <?php foreach ( $settings['testimonials'] as $testimonial ) : ?>
            <div class="testimonial-slide">
                <p class="testimonial-content"><?php echo $testimonial['testimonial_content']; ?></p>
                <p class="testimonial-author"><?php echo $testimonial['testimonial_author']; ?></p>
                <p class="testimonial-position"><?php echo $testimonial['testimonial_position']; ?></p>
            </div>
        <?php endforeach; ?>
        <div class="testimonial-arrows">
        <button class="prev">&lt;</button>
        <button class="next">&gt;</button>
        </div>
    </div>
    <?php
}

    protected function _content_template() {
        ?>
        <#
        var testimonials = settings.testimonials;
        #>
        <div class="testimonial-slider">
            <# _.each( testimonials, function( testimonial ) { #>
                <div class="testimonial-slide">
                    <p class="testimonial-content">{{{ testimonial.testimonial_content }}}</p>
                    <p class="testimonial-author">{{{ testimonial.testimonial_author }}}</p>
                    <p class="testimonial-position">{{{ testimonial.testimonial_position }}}</p>
                </div>
            <# }); #>
        </div>
        <?php
    }
}

    \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Elementor_Testimonial_Slider_Widget());
});
