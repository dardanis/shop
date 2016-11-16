<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Laravel\Cashier\Billable;
use Laravel\Cashier\Contracts\Billable as BillableContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract,BillableContract {

	use Authenticatable, CanResetPassword,Billable;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['role_id','name','lastname', 'email','username','password','active'];

	protected $dates=['trial_ends_at','subscription_ends_at'];
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	public function role()
	{
		return $this->hasOne('App\Role', 'id', 'role_id');
	}
	public function hasRole($roles)
	{
		$this->have_role = $this->getUserRole();
		
		if(is_array($roles)){
			foreach($roles as $need_role){
				if($this->checkIfUserHasRole($need_role)) {
					return true;
				}
			}
		} else{
			return $this->checkIfUserHasRole($roles);
		}
		return false;
	}

	private function getUserRole()
	{
		return $this->role()->getResults();
	}

	private function checkIfUserHasRole($need_role)
	{
		return (strtolower($need_role)==strtolower($this->have_role->name)) ? true : false;
	}

	public function accountIsActive($code) {
		$user = User::where('activation_code', '=', $code)->first();
		$user->active = 1;
		$user->activation_code = '';
		if($user->save()) {
			\Auth::login($user);
		}
		return true;
	}
	public function products(){
		return $this->hasMany('App\Product');
	}

	public function confirmEmail()
	{
		$this->active = true;
		$this->token = null;
		$this->save();
	}

}
