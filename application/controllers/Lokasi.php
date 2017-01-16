<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lokasi extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @author Yusuf Ayuba
	 * @header    
	 */
	public function index()
	{
		$this->peta();
	}

	public function peta()
	{
		$this->load->library('googlemaps');

		$config = array();
		$config['center'] = 'auto';
		$config['zoom'] = '5';
		$config['onboundschanged'] = 'if (!centreGot) {
			var mapCentre = map.getCenter();
			marker_0.setOptions({
				position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng()) 
			});
		}
		centreGot = true;';
		$this->googlemaps->initialize($config);
	   
		// set up the marker ready for positioning 
		// once we know the users location
		$marker = array();
		$marker['draggable'] = true;
		$marker['ondragend'] = 'alert(\'You just dropped me at: \' + event.latLng.lat() + \', \' + event.latLng.lng());';

		$config['places'] = TRUE;
		$config['placesAutocompleteInputID'] = 'searchInput';
		$config['placesAutocompleteBoundsMap'] = TRUE; // set results biased towards the maps viewport
		$config['placesAutocompleteOnChange'] = 'createMarker_map({ map: map, position:event.latLng });';

		$this->googlemaps->add_marker($marker);
		$this->googlemaps->initialize($config);
		$data['map'] = $this->googlemaps->create_map();
		$this->load->view('map_lokasi', $data);
	}
}