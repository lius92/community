<?php
namespace Modules\Admin\Http\Controllers\Org;

use Illuminate\Http\Request;
use Modules\Admin\Http\Controllers\BaseController;

class CompanyController extends BaseController
{
    public function get($id)
    {
        $data = [
            'id' => $id
        ];
        return $this->success($data);
    }

    public function getList(Request $request)
    {
        $pageIndex = $request->get('pageIndex', 0);
        $pageSize = $request->get('pageSize', 10);

        $data = [
            'id' => $pageSize
        ];
        return $this->success($data);
    }

    public function create(Request $request)
    {

    }

    public function update(string $id, Request $request)
    {

    }

    public function delete(string $id)
    {

    }

}