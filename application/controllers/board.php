<?php

/**
 * Board Controller
 */
class Board_Controller extends Base_Controller {

	public $restful = true;

	/**
	 * The Homepage
	 *
	 * List all the boards
	 */
	public function get_listAll() {
		// get a list of all the boards
		$boardlist = DB::table('boards')
			->order_by('position', 'asc')
			->get();
		return View::make('board-list')->with('boardlist', $boardlist);
	}

	/**
	 * Create a board
	 */
	public function post_new() {
		$data = Input::get();
		$rules = array(
			'name'			=> 'required',
			'description'	=> 'required',
			'position'		=> 'integer',
		);
		$val = Validator::make($data, $rules);
		if( $val->fails() ) {
			Session::flash('status', 'new-board-fail');
			return Redirect::to('/')
				->with_input()
				->with_errors($val);
		}
		else
		{
			if( !isset($data['position'])) {
				$data['position'] = 1;
			}
			// make the board
			$board = new Board();
			$board->name = $data['name'];
			$board->description = $data['description'];
			$board->position 	= $data['position'];
			$board->save();
			return Redirect::to('/');
		}
	}

	/**
	 * View a board
	 *
	 * List all the threads in the board
	 */
	public function get_view($board_id) {
		// get all the threads for this board
		$threadlist = DB::table('threads')
			->join('users', 'threads.user_id', '=', 'users.id')
			->where('threads.board_id', '=', $board_id)
			->order_by('threads.updated_at', 'desc')
			->paginate(10, array(
				'threads.id', 'threads.user_id', 'threads.subject',
				'threads.postcount','threads.created_at', 'users.username',
			));
		// get this board
		$board = Board::find($board_id);
		return View::make('thread-list')
			->with('threadlist', $threadlist)
			->with('board', $board);
	}
}