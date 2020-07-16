<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chart extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('data');
	}  
	
	public function index()
	{
		$this->data();
	}
	
	public function data()
	{
		
		$data = $this->data->get_data();
		
		/*$category = array();
		$category['name'] = 'Category';
		*/
		$series1 = array();
		$series1['name'] = 'WordPress';
		
		$series2 = array();
		$series2['name'] = 'CodeIgniter';
		
		$series3 = array();
		$series3['name'] = 'Highcharts';
		
		foreach ($data as $row)
		{
		    $category['data'][] = $row->month;
			$series1['data'][] = $row->wordpress;
			$series2['data'][] = $row->codeigniter;
			$series3['data'][] = $row->highcharts;

		}
		
		$resultmes = array();
		array_push($resultmes,$category);
		$resultdados = array();
		array_push($resultdados,$series1);
		array_push($resultdados,$series2);
		array_push($resultdados,$series3);
		
		//print json_encode($resultmes, JSON_NUMERIC_CHECK);
		//print json_encode($resultdados, JSON_NUMERIC_CHECK);
		$this->view_data['category'] = json_encode($resultmes, JSON_NUMERIC_CHECK);
		$this->view_data['dados'] = json_encode($resultdados, JSON_NUMERIC_CHECK);
				
		//$this->load->view('chart');
		$this->load->view('chart', $this->view_data);
	}
	
}

/* End of file chart.php */
/* Location: ./application/controllers/chart.php */