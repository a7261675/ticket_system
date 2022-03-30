<?php

namespace App\Repositories;

use App\Models\BugList;

class BugListRepository
{

    /**
     * @var BugList
     */
    private $bugList;

    public function __construct(BugList $bugList)
    {
        $this->bugList = $bugList;
    }

    public function addBugList($conditions = []): int
    {
        return $this->bugList->insertGetId($conditions);
    }

    public function modifyBugList($conditions = []): int
    {
        return $this->bugList->where('id', $conditions['id'])->update(['summary' => $conditions['summary'], 'description' => $conditions['description']]);
    }

    public function deleteBugList($bug_list_id): int
    {
        return $this->bugList->where('id', $bug_list_id)->delete();
    }

    public function solveBugList($bug_list_id): int
    {
        return $this->bugList->where('id', $bug_list_id)->update(['is_solved' => 1]);
    }

    public function getBugList(): array
    {
        return $this->bugList->get()->toArray();
    }

    // public function getRewardGiftRecord($acc_id, $language_id, $reward_status): array
    // {
    //     return $this->rewardGiftRecord
    //             ->where(
    //                 [
    //                     'acc_id' => $acc_id, 
    //                     'language_id' => $language_id, 
    //                     'tc_reward_status' => $reward_status
    //                 ]
    //             )
    //             ->orderBy('tc_reward_record_id', 'DESC')
    //             ->get()
    //             ->toArray();
    // }

    // public function getRewardGiftRecordByIds($reward_record_ids): array
    // {
    //     return $this->rewardGiftRecord
    //             ->whereIn('tc_reward_record_id', $reward_record_ids)
    //             ->get()
    //             ->toArray();
    // }

    // public function deleteRewardGiftRecord($reward_record_id): int
    // {
    //     return $this->rewardGiftRecord
    //             ->where('tc_reward_record_id', $reward_record_id)
    //             ->delete();
    // }

}
