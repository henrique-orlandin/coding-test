<?php

	class MY_Controller extends CI_Controller {

	    protected $_module = '';
	    protected $_moduleImg = '';
	    protected $_baseUrl = '';
	    protected $_siteUrl = '';
	    protected $_baseImg = '';
	    protected $_baseSvg = '';
	    protected $_baseCss = '';
	    protected $_baseJs = '';
	    protected $_basePlugins = '';
	    protected $company = false;
	    public $_loadedAssets = '';

		public function __construct (){

			error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

			parent::__construct();

			$this->load->library('template');
			$this->load->library('session');
			$this->load->helper('url');
			$this->load->helper('email');
			$this->load->helper('string');

			if(ENVIRONMENT == 'development'){
	            $this->output->enable_profiler(FALSE);
	        }

	        $this->_module = $this->router->fetch_module();
	        $this->_baseUrl = $this->config->item('base_url');
	        $this->_siteUrl = $this->config->site_url();

	        $layoutPath = "comum";

	        $this->_moduleImg = $this->_baseUrl . APPPATH . 'modules/'.$this->_module.'/assets/img/';
	        $this->_baseImg = $this->_baseUrl . APPPATH . 'modules/'.$layoutPath.'/assets/img/';
	        $this->_baseSvg = $this->_baseUrl . APPPATH . 'modules/'.$layoutPath.'/assets/svg/';
	        $this->_baseCss = $this->_baseUrl . APPPATH . 'modules/'.$layoutPath.'/assets/css/';
	        $this->_baseJs = $this->_baseUrl . APPPATH . 'modules/'.$layoutPath.'/assets/js/';
	        $this->_basePlugins = $this->_baseUrl . APPPATH . 'modules/'.$layoutPath.'/assets/plugins/';

	        $site_urls = array(
	            'siteUrl'=> $this->_siteUrl,
	            'baseJs'=> $this->_baseJs,
	            'basePlugins'=> $this->_basePlugins,
	            'baseImg'=> $this->_baseImg,
	            'baseSvg'=> $this->_baseSvg,
	            'baseCss' => $this->_baseCss,
	            'module' => $this->_module,
	            'moduleImg' => $this->_moduleImg
	        );

	        $layout = $layoutPath.'/views/layouts/default';
	        $partialHeader = $layoutPath.'/parts/header';
	        $partialFooter = $layoutPath.'/parts/footer';

	        $this->load->model('comum/comum_m');

            $this->template->set("_siteUrls", $site_urls)
                            ->set_layout($layout)
                            ->set('csrf_test_name', $this->security->get_csrf_hash());
		}

		protected function autoLoadAssets (){

			$module = "application/modules/".$this->_module."/assets/";
			$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($module));

			while($it->valid()) {

			    if (!$it->isDot()) {

			    	$extensionTest = explode('.', $it->getSubPathName());
			    	$extensionTest = strtolower($extensionTest[count($extensionTest)-1]);
			    	if ($extensionTest == 'css' || $extensionTest == 'js'){

			    		$file = str_replace("\\", "/", $this->_siteUrl.$module.$it->getSubPathName());

				    	if ($it->getSubPath() == 'js'){
				    		$file = '<script type="text/javascript" src="'.$file.'?v='.$this->config->item('version').'"></script>';
				    		$this->_loadedAssets .= $file;
				    	}
				        else if ($it->getSubPath() == 'css'){
				        	$file = '<link media="none" onload="if(media!=\'all\')media=\'all\'" rel="stylesheet" type="text/css" href="'.$file.'?v='.$this->config->item('version').'" />';
				    		$this->_loadedAssets .= $file;
				    	}

			    	}
			    }

			    $it->next();
			}
		}

        public function upload_single ($file, $folder, $name, $type = 'image', $width = 2000, $height = 2000)
        {
            set_time_limit(0);

			$this->load->library('Slug');
			$this->load->library('WideImage');
			$dir = FCPATH.'userfiles/'.$folder;
			$files = $file;

			if (!is_dir($dir))
				mkdir($dir, 0755);

            $countSiblings = 0;
			$readDirectory = scandir($dir);
			foreach($readDirectory as $rd){
				if($rd != '.' && $rd != '..'){
					if (preg_match('/'.$this->slug->slugger($name,'-').'/i', $rd))
						$countSiblings++;
				}
			}

			$newName = explode('.', $files['name']);
			$ext = end($newName);
			$newName = ($countSiblings > 0) ? '-'.$countSiblings : '';
			$newName = $this->slug->slugger($name,'-') . $newName . '.' . $ext;

			move_uploaded_file($files["tmp_name"], $dir.'/'.$newName);

			return $newName;
        }

        public function seo($title = FALSE, $description = FALSE, $keywords = FALSE, $image = FALSE, $canonical = FALSE)
        {

            $json_ld =
            [
                "@context" => "https://schema.org",
                "@type" => "Organization",
                "name" => $this->company->company,
                "url" => $this->_baseUrl,
                "logo" => $this->_baseImg.'logo.png',
                "foundingDate" => "2019",
                "founders" => [
                    [
                        "@type" => "Person",
                        "name" => "Leonardo Daniel Bianchi"
                    ]
                ],
                "address" => [
                    "@type" => "PostalAddress",
                    "streetAddress" => $this->company->street.', '.$this->company->number,
                    "addressLocality" => $this->company->city,
                    "addressRegion" => $this->company->state,
                    "postalCode" => $this->company->zipcode,
                    "addressCountry" => "BRL"
                ],
                "contactPoint" => [
                    "@type" => "ContactPoint",
                    "contactType" => "customer support",
                    "telephone" => "[+55".preg_replace('/\D/','',$this->company->phone)."]",
                    "email" => $this->company->email
                ],
                "sameAs" => [
                    $this->company->facebook,
                    $this->company->twitter,
                    $this->company->instagram,
                    $this->company->youtube,
                ]
            ];

            if($title) {
                $json_ld =
                [
                    "@context" => "http://schema.org",
                    "@type" => "WebPage",
                    "name" => $title,
                    "description" => !empty($description) ? $description : $this->company->description,
                ];
            }

            $this->template
                ->set_metadata('description', !empty($description) ? $description : $this->company->description)
                ->set_metadata('keywords', !empty($keywords) ? $keywords : $this->company->keywords)

                ->set_metadata('og:locale', 'pt_BR')
                ->set_metadata('og:url', site_url($this->uri->uri_string()))
                ->set_metadata('og:title', !empty($title) ? $title : $this->company->company)
                ->set_metadata('og:site_name', $this->company->company)
                ->set_metadata('og:description', !empty($description) ? $description : $this->company->description)
                ->set_metadata('og:type', 'website')
                ->set_metadata('og:image', !empty($image) ? $image : $this->_baseImg.'logo.png')

                ->set_metadata('twitter:card', 'summary')
                ->set_metadata('twitter:title', !empty($title) ? $title : $this->company->company)
                ->set_metadata('twitter:decription', !empty($description) ? $description : $this->company->description)
                ->set_metadata('twitter:image', !empty($image) ? $image : $this->_baseImg.'logo.png')
                ->set('json_ld', $json_ld)
                ->set('canonical', !empty($canonical) ? $canonical : site_url($this->uri->uri_string()));
        }

	}
?>