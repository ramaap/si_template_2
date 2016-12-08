<?php

class databased extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Model template  
        $this->load->model('data_profile');
        // Place your model here...
    }

    public function index() {
        $this->lib->check_session();
        $this->lib->check_lokasi("Database");

        $data['error'] = '';
        $data['status'] = '';
        $data['profile'] = $profil;
        // $this->session->set_userdata("error","");
        $this->load->view('pengaturan/profile_view', $data);
    }

    public function backup() {
        $data['akses'] = 'pg_backup';
        $this->session->set_userdata("akses_id", $data['akses']);
        $this->lib->check_session();
        $this->lib->check_lokasi("Backup Database");

        $data['error'] = '';
        $data['status'] = '';
        // $this->session->set_userdata("error","");
        $this->load->view('pengaturan/database_backup_view', $data);
    }

    public function restore() {
        $data['akses'] = 'pg_restore';
        $this->session->set_userdata("akses_id", $data['akses']);
        $this->lib->check_session();
        $this->lib->check_lokasi("Restore Database"); 

        $data['error'] = '';
        $data['status'] = '';
        // $this->session->set_userdata("error","");
        $this->load->view('pengaturan/database_restore_view', $data);
    }

    function backup_now() {
		ini_set('max_execution_time', 0); 
		ini_set('memory_limit','2048M');

		// Load the DB utility class
		$this->load->dbutil();
		$prefs = array(
                'tables'      => array(),  // Array of tables to backup.
                'ignore'      => array("ci_sessions","log"), // List of tables to omit from the backup
                'format'      => 'txt',             // gzip, zip, txt
                'filename'    => 'mybackup '.date("d M Y").'.txt',    // File name - NEEDED ONLY WITH ZIP FILES
                'add_drop'    => TRUE,              // Whether to add DROP TABLE statements to backup file
                'add_insert'  => TRUE,              // Whether to add INSERT data to backup file
                'newline'     => "\n"               // Newline character used in backup file
              );

		
		// Backup your entire database and assign it to a variable
		$backup =& $this->dbutil->backup($prefs);

		// Load the file helper and write the file to your server
		$this->load->helper('file');
		write_file('/path/to/mybackup.txt', $backup); 

		// Load the download helper and send the file to your desktop
		$this->load->helper('download');
		force_download('Backup '.date("d M Y").'.txt', $backup);
	}
    
    function restore_now() {
		
		ini_set('max_execution_time', 0); 
		ini_set('memory_limit','2048M');
        $this->load->helper('file');
        $config['upload_path'] = dirname(BASEPATH) . '/fileholder/';
        $config['file_name'] = 'import';
        $config['allowed_types'] = 'txt';
        $config['overwrite'] = TRUE;
        $this->upload->initialize($config);
        $this->load->library('upload', $config);
		 
        include APPPATH . 'config/database.php';
        $this->dbconfig = $db; 
        $mysql_hostname = $this->dbconfig['default']['hostname'];
        $mysql_username = $this->dbconfig['default']['username'];
        $mysql_password = $this->dbconfig['default']['password'];
        $mysql_database = $this->dbconfig['default']['database'];
        $mysql_dbdriver = $this->dbconfig['default']['dbdriver'];
       // $this->dbconfig['default']['dbdriver']="mysqli";

        if (!$this->upload->do_upload()) { //upload failed
            $data['warning'] = 'gagal';
            $data['error'] = $this->upload->display_errors();
            $data['subtitle'] = 'Export Import';
            redirect('pengaturan/databased/restore');
        } else {
            $this->post['warning'] = 'import berhasil dilakukan';
            $filename = dirname(BASEPATH) . '/fileholder/import.txt'; 
			$result=false; 
			 
          /*   $query = '';
            $display = '';
            $tables = $this->db->list_tables();
            $this->load->dbforge();
            $x = 0;
            foreach ($tables as $table) {
                if ($table == 'ci_sessions' || $table == 'log')
                    continue;
                else
                    $this->dbforge->drop_table($table);
            } */
			
			$isi_file = file_get_contents($filename);
			$string_query = rtrim( $isi_file, "\n;" );
			$array_query = explode(";", $string_query);
			foreach($array_query as $query){
				
				if($mysql_dbdriver=="mysql")
				// mysql_query($query);
				$this->db->query($query);
				else
				$this->db->query($query);
			}
			
		 

			$this->db->query("CREATE TABLE IF NOT EXISTS `ci_sessions` (
				  `id` varchar(40) NOT NULL,
				  `ip_address` varchar(45) NOT NULL,
				  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
				  `data` blob NOT NULL,
				  PRIMARY KEY (`id`),
				  UNIQUE KEY `ci_sessions_id_ip` (`id`,`ip_address`),
				  KEY `ci_sessions_timestamp` (`timestamp`)
				) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

			$this->db->query('
				CREATE TABLE IF NOT EXISTS `log` (
				  `log_id` bigint(20) NOT NULL AUTO_INCREMENT,
				  `log_action` varchar(20) NOT NULL,
				  `log_menu` varchar(50) NOT NULL,
				  `log_tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
				  `log_keterangan` text NOT NULL,
				  `last_update` timestamp NULL DEFAULT NULL,
				  `last_user_id` smallint(6) NOT NULL,
				  `is_delete` tinyint(4) NOT NULL,
				  PRIMARY KEY (`log_id`)
				) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=497 ;');


			redirect('login/logout/'); 
			 
        }
    }
 
}

	/*
		backup & restore
		versi 2.0 
		edited by indra pradipta - @2016
	*/
