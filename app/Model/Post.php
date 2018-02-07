<?php
App::uses('AppModel', 'Model');
/**
 * Post Model
 *
 */
class Post extends AppModel {

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $actsAs = array(
		'Upload.Upload' => array(
			'photo' => array(
				//Local onde será salva
				'pathMethod' => 'flat',

				//Campos personalizados
				'fields' =>	array(
					'dir' => 'dir',
					'type' => 'mimetype',
					'size' => 'filesize',
				),

				// Thumbnails
				'thumbnailMethod' => 'php', //GD
				'thumbnailSize' => array(
					'avatar' => '150x150', 
					'thumb' => '80x80',
				)
			),
		)
	);

	public function beforeValidate($options = array()){
		if(!empty($this->data['Post']['photo'])){
			$filename = $this->data['Post']['photo']['name'];
			$parts = explode('.', $filename);
			$ext = end($parts);

			$filename = $this->data['Post']['slug'];
			$filename .= '_' . substr(md5(time()), 0, 5);
			$filename .= '.' . $ext;

			$this->data['Post']['photo']['name'] = $filename;
		}

		return parent::beforeValidate($options);
	}

	public $validate = array(
		'title' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Informe um título para o novo post!',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'slug' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Informe um slug para o novo post!',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'text' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Informe o texto do post!',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
