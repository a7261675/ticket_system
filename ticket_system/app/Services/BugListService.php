<?php

namespace App\Services;

use App\Repositories\BugListRepository;

class BugListService
{
	/**
	 * @var BugListRepository
	 */
	private $bugListRepository;

	function __construct(BugListRepository $bugListRepository)
	{
		$this->bugListRepository = $bugListRepository;
	}

	public function addBugList($conditions = [])
	{
		return $this->bugListRepository->addBugList($conditions);
	}

	public function modifyBugList($conditions = [])
	{
		$bug_data = $this->bugListRepository->getById($conditions['id']);

		if(empty($bug_data)) {
			return "BUG has been deleted.";
		}

		if($bug_data['is_solved'] == 1) {
			return "BUG has been solved.";
		}

		return $this->bugListRepository->modifyBugList($conditions);
	}

	public function deleteBugList($bug_list_id)
	{
		return $this->bugListRepository->deleteBugList($bug_list_id);
	}

	public function solveBugList($conditions = [])
	{
		$bug_data = $this->bugListRepository->getById($conditions['id']);

		if(empty($bug_data)) {
			return "BUG has been deleted.";
		}

		if($bug_data['summary'] != $conditions['summary']) {
			return "BUG summary has been changed.";
		}

		if($bug_data['description'] != $conditions['description']) {
			return "BUG description has been changed.";
		}

		return $this->bugListRepository->solveBugList($bug_list_id);
	}

	public function getBugList()
	{
		return $this->bugListRepository->getBugList();
	}
}