<?php
/**
 *  Este arquivo contem as funções administrativas
 * 
 */

if (!defined('WPINC')) {
    die();
}

function admin_menu_page() {
    add_menu_page(
        'Minha Página Admin',            // Título
        'Novo plugin',                   // Link do menu na sidebar
        'manage_options',                // Capacidade de acesso
        'novo-plugin',                   // Slug
        'np_admin_page_content',         // Callback do conteúdo
        'dashicons-plugins-checked',     // Ícone
        1                                // Prioridade de exibição na sidebar
    );
}

function np_admin_page_content() {
    ?>
        <div class="wrap">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            <form action="options.php" method="post">
                <?php
                    settings_fields('np_settings');
                    do_settings_sections('novo-plugin');
                    submit_button();
                ?>
            </form>
        </div>
    <?php
}

//

function np_register_settings() {
    register_setting(
        'np_settings',        // Nome do grupo
        'np_home_text',       // Nome da opção
        'sanitize_text_field' // Sanitização
    );

    register_setting(
        'np_settings',        // Nome do grupo
        'np_home_logo',       // Nome da opção
        'sanitize_text_field' // Sanitização
    );

    add_settings_section(
        'add_settings_section_id',   // Id da seção
        'Título',                    // titulo
        '',                          // Callback
        'novo-plugin'                // Slug
    );

    add_settings_field(
        'np_home_text_id',          // Id do filed
        'Home Text',                // titulo
        'np_text_field_html',       // Função que mostra o campo
        'novo-plugin',              // Slug
        'add_settings_section_id',  // Id da seção
        [
            'label_for' => 'home_text',
            'class' => 'np_class'
        ]
    );

    add_settings_field(
        'np_home_logo_id',          // Id do filed
        'Logo',                     // titulo
        'np_logo_field_html',       // Função que mostra o campo
        'novo-plugin',              // Slug
        'add_settings_section_id',  // Id da seção
        [
            'label_for' => 'home_logo',
            'class' => 'np_class'
        ]
    );
}

function np_text_field_html() {
    $text = get_option('np_home_text');
    printf('<input type="text" id="np_home_text_id" name="np_home_text" value="%s" />', esc_attr($text));
}

function np_logo_field_html() {
    $logo_id = get_option('np_home_logo');
    if($logo = wp_get_attachment_image_src($logo_id)) {
        echo '<a href="#" class="np-upl"><img src="'. $logo[0] .'"/></a>';
        echo '<a href="#" class="np-rmv">Remover Logo</a>';
        echo '<input type="hidden" name="np_home_logo" value="'. $logo_id.'" />';
    } else {
        echo '<a href="#" class="np-upl">Upload Logo</a>';
        echo '<a href="#" class="np-rmv" style="display: none;">Remover Logo</a>';
        echo '<input type="hidden" name="np_home_logo" value="" />';
    }
}

add_action('admin_menu', 'admin_menu_page');
add_action('admin_init', 'np_register_settings');