<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Project;
use App\Rank;
use Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Session\Store;
use App\Models\Deposit;
use App\Models\Statistic;
use Carbon\Carbon;
use Cache;

class AdminBaseController extends BaseController {
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests, AuthenticatesUsers;

	protected $_visitor;

	public function __construct(Store $session) {
            
		$this->middleware('admin', ['except' => ['login', 'index']]);
	}

	public function username() {
		return 'name';
	}

	public function index() {
            
		$this->_visitor = Auth::user();
                
		if ($this->_visitor)
		{
			if (in_array($this->_visitor->id, [1])) {

				return view('vendor.adminlte.dashboard');
			}
			else
            {
				return view('vendor.adminlte.login')->with('error', 'Không thể đăng nhập');
			}
		}

		return view('vendor.adminlte.login');
	}

	/**
	 * The user has been authenticated.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  mixed  $user
	 * @return mixed
	 */
	protected function authenticated(Request $request, $user) {
		return redirect()->route('admin.admin.index');
	}

	public function callAction($method, $parameters) {
		return parent::callAction($method, $parameters);
	}

}
