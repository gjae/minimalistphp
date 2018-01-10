<?php  
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class User extends Eloquent{

	protected $table = 'users';
	public $dates = ['deleted_at',];
	protected $fillable = [
		'email', 'password', 'avatar', 	
	];
	protected $guard = ['persona_id', 'clave'];
	protected $hidden = ['password'];


	/**
	 * LAS FUNCIONES "SET...ATTRIBUTE"
	 * PERMITEN ARREGLAR UN VALOR ANTES DE INSERTARLO
	 * EN LA BD
	 */
	public function setPasswordAttribute($value)
	{
		$this->attributes['clave'] = md5( trim($value) );
	}

	public function setEmailAttribute($value)
	{
		$this->attributes['email'] = trim($value);
	}
}