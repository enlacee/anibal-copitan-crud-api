<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.altimea.com
 * @since      1.0.0
 *
 * @package     accapi
 * @subpackage  accapi/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package     accapi
 * @subpackage  accapi/admin
 * @author     Altimea <apps@altimea.com>
 */
class  accapiAdmin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $accapi    The ID of this plugin.
	 */
	private $accapi;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $accapi       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $accapi, $version ) {

		$this->accapi = $accapi;
		$this->version = $version;
		$this->file = accapi_get_file_path();

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in  accapiLoader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The  accapiLoader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->accapi, plugin_dir_url( __FILE__ ) . 'css/accapi-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in  accapiLoader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The  accapiLoader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->accapi, plugin_dir_url( __FILE__ ) . 'js/accapi-admin.js', array( 'jquery' ), $this->version, true );

	}


	/*
	* Agregar menu
	*/
	public function add_menu()
	{
		add_menu_page(
			'Settings Anibal Copitan Crud API',
			'Settings Anibal Copitan Crud API',
			'manage_options', // capability *admin*
			$this->file,
			array($this, 'display_menu_content'),
			null,
			null
		);
	}

	/*
	* View
	*/
	static function display_menu_content()
	{
		?>
		<div class="wrap">
		  <h2>Anibal Copitan Crud API(beta)
		  <button class="button action"  onclick="app.listado()">Listar registros</button> 
		  <button class="button action" onclick="app.verUltimosRegistros()">Ultimos Registros</button>
		  </h2>
		
		  <div id="application">
			<table id="list" class="wp-list-table widefat striped">
				<thead>
				<tr>
					<th width="5%">User ID</th>
					<th width="25%">Nombre</th>
					<th width="25%">Correo</th>
					<th width="25%">Sexo</th>
					<th width="20%">Acciones</th>
				</tr>
				</thead>
				<tbody>
					<tr id="add">
						<form action="" method="post" autocomplete="off">
						<td><input type="text" value="AUTO" disabled></td>
						<td><input type="text" id="nombre" name="nombre" ></td>
						<td><input type="email" id="correo" name="correo"></td>
						<td>
							<select id="sexo" name="sexo">
								<option value="Male">Masculino</option>
								<option value="Female">Fememino</option>
							</select>
						</td>
						<td><button id="newsubmit" name="newsubmit" type="submit" onclick="app.agregar(event)">Agregar</button></td>
						</form>
					</tr>
				</tbody>
			</table>


			<table id="edit" style="display:none" class='wp-list-table widefat striped'>
			  <thead>
			    <tr>
			      <th width='5%'>User ID</th>
			      <th width='25%'>Nombre</th>
			      <th width='25%'>Correo</th>
			      <th width='25%'>Sexo</th>
			      <th width='20%'>Acciones</th>
			    </tr>
			  </thead>
			  <tbody>
			    <form action='' method='post'>
			      <tr>
			        <td width='5%'><input type='hidden' id='edit-id' name='edit-id' value=''></td>
			        <td width='25%'><input type='text' id='edit-nombre' name='edit-nombre' value=''></td>
			        <td width='25%'><input type='text' id='edit-correo' name='edit-correo' value=''></td>
			        <td width='25%'>
				    	<select id='edit-sexo' name='edit-sexo'>
				    		<option value='Male' >Masculino</option>
				    		<option value='Female' >Fememino</option>
				    	</select></td>
			        <td width='20%'>
					<button id='uptsubmit' name='uptsubmit' type='submit' onclick="app.editarYGuardar(event)">Actualizar</button>
					<button type='button' onclick="app.editarYCancelar(event)">Cancelar</button></td>
			      </tr>
			    </form>
			  </tbody>
			</table>

		  </div>
		</div>
		<?php
	}

}
