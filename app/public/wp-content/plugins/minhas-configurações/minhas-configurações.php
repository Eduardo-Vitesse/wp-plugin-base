<?php
/**
 * Plugin Name: Minhas configurações
 */

 function minhas_config() {
    register_setting(
        'grupo_minhas_config', 
        'chave_api_minha_integracao', 
        [
            'sanitize_callback' => function($value) {
                if(mb_strlen($value) < 10) {
                    add_settings_error(
                        'chave_api_minha_integracao',
                        esc_attr('chave_api_minha_integracao_error'),
                        'O tamanho da chave de API está incorreto',
                        'error'
                    );
                    return get_option('chave_api_minha_integracao');
                }
                return $value;
            },
        ]
    );

    add_settings_section(
        'minha_secao',
        'Minha Seção',
        function() {
            echo "<p>Cole aqui sua chave da API</p>";
        },
        'grupo_minhas_config',
    );

    add_settings_field(
        'chave_api_minha_integracao', 
        'Chave API da minha integração',
        function($args) {
            $options = get_option('chave_api_minha_integracao')
            ?>
                <input 
                    id="<?php echo esc_attr($args['label_for']); ?>" 
                    type="text" name="chave_api_minha_integracao" v
                    value="<?php echo esc_attr($options); ?>"
                >
            <?php
        },
        'grupo_minhas_config',
        'minha_secao',
        [
            'label_for' => 'chave_api_minha_integracao_html_id',
            'class' => 'minhas_class_tr',
        ]
    );
 }

 add_action('admin_init', 'minhas_config');


function minhas_config_menu() {
    add_options_page(
        'Minhas Configurações',
        'Minhas config',
        'manage_options',
        'minhas-configuracoes',
        'menu_config_html' // Função
    );
}

function menu_config_html() {
    ?>
        <div class="wrap">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            <form action="data.php" method="post">
                <?php
                    settings_fields('grupo_minhas_config');
                    do_settings_sections('grupo_minhas_config');
                    submit_button();
                ?>
            </form>
        </div>
    <?php
}

add_action('admin_menu', 'minhas_config_menu');


