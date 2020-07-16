<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chart extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//$this->load->model('data');
		init_painel();
		esta_logado();
		$this->load->model('data_model', 'data');
		}

	public function index()
	{
		$this->init();
	}
	// TODO: refazer a função de carregamento do grafico.
	public function data()
	{
		$data = $this->data->get_data();

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

		//$view_data['category'] = json_encode($resultmes, JSON_NUMERIC_CHECK);
		//$view_data['nomes'] = json_encode($resultdados, JSON_NUMERIC_CHECK);
		print json_encode($resultdados, JSON_NUMERIC_CHECK);
	}
// TODO: procurar uma forma de como carregar o array pela view
	public function init()
	{
		set_tema('titulo', 'Line Chart');
		set_tema('conteudo', load_modulo('chart', 'grafico'));
        set_tema('headerinc', load_js('high'), FALSE);
        set_tema('headerinc', load_css('high'), FALSE);
		set_tema('footerinc', load_js(array('exporting', 'highcharts')), FALSE);
        load_template();

	}

}

/* End of file chart.php */
/* Location: ./application/controllers/chart.php */
