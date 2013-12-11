<?php
class MailinglijstSettings
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'Settings Admin', 
            'Mailinglijst', 
            'manage_options', 
            'my-setting-admin', 
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'mailinglijst' );
        ?>
        <div class="wrap">
            <?php screen_icon(); ?>
            <h2>Mailinglijst Settings</h2>           
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'mailinglijst_group' );   
                do_settings_sections( 'mailinglijst-admin' );
                submit_button(); 
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {        
        register_setting(
            'mailinglijst_group', // Option group
            'mailinglijst', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            'Lijstgegevens', // Title
            array( $this, 'print_section_info' ), // Callback
            'mailinglijst-admin' // Page
        );  

        add_settings_field(
            'lijstnummer', // ID
            'Lijstnummer', // Title 
            array( $this, 'lijstnummer_callback' ), // Callback
            'mailinglijst-admin', // Page
            'setting_section_id' // Section           
        );      

        add_settings_field(
            'formtype', 
            'Aanmeldformulier', 
            array( $this, 'formtype_callback' ), 
            'mailinglijst-admin', 
            'setting_section_id'
        );      
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
        if( isset( $input['lijstnummer'] ) )
            $new_input['lijstnummer'] = absint( $input['lijstnummer'] );

        if( isset( $input['formtype'] ) )
            $new_input['formtype'] = sanitize_text_field( $input['formtype'] );

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'Enter your settings below:';
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function lijstnummer_callback()
    {
        printf(
            '<input type="text" id="lijstnummer" name="mailinglijst[lijstnummer]" value="%s" />',
            isset( $this->options['lijstnummer'] ) ? esc_attr( $this->options['lijstnummer']) : ''
        );
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function formtype_callback()
    {
    	$options = array(
    		'popup'=>'popup',
    		'iframe' => 'iframe',
    		'fast' => 'FAST'
    	);
    	echo '<select id="formtype" name="mailinglijst[formtype]">';
    	foreach($options as $key=>$val) {
	    	printf(
	    		'<option value="'.$key.'" %s>'.$val.'</option>',
	    		(isset( $this->options['formtype'] ) && (esc_attr( $this->options['formtype'])==$key)) ? 'selected="selected"' : ''
	    	);
    	}
    	echo '</select>';
    }
}

if( is_admin() )
    $my_settings_page = new MailinglijstSettings();