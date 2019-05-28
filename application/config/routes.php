<?php if (!defined('SITEPATH')) exit('No direct script access allowed');

use caichuanhai\router;

Router::setDefaultRoute('cai@chuanhai');
Router::set404Route('cai@chuanhai404');

Router::get('a/c/[0-9]+', 'a@bb')->name('ab')->middleware('aa');
Router::post('a/b/(:num)', 'a@bpost')->name('abc')->middleware('aa');

Router::name('cd')->any('c/d', 'c@d')->middleware(['bb', 'bb1']);

Router::prefix('cai')->middleware('chuan')->name('cch.')->group(function (){

	Router::any('e/f', 'e@f')->name('123');

	Router::any('g/[0-9]', 'e@f')->middleware('hai');

});

Router::get('c/caichuanhai', function (){
	/*由于在运行路由时，还未加载控制器，所以不能获取控制器对象，以下代码无法运行*/
	$c = & get_instance();
	$c->load->view('index.html', array('the' => 'variables', 'go' => 'here'));
});