<?php

namespace App\Http\Controllers;

use Exception;
use App\Services\BugListService;
use App\Http\Requests\BugList\AddBugListRequest;
use App\Http\Requests\BugList\ModifyBugListRequest;
use App\Http\Requests\BugList\DeleteBugListRequest;
use App\Http\Requests\BugList\SolveBugListRequest;

/**
 * @OA\Info(title="BugList API", version="0.1")
 */
class BugListController extends Controller
{
    /**
     * @var BugListService
     */
    private $bugListService;

    public function __construct(BugListService $bugListService)
    {
        $this->bugListService = $bugListService;
    }


    /**
     * @OA\Post(
     *     path="/bug_list/add",
     *     @OA\RequestBody(
     *      required=true,
     *      description="新增BUG單。",
     *      @OA\MediaType(
     *          mediaType="application/x-www-form-urlencoded",
     *          @OA\Schema(
     *          required={"summary", "description"},
     *          type="object",
     *              @OA\Property(property="summary", description="BUG總括", type="string", example="按鈕未出現"),
     *              @OA\Property(property="description", description="BUG描述", type="string", example="連點五下時，按鈕未出現"),
     *          ),
     *      )
     *  ),
     *     @OA\Response(
     *          response="200", 
     *          description="新增成功",
     *          @OA\JsonContent(
     *              type = "object",
     *              @OA\Property(property="bug_list_id", description="新增的BUG單ID", type="integer", default="1")
     *          )
     *      )
     * )
     */
    public function addBugList(AddBugListRequest $request)
    {
        $bug_list_id = $this->bugListService->addBugList(['summary' => $request->summary, 'description' => $request->description]);

        return response()->json(['bug_list_id' => $bug_list_id]);
    }

    /**
     * @OA\Post(
     *     path="/bug_list/modify",
     *     @OA\RequestBody(
     *      required=true,
     *      description="修改BUG單。",
     *      @OA\MediaType(
     *          mediaType="application/x-www-form-urlencoded",
     *          @OA\Schema(
     *          required={"id", "summary", "description"},
     *          type="object",
     *              @OA\Property(property="id", description="BUG單ID", type="integer", example="1"),
     *              @OA\Property(property="summary", description="BUG總括", type="string", example="按鈕未出現"),
     *              @OA\Property(property="description", description="BUG描述", type="string", example="連點五下時，按鈕未出現"),
     *          ),
     *      )
     *  ),
     *     @OA\Response(
     *          response="200", 
     *          description="修改成功",
     *          @OA\JsonContent(
     *              type = "object",
     *              @OA\Property(property="result", description="修改的BUG單ID", type="integer", default="1")
     *          )
     *      )
     * )
     */
    public function modifyBugList(ModifyBugListRequest $request)
    {
        $modify_bug_result = $this->bugListService->modifyBugList(['id' => $request->id, 'summary' => $request->summary, 'description' => $request->description]);

        return response()->json(['result' => $modify_bug_result]);
    }


    /**
     * @OA\Delete(
     *     path="/bug_list/delete",
     *     @OA\RequestBody(
     *      required=true,
     *      description="刪除BUG單。",
     *      @OA\MediaType(
     *          mediaType="application/x-www-form-urlencoded",
     *          @OA\Schema(
     *          required={"id"},
     *          type="object",
     *              @OA\Property(property="id", description="BUG單ID", type="integer", example="1"),
     *          ),
     *      )
     *  ),
     *     @OA\Response(
     *          response="200", 
     *          description="刪除成功",
     *          @OA\JsonContent(
     *              type = "object",
     *              @OA\Property(property="result", description="修改的BUG單ID", type="integer", default="1")
     *          )
     *      )
     * )
     */
    public function deleteBugList(DeleteBugListRequest $request)
    {
        $delete_bug_result = $this->bugListService->deleteBugList($request->id);

        return response()->json(['result' => $delete_bug_result]);
    }


    /**
     * @OA\Post(
     *     path="/bug_list/solve",
     *     @OA\RequestBody(
     *      required=true,
     *      description="解BUG單。",
     *      @OA\MediaType(
     *          mediaType="application/x-www-form-urlencoded",
     *          @OA\Schema(
     *          required={"id"},
     *          type="object",
     *              @OA\Property(property="id", description="BUG單ID", type="integer", example="1"),
     *          ),
     *      )
     *  ),
     *     @OA\Response(
     *          response="200", 
     *          description="解BUG成功",
     *          @OA\JsonContent(
     *              type = "object",
     *              @OA\Property(property="result", description="修改的BUG單ID", type="integer", default="1")
     *          )
     *      )
     * )
     */
    public function solveBugList(SolveBugListRequest $request)
    {
        $solve_bug_result = $this->bugListService->solveBugList(['id' => $request->id, 'summary' => $request->summary, 'description' => $request->description]);

        return response()->json(['result' => $solve_bug_result]);
    }

    /**
     * @OA\Get(
     *     path="/bug_list/get",
     *      @OA\Response(
     *          response=200,
     *          description="取得BUG單列表",
     *          @OA\JsonContent(
     *              type = "object",
     *              @OA\Property(
     *                  property="data",
     *                  description="響應數據",
     *                  type="object",
     *                  @OA\Property(
     *                      property="record",
     *                      description="BUG單列表",
     *                      type="array",
     *                      @OA\Items(
     *                          @OA\Property(property="id", description="BUG單ID", type="integer", example="1"),
     *                          @OA\Property(property="summary", description="BUG總括", type="string", example="畫面閃退"),
     *                          @OA\Property(property="description", description="BUG描述", type="string", example="長按畫面後連續關閉視窗，畫面會閃退"),
     *                          @OA\Property(property="is_solved", description="BUG是否被解掉", type="integer", example="0"),
     *                          @OA\Property(property="update_at", description="BUG更新時間", type="string", example="2022-03-30T18:59:20.000000Z"),
     *                      )
     *                  ),
     *              )
     *          )
     *      )
     * )
     */
    public function getBugList()
    {
        $bug_list = $this->bugListService->getBugList();

        return response()->json(['record' => $bug_list]);
    }
}
