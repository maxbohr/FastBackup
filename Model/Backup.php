<?php
App::uses('AppModel', 'Model');
/**
 * Backup Model
 *
 */
class Backup extends AppModel {

    public static $target_path = "/var/autobackup";
    public static $backup_db_user = "backupMgr";
    public static $backup_db_password = "backupMgr";

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
		'backup_validity' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'retention_period' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
	);
    
    public function backup_all() {
        $backups = $this->find('all');
        $backup_results = array();
        foreach($backups as $backup) {
            $backup_results[] = $this->create_backup($backup);
        }
        return $backup_results;
    }
    
    public function backup_path($backup, $check_valid_backup = true) {
        if(!file_exists($backup['Backup']['path'])) {
            $backup['Backup']['status'] = "Error";
            $backup['Backup']['message'] = "Path does not exist";
            return $backup;
        }
        if($check_valid_backup && $this->has_valid_backup($backup['Backup']['id'], 'files')) {
            $backup['Backup']['status'] = "Skipped";
            $backup['Backup']['message'] = "Valid backup file present";
            return $backup;
        }
        $date_prefix = date('Y-m-d');
        $target_path = self::$target_path . '/' . $backup['Backup']['name'];
        if(!is_dir($target_path)) {
            mkdir($target_path);
        }
        $target_file = $date_prefix . '-' . $backup['Backup']['name'] . '-files' . '.tgz';
        $target_file_path = "$target_path/$target_file";
        
        $source_file_path = $backup['Backup']['path'];
        
        $command = "tar -czf $target_file_path $source_file_path";
        exec($command, $output, $return_code);
        
        if(!file_exists($target_file_path)) {
            $backup['Backup']['status'] = "Error";
            $backup['Backup']['message'] = "Backup file could not be created";
            return $backup;
        }
        
        $backup['Backup']['status'] = "Success";
        $backup['Backup']['message'] = "";
        return $backup;
    }
    
    public function backup_database($backup, $check_valid_backup = true) {
        $db_user = self::$backup_db_user;
        $db_pass = self::$backup_db_password;
        $db_name = $backup['Backup']['database'];

        $date_prefix = date('Y-m-d');
        $target_path = self::$target_path . '/' . $backup['Backup']['name'];
        if(!is_dir($target_path)) {
            mkdir($target_path);
        }
        $target_file = $date_prefix . '-' . $backup['Backup']['name'] . '-db' . '.sql';
        $target_file_path = "$target_path/$target_file";
        
        $command = "mysqldump --user=$db_user --password=$db_pass $db_name > $target_file_path";
        exec($command);
        exec("gzip $target_file_path");
        $target_file_path .= '.gz';
        
        if(!file_exists($target_file_path)) {
            $backup['Backup']['status'] = "Error";
            $backup['Backup']['message'] = "Backup file could not be created";
            return $backup;
        }
        
        $backup['Backup']['status'] = "Success";
        $backup['Backup']['message'] = "";
        return $backup;
    }

    public function get_backups($id) {
        $backup = $this->read(null, $id);
        $target_path = self::$target_path . '/' . $backup['Backup']['name'];
        if(is_dir($target_path)) {
            chdir($target_path);
            $backup_files = glob('*');
            $backup['Backup']['files'] = array_reverse($backup_files);
        }
        else {
            mkdir($target_path);
            $backup['Backup']['files'] = array();
        }
        return $backup;
    }

    public function validate_env() {
        if(PHP_OS != 'Linux') {
            return false;
        }
        if(!function_exists('exec')) {
            return false;
        }
        return true;
    }
    
    public function has_valid_backup($id, $type) {
        $backup = $this->get_backups($id);
        //TODO: Compare existing backup to check if files have changed:
        // tar -df 2012-05-04-rbh-files.tgz -C /
        // Also create database backup without comments and compare it
        $has_valid_backup = false;
        $date_today = new DateTime("now");
        foreach ($backup['Backup']['files'] as $prev_backup) {
            if($type == 'files' && substr($prev_backup, -9) != 'files.tgz') {
                continue;
            }
            if($type == 'db' && substr($prev_backup, -9) != 'db.sql.gz') {
                continue;
            }
            $date_prev = new DateTime(substr($prev_backup,0,10));
            $date_diff_obj = date_diff($date_prev, $date_today);
            $date_diff = $date_diff_obj->days;
            if($date_diff < $backup['Backup']['backup_validity']) {
                $has_valid_backup = true;
                break;
            }
        }
        return $has_valid_backup;
    }
    
    public function create_backup($backup, $check_valid_backup = true) {
        if(!empty($backup['Backup']['path'])) {
            if($check_valid_backup && $this->has_valid_backup($backup['Backup']['id'], 'files')) {
                $backup['Backup']['status'] = "Skipped";
                $backup['Backup']['message'] = "Valid backup file present";
                return $backup;
            }
            $backup_result = $this->backup_path($backup, $check_valid_backup);
            if($backup_result['Backup']['status']  != 'Success') {
                return $backup_result;
            }
        }
        if(!empty($backup['Backup']['database'])) {
            if($check_valid_backup && $this->has_valid_backup($backup['Backup']['id'], 'db')) {
                $backup['Backup']['status'] = "Skipped";
                $backup['Backup']['message'] = "Valid backup file present";
                return $backup;
            }
            $backup_result = $this->backup_database($backup, $check_valid_backup);
        }
        return $backup_result;
    }
    
}
