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
		return $this->bugListRepository->modifyBugList($conditions);
	}

	public function deleteBugList($bug_list_id)
	{
		return $this->bugListRepository->deleteBugList($bug_list_id);
	}

	public function solveBugList($bug_list_id)
	{
		return $this->bugListRepository->solveBugList($bug_list_id);
	}

	public function getBugList()
	{
		return $this->bugListRepository->getBugList();
	}
}